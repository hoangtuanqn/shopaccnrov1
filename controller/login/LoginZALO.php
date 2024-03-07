<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $appId = $TUANORI->site('id_zalo');
    $appSecret = $TUANORI->site('key_zalo');
    $redirectUri = 'https://tuanori.tech/LoginZALO';
    // Xử lý đăng nhập
    if($TUANORI->site('status_zalo')) {
        if(isset($_GET['code'])) {
            $code = check_string($_GET['code']);
            $data = array(
                'app_id' => $appId,
                'code' => $code,
                'grant_type' => 'authorization_code'
            );
            
            // Tạo header
            $headers = array(
                'Content-Type: application/x-www-form-urlencoded',
                'secret_key: ' . $appSecret
            );
            
            // Khởi tạo cURL
            $ch = curl_init();
            
            // Cài đặt cURL
            curl_setopt($ch, CURLOPT_URL, 'https://oauth.zaloapp.com/v4/access_token');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $responseData = json_decode($response, true);
            if(isset($responseData['access_token'])) {
                // Lấy thông tin người dùng từ Zalo
                $accessToken = $responseData['access_token'];
                $getUserInfoUrl = "https://graph.zalo.me/v2.0/me?access_token={$accessToken}";
                $userInfo = json_decode(file_get_contents($getUserInfoUrl), true);
                
                $email = $userInfo['id'].'@gmail.com';
                $fullname = $userInfo['name'];
                $info = $TUANORI->get_row(" SELECT * FROM `users` WHERE `email` = '$email' ");
                    $token = randomtoken();
                    if($info) {
                        $TUANORI->update("users", array(
                            'tokenlog'      => $token,
                            'timeon'        => gettime(),
                            'ip'            => myip()
                        ), " `email` = '$email'");
                    } else {
                        $create = $TUANORI->insert("users", [
                            'username'          => 'ZL'.strtoupper(slug($fullname)).rand(1111,9999),
                            'password'          => md5(rand(111111,999999)),
                            'email'             => $email,
                            'fullname'          => $fullname,
                            'money'             => 0,
                            'total_money'       => 0,
                            'level'             => 'member',
                            'tokenlog'          => $token,
                            'timereg'           => gettime(),
                            'timeon'            => gettime(),
                            'online'            => 'ONLINE',
                            'ip'                => myip()
                        ]);
                    }
                    setcookie('token', $token, time() + 2678400, '/');
                    header("Location: /");
            } else {
                /*lỗi access_token, thực hiện login lại*/
                $loginUrl = "https://oauth.zaloapp.com/v4/permission?state=".randomtoken(200)."&app_id={$appId}&redirect_uri=".$redirectUri;
                header("Location: {$loginUrl}");
            }
        } else {
            // Redirect đến trang đăng nhập Zalo
            $loginUrl = "https://oauth.zaloapp.com/v4/permission?state=".randomtoken(200)."&app_id={$appId}&redirect_uri=".$redirectUri;
            header("Location: {$loginUrl}");
            exit;
        }
    } else {
        die("Chức năng này tạm bảo trì");
    }