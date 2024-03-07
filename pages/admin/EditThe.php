<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'EDIT THẺ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id']))  {
    $row = $TUANORI->get_row(" SELECT * FROM `list_khothe` WHERE `id` = '".check_string($_GET['id'])."'  ");
    $row2 = $TUANORI->get_row(" SELECT * FROM `category_banthe` WHERE `nhamang` = '".$row['loaithe']."'  ");
    if(!$row)
    {
        msg_error_ad("Loại thẻ này không tồn tại", BASE_URL(''), 1000);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['btnUpload'])) {
    $menhgia  = check_string($_POST['menhgia']);
    $the        = check_string($_POST['the']);
    if(!$menhgia || !$the) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 1000);
    }
    $TUANORI->update("list_khothe", array(
        'menhgia'   => $menhgia,
        'thongtin'  => $the
    ), " `id` = '".$row['id']."' ");
    msg_success_ad("Đã cập nhật thẻ thành công", '', 1000);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit thẻ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-6">
                <div class="mb-3">
                    <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/AddThe/'.$TUANORI->get_row(" SELECT * FROM `category_banthe` WHERE `nhamang` = '".$row['loaithe']."'  ")['id']);?>"
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
                                        <input type="text" placeholder="Nhà mạng" value="<?=$row['loaithe'];?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mệnh giá</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="custom-select" name="menhgia">
                                            <?php  foreach(explode("\n", $row2['menhgia']) as $ok) { ?>
                                                <option value="<?=$ok;?>" <?=($row['menhgia'] == $ok) ? 'selected' : ''?>><?=format_cash($ok);?>đ</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông tin thẻ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" placeholder="Nhà mạng" name="the" value="<?=$row['thongtin'];?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnUpload" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT NGAY</span></button>
                            
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