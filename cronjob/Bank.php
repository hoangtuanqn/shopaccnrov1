<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
/*CRON 1P 1 LẦN*/   
define("IN_SITE", true);
require_once("../core/config.php");
require_once("../core/function.php");
if(!$TUANORI->site('token_bank') || !$TUANORI->site('stk_bank') || !$TUANORI->site('user_bank') || !$TUANORI->site('mk_bank') || !$TUANORI->site('loaibank')) {
    die('Dữ liệu chưa có để api');
}
if($TUANORI->site('status_bank') != 1) die;
$data = json_decode(curl_get("https://tuanori.tech/a.json"), true);
foreach($data['data'] as $mb) {
    $magd   = explode('\\', $mb['refNo'])[0];
    $sotien = $mb['creditAmount'] + round($mb['creditAmount']*$TUANORI->site('ckatm')/ 100);
    $cmt    = $mb['description'];
    $tien2  = $mb['debitAmount'];
    $id     = get_id_bank($cmt);
    if(!$tien2 && is_numeric($id)) {
        $check = $TUANORI->get_row(" SELECT * FROM `users` WHERE `id` = '$id'");
        $check2 = $TUANORI->get_row(" SELECT * FROM `napatm` WHERE `hinhthuc` = 'MBBANK' AND `magd` = '$magd'");
        if($check && !$check2) {
            $isMoney = $TUANORI->cong("users", "money", $sotien, " `username` = '".$check['username']."'");
            $isMoney2 = $TUANORI->cong("users", "total_money", $sotien, " `username` = '".$check['username']."'");
            $isMoney3 = $TUANORI->cong("users", "total_topnapthe", $sotien, " `username` = '".$check['username']."'");
            if($isMoney && $isMoney2) {
                $create = $TUANORI->insert("napatm", [
                    'username'       => $check['username'],
                    'hinhthuc'       => 'MBBANK',
                    'magd'           => $magd,
                    'sotien'         => $sotien,
                    'thoigian'       => gettime(),
                    'ndnaptien'      => $cmt
                ]);
                $TUANORI->insert("biendongsodu", [
                    'username'  => $check['username'],
                    'truoc'     => $check['money'],
                    'sau'       => $check['money'] + $sotien, 
                    'note'      => "Nạp ".format_cash($sotien)."đ vào tài khoản qua MBBANK",
                    'tongtien'  => $sotien,
                    'time'      => gettime()
                ]);
                send_tele("Thành viên ".$check['username']." vừa nạp ".format_cash($sotien)." vào tài khoản lúc ".format_date(time()).". Hình thức qua MBBANK");
            }
        }
    }
}