<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'MÃ GIẢM GIÁ | '.$TUANORI->site('title');
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
                    <h1>MÃ GIẢM GIÁ HIỆN HÀNH</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-6"></section>
            <section class="col-lg-6 text-right">
                <div class="mb-3">
                    <a class="btn btn-primary btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Add-Coupon');?>"
                        type="button"><i class="fas fa-plus-circle mr-1"></i>Thêm mã giảm giá</a>
                </div>
            </section>
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
                                        <th>MÃ</th>
                                        <th>LƯỢT DÙNG BAN ĐẦU</th>
                                        <th>ĐÃ DÙNG</th>
                                        <th>GIẢM</th>
                                        <th>THỂ LOẠI</th>
                                        <th>TẠO LÚC</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `coupon` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td style="color: green; font-weight: bold"><?=$row['code'];?></td></td>
                                        <td><span class="badge badge-info"><?=format_cash($row['luotdung']);?></span></td>
                                        <td><span class="badge badge-danger"><?=format_cash($row['luotdung'] - $row['conlai']);?></span></td>
                                        <td><span  class="badge badge-dark"><?=$row['giam'];?>%</span></td>
                                        <td><b><?=dichvu_shop($row['apply']);?></b></td>
                                        <td style="font-weight: bold"><?=intg(strtotime($row['thoigian']));?></td>
                                        <td>
                                            <a aria-label="" href="<?=BASE_URL('Admin/EditCoupon/'.$row['id']);?>"
                                                style="color:white;"
                                                class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                                            </a>
                                            <button style="color:white;" onclick="RemoveRow(<?=$row['id'];?>, '<?=$row['code'];?>')"
                                                class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-trash mr-1"></i><span class="">Delete</span>
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
            url: "/controller/admin/DeleteMgg.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire("Thông Báo","Đã xóa mã giảm giá: " + username, "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire("Thông Báo", "Đã xảy ra lỗi khi xóa mã: " + username, "success");
                }
            }
        });
    }
    function RemoveRow(id, username) {
        if (confirm("Bạn đã chắc chắn khi muốn xóa mã giảm giá: " + username + "?")) 
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