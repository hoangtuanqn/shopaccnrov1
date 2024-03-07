<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../core/config.php");
    require_once("../core/function.php");
    $time = strtotime(date('d-m-Y', strtotime(str_replace('/', '-', $TUANORI->site('time_topnap')))));
    $ok = explode('/', $TUANORI->site('time_topnap'));
    if($time < time()) {
        $dt = $ok[1]+1;
        $nam = $ok[2];
        if($dt >= 13) {
            $dt = 1;
            $nam = $ok[2] +1;
        }
        $TUANORI->update("options", array(
            'value' => $ok[0].'/'.$dt.'/'.$nam 
        ), " `key` = 'time_topnap' ");
        /*TRẢ THƯỞNG TOP*/
        $i = 0;
        if($TUANORI->site('type_topnap') == 1) {
            foreach($TUANORI->get_list(" SELECT * FROM `users` WHERE `total_topnapthe` != '0' ORDER BY total_topnapthe DESC LIMIT 3") as $row){
                $sotien = explode("\n", $TUANORI->site('topnap'))[$i]; // lấy thông tin số tiền
                $TUANORI->cong("users", "money", $sotien, " `username` = '".$row['username']."'"); // cộng tiền thành viên
                // biến động số dư trừ tiền thành viên
                $TUANORI->insert("biendongsodu", [
                    'username'  => $row['username'],
                    'truoc'     => $row['money'],
                    'tongtien'  => $sotien,
                    'sau'       => $row['money'] + $sotien,
                    'note'      => 'Thưởng nạp top #'.($i+1).' với số tiền '.number_format($sotien).'đ',
                    'time'      => gettime()
                ]);
                ++$i;
            }
        }
        /*TRẢ THƯỞNG XONG THÌ MÌNH CHO NÓ RESET VỀ 0 LẠI THÔI HIHI*/
        $TUANORI->update("users", array(
            'total_topnapthe' => 0
        ), " `id` > 0 ");
    }
    /*XỬ LÝ ON OFF THÀNH VIÊN*/
    foreach($TUANORI->get_list(" SELECT * FROM `users` WHERE `banned` = 'ON' AND `online` = 'ONLINE'") as $data2) {
        $tt1 = time() - 300;
        if($tt1 > strtotime($data2['timeon'])) {
            $TUANORI->update("users", array(
                'online' => 'OFFLINE'
            ), " `username` = '".$data2['username']."' AND `banned` = 'ON' AND `online` = 'ONLINE' ");
            
        }
    }