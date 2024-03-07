
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $slug = check_string($_GET['slug']);
    $tt = $TUANORI->get_row(" SELECT * FROM `category_dichvu` WHERE `slug` = '$slug' AND `status` = '1'");
    if(!$tt) {
        header("Location: /");
        die;
    }
    $title = $tt['title'] ?? "404";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();
?>
    <div class="c-layout-page">
        <!-- BEGIN: PAGE CONTENT -->



        <div class="c-content-box c-size-lg c-overflow-hide c-bg-white font-roboto">

            <div class="container">
                <div class="alert alert-info">
                    <div class="row">
                        <div class="col-md-12 header-title-buy">
                            <div class="content_post">
                               <?=$tt['mota']?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center" style="margin-bottom: 50px;">
                <h2 style="font-size: 30px;font-weight: bold;text-transform: uppercase">DỊCH VỤ <?=$tt['title'];?></h2>
                <div class="row  hidden-sm hidden-md hidden-lg">
                </div>
            </div>
            
            <form>
                <div class="container detail-service">


                    <div class="col-md-7" style="margin-bottom:20px;">

                        <div class="row-flex-safari service-info">
                            <div class="col-md-5 hidden-xs hidden-sm">
                                <div class="row">
                                    <div class="news_image">
                                        <img src="<?=$tt['img'];?>" alt="<?=$tt['title'];?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <p style="margin-top: 15px" class="bb"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?=$tt['title'];?></p>
                                  

                                </div>
                            </div>
                            <div class="col-md-7">

                                <span class="mb-15 control-label bb">Chọn máy chủ:</span>
                                <div class="mb-15">
                                    <select name="server" id="server" class="server-filter form-control t14" style="">
                                        <option value="">Chọn máy chủ </option>
                                        <?php foreach(json_decode($tt['server'], true) as $sv) { ?>
                                            <option value="<?=$sv;?>">Vũ trụ <?=$sv;?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <span class="mb-15 control-label bb">Chọn dịch vụ:</span>
                                <div class="mb-15">
                                    <select name="dichvu" id="dichvu" class="server-filter form-control t14" style="">
                                        <option value="">Vui lòng chọn máy chủ</option>
                                    </select>
                                </div>
                                <span class="mb-15 control-label bb">Mã giảm giá:</span>
                                <div class="mb-15">
                                    <input class="server-filter form-control" id="mgg" type="text" placeholder="Mã giảm giá (Nếu có)" value=""/>
                                </div>



                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="row emply-btns">
                            <div class="col-md-8 col-md-offset-2">
                                <div class=" emply-btns text-center">
                                    <a id="txtPrice" style="font-size: 20px;font-weight: bold" class="">Tổng: 0đ</a>
                                    <?php if(empty($_COOKIE['token'])) { ?>
                                        <a style="font-size: 20px;" class="followus" href="/login" title=""><i class="fa fa-key" aria-hidden="true"></i> Đăng nhập để thanh toán</a>
                                    <?php } else { ?>
                                        <button id="btnPurchase" type="button" style="font-size: 20px;" class="followus"><i class="fa fa-credit-card" aria-hidden="true"></i> Thanh toán</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="homealert" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="loader" style="text-align: center"><img src="/assets/frontend/images/loader.gif" style="width: 50px;height: 50px;display: none">
                        </div>
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Xác nhận thông tin thanh toán</h4>

                            </div>
                            <div class="modal-body">
                                
                                <span class="mb-15 control-label bb">Tài Khoản:</span>
                                
                                <div class="mb-15">
                                    <input type="text" required name="customer_data0" id="taikhoan" class="form-control t14 " placeholder="Tài Khoản" value="">
                                </div>
                                
                                
                                <span class="mb-15 control-label bb">Mật Khẩu:</span>
                                
                                <div class="mb-15">
                                    <input type="password" required class="form-control" id="matkhau" name="customer_data1" placeholder="Mật Khẩu">
                                </div>
                                <div id="error"></div>





                            </div>
                            <div class="modal-footer">

                                <button type="button" id="Thanhtoan" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" id="d3" style="">Xác nhận thanh toán</button>


                                <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>

                            </div>


                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                     $(document).ready(function () {
                        $('#btnPurchase').click(function () {

                            $('#homealert').modal('show');
                        });
                    });


                    function Confirm(index, serverid) {
                        $('[name="server"]').val(serverid);
                        $('[name="selected"]').val(index);
                        $('#btnPurchase').click();
                    }

                    $('#server').change(function() {
                        $.ajax({
                            url: "/controller/view/Dichvu.php",
                            method: "GET",
                            data: {
                                id: <?=$tt['id'];?>,
                                server: $("#server").val()
                            },
                            success: function(response) {
                                $("#dichvu").html(response);
                                $("#txtPrice").html('Tổng: 0đ');

                            }
                        });
                    });
                    
                    // Lắng nghe sự kiện input cho cả hai trường "mgg" và "dichvu"
                    $('[id="mgg"], #dichvu').on('input', function() {
                        var ketqua = 'Đang tính thực nhận';
                        document.getElementById("txtPrice").value = (ketqua.toString().replace(/(.)(?=(\d{3})+$)/g, '$1.'));
                        sendRequest(); // Gọi hàm để gửi request
                    });

                    // Hàm gửi request
                    function sendRequest() {
                        $.ajax({
                            url: "/controller/client/Tinhtien.php",
                            method: "POST",
                            data: {
                                id: <?=$tt['id'];?>,
                                server: $("#server").val(),
                                dichvu: $("#dichvu").val(),
                                coupon: $("#mgg").val()
                            },
                            success: function(response) {
                                $("#txtPrice").html(response);
                            }
                        });
                    }

                $("#Thanhtoan").on("click", function() {

                    $('#Thanhtoan').html('Đang xử lý...').prop('disabled',
                        true);
                    $.ajax({
                        url: "/controller/client/Dichvu.php",
                        method: "POST",
                        data: {
                            id: <?=$tt['id'];?>,
                            server: $("#server").val(),
                            dichvu: $("#dichvu").val(),
                            taikhoan: $("#taikhoan").val(),
                            matkhau: $("#matkhau").val(),
                            coupon: $("#mgg").val()
                        },
                        success: function(response) {
                            $("#error").html(response);
                            $('#Thanhtoan').html(
                                    ' XÁC NHẬN THANH TOÁN')
                                .prop('disabled', false);
                        }
                    });
                });
                </script>

                <div class="modal fade" id="homealert" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="loader" style="text-align: center"><img src="/assets/frontend/images/loader.gif" style="width: 50px;height: 50px;display: none">
                        </div>
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Xác nhận thông tin thanh toán</h4>

                            </div>

                            <div class="modal-body">

                                <span class="mb-15 control-label bb">Tài Khoản:</span>

                                <div class="mb-15">
                                    <input type="text" required name="customer_data0" class="form-control t14 " placeholder="Tài Khoản" value="">
                                </div>


                                <span class="mb-15 control-label bb">Mật Khẩu:</span>

                                <div class="mb-15">
                                    <input type="password" required class="form-control" name="customer_data1" placeholder="Mật Khẩu">
                                </div>





                            </div>
                            <div class="modal-footer">

                                <a class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" href="/login">Đăng nhập</a>

                                <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>

                            </div>


                        </div>
                    </div>
                </div>


            </form>

            <div class="container">
                <div class="job-wide-devider">





                </div>
            </div>




        </div>

<?php 
    require_once("../../pages/client/Footer.php");
?>