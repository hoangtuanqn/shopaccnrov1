
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Đăng nhập thành viên";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
?>
    <div class="c-layout-page">
        <!-- BEGIN: PAGE CONTENT -->
        <div class="login-box">

            <!-- /.login-logo -->
            <div class="login-box-body box-custom">
                <p class="login-box-msg">Đăng Nhập Hệ Thống</p>
                <span class="help-block" style="text-align: center;color: #dd4b39">
                       <strong></strong>
                </span>

                <span class="help-block" style="text-align: center;color: #dd4b39">
                       <strong></strong>
                </span>

                <form >

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" id="taikhoan"  value="" placeholder="Tài khoản" autofocus required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                   
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" id="matkhau"  placeholder="Mật khẩu" value="" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    </div>
                   
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="checkbox icheck">
                                <label style="color: #666">
                                    <input type="checkbox" name="remember" id="remember" value="remember-login" checked> Ghi nhớ
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6" style="text-align: right">
                            <a href="resetpassword.html" style="color: #666;margin-top: 10px;display: block;">Bạn quên mật khẩu?</a>
                            <br>
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="row">

                        <!-- /.col -->
                        <div class="col-xs-12">
                            <button type="button" id="Login" class="btn btn-primary btn-block btn-flat" style="margin: 0 auto;">
                                Đăng Nhập
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p style="margin-top: 10px">- HOẶC -</p>
                    <?php if($TUANORI->site('status_zalo')): ?>
                    <!--a href="/fblogin/" class="btn btn-social btn-facebook btn-block btn-flat" style="margin-bottom: 5px; margin-left: 0px;"><i class="icon-social-facebook icons"></i>Đăng Nhập Bằng Facebook</a-->
                    <a href="<?=BASE_URL('LoginZALO');?>" class="btn btn-social btn-primary btn-block btn-flat" style="margin-bottom: 5px; margin-left: 0px;">
                        <i class="icon-globe icons"></i>
                        Đăng Nhập Bằng Zalo
                    </a>
                    <?php endif;?>
                    <?php if($TUANORI->site('status_google')): ?>
                        <a href="<?=BASE_URL('LoginGOOGLE');?>" class="btn btn-social btn-danger btn-block btn-flat" style="margin-bottom: 5px; margin-left: 0px;">
                            <i class="fa-brands fa-google"></i>
                            Đăng Nhập Bằng Google
                        </a>
                    <?php endif;?>
                    <hr/>
                    <a href="/register" class="btn btn-social btn-google btn-block btn-flat" style="margin-bottom: 5px; margin-left: 0px;"><i class="icon-key icons"></i>Đăng Ký Tài Khoản</a>
                </div>
                <!-- /.social-auth-links -->
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- END: PAGE CONTENT -->
    </div>
    
<script type="text/javascript">
$("#Login").on("click", function() {

    $('#Login').html('Đang xử lý...').prop('disabled',
        true);
    $.ajax({
        url: "/controller/client/Login.php",
        method: "POST",
        data: {
            taikhoan: $("#taikhoan").val(),
            matkhau: $("#matkhau").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Login').html(
                    ' Đăng Nhập')
                .prop('disabled', false);
        }
    });
});
</script>
<?php 
    require_once("../../pages/client/Footer.php");
?>
   