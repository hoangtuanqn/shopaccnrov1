
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Đăng ký thành viên";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
?>
    <div class="c-layout-page">
        <!-- BEGIN: PAGE CONTENT -->
        <div class="login-box">

            <!-- /.login-logo -->
            <div class="login-box-body box-custom">
                <p class="login-box-msg">Đăng Ký Thành Viên</p>
                <span class="help-block" style="text-align: center;color: #dd4b39">
                       <strong></strong>
                </span>
                <span class="help-block" style="text-align: center;color: #dd4b39">
                       <strong></strong>
                </span>

                <form>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" id="name" value="" placeholder="Tên hiển thị" autofocus required>
                        <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" id="taikhoan" value="" placeholder="Tài khoản đăng nhập" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" id="email" value="" placeholder="Email (dùng để quên MK)">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                  
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control"  id="matkhau" placeholder="Mật khẩu" value="" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

           
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" id="matkhau2" value="" placeholder="Xác nhận mật khẩu" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    </div>


                    <div class="form-group has-feedback">
                        <font style="font-size:12px; font-weight: 100;"><i class="icon-check"></i>&nbsp;&nbsp;Bằng cách nhấp vào Đăng ký, bạn đồng ý với <a href="chinhsach/index.html" target="_blank" style="font-weight: 500;">Điều khoản</a>, <a href="chinhsach/index.html" target="_blank" style="font-weight: 500;">Chính sách dữ liệu</a> và <a href="chinhsach/index.html" target="_blank" style="font-weight: 500;">Chính sách cookie</a> của chúng tôi. </font>
                    </div>

                    <div class="row">

                        <!-- /.col -->
                        <div class="col-xs-12">
                            <button type="button" id="Register" class="btn btn-primary btn-block btn-flat" style="margin: 0 auto;">Đăng Ký</button>
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
                        Đăng Ký Bằng Zalo
                    </a>
                    <?php endif;?>
                    <?php if($TUANORI->site('status_google')): ?>
                        <a href="<?=BASE_URL('LoginGOOGLE');?>" class="btn btn-social btn-danger btn-block btn-flat" style="margin-bottom: 5px; margin-left: 0px;">
                            <i class="fa-brands fa-google"></i>
                            Đăng Ký Bằng Google
                        </a>
                    <?php endif;?>
                    <hr/>
                    <a href="<?=BASE_URL('login');?>" class="btn btn-social btn-google btn-block btn-flat" style="margin-bottom: 5px; margin-left: 0px;"><i class="icon-key icons"></i>Đăng Nhập Tài Khoản</a>
                </div>  
                <!-- /.social-auth-links -->
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- END: PAGE CONTENT -->
    </div>

<script type="text/javascript">
$("#Register").on("click", function() {

    $('#Register').html('Đang xử lý...').prop('disabled',
        true);
    $.ajax({
        url: "/controller/client/Register.php",
        method: "POST",
        data: {
            name: $("#name").val(),
            email: $("#email").val(),
            taikhoan: $("#taikhoan").val(),
            matkhau: $("#matkhau").val(),
            matkhau2: $("#matkhau2").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Register').html(
                    ' Đăng Ký')
                .prop('disabled', false);
        }
    });
});
</script>
<?php 
    require_once("../../pages/client/Footer.php");
?>
   