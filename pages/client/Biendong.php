
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = "Biến động số dư";
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
                        <h3 class="c-font-uppercase c-font-bold">Biến động số dư</h3>
                        <div class="c-line-left"></div>
                    </div>
                    <table class="table table-striped table-custom-res">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Trước GD</th>
                                <th>Số tiền</th>
                                <th>Sau GD</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `biendongsodu` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC LIMIT $from,$sotin1trang") as $row){ ?>
                            <tr>
                                <td><?=++$i?></td>
                                <td><b><?=number_format($row['truoc'])?>đ</b></td>
                                
                                <td>
                                    <?php if($row['truoc'] > $row['sau']) {
                                        echo '<b style="color: red">-'.number_format($row['tongtien']).'đ</b>';
                                    } else {
                                        echo '<b style="color: green">+'.number_format($row['tongtien']).'đ</b>';
                                    } ?>
                                </td>
                                <td><b><?=number_format($row['sau'])?>đ</b></td>
                                <td><?=$row['note']?></td>

                                <td><b><?=intg(strtotime($row['time']));?></b></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <center>
                        <div class="row">
                            <?php
                                $tong = $TUANORI->num_rows(" SELECT * FROM `biendongsodu` WHERE `username` = '".$getUser['username']."' ");
                                if ($tong > $sotin1trang)
                                {
                                    echo '<center>' . phantrang('/profile/bien-dong-so-du?', $from, $tong, $sotin1trang) . '</center>';
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