
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Lịch Sử Mua Ngọc";
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
                        <h3 class="c-font-uppercase c-font-bold">LỊCH SỬ MUA NGỌC</h3>
                        <div class="c-line-left"></div>
                    </div>
                    <table id="charge_recent" class="table table-striped table-custom-res">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tài Khoản</th>
                                <th>Máy chủ</th>
                                <th>Số tiền</th>
                                <th>Số ngọc</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `history_dichvu` WHERE `username` = '".$getUser['username']."'  AND `dichvu` = '-2' ORDER BY id DESC LIMIT $from,$sotin1trang") as $row){ ?>
                            <tr>
                                <td><?=++$i;?></td>
                                <td><?=$row['tk'];?></td>
                                <td>Vũ Trụ <?=$row['server'];?></td>
                                <td><b style="color: green"><?=number_format($row['tongtien']);?>đ</b></td>
                                <td><b style="color: green"><?=number_format($row['iteam']);?> ngọc</b></td>
                                <td><?=status_dichvu($row['status']);?></td>
                                <td><b><?=intg(strtotime($row['thoigian']));?></b></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <center>
                        <div class="row">
                            <?php
                                $tong = $TUANORI->num_rows(" SELECT * FROM `history_dichvu` WHERE `username` = '".$getUser['username']."' AND `dichvu` = '-2' ");
                                if ($tong > $sotin1trang)
                                {
                                    echo '<center>' . phantrang('/profile/mua-ngoc?', $from, $tong, $sotin1trang) . '</center>';
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