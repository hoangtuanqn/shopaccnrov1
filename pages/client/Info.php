
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Thông tin tài khoản";
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
                        <h3 class="c-font-uppercase c-font-bold">Thông tin tài khoản</h3>
                        <div class="c-line-left"></div>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">UID của bạn:</th>
                                <th><span class="c-font-uppercase" style="color: red"><?=$getUser['id']?></span>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">Tài khoản của bạn:</th>
                                <th><span class="c-font-uppercase"><?=$getUser['username']?></span>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">Họ tên:</th>
                                <th>
                                    <span class="c-font-uppercase"><?=$getUser['fullname']?></span> <a href="/profile/doithongtin"> (Đổi Thông Tin)</a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">Mật Khẩu:</th>
                                <td><b class="text-danger"></h2>********</b><a href="/profile/doimatkhau"> (Đổi Mật khẩu)</td>
                            </a>
                            </tr>
                            <tr>
                                <th scope="row">Email:</th>
                                <th><a><?=$getUser['email']?></a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">Số dư tài khoản:</th>
                                <td><b class="text-danger"><tuan id="infouuser1"><?=format_cash($getUser['money'])?></tuan>đ</b>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Tổng nạp tháng <?=date('m');?>:</th>
                                <td><b class="text-danger"><?=format_cash($getUser['total_topnapthe']);?>đ</b>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Vàng chưa rút:</th>
                                <td><b class="text-danger"><?=format_cash($getUser['iteam'])?> vàng</b>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Ngọc chưa rút:</th>
                                <td><b class="text-danger"><?=format_cash($getUser['iteam_ngoc'])?> ngọc</b>
                                </td>
                            </tr>
                    
                            <tr>
                                <th scope="row">Nhóm tài khoản:</th>
                                <td> <?=$cv;?></td>
                            </tr>
                            <tr>
                                <th scope="row">Đã nạp:</th>
                                <td><b class="text-danger"><?=format_cash($getUser['total_money'])?> đ</b>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Tham gia:</th>
                                <td>
                                    <?=intg(strtotime($getUser['timereg']))?> </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php 
    require_once("../../pages/client/Footer.php");
?>