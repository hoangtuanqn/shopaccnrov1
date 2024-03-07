
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Đổi mật khẩu";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();
    
?>
    <div class="c-layout-page">
        <div class="c-layout-page" style="margin-top: 20px;">
            <div class="container">
                <?php
                    require_once("../../pages/client/Sidebar.php");
                ?>
                    <div class="c-content-title-1">
                        <h3 class="c-font-uppercase c-font-bold">ĐỔI MẬT KHẨU</h3>
                        <div class="c-line-left"></div>
                    </div>
                    <form class="form-horizontal" method="POST">
                        <input type="hidden" name="_token" value="7a19fbc0a0eb5af605cb45ff62913fd8">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nhập Mật khẩu cũ:</label>
                            <div class="col-md-6">
                                <input class="form-control  c-theme" id="mkcu"  type="password" placeholder="Nhập mật khẩu cũ" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nhập Mật khẩu mới:</label>
                            <div class="col-md-6">
                                <input class="form-control c-theme " type="password" id="mknew" placeholder="Nhập mật khẩu mới" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nhập lại mật khẩu mới:</label>
                            <div class="col-md-6">
                                <input class="form-control c-theme" id="mknew2" type="password" placeholder="Nhập lại mật khẩu mới">
                            </div>
                        </div>
                        <div class="form-group c-margin-t-40">
                            <div class="col-md-offset-3 col-md-6">
                                <button id="change" class="btn c-theme-btn c-btn-uppercase c-btn-bold btn-block btn-confirm">
                                    Đổi Mật Khẩu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<script type="text/javascript">
$("#change").on("click", function() {

    $('#change').html('Đang xử lý...').prop('disabled',
        true);
    $.ajax({
        url: "/controller/client/Doimatkhau.php",
        method: "POST",
        data: {
            mkcu: $("#mkcu").val(),
            mknew: $("#mknew").val(),
            mknew2: $("#mknew2").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#change').html(
                    ' Đổi Mật Khẩu')
                .prop('disabled', false);
        }
    });
});
</script>
<?php 
    require_once("../../pages/client/Footer.php");
?>