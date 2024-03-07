
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Đổi thông tin";
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
                    <div class="c-content-title-1" style="margin-top: 40px">
                        <h3 class="c-font-uppercase c-font-bold">THAY ĐỔI THÔNG TIN</h3>
                        <div class="c-line-left"></div>
                    </div>
                    <form class="form-horizontal" method="POST">

                        <div class="form-group">
                            <label class="col-md-3 control-label">Họ Tên:</label>
                            <div class="col-md-6">
                                <input class="form-control  c-theme" id="name" type="text" placeholder="Họ tên" required="" value="<?=$getUser['fullname']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email:</label>
                            <div class="col-md-6">
                                <input class="form-control c-theme " type="text" id="email" name="email" placeholder="" value="<?=$getUser['email'];?>">
                            </div>
                        </div>
                        <div class="form-group c-margin-t-40">
                            <div class="col-md-offset-3 col-md-6">
                                <button id="change" class="btn c-theme-btn c-btn-uppercase c-btn-bold btn-block btn-confirm">
                                    Đổi Thông Tin
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
        url: "/controller/client/UpdateInfo.php",
        method: "POST",
        data: {
            name: $("#name").val(),
            email: $("#email").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#change').html(
                    ' Đổi Thông Tin')
                .prop('disabled', false);
        }
    });
});
</script>
<?php 
    require_once("../../pages/client/Footer.php");
?>