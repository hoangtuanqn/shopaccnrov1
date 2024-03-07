<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    require_once("../../assets/google/vendor/autoload.php");
    function clientGoogle(){
        global $TUANORI;
        $client_id = $TUANORI->site('id_google'); // Client ID
        $client_secret = $TUANORI->site('key_google'); // Client secret
        $redirect_uri = BASE_URL('LoginGOOGLE'); // URL tại Authorised redirect URIs
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope('email');
        $client->addScope('profile');
        return $client;
    }
    $client = clientGoogle();


    if($TUANORI->site('status_google')) {
        if(isset($_GET['code'])) {
            /*THỰC HIỆN PHẦN XỬ LÝ LOGIN*/
            $service = new Google_Service_Oauth2($client); // LẤY THÔNG TIN NGƯỜI DÙNG
            $check = $client->authenticate($_GET['code']);
            if(isset( $check['error'] )){
                die($check['error_description']);
            }else{
                // Thông tin người dùng
                $user = $service->userinfo->get();
                $email      = $user->email;
                $fullname   = $user->name;
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
                        'username'          => 'GG'.strtoupper(strtok($email, '@')).rand(1111,9999),
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
            }
        } else {
            /*THỰC HIỆN PHẦN LOGIN*/
            $url = $client->createAuthUrl(); // url đăng nhập
            header("Location: $url"); // chuyển hướng url login
        }
    } else {
        die("Chức năng này tạm bảo trì");
    }