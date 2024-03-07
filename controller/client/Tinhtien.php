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
    $id     = check_string($_POST['id']);
    $dichvu = check_string($_POST['dichvu']);
    $server = check_string($_POST['server']);
    $mgg    = check_string($_POST['coupon']);    
    if($id && $dichvu && $server) {
        if($row = $TUANORI->get_row(" SELECT * FROM `banggia_dichvu` WHERE `category_dichvu` = '$id' AND `id` = '$dichvu' AND `status` = '1'")) {
            $s = json_decode($row['author'], true)['gia'];
            $sotien = $s[$server];
            $gg = $TUANORI->get_row(" SELECT * FROM `coupon` WHERE `code` = '$mgg' AND `conlai` >=1 AND `apply` = 'dichvu' ") ?? 0;
            $sotien-=$sotien*($gg['giam'] ?? 0)/100;
            if(isset($sotien)) tong($sotien); else  tong(0);
        }
        tong(0);
    } 
    tong(0);
} 
tong(0);