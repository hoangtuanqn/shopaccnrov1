<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'THÊM THẺ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id']))  {
    $row = $TUANORI->get_row(" SELECT * FROM `category_banthe` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        msg_error_ad("Nhà mạng này không tồn tại", BASE_URL(''), 1000);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['btnUpload']) && $getUser['level'] == 'admin' ) {
    $menhgia  = check_string($_POST['menhgia']);
    $the        = check_string($_POST['the']);
    if(!$menhgia || !$the) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 1000);
    }
    $i = 0;
    foreach(explode("\n", $the) as $ok) {
        $TUANORI->insert("list_khothe", array(
            'loaithe'   => $row['nhamang'],
            'menhgia'   => $menhgia,
            'thongtin'       => $ok
        ));
        ++$i;
    }
    msg_success_ad("Đã thêm thành công $i thẻ vào hệ thống", '', 1000);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm thẻ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-6">
                <div class="mb-3">
                    <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/SettingMuaThe');?>"
                        type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
                </div>
            </section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM THẺ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhà mạng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" placeholder="Nhà mạng" value="<?=$row['nhamang'];?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mệnh giá</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="custom-select" name="menhgia">
                                            <?php  foreach(explode("\n", $row['menhgia']) as $ok) { ?>
                                                <option value="<?=$ok;?>"><?=format_cash($ok);?>đ</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông tin thẻ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="the" placeholder="Mã thẻ | Seri | Thông tin khác" rows="6"></textarea>
                                        <i>Có thể thêm nhiều thẻ 1 lúc, mỗi thông tin trên 1 hàng.</i>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnUpload" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>
                            
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(function() {
                    // Summernote
                    $('.textarea').summernote()

                    //Colorpicker
                    $('.my-colorpicker1').colorpicker()
                    //color picker with addon
                    $('.my-colorpicker2').colorpicker()

                    $('.my-colorpicker2').on('colorpickerChange', function(event) {
                        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                    });
                })
            </script>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">200 DANH SÁCH THẺ</h3>
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
                                        <th>NHÀ MẠNG</th>
                                        <th>THÔNG TIN</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `list_khothe` WHERE `loaithe` = '".$row['nhamang']."' ORDER BY id DESC LIMIT 200 ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td><b><?=$row['loaithe'];?></b></td>
                                        <td>
                                            <ul>
                                                <li>Mệnh giá: <b style="color:red"><?=number_format($row['menhgia']);?></b></li>
                                                <li>Thông tin thẻ: <b style="color:black"><?=$row['thongtin'];?></b></li>
                                                <?php if($row['username']) { ?>
                                                    <li>Người mua: <b><?=$row['username'];?></b></li>
                                                    <li>Vào lúc: <b><?=intg(strtotime($row['username']));?></b></li>
                                                <?php }?>
                                            </ul>
                                        </td>
                                        <td><?=status_category($row['status']);?></td>
                                        <td>
                                            <a aria-label="" href="/Admin/EditThe/<?=$row['id'];?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit mr-1"></i></i><span class="">EDIT</span>
                                            </a>
                                            <button style="color:white;" onclick="RemoveRow(<?=$row['id']?>, '<?=$row['loaithe']?>')"
                                                class="btn btn-danger btn-sm btn-icon-left m-b-10"
                                                type="button">
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
            url: "/controller/admin/DeleteThe.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire("Thông Báo","Đã xóa thành công thẻ: " + username, "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire("Thông Báo", "Đã xảy ra lỗi khi xoá thẻ: " + username, "success");
                }
            }
        });
    }
    function RemoveRow(id, username) {
        if (confirm("Bạn đã chắc chắn xóa chưa, vì không thể nào khôi phục lại được đó?")) 
        postRemove(id, username);
    }
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable2").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>