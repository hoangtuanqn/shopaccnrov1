<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CẤU HÌNH NHẬN THÔNG BÁO | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_POST['btnUpload']) || isset($_POST['btnUpload1'])) {
    foreach ($_POST as $key => $value)
    {
        $TUANORI->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
    msg_success_ad('Cập nhật thông tin thành công', '', 500);
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cấu hình</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NHẬN THÔNG BÁO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Telegram</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="id_tele" value="<?=$TUANORI->site('id_tele');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">KEY Telegram</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="key_tele" value="<?=$TUANORI->site('key_tele');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="status_tele" required>
                                            <option value="1" <?=($TUANORI->site('status_tele') == 1) ? 'selected' : '';?>>ON</option>
                                            <option value="0" <?=($TUANORI->site('status_tele') == 0) ? 'selected' : '';?>>OFF</option>
                                        </select> 
                                        <i>Bật/Tắt nhận thông báo qua Telegram, dành cho ADMIN.</i>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="email" value="<?=$TUANORI->site('email');?>"
                                            class="form-control">
                                        <i>Dùng để gửi Email cho thành viên (Quên MK, ...)</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mật khẩu (SMTP)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="pass_email" value="<?=$TUANORI->site('pass_email');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnUpload" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
         
          
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>




<script>
$(function() {
    // Summernote
    $('.textarea').summernote()
})
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once("./Footer.php");
?>