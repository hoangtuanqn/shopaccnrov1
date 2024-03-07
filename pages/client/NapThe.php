
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Nạp Thẻ";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();
?>
<?php
    $sotin1trang = 25;
    if(isset($_GET['page'])) {
        $page = intval($_GET['page']);
    } else {
        $page = 1;
    }
    $from = ($page - 1) * $sotin1trang;
?>
    <div class="c-layout-page">
        <div class="c-layout-page" style="margin-top: 20px;">
            <div class="container">
                <?php
                    require_once("../../pages/client/Sidebar.php");
                ?>
                    <div class="c-content-title-1" style="margin-top: 40px">
                        <h3 class="c-font-uppercase c-font-bold">Nạp thẻ cào tự động</h3>
                        <div class="c-line-left"></div>
                    </div>
                    <div class="col-md-12">

                    </div>

                    <form class="js-member-topup form-horizontal form-charge" id="formnap" >
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tài khoản:</label>
                            <div class="col-md-6">
                                <input class="form-control t16 bb text-center" style="color:#ff0000; background-color: white;" type="text" maxlength="16" placeholder="" readonly="" value="<?=$getUser['username']?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Loại thẻ:</label>
                            <div class="col-md-6">
                                <select class="form-control  c-theme" name="type" id="type" required="">
                                    <option value="" fullten="" tile="0">-- Chọn loại thẻ --</option>
                                    <option value="VIETTEL" fullten="VIETTEL" tile="<?=(100-$TUANORI->site('ckcard'))?>">VIETTEL</option>
                                    <option value="VINAPHONE" fullten="VINAPHONE" tile="<?=(100-$TUANORI->site('ckcard'))?>">VINAPHONE</option>
                                    <option value="MOBIFONE" fullten="MOBIFONE" tile="<?=(100-$TUANORI->site('ckcard'))?>">MOBIFONE</option>
                                    <option value="VIETNAMOBILE" fullten="VIETNAMOBILE" tile="<?=(100-$TUANORI->site('ckcard'))?>">VIETNAMOBILE</option>
                                    <option value="ZING" fullten="ZING" tile="<?=(100-$TUANORI->site('ckcard'))?>">ZING</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mệnh giá:</label>
                            <div class="col-md-6">
                                <select class="form-control  c-theme" name="amount" id="CardValue" required="">
                                    <option value="">-- Chọn mệnh giá sai trừ 50% giá trị thực --</option>
                                    <option value="10000">10,000 ₫</option>
                                    <option value="20000">20,000 ₫</option>
                                    <option value="30000">30,000 ₫</option>
                                    <option value="50000">50,000 ₫</option>
                                    <option value="100000">100,000 ₫</option>
                                    <option value="200000">200,000 ₫</option>
                                    <option value="300000">300,000 ₫</option>
                                    <option value="500000">500,000 ₫</option>
                                    <option value="1000000">1,000,000 ₫</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Nhận được:</label>
                            <div class="col-md-6">
                                <input id="MoneyConsum" name="MoneyConsum" class="form-control t16 bb text-center" style="color:#ff0000; background-color: white;" type="text" maxlength="16" placeholder="" readonly="" value="0 ₫">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Mã thẻ:</label>
                            <div class="col-md-6">
                                <input class="form-control  c-theme " id="pin" name="pin" autofocus placeholder="Nhập mã số sau lớp bạc mỏng" autocomplete="off" type="text" required="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Số serial:</label>
                            <div class="col-md-6">
                                <input class="form-control c-theme " id="serial" name="serial" placeholder="Nhập mã serial nằm sau thẻ" autocomplete="off" type="text" required="">
                            </div>
                        </div>
                        <script>
                            function ok() {
                                var e = document.getElementById("type");
                                var type = e.options[e.selectedIndex].getAttribute("fullten");
                                var e1 = document.getElementById("CardValue");
                                var gia = e1.options[e1.selectedIndex].text;
                                var ma = document.getElementById("pin").value;
                                var sr = document.getElementById("serial").value;
                                return "Bạn Có Muốn Nạp Thẻ " + type + " \r\nMã Thẻ: " + ma + " \r\nSerial: " + sr + " \r\nMệnh Giá: " + gia + " Không? \r\nNạp Sai Mệnh Giá Sẽ Bị Mất Thẻ!";
                            }
                        </script>
                        <div class="form-group c-margin-t-40">
                            <div class="col-md-offset-3 col-md-6">
                                <button id="napngay" type="button"  onclick="return confirm(ok())" class="btn btn-submit c-theme-btn c-btn-uppercase c-btn-bold btn-block" disabled>
                                    Vui lòng chọn đủ thông tin
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="c-content-title-1" style="margin-top: 40px">
                        <h3 class="c-font-uppercase c-font-bold">LỊCH SỬ</h3>
                        <div class="c-line-left"></div>
                    </div>
                    
                    <table class="table table-striped table-custom-res">
                        <thead>
                            <tr>
                                <th>Trạng thái</th>
                                <th>Mã thẻ</th>
                                <th>Số serial</th>
                                <th>Loại thẻ</th>
                                <th>Mệnh giá</th>
                                <th>Thực nhận</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($TUANORI->get_list(" SELECT * FROM `napcard` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC LIMIT $from,$sotin1trang") as $row){ ?>
                        <tr>
                            <td><?=status_napthe($row['status']);?></td>
                            <td><?=$row['pin'];?></td>
                            <td><?=$row['seri'];?></td>
                            <td><?=$row['loaithe'];?></td>
                            <td><?=number_format($row['menhgia']);?><sup>đ</sup></td>
                            <td><?=number_format($row['thucnhan']);?><sup>đ</sup></td>

                            <td><?=intg(strtotime($row['thoigian']));?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <center>
                        <div class="row">
                            <?php
                                $tong = $TUANORI->num_rows(" SELECT * FROM `napcard` WHERE `username` = '".$getUser['username']."' ");
                                if ($tong > $sotin1trang)
                                {
                                    echo '<center>' . phantrang('/nap-the?', $from, $tong, $sotin1trang) . '</center>';
                                }
                            ?>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $('#formnap').bind('focus keyup change input', function () {
            checkformnap();
        });

        function checkformnap() {
            var loai = document.getElementById("type").value;
            var mg = document.getElementById("CardValue").value;
            var ma = document.getElementById("pin").value;
            var sr = document.getElementById("serial").value;
            if (loai == "" || mg == "" || ma == "" || sr == "" ) {
                $('#napngay').prop("disabled", true);
                document.getElementById("napngay").innerText = "Vui lòng chọn đủ thông tin";
            } else {
                $('#napngay').prop("disabled", false);
                document.getElementById("napngay").innerText = "Nạp Ngay";
            }
        }
    </script>
    <script type="text/javascript">
    $("#napngay").on("click", function() {

        $('#napngay').html('Đang xử lý...').prop('disabled',
            true);
        $.ajax({
            url: "/controller/client/NapThe.php",
            method: "POST",
            data: {
                loaithe: $("#type").val(),
                menhgia: $("#CardValue").val(),
                mathe: $("#pin").val(),
                seri: $("#serial").val()
            },
            success: function(response) {
                $("#thongbao").html(response);
                $('#napngay').html(
                        ' Nạp Ngay')
                    .prop('disabled', false);
            }
        });
    });
    </script>
    <script>
        $(".form-charge").submit(function() {
            $('.btn-submit').button('loading');
        });
    </script>
    <script>
        function hellow() {
            var money = $('#CardValue').children("option:selected").val();
            if (money > 0) {
                var e = document.getElementById("type");
                var tile = parseInt(e.options[e.selectedIndex].getAttribute("tile"));
                if (tile != 100) {
                    money = parseInt(money * ((tile) / 100));
                }
                var moneyout = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(money);
                $("#MoneyConsum").val(moneyout);
            } else {
                $("#MoneyConsum").val("0 ₫");
            }
        }
        $("#CardValue").add('#type').change(function() {
            hellow();
        });
        $(document).ready(function() {
       
            hellow();
        });
    </script>
<?php 
    require_once("../../pages/client/Footer.php");
?>