<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'EDIT RÚT VÀNG | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `history_rutvang` WHERE `id` = '".check_string($_GET['id'])."'   ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['btnUpload'])) {
    $username   = check_string($_POST['username']);
    $tennv      = check_string($_POST['tennv']);
    $server     = check_string($_POST['server']);
    $vang       = check_string(numb($_POST['vang']));
    $note       = check_string($_POST['note']);
    $status     = check_string($_POST['status']);
    if(!$username || !$tennv || !$server || !$vang) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    if($row['status'] == 2) {
        msg_error_ad("Đơn này đã được hủy từ trước rồi, không thể thao tác", "", 1000);
    } 
    if($status == 2) {
        $TUANORI->cong("users", "iteam", $row['vang'], " `username` = '".$row['username']."' ");
    }
    $TUANORI->update("history_rutvang", array(
        'username'  => $username,
        'tennv'     => $tennv, 
        'server'    => $server,
        'vang'      => $vang,
        'note'      => $note,
        'status'    => $status
    ), " `id` = '".check_string($_GET['id'])."' ");
    msg_success_ad("Cập nhật đơn rút thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh Sửa đơn</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Rutvang');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Người rút</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="username" value="<?=$row['username'];?>" class="form-control" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên nhân vật</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="tennv" value="<?=$row['tennv'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Máy chủ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="server" value="<?=$row['server'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vàng rút</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="vang" placeholder="Vàng rút" value="<?=format_cash($row['vang']);?>" class="form-control fnum" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ghi chú từ ADMIN</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="note" rows="6"><?=$row['note'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1" <?=($row['status'] == 1) ? 'selected' :  '';?>>Thành Công</option>
                                        <option value="0" <?=($row['status'] == 0) ? 'selected' :  '';?>>Chờ xử lý</option>
                                        <option value="2" <?=($row['status'] == 2) ? 'selected' :  '';?>>Hủy đơn</option>
                                    </select>
                                    <i>Sau khi hủy hệ thống sẽ cộng lại vàng cho người dùng</i>
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