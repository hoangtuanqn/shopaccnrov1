
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Rút vàng";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();
?>
<?php
    $sotin1trang =  25; // 5 hàng 4 cột => 20 acc
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
                        <h3 class="c-font-uppercase c-font-bold">Rút Vàng</h3>
                        <div class="c-line-left"></div>
                    </div>

                    <div class="col-md-12"></div>

                    <form class="form-horizontal" method="POST">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tên nhân vật:</label>
                            <div class="col-md-6">
                                <input class="form-control  c-theme" id="tennv" type="text" placeholder="Tên nhân vật" required="" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Máy chủ:</label>
                            <div class="col-md-6">
                                <select class="server-filter form-control t14" style="" id="server">
                                 <?php foreach(json_decode($TUANORI->site('server_banvang'), true)['maychu'] as $sv) { ?>
                                    <option value="<?=$sv;?>">Vũ trụ <?=$sv;?> </option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <style>
                            .allin {
                                margin-right: 18px;
                                pointer-events: all;
                                cursor: pointer;
                                margin-top: 13px;
                            }
                        </style>
                        <script>
                            $(document).ready(function() {
                                const allinmoney = document.querySelector("#allinmoney");
                                allinmoney.addEventListener("click", function() {
                                    var hello = document.getElementById("amount").value;
                                    var max = 500000000;
                                    if (max > 0) {
                                        max = 0;
                                    }
                                    $('#amount').val(numberWithCommass(max));
                                    show_result();
                                });
                            });

                            function numberWithCommass(x) {
                                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                        </script>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Số vàng:</label>
                            <div class="col-md-6">
                                <input class="form-control c-theme " type="text" placeholder="Nhập số vàng muốn rút" id="amount"  value="" onkeyup="show_result()" />
                                <i class="allin fa fa-money form-control-feedback" id="allinmoney" title="Tất Tay Luôn ^^"></i>
                            </div>
                        </div>
                        <script language="javascript">
                            var tmpval = 0;
                            var sai = false;
                            var tmp = "";
                            $('#amount').bind('focus keyup change input', function() {
                                show_result();
                            });
                            // Hàm show kết quả
                            function show_result() {
                                var hihi = $('#amount').val();
                                var kq = $('#amount').val().replace(/[^\d]/g, '');
                                if (tmp != hihi && kq != hihi) {
                                    $('#amount').val(kq);
                                    tmp = hihi;
                                }
                                var giatien = $('#server').children("option:selected").attr('gia');
                                try {
                                    var nhap = parseInt(kq);
                                } catch (error) {
                                    var nhap = 0;
                                }
                                if (nhap == 0 || isNaN(nhap)) {
                                    $('#giatiendv').val("Nhập Số Vàng Cần Rút");
                                    $('#amount').val('');
                                } else {
                                    sai = false;
                                    if (nhap < 1000) {
                                        $('#amount').val(parseInt(kq));
                                    } else if (nhap >= 1000 && nhap < 2000000000) {
                                        tmpval = nhap.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        $('#amount').val(tmpval);
                                    } else if (nhap >= 2000000000) {
                                        $('#amount').val(tmpval);
                                        show_result();
                                        sai = true;
                                    }
                                    if (!sai) {
                                        var giatri = parseInt(nhap);
                                        if (giatri > 500000000) {
                                            $('#giatiendv').val("Rút ≤ 500 Triệu Vàng. Kia Là " + numberWithCommas(giatri) + " Vàng Rồi!");
                                        } else if (giatri < 10000000) {
                                            $('#giatiendv').val("Rút Tối Thiểu 10 Triệu Vàng. Kia Là " + numberWithCommas(giatri) + " Vàng Rồi!");
                                        } else {
                                            $('#giatiendv').val(numberWithCommas(giatri));
                                        }
                                    }
                                }
                            }

                            function numberWithCommas(x) {
                                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                        </script>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Số vàng nhận được:</label>
                            <div class="col-md-6">
                                <input id="giatiendv" name="giatiendv" class="form-control t16 bb text-center" style="color:#ff0000; background-color: white;" type="text" maxlength="16" placeholder="" readonly="" value="Nhập Số Vàng Cần Rút">
                            </div>
                        </div>
                        

                        <div class="form-group c-margin-t-40">
                            <p style="text-align: center; color: red">Yêu cầu kiểm tra lại thông tin trước khi thực hiện</p>
                            <div class="col-md-offset-3 col-md-6">
                                <button type="button" id="Rutvang" class="btn c-theme-btn c-btn-uppercase c-btn-bold btn-block btn-confirm">
                                    Thực hiện
                                </button>
                            </div>
                        </div>
                    </form>
                    <script type="text/javascript">
                        $("#Rutvang").on("click", function() {

                            $('#Rutvang').html('Đang xử lý...').prop('disabled',
                                true);
                            $.ajax({
                                url: "/controller/client/Rutvang.php",
                                method: "POST",
                                data: {
                                    tennv: $("#tennv").val(),
                                    vang: $("#amount").val(),
                                    server: $("#server").val()
                                },
                                success: function(response) {
                                    $("#thongbao").html(response);
                                    $('#Rutvang').html(
                                        ' Thực hiện')
                                        .prop('disabled', false);
                                }
                            });
                        });
                    </script>

                    <div class="c-content-title-1" style="margin-top: 40px">
                        <h3 class="c-font-uppercase c-font-bold">TRẠNG THÁI</h3>
                        <div class="c-line-left"></div>
                    </div>
                    <div class="table-bot m_datatable m-datatable m-datatable--default m-datatable--loaded">
                        <table class="table table-bordered m-table m-table--border-brand">
                            <thead class="m-datatable__head">
                                <tr class="m-datatable__row">
                                    <th style="" class="m-datatable__cell text-center">
                                        Máy Chủ
                                    </th>
                                    <th class="m-datatable__cell text-center">
                                        Nhân Vật
                                    </th>
                                    <th style="" class="m-datatable__cell text-center">
                                        Vị Trí
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="m-datatable__body-bot">
                            <?php $ok = json_decode($TUANORI->site('server_banvang'), true);
                            for($i = 0; $i < count($ok['maychu']); ++$i) { ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">Vũ Trụ <?=$ok['maychu'][$i  ];?></td>
                                    <?php if($ok['status'][$i] == 1) { ?>
                                        <td style="text-align: center; vertical-align: middle; color: green; font-weight: bold"><?=$ok['tennv'][$i];?></td>
                                        <td style="text-align: center; vertical-align: middle; color: red; font-weight: bold" ><?=$ok['vitri'][$i];?></td>
                                    <?php } else { ?>
                                        <td style="text-align: center; vertical-align: middle;" colspan="2">
                                            <span style="color: red; font-weight: bold;">[OFFLINE]</span>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                   
                    <div class="c-content-title-1" style="margin-top: 40px">
                        <h3 class="c-font-uppercase c-font-bold">LỊCH SỬ RÚT VÀNG</h3>
                        <div class="c-line-left"></div>
                    </div>
                    <table id="charge_recent" class="table table-striped table-custom-res">
                    <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên NV</th>
                                <th>Máy chủ</th>
                                <th>Số vàng</th>
                                <th>Note</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `history_rutvang` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC LIMIT $from,$sotin1trang") as $row){ ?>
                        <tr>
                            <td><?=++$i;?></td>
                            <td style="color: green; font-weight: bold"><?=$row['tennv'];?></td>
                            <td><?=$row['server'];?> sao</td>
                            <td><?=number_format($row['vang']);?> vàng</td>
                            <td><?=$row['note'];?></td>
                            <td><?=status_nhapnick($row['status']);?></td>
                            <td><?=intg(strtotime($row['thoigian']));?></td>

                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <center>
                        <div class="row">
                            <?php
                                $tong = $TUANORI->num_rows(" SELECT * FROM `history_rutvang` WHERE `username` = '".$getUser['username']."' ");
                                if ($tong > $sotin1trang)
                                {
                                    echo '<center>' . phantrang('/profile/rut-vang?', $from, $tong, $sotin1trang) . '</center>';
                                }
                            ?>
                        </div>
                    </center>
                </div>
            </div>
        </div>
<?php 
    require_once("../../pages/client/Footer.php");
?>