
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    if(!$TUANORI->site('status_banvang')) {
        header("Location: /");
        die;
    }
    $title = 'DỊCH VỤ MUA THẺ';
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
?>
    <div class="c-layout-page">
        <!-- BEGIN: PAGE CONTENT -->



        <div class="c-content-box c-size-lg c-overflow-hide c-bg-white font-roboto">

            <div class="container">
                <div class="alert alert-info">
                    <div class="row">
                        <div class="col-md-12 header-title-buy">
                            <div class="content_post">
                                <?=$TUANORI->site('mota_banvang');?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center" style="margin-bottom: 50px;">
                <h2 style="font-size: 30px;font-weight: bold;text-transform: uppercase">DỊCH VỤ MUA THẺ</h2>
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
                                        <img src="<?=BASE_URL('uploads/img/mua-the.png');?>" alt="DỊCH VỤ MUA THẺ">
                                    </div>
                                </div>
                                <div class="row">
                                    <p style="margin-top: 15px" class="bb"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> DỊCH VỤ MUA THẺ</p>
                                  

                                </div>
                            </div>
                            <div class="col-md-7">

                                <span class="mb-15 control-label bb">Chọn nhà mạng:</span>
                                <div class="mb-15">
                                    <select name="loaithe" id="loaithe" class="server-filter form-control t14" style="" onchange="calculate()">
                                        <option value="">Chọn nhà mạng </option>
                                        <?php foreach($TUANORI->get_list(" SELECT * FROM `category_banthe` WHERE `status` = '1' ORDER BY id DESC") as $row){ ?>
                                            <option value="<?=$row['id'];?>"><?=$row['nhamang'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <span class="mb-15 control-label bb">Mệnh giá:</span>
                                <div class="mb-15">
                                    <select name="menhgia" id="menhgia" class="server-filter form-control t14" style="" onchange="calculate()">
                                        <option value="">Chọn nhà mạng trước</option>
                                    </select>
                                </div>

                                <span class="mb-15 control-label bb">Số lượng:</span>
                                <div class="mb-15">
                                    <input class="server-filter form-control" id="amount" type="text" placeholder="Số lượng thẻ muốn mua" value="1"/>
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
                                <h4 style="color: green; text-align: center; font-weight: bold">Vui lòng kiểm tra lại thông tin và bấm nút "XÁC NHẬN THANH TOÁN"</h4>
                                <div id="error"></div>
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


                    $('#loaithe').change(function() {
                        $.ajax({
                            url: "/controller/view/Menhgia.php",
                            method: "GET",
                            data: {
                                loaithe: $("#loaithe").val()
                            },
                            success: function(response) {
                                $("#menhgia").html(response);
                                sendRequest();

                            }
                        });
                    });
                    
                    // Lắng nghe sự kiện input cho cả hai trường "mgg" và "dichvu"
                    $('[id="amount"], #menhgia').on('input', function() {
                        var ketqua = 'Đang tính thực nhận';
                        document.getElementById("txtPrice").value = (ketqua.toString().replace(/(.)(?=(\d{3})+$)/g, '$1.'));
                        sendRequest(); // Gọi hàm để gửi request
                    });

                    // Hàm gửi request
                    function sendRequest() {
                        $.ajax({
                            url: "/controller/client/TienThe.php",
                            method: "POST",
                            data: {
                                loaithe: $("#loaithe").val(),
                                menhgia: $("#menhgia").val(),
                                amount: $("#amount").val()
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
                        url: "/controller/client/Muathe.php",
                        method: "POST",
                        data: {
                            loaithe: $("#loaithe").val(),
                            menhgia: $("#menhgia").val(),
                            amount: $("#amount").val()
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
               
    

            </form>

        </div>

<?php 
    require_once("../../pages/client/Footer.php");
?>