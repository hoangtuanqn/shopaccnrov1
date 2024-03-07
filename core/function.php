<?php
if (!defined('IN_SITE')) die('The Request Not Found');
$TUANORI = new TUANORI;
// $site_gmail_momo    = $TUANORI->site('email');
// $site_pass_momo     = $TUANORI->site('pass_email');
// require_once(__DIR__.'/../lib/Pusher.php');
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/

function sendCSM($mail_nhan,$ten_nhan,$chu_de,$noi_dung,$bcc)
{
    // return true;
    global $site_gmail_momo, $site_pass_momo;
        // PHPMailer Modify
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail ->Debugoutput = "html";
        $mail->isSMTP();
        $mail->Host = 'mail.tuanori.vn';
        $mail->SMTPAuth = true;
        $mail->Username = $site_gmail_momo; // GMAIL STMP
        $mail->Password = $site_pass_momo; // PASS STMP
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($site_gmail_momo, $bcc);
        $mail->addAddress($mail_nhan, $ten_nhan);
        $mail->addReplyTo($site_gmail_momo, $bcc);
        $mail->isHTML(true);
        $mail->Subject = $chu_de;
        $mail->Body    = $noi_dung;
        $mail->CharSet = 'UTF-8';
        $send = $mail->send();
        return $send;
}
$MEMO_PREFIX = $TUANORI->site('noidung_naptien');
function get_id_bank($des)
{
    global $MEMO_PREFIX;
    $re = '/'.$MEMO_PREFIX.'\d+/im';
    preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0 )
        return null;
    // Print the entire match result
    $orderCode = $matches[0][0];
    $prefixLength = strlen($MEMO_PREFIX);
    $orderId = intval(substr($orderCode, $prefixLength ));
    return $orderId ;
}

function send_tele($data)
{
    global $TUANORI;
    $id     = $TUANORI->site("id_tele");
    $key    = $TUANORI->site("key_tele");
    $json   = '';
    if($TUANORI->site('status_tele')) {
        $json   = json_decode(file_get_contents('https://api.telegram.org/bot'.$key.'/sendMessage?chat_id='.$id.'&text='.urlencode($data)), true);
    }
    return $json;
}


function BASE_URL($url)
{
    global $base_url;
    return $base_url.$url;
}
function format_date($time){
    return date("H:i:s d/m/Y", $time);
}
function gettime()
{
    return date('Y/m/d H:i:s', time());
}
function gettime2($data)
{
    return date('Y/m/d H:i:s', $data);
}
function intg($data)
{
    return date('d/m/Y - H:i:s', $data);
}
function check_string($data)
{
    return trim(htmlspecialchars(addslashes($data)));
}
function format_cash($price)
{
    return str_replace(",", ".", number_format($price));
}
function sotienmua($data)
{
    if($data > 0)
    {
        return format_cash($data).'₫';
    }
    else
    {
        return 'Miễn phí';
    }
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    
    curl_close($ch);
    return $data;
}
function random($string, $int)
{  
    return substr(str_shuffle($string), 0, $int);
}

function check_img($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("png","jpeg","jpg","PNG","JPEG","JPG","gif","GIF");
    if(in_array($ext, $valid_ext))
    {
        return true;
    }
}
function hienthi($data)
{
    if(!$data)
    {
        return '';
    }
    else
    {
        return $data;
    }
}

function chietkhau($data, $data1)
{
    return $data - ($data*$data1/ 100);
}
// function pusher($username = '', $status, $msg) {
//     // $username username nhận thông báo; $status // trạng thái success, error; $msg nội dung
//     $options = array(
//         'encrypted' => true
//     );
//     $pusher = new Pusher(
//             '10d5ea7e7b632db09c72', 'a496a6f084ba9c65fffb', '234217', $options
//     );
//     $arr['type'] = $status;
//     $arr['message'] = $msg;
//     $pusher->trigger($username, 'realtime', $arr);
// }
function msg_success2($text)
{
    return die('<script type="text/javascript">swal("Thành Công", "'.$text.'", "success");</script>');
}
function msg_error2($text)
{
    return die('<script type="text/javascript">swal("Thất Bại", "'.$text.'", "error");</script>');
}
function msg_warning2($text)
{
    return die('<script type="text/javascript">swall("Cảnh Báo", "'.$text.'", "warning");</script>');
}
function msg_success($text, $url, $time)
{
    return die('<script type="text/javascript">swal("Thành Công", "'.$text.'", "success");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_error($text, $url, $time)
{
    return die('<script type="text/javascript">swal("Thất Bại", "'.$text.'", "error");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_warning($text, $url, $time)
{
    return die('<script type="text/javascript">swall("Cảnh Báo", "'.$text.'", "warning");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function status_online($data)  {
    if($data == 'ONLINE') {
        return '<span class="badge badge-success">ONLINE</span>';
    } else {
        return '<span class="badge badge-danger">OFFLINE</span>';
    }
}
function status_onoff($data) {
    if($data) {
        return '<span class="badge badge-success right">ON</span>';
    }
    return '<span class="badge badge-danger ger right">OFF</span>';
}
function status_category($data)  {
    if($data == '1') {
        return '<span class="badge badge-success">Hiển thị</span>';
    } else {
        return '<span class="badge badge-danger">Đang ẩn</span>';
    }
}
function status_ctv($data) {
    switch($data) {
        case 'ctv':
            $show = '<span class="badge badge-info">Cộng tác viên</span>';
        break;
        case 'admin':
            $show = '<span class="badge badge-success">Quản trị viên</span>';
        break;
        default;
            $show = '<span class="badge badge-primary">Thành viên</span>';
    }
    return $show;
}

function msg_success2_ad($text)
{
    return die('<script type="text/javascript">Swal.fire("Thành Công", "'.$text.'", "success");</script>');
}
function msg_error2_ad($text)
{
    return die('<script type="text/javascript">Swal.fire("Thất Bại", "'.$text.'", "error");</script>');
}
function msg_warning2_ad($text)
{
    return die('<script type="text/javascript">Swal.fire("Cảnh Báo", "'.$text.'", "warning");</script>');
}
function msg_success_ad($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("Thành Công", "'.$text.'", "success");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_error_ad($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("Thất Bại", "'.$text.'", "error");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_warning_ad($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("Cảnh Báo", "'.$text.'", "warning");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function stnapthe($data) {
    if ($data == 'xuly'){
        $show = '<span class="badge bg-warning rounded-lg">Chờ xử lý</span>';
    }
    else if ($data == 'thanhcong'){
        $show = '<span class="badge bg-success rounded-lg">Thành công</span>';
    }
    else if ($data == 'thatbai'){
        $show = '<span class="badge bg-danger rounded-lg">Thất bại</span>';
    }
    return $show;
}
function display($data) {
    if ($data == 1) {
        $show = '<span class="badge badge-success">HIỂN THỊ</span>';
    } else {
        $show = '<span class="badge badge-danger">ẨN</span>';
    }
    return $show;
}
function status_gift($data) {
    if ($data == 1) {
        $show = '<span class="badge badge-success">CHƯA DÙNG</span>';
    } else {
        $show = '<span class="badge badge-danger">ĐÃ DÙNG</span>';
    }
    return $show;
}

function display_banned($data) {
    if ($data == 'OFF') {
        $show = '<span class="badge badge-danger">Banned</span>';
    }
    else  {
        $show = '<span class="badge badge-success">Hoạt động</span>';
    }
    return $show;
}
function slug($str, $ok = 1)
{
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	$str = preg_replace("/(đ)/", 'd', $str);
	$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
	$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|E)/", 'e', $str);
	$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
	$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
	$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|U)/", 'u', $str);
	$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ|Y)/", 'y', $str);
	$str = preg_replace("/(Đ)/", 'd', $str);
	$str = preg_replace("/(Q)/", 'q', $str);
	$str = preg_replace("/(R)/", 'r', $str);
	$str = preg_replace("/(T)/", 't', $str);
	$str = preg_replace("/(Y)/", 'y', $str);
	$str = preg_replace("/(I)/", 'i', $str);
	$str = preg_replace("/(O)/", 'o', $str);
	$str = preg_replace("/(P)/", 'p', $str);
	$str = preg_replace("/(A)/", 'a', $str);
	$str = preg_replace("/(S)/", 's', $str);
	$str = preg_replace("/(D)/", 'd', $str);
	$str = preg_replace("/(F)/", 'f', $str);
	$str = preg_replace("/(G)/", 'g', $str);
	$str = preg_replace("/(H)/", 'h', $str);
	$str = preg_replace("/(J)/", 'j', $str);
	$str = preg_replace("/(K)/", 'k', $str);
	$str = preg_replace("/(L)/", 'l', $str);
	$str = preg_replace("/(Z)/", 'z', $str);
	$str = preg_replace("/(X)/", 'x', $str);
	$str = preg_replace("/(C)/", 'c', $str);
	$str = preg_replace("/(V)/", 'v', $str);
	$str = preg_replace("/(B)/", 'b', $str);
	$str = preg_replace("/(N)/", 'n', $str);
	$str = preg_replace("/(M)/", 'm', $str);
	$str = preg_replace("/(W)/", 'w', $str);
	$str = preg_replace("/(  )/", '', $str);
    if($ok == 1) {
        $str = preg_replace('/([^\pL\pN\.\ ]+)/u', '', strip_tags($str));
        return str_replace(' ', '', $str);
    } else {
        $str = preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($str));
        return str_replace(' ', '-', $str);
    }
}

/*CÀI ĐẶT PHÂN TRANG*/
function phantrang($url, $start, $total, $kmess)
{
    $out[] = '<div class="row">
    <center><ul class="pagination">';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    /*CÁI CHUẨN BỊ CHỌN, KẾ TIẾP CÁI ĐANG CHỌN*/
    // $base_link = '<li><a class="mx-1 border border-gray-400 bg-white relative v-page-no w-8 md:w-10 h-8 md:h-10 text-md md:text-lg rounded font-bold inline-flex items-center justify-center px-2 py-2 leading-5 font-medium focus:outline-none transition ease-in-out duration-150 text-gray-800 v-pagination-text disabled" href="' . strtr($url, array('%' => '%%')) . 'page=%d' . '">%s</a></li>';
    $base_link = '<li><a class="pagenav" href="' . strtr($url, array('%' => '%%')) . 'page=%d' . '">%s</a></li>'; // cái tiếp theo cái đang chọn
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '«'); // đây là icon quay lại trang
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<li><a>...</a></li>';
    for ($nCont = $neighbors;$nCont >= 1;$nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    /*CÁI ĐANG CHỌN*/
    // $out[] = '<li class="border mx-1 w-8 md:w-10 h-8 md:h-10 text-md md:text-lg select-none rounded inline-flex justify-center items-center px-4 py-2 focus:outline-none text-white border-red-600 text-white bg-red-600"><a class="page-link">' . ($start / $kmess + 1) . '</a></li>';
    $out[] = '<li class="active"><a><b>' . ($start / $kmess + 1) . '</b></a></li>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1;$nCont <= $neighbors;$nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<li><a>...</a></li>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total)
    {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, '»'); // icon tiến tới
    }
    $out[] = '</ul></div>
    </center>';
    return implode('', $out);
}
// function phantrang($url, $start, $total, $kmess)
// {
//     $out[] = ' <nav class="relative z-0 inline-flex v-pagination mx-auto v-text-1 v-light-theme">';
//     $neighbors = 2;
//     if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
//     else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
//     $base_link = '<li><a class="mx-1 border border-gray-400 bg-white relative v-page-no w-8 md:w-10 h-8 md:h-10 text-md md:text-lg rounded font-bold inline-flex items-center justify-center px-2 py-2 leading-5 font-medium focus:outline-none transition ease-in-out duration-150 text-gray-800 v-pagination-text disabled" href="' . strtr($url, array('%' => '%%')) . 'page=%d' . '">%s</a></li>';
//     $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '<svg viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
//     <path fill-rule="evenodd"
//         d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
//         clip-rule="evenodd"></path>
//     </svg>'); // đây là icon quay lại trang
//     if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
//     if ($start > $kmess * ($neighbors + 1)) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
//     for ($nCont = $neighbors;$nCont >= 1;$nCont--) if ($start >= $kmess * $nCont) {
//         $tmpStart = $start - $kmess * $nCont;
//         $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
//     }
//     $out[] = '<li class="border mx-1 w-8 md:w-10 h-8 md:h-10 text-md md:text-lg select-none rounded inline-flex justify-center items-center px-4 py-2 focus:outline-none text-white border-red-600 text-white bg-red-600"><a class="page-link">' . ($start / $kmess + 1) . '</a></li>';
//     $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
//     for ($nCont = 1;$nCont <= $neighbors;$nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
//         $tmpStart = $start + $kmess * $nCont;
//         $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
//     }
//     if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
//     if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
//     if ($start + $kmess < $total)
//     {
//         $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
//         $out[] = sprintf($base_link, $display_page, '<svg viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
//         <path fill-rule="evenodd"
//             d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
//             clip-rule="evenodd"></path>
//     </svg>
//         '); // icon tiến tới
//     }
//     $out[] = '</ul></nav>';
//     return implode('', $out);
// }

function getid($id) {
    global $TUANORI;
    return $TUANORI->getId($id);
}
function vq($data) {
    switch($data) {
        case 'vang':
            return 'Vàng';
        break;
        case 'ngoc':
            return 'Ngọc';
            break;
        case 'tien':
            return 'Tiền trong shop';
            break;
        default:
            return 'Tiền trong shop';
    }
}
function getUser($username) {
    global $TUANORI;
    return $TUANORI->getUser($username);
}
function status_napthe($data, $cl = 'label') {
    switch($data) {
        case 0:
            $show = '<span class="'.$cl.' '.$cl.'-warning">Đang xử lý</span>';
        break;
        case 1: 
            $show = '<span class="'.$cl.' '.$cl.'-success">Thẻ đúng</span>';
        break;
        default:
            $show = '<span class="'.$cl.' '.$cl.'-danger">Thẻ sai</span>';
    }
    return $show;
}
function status_muathe($data) {
    if(!$data) return '<span class="badge badge-success">Chưa bán</span>';
    return '<span class="badge badge-danger">Đã bán</span>';
}
function dichvu_shop($data) {
    switch($data) {
        case 'vang':
            return 'Dịch vụ bán vàng';
        case 'ngoc':
            return 'Dịch vụ bán ngọc';
        case 'random':
            return 'Mua tài khoản random';
        case 'caythue':
            return 'Dịch vụ cày thuê';
        case 'account':
            return 'Mua tài khoản game';
    }
}
function status_dichvu_ad($data, $cl = 'label') {
    switch($data) {
        case 1: 
            $show = '<span class="'.$cl.' '.$cl.'-success">ONLINE</span>';
        break;
        default:
            $show = '<span class="'.$cl.' '.$cl.'-danger">OFFLINE</span>';
    }
    return $show;
}
function stautus_($data, $cl = 'label') {
    switch($data) {
        case 1: 
            $show = '<span class="'.$cl.' '.$cl.'-success">ONLINE</span>';
        break;
        default:
            $show = '<span class="'.$cl.' '.$cl.'-danger">OFFLINE</span>';
    }
    return $show;
}
function listbank()
{
    $html = '
    <option value="">Chọn ngân hàng</option>
    <option value="MOMO">MOMO</option>
    <option value="VIETTEL PAY">VIETTEL PAY</option>
    <option value="ZALO PAY">ZALO PAY</option>
    <option value="AIRPAY">AIRPAY</option>
    <option value="VIETINBANK">VIETINBANK</option>
    <option value="VIETCOMBANK">VIETCOMBANK</option>
    <option value="AGRIBANK">AGRIBANK</option>
    <option value="TPBANK">TPBANK</option>
    <option value="HDB">HDB</option>
    <option value="VPBANK">VPBANK</option>
    <option value="MBBANK">MBBANK</option>
    <option value="OCEANBANK">OCEANBANK</option>
    <option value="BIDV">BIDV</option>
    <option value="SACOMBANK">SACOMBANK</option>
    <option value="ACB">ACB</option>
    <option value="ABBANK">ABBANK</option>
    <option value="NCB">NCB</option>
    <option value="IBK">IBK</option>
    <option value="CIMB">CIMB</option>
    <option value="EXIMBANK">EXIMBANK</option>
    <option value="SEABANK">SEABANK</option>
    <option value="SCB">SCB</option>
    <option value="DONGABANK">DONGABANK</option>
    <option value="SAIGONBANK">SAIGONBANK</option>
    <option value="PG BANK">PG BANK</option>
    <option value="PVCOMBANK">PVCOMBANK</option>
    <option value="KIENLONGBANK">KIENLONGBANK</option>
    <option value="VIETCAPITAL BANK">VIETCAPITAL BANK</option>
    <option value="OCB">OCB</option>
    <option value="MSB">MSB</option>
    <option value="SHB">SHB</option>
    <option value="VIETBANK">VIETBANK</option>
    <option value="VRB">VRB</option>
    <option value="NAMABANK">NAMABANK</option>
    <option value="SHBVN">SHBVN</option>
    <option value="VIB">VIB</option>
    <option value="TECHCOMBANK">TECHCOMBANK</option>
    ';
    return $html;
}
function status_bank($data, $cl = 'label') {
    switch($data) {
        case 1:
            $show = '<span class="'.$cl.' '.$cl.'-success">Đang chạy</span>';
        break;
        default:
            $show = '<span class="'.$cl.' '.$cl.'-danger">Ngưng chạy</span>';
    }
    return $show;
}
function status_dichvu($data, $cl = 'label') {
    switch($data) {
        case 0:
            $show = '<span class="'.$cl.' '.$cl.'-warning">Đang xử lý</span>';
        break;
        case 1:
            $show = '<span class="'.$cl.' '.$cl.'-success">Hoành thành</span>';
        break;
        case 2:
            $show = '<span class="'.$cl.' '.$cl.'-danger">Hủy đơn</span>';
        break;
        case 3:
            $show = '<span class="'.$cl.' '.$cl.'-info">Sai thông tin</span>';
        break;
        case 4:
            $show = '<span class="'.$cl.' '.$cl.'-info">Giam tiền</span>';
        break;
        default:
            $show = '<span class="'.$cl.' '.$cl.'-danger">Tài khoản không đủ tiêu chuẩn để thuê</span>';
    }
    return $show;
}
function status_nhapnick($data, $cl = 'label') {
    switch($data) {
        case 0:
            $show = '<span class="'.$cl.' '.$cl.'-warning">Đang xử lý</span>';
        break;
        case 1: 
            $show = '<span class="'.$cl.' '.$cl.'-success">Chấp thuận</span>';
        break;
        default:
            $show = '<span class="'.$cl.' '.$cl.'-danger">Từ chối</span>';
    }
    return $show;
}
function XoaDauCach($text)
{
    return trim(preg_replace('/\s+/',' ', $text));
}
function numb($data, $str = '.') {
    return str_replace($str, '', $data);
}
function status_users($data) {
    if($data == 'ON') {
        return '<span class="badge badge-success">Active</span>';
    }
    return '<span class="badge badge-danger">Banned</span>';
}
function active($data = []) {
    $url_path = $_SERVER['REQUEST_URI'];
    if (strpos($url_path, '?') !== false) {
        $url_path = strtok($url_path, '?');
    }

    return (in_array($url_path, $data) ? 'active': '');
}
function active_ad($data = []) {
    $url_path = $_SERVER['REQUEST_URI'];
    if(in_array(explode('/', $_SERVER['REQUEST_URI'])[2], $data)) {
        return 'active';
    }
    return '';
}
function giamgia($money, $pt) {
    return $money - $money *$pt/100;
}
/*XỬ LÝ UPLOAD ẢNH*/
function upload_imgur($images) {
    $file     = file_get_contents($images);
    $dataPost = array(
        'image' => base64_encode($file)
    );
    $ch       = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, 1);
    $header[] = 'Authorization: Client-ID d5062e24816be2a';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function inkq($data, $str = '') {
    return ($data) ? $data: $str;
}
function check_username($data)
{
    if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_email($data)
{
    if (preg_match('/^.+@.+$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_phone($data)
{
    if(preg_match('/^[0-9]{10}+$/', $data)) {
        return True;
    } else {
        return False;
    }
}

function myip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))      {  
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];  
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))     {  
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    } else {  
        $ip_address = $_SERVER['REMOTE_ADDR'];  
    }
    return $ip_address;
}
function blockip() {
    global $TUANORI;
    if($TUANORI->get_row(" SELECT * FROM `blockip` WHERE `ip` = '".myip()."' AND `anxa` > '".gettime()."'   ")) {
        return true;
    } else {
        return false;
    }
}
function timeAgo($time_ago) {
    $time_ago   = date("Y-m-d H:i:s", $time_ago);
    $time_ago   = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60)
    {
        return "$seconds giây trước";
    }
    //Minutes
    else if($minutes <= 60)
    {
        return "$minutes phút trước";
    }
    //Hours
    else if($hours <= 24)
    {
        return "$hours tiếng trước";
    }
    //Days
    else if($days <= 7)
    {
        if($days == 1)
        {
            return "Hôm qua";
        }
        else
        {   
            return "$days ngày trước";
        }
    }
    //Weeks
    else if($weeks <= 4.3)
    {
        return "$weeks tuần trước";
    }
    //Months
    else if($months <=12)
    {
        return "$months tháng trước";
    }
    //Years
    else
    {
        return "$years năm trước";
    }
}
function timeLater($time_ago) {
    // $time_ago   = date("Y-m-d H:i:s", $time_ago);
    $time_ago   = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $time_ago - $cur_time;
    if($time_elapsed < 0) {
        return timeAgo($time_ago);
    }
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60)
    {
        return "$seconds giây nữa";
    }
    //Minutes
    else if($minutes <= 60)
    {
        return "$minutes phút nữa";
    }
    //Hours
    else if($hours <= 24)
    {
        return "$hours tiếng nữa";
    }
    //Days
    else if($days <= 7)
    {
        if($days == 1)
        {
            return "Hôm qua";
        }
        else
        {   
            return "$days ngày nữa";
        }
    }
    //Weeks
    else if($weeks <= 4.3)
    {
        return "$weeks tuần nữa";
    }
    //Months
    else if($months <=12)
    {
        return "$months tháng nữa";
    }
    //Years
    else
    {
        return "$years năm nữa";
    }
}
function randomtoken($length = 25) {
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}
function randomtoken2($length = 15) {
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}
$onethang = 2592000;
if(isset($_COOKIE['token']))
{
    $TUANORI->update("users", array(
        'timeon' => gettime(),
        'online' => 'ONLINE'
    ), "tokenlog = '".$_COOKIE['token']."' ");
}
/*
function logclient()
{
    global $TUANORI;
    if(!$TUANORI->get_row(" SELECT * FROM `logclient` WHERE `ip` = '".myip()."' AND `time` >= DATE(NOW()) AND `time` < DATE(NOW()) + INTERVAL 1 DAY"))
    {
            $TUANORI->insert("logclient", [
            'ip'    => myip(),
            'time'  => gettime()
        ]);
    }
}
logclient();
*/

function gift($id, $item, $type=null)  {
    global $TUANORI;
    $res = $TUANORI->get_row(" SELECT * FROM `mini_game_gift` WHERE `id_vongquay` = '$id'");
    $prefix = 'o_';
    $json = json_decode($res[$prefix.$item], true);
    return $json[$type];
}
// LẤY THÔNG TIN CHUNG VÒNG QUAY
function mini_game($id, $action) {
    global $TUANORI;
    $result = $TUANORI->get_row(" SELECT * FROM `mini_game` WHERE `id` = '$id'");
    return $result[$action];
}
$tenmien = $_SERVER['SERVER_NAME'];
$fr = explode('.', $tenmien);

if(blockip() && isset($_COOKIE['token'])) {
    unset($_COOKIE['token']);
    setcookie('token', null, -1, '/');
    header('Location: /');
    die();
}