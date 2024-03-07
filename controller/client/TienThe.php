<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    // require_once('../../class/class.smtp.php');
    // require_once('../../class/PHPMailerAutoload.php');
    // require_once('../../class/class.phpmailer.php');
function tong($data) {
    die('Tổng: '.number_format($data).'đ');
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loaithe    = check_string($_POST['loaithe']);
    $menhgia    = check_string($_POST['menhgia']);
    $amount     = check_string($_POST['amount']);
    if($loaithe && $menhgia && $amount) {
        if($row = $TUANORI->get_row(" SELECT * FROM `category_banthe` WHERE `id` = '$loaithe' AND  `status` = '1'")) {
            $ok = explode("\n", $row['menhgia']); 
            $ok2 = explode("\n", $row['ck']);
            for($i = 0; $i < count($ok); ++$i) {
                if($menhgia == $ok[$i]) {
                    $sotien = $menhgia - $menhgia*$ok2[$i]/100;
                    tong($amount*$sotien);
                    break;
                }
            }
        }
        tong(0);
    } 
    tong(0);
} 
tong(0);