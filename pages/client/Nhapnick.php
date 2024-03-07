
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Dịch Vụ Nhập Nick";
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
                        <h3 class="c-font-uppercase c-font-bold">Nhập Nick Ngọc Rồng
                    </h3>
                        <div class="c-line-left"></div>
                    </div>
                    <div class="col-md-12"></div>

                    <form class="form-horizontal">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tài khoản:
                            </label>
                            <div class="col-md-6">
                                <input class="form-control  c-theme" id="taikhoan" type="text" placeholder="Tài khoản" required="" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu</label>
                            <div class="col-md-6">
                                <input class="form-control  c-theme" id="matkhau" type="text" placeholder="Mật khẩu" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Số tiền muốn bán</label>
                            <div class="col-md-6">
                                <input class="form-control  c-theme fnum" id="sotien" type="text" placeholder="Số tiền muốn bán" required="">
                                <i style="color: red">Admin có thể thay đổi lại nếu giá bán không hợp lệ</i>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Máy chủ:</label>
                            <div class="col-md-6">
                                <select id="server" class="server-filter form-control t14" style="" id="server">
                                    <option value="1">Vũ Trụ 1</option>
                                    <option value="2">Vũ Trụ 2</option>
                                    <option value="3">Vũ Trụ 3</option>
                                    <option value="4">Vũ Trụ 4</option>
                                    <option value="5">Vũ Trụ 5</option>
                                    <option value="6">Vũ Trụ 6</option>
                                    <option value="7">Vũ Trụ 7</option>
                                    <option value="8">Vũ Trụ 8</option>
                                    <option value="9">Vũ Trụ 9</option>
                                    <option value="10">Vũ Trụ 10</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lời nhắn tới admin:</label>
                            <div class="col-md-6">
                                <textarea class="form-control c-theme " type="text" value="" id="ghichu" placeholder="TK nhận tiền, v.v" ></textarea> 
                            </div>
                        </div>


                        <div class="form-group c-margin-t-40">
                            <div class="col-md-offset-3 col-md-6">
                                <button id="XacNhan" class="btn c-theme-btn c-btn-uppercase c-btn-bold btn-block btn-confirm">
                                    Thực hiện
                                </button>
                            </div>
                        </div>
                    </form>
                    <script type="text/javascript">
                    $("#XacNhan").on("click", function() {

                        $('#XacNhan').html('Đang xử lý...').prop('disabled',
                            true);
                        $.ajax({
                            url: "/controller/client/NhapNick.php",
                            method: "POST",
                            data: {
                                taikhoan: $("#taikhoan").val(),
                                matkhau: $("#matkhau").val(),
                                sotien: $("#sotien").val(),
                                server: $("#server").val(),
                                ghichu: $("#ghichu").val()
                            },
                            success: function(response) {
                                $("#thongbao").html(response);
                                $('#XacNhan').html(
                                        ' Thực Hiện')
                                    .prop('disabled', false);
                            }
                        });
                    });
                    </script>
                    <div class="c-content-title-1" style="margin-top: 40px">
                        <h3 class="c-font-uppercase c-font-bold">LỊCH SỬ NHẬP NICK</h3>
                        <div class="c-line-left"></div>
                    </div>
                    <table class="table table-striped table-custom-res">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Tài khoản</th>
                                <th>Số tiền</th>
                                <th>Máy chủ</th>
                                <th>Lời nhắn</th>
                                <th>Ghi chú (Admin)</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                            </tr>
                        </tbody>
                        <tbody>
                        <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `nhapnick_game` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC LIMIT $from,$sotin1trang") as $row){ ?>
                        <tr>
                            <td><?=++$i;?></td>
                            <td><?=$row['tk'];?></td>
                            <td style="color: green; font-weight: bold">+ <?=number_format($row['sotien']);?>đ</td>
                            <td><?=$row['server'];?> sao</td>
                            <td><?=$row['note'];?></td>
                            <td><?=$row['noteadmin'];?></td>
                            <td><?=status_nhapnick($row['status']);?></td>
                            <td><b><?=intg(strtotime($row['thoigian']));?></b></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <center>
                        <div class="row">
                            <?php
                                $tong = $TUANORI->num_rows(" SELECT * FROM `nhapnick_game` WHERE `username` = '".$getUser['username']."' ");
                                if ($tong > $sotin1trang)
                                {
                                    echo '<center>' . phantrang('/profile/tai-khoan-da-mua?', $from, $tong, $sotin1trang) . '</center>';
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