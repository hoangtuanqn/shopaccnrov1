<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'TÍCH HỢP LOGIN GOOGLE | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_POST['btnSaveOption'])) {
    foreach ($_POST as $key => $value)
    {
        $TUANORI->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
    msg_success_ad('Lưu thành công', '', 500);
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>THÔNG TIN</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Client ID</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="id_google" value="<?=$TUANORI->site('id_google');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Client secret</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" name="key_google" value="<?=$TUANORI->site('key_google');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Url chuyển  hướng hợp lệ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=BASE_URL('LoginGOOGLE');?>"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="status_google" required>
                                            <option value="1" <?=($TUANORI->site('status_google') == 1) ? 'selected' : '';?>>BẬT TÍNH NĂNG</option>
                                            <option value="0" <?=($TUANORI->site('status_google') == 0) ? 'selected' : '';?>>TẮT TÍNH NĂNG</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
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





<?php 
    require_once("./Footer.php");
?>