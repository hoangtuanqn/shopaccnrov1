
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    if($getUser['level'] != 'admin') {
        header("Location: /");
        die;
    }
    $title = "Đăng nhập vào ADMIN";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
?>
    <div class="c-layout-page">
        <!-- BEGIN: PAGE CONTENT -->
        <div class="login-box">

            <!-- /.login-logo -->
            <div class="login-box-body box-custom">
                <p class="login-box-msg">Đăng Nhập Quản Trị</p>
                <span class="help-block" style="text-align: center;color: #dd4b39">
                       <strong></strong>
                </span>

                <span class="help-block" style="text-align: center;color: #dd4b39">
                       <strong></strong>
                </span>

                <form >


                   
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" id="matkhau"  placeholder="Mật khẩu Cấp 2" value="" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <i style="color: red">Sai quá <?=$getUser['saimkad'];?> lần, cấm vĩnh viễn ADMIN</i>
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
        url: "/controller/admin/LoginAdmin.php",
        method: "POST",
        data: {
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
   