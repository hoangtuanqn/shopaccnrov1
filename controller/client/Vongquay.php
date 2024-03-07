<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    require $_SERVER['DOCUMENT_ROOT'] . '/lib/BiasedRandom/Element.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/lib/BiasedRandom/Randomizer.php';
    $id = intval($_POST['id']);
    $wheel = $TUANORI->get_row("SELECT * FROM `mini_game` WHERE `id` = '$id' ");
    if(empty($wheel)) {
        die(json_encode(['status' => 'ERROR', 'msg' => 'Vòng quay này không tồn tại']));
    }
    $randomizer = new Randomizer();
    $randomizer->add(new Element('1', gift($id, 1, 'tyle')))
        ->add(new Element('2', gift($id, 2, 'tyle')))
        ->add(new Element('3', gift($id, 3, 'tyle')))
        ->add(new Element('4', gift($id, 4, 'tyle')))
        ->add(new Element('5', gift($id, 5, 'tyle')))
        ->add(new Element('6', gift($id, 6, 'tyle')))
        ->add(new Element('7', gift($id, 7, 'tyle')))
        ->add(new Element('8', gift($id, 8, 'tyle')));
    $id_nhan = $randomizer->get();
    $msg    = gift($id, $id_nhan, 'text');
    $iteam  = gift($id, $id_nhan, 'iteam');
    $ht     = gift($id, $id_nhan, 'hinhthuc');
    if (empty($_COOKIE['token'])) {
        die(json_encode(['status' => 'LOGIN']));
    } elseif ($wheel['sotien'] > $getUser['money']) {
        die(json_encode(['status' => 'ERROR', 'msg' => 'Số tiền bạn không đủ để thực hiện quay']));
    } else {
        $sotien = $wheel['sotien'];

        /* TRỪ TIỀN */
        $TUANORI->tru("users", "money", $sotien, " `username` = '".$getUser['username']."' ");
        $TUANORI->cong("mini_game", "num_sell", 1, " `id` = '$id' ");
        if($ht == 'ngoc') {
            $TUANORI->cong("users", "iteam_ngoc", $iteam, " `username` = '".$getUser['username']."' ");
        } else if($ht == 'vang') {
            $TUANORI->cong("users", "iteam", $iteam, " `username` = '".$getUser['username']."' ");
        } else {
            $TUANORI->cong("users", "money", $iteam, " `username` = '".$getUser['username']."' ");
            $TUANORI->insert("biendongsodu", [
                'username'  => $getUser['username'],
                'truoc'     => $getUser['money'],
                'sau'       => $getUser['money'] + $iteam,
                'note'      => "Quay vòng quay #".$id." nhận được ".number_format($sotien)."đ",
                'tongtien'  => $sotien,
                'time'      => gettime()
            ]);
        }

        /* GHI LOG DÒNG TIỀN */
        $TUANORI->insert("biendongsodu", [
            'username'  => $getUser['username'],
            'truoc'     => $getUser['money'],
            'sau'       => $getUser['money'] - $sotien,
            'note'      => "Quay vòng quay #".$id." với giá ".number_format($sotien)."đ",
            'tongtien'  => $sotien,
            'time'      => gettime()
        ]);
        $TUANORI->insert("history_vongquay", [
            'username'  => $getUser['username'],
            'vongquay'  => $id,
            'sotien'    => $sotien,
            'note'      => $msg,
            'hinhthuc'  => $ht,
            'iteam'     => $iteam,
            'thoigian'  => gettime()
        ]);
        $response = [
            'status'    => 'SUCCESS',
            'msg'       => [
                'num_roll_remain' => floor($getUser['money']/$wheel['sotien'])-1, // số lượng quay còn lại
                'pos'   => $id_nhan, // số vòng quay nhận
                'name'  => $msg
            ]
        ];
        die(json_encode($response));
    }
