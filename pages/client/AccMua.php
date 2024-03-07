
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Tài khoản đã mua";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    CheckLogin();
?>
<?php
    $sotin1trang =  25;
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
                            <h3 class="c-font-uppercase c-font-bold">Tài Khoản Đã Mua</h3>
                            <div class="c-line-left"></div>
                        </div>
                        <table class="table table-striped table-custom-res">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mã số</th>
                                    <th style="min-width: 140px;">Thông tin tài khoản</th>
                                    <th>Giá tiền</th>
                                    <th>Người bán</th>
                                    <th>Thời gian</th>

                            </thead>
                            <tbody>
                                <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `list_acc_game` WHERE `username` = '".$getUser['username']."' AND `type` = 'account' ORDER BY timemua DESC LIMIT $from,$sotin1trang") as $row){ ?>
                                <tr>
                                    <td><?=++$i;?></td>
                                    <td style="color: red; font-weight: bold">#<?=$row['id'];?></td>
                                    <td><button type="button" class="btn c-bg-dark c-font-white c-btn-square btn-xs load-modal" rel="/view/acc<?=$row['id']?>.html">Thông Tin</button></td>
                                    <td style="color: red; font-weight: bold">-<?=number_format($row['thanhtoan']);?>đ</td>
                                    <td><b><?=$row['ctv'];?></b></td>
                                    <td><b><?=intg(strtotime($row['timemua']));?></b></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <center>
                            <div class="row">
                                <?php
                                    $tong = $TUANORI->num_rows(" SELECT * FROM `list_acc_game` WHERE`username` = '".$getUser['username']."' AND `type` = 'account' ");
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
        </div>
<?php 
    require_once("../../pages/client/Footer.php");
?>