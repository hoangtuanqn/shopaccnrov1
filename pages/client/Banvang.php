
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    if(!$TUANORI->site('status_banvang')) {
        header("Location: /");
        die;
    }
    $title = $TUANORI->site('title_banvang');
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
                <h2 style="font-size: 30px;font-weight: bold;text-transform: uppercase"><?=$TUANORI->site('title_banvang');?></h2>
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
                                        <img src="<?=$TUANORI->site('img_banvang');?>" alt="<?=$TUANORI->site('title_banvang');?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <p style="margin-top: 15px" class="bb"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?=$TUANORI->site('title_banvang');?></p>
                                  

                                </div>
                            </div>
                            <div class="col-md-7">

                                <span class="mb-15 control-label bb">Chọn máy chủ:</span>
                                <div class="mb-15">
                                    <select name="server" id="server" class="server-filter form-control t14" style="" onchange="calculate()">
                                        <option value="">Chọn máy chủ </option>
                                        <?php foreach(json_decode($TUANORI->site('server_banvang'), true)['maychu'] as $sv) { ?>
                                            <option value="<?=$sv;?>">Vũ trụ <?=$sv;?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <span class="mb-15 control-label bb">Số tiền muốn mua:</span>
                                <div class="mb-15">
                                    <input class="server-filter form-control t14" id="sotien" type="number" placeholder="Số tiền muốn mua" value="0"  oninput="calculate()" autofocus/>
                                    <i>Mua tối thiểu là <b><?=number_format($TUANORI->site('min_banvang'));?>đ</b> và tối đa là <b><?=number_format($TUANORI->site('max_banvang'));?>đ</b></i>
                                </div>

                                <span class="mb-15 control-label bb">Hệ số:</span>
                                <div class="mb-15">
                                    <input class="server-filter form-control t14" id="hesoInput" value="0" disabled/>
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
                                    <a id="txtPrice" style="font-size: 20px;font-weight: bold" class="">Tổng: 0 vàng</a>
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
                                
                            <span class="mb-15 control-label bb">Tên nhân vật nhận vàng:</span>

                                <div class="mb-15">
                                    <input type="text" required name="customer_data0" class="form-control t14 " id="tennv" placeholder="Tên nhân vật nhận vàng" value="">
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

                $("#Thanhtoan").on("click", function() {

                    $('#Thanhtoan').html('Đang xử lý...').prop('disabled',
                        true);
                    $.ajax({
                        url: "/controller/client/Banvang.php",
                        method: "POST",
                        data: {
                            server: $("#server").val(),
                            sotien: $("#sotien").val(),
                            tennv: $("#tennv").val(),
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
                <script>
                    function calculate() {
                        // Lấy giá trị số tiền từ input
                        var sotienInput = document.getElementById("sotien").value;
                        
                        // Lấy giá trị của server từ select
                        var selectedServer = document.getElementById("server").value;
                        
                        // Hệ số
                        var heso = {
                            "" : 'Chưa chọn máy chủ',
                            <?php $i = 0;
                            $ok = json_decode($TUANORI->site('server_banvang'), true);
                            for($i = 0; $i < count($ok['heso']); ++$i) { ?>
                                <?=$ok['maychu'][$i];?>: <?=$ok['heso'][$i];?>,
                            <?php }  ?>
                        };
                        document.getElementById("hesoInput").value = heso[selectedServer];
                        if (!isNaN(sotienInput) && sotienInput > 0) {
                            var selectedHeso = heso[selectedServer];
                            var result = sotienInput * selectedHeso;
                            result = Math.round(result * 100) / 100;
                            document.getElementById("txtPrice").textContent = "Tổng: " + (result).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " vàng";
                        } else {
                            document.getElementById("txtPrice").textContent = "Số tiền không hợp lệ";
                        }
                    }
                </script>
    

            </form>

            <div class="container">
                <div class="job-wide-devider">
                    <div class="row">
                        <div class="col-lg-12 column">
                            <div class="job-details">
                                <h2 style="margin-bottom: 23px;font-size: 20px;font-weight: bold;text-transform: uppercase;float: left">Thông tin nhận vàng</h2>
                                <div class="table-bot m_datatable m-datatable m-datatable--default m-datatable--loaded">
                                    <table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand">
                                        <thead class="m-datatable__head">
                                            <tr class="m-datatable__row">
                                                <th style="" class="m-datatable__cell">
                                                    Server
                                                </th>
                                                <th class="m-datatable__cell">
                                                    Nhân vật
                                                </th>
                                                <th style="" class="m-datatable__cell">
                                                    Vị trí
                                                </th>
                                                <th style="" class="m-datatable__cell">
                                                    Trạng thái
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="m-datatable__body-bot">
                                            <?php $ok = json_decode($TUANORI->site('server_banvang'), true);
                                            for($i = 0; $i < count($ok['maychu']); ++$i) { ?>
                                            <tr>
                                                <td><?=$ok['maychu'][$i];?></td>
                                                <td><b><?=$ok['tennv'][$i];?></b></td>
                                                <td><?=$ok['vitri'][$i];?></td>
                                                <td>
                                                    <?php if($ok['status'][$i] == 1) { ?>
                                                        <span style="color:#2fa70f;font-weight: bold">[ONLINE]</span>
                                                    <?php } else { ?>
                                                        <span style="color:red;font-weight: bold">[OFFLINE]</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>

<?php 
    require_once("../../pages/client/Footer.php");
?>