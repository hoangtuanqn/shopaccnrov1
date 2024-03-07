<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'DANH SÁCH IP BỊ CHẶN | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
  
<?php
if(isset($_POST['btnUpload']) ) {
    $ip     = check_string(trim($_POST['ip']));
    $note   = check_string($_POST['note']);
    $time   = check_string($_POST['time']);
    if(!$ip || !$time) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    $TUANORI->insert("blockip", array(
        'ip'        => $ip,
        'amount'    => 1,
        'note'      => $note,
        'thoigian'  => gettime(),
        'anxa'      => gettime2(time() + $time)
    ));
    msg_success_ad("Block IP này thành công", '', 500);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DANH SÁCH IP BỊ CHẶN</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">THÊM IP CẦN BLOCK</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">IP muốn block</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <input type="text" name="ip" placeholder="1.1.1.1"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Thời gian ân xá</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <select class="custom-select" name="time">
                                                <option value="86400" >1 ngày</option>
                                                <option value="604800" >7 ngày</option>
                                                <option value="2592000" >1 tháng</option>
                                                <option value="31536000" >1 năm</option>
                                                <option value="86400000000" >Vĩnh Viễn</option>
                                            </select>
                                            <i>Hệ thống sẽ tự mở chặn nếu đủ thời gian khóa.</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Lý do chặn</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <textarea type="text" name="note" placeholder="Spam nhiều lần"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" name="btnUpload" class="btn btn-primary btn-block">
                                    <span>THÊM</span></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">THÔNG TIN CHI TIẾT</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>IP</th>
                                            <th>SỐ LẦN SPAM</th>
                                            <th>TRẠNG THÁI</th>
                                            <th>LÝ DO</th>
                                            <th>CHẶN LÚC</th>
                                            <th>MỞ CHẶN</th>
                                            <th>THAO TÁC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $i = 0;
                                        foreach($TUANORI->get_list(" SELECT * FROM `blockip` ORDER BY id DESC ") as $row){
                                        ?>
                                        <tr>
                                            <td><?=++$i;?></td>
                                            <td><?=$row['ip'];?></td>
                                            <td><?=$row['amount'];?></td>
                                            <td>
                                                <?php if(strtotime($row['anxa']) > time()) {
                                                    echo '<span class="badge badge-danger">Đang khóa</span>';
                                                } else {
                                                    echo '<span class="badge badge-success">Đã mở</span>';
                                                }
                                                ?>
                                            </td>
                                            <td><?=$row['note'];?></td>
                                            <td><?=intg(strtotime($row['thoigian']));?></td>
                                            <td><?=intg(strtotime($row['anxa']))?> - (<b style="color: red"><?=timeLater($row['anxa']);?></b>)</td>
                                            <td>
                                                <button style="color:white;" onclick="RemoveRow(<?=$row['id'];?>, '<?=$row['ip'];?>')"
                                                    class="btn btn-danger btn-sm btn-icon-left m-b-10"
                                                    type="button">
                                                    <i class="fas fa-trash mr-1"></i><span class="">Bỏ Chặn</span>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>


<script type="text/javascript">
    function postRemove(id,username) {
        $.ajax({
            url: "/controller/admin/DeleteIpBlack.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire("Thông Báo","Đã bỏ chặn cho ip: " + username, "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire("Thông Báo", "Đã xảy ra lỗi khi bỏ chặn ip: " + username, "success");
                }
            }
        });
    }
    function RemoveRow(id, username) {
        if (confirm("Bạn đã chắc chắn khi muốn bỏ chặn ip " + username + "?")) 
        postRemove(id, username);
    }
</script>

<script>
$(function() {
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>