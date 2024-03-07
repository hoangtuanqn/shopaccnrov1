
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $slug = check_string($_GET['slug']);
    $tt = $TUANORI->get_row(" SELECT * FROM `category_game` WHERE `slug` = '$slug' AND `status` = '1'");
    if(!$tt) {
        header("Location: /");
        die;
    }
    $title = $tt['title'] ?? "404";
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    $sotin1trang = 20; // 5 hàng 4 cột => 20 acc
    if(isset($_GET['page'])) {
        $page = intval($_GET['page']);
    } else {
        $page = 1;
    }
    $from = ($page - 1) * $sotin1trang;
    $mucchinh = [];
    foreach(explode("\n", $tt['author']) as $tuan) {
        array_push($mucchinh, $tuan);
    }
    if($tt['type'] == 'account') { 
        /*XỬ LÝ MỤC HIỆN THÔNG TIN ĐỂ TÌM KIẾM*/
        $show = $TUANORI->get_row(" SELECT * FROM `select_category` WHERE `category_game` = '".$tt['id']."'")['author'];
        $show = json_decode($show, true);
    }

    ?>
<?php 
/*GIÁ TRỊ MẶC ĐỊNH*/
$sapxep = 1;
$desc = "ORDER BY id DESC";
$idacc = '';
$tkacc = $tkgia = "";
/*GIÁ TRỊ SAU KHI SUBMIT TÌM KIẾM*/
if(isset($_GET['timkiem'])) { 
    $idacc = check_string($_GET['idacc']);
    if($idacc >=1) {
        $tkacc= "AND `id` = '$idacc'";
    }
    /*START TÌM KIẾM THEO GIÁ TIỀN*/
    $price = check_string( $_GET['price']);
    switch($price) {
        case 'duoi-50k':
            $tkgia =  "AND `card` < 50000";
        break;
        case 'tu-50k-200k':
            $tkgia =  "AND `card` >= 50000 AND `card` <=200000";
        break;
        case 'tu-200k-500k':
            $tkgia =  "AND `card` >= 200000 AND `card` <=500000";
        break;
        case 'tu-500k-1-trieu':
            $tkgia =  "AND `card` >= 500000 AND `card` <=1000000";
        break;
        case 'tren-1-trieu':
            $tkgia =  "AND `card` > 1000000";
        break;
        case 'tren-5-trieu':
            $tkgia =  "AND `card` > 5000000";
        break;
        case 'tren-10-trieu':
            $tkgia =  "AND `card` > 10000000";
        break;
    }
    /*END TÌM KIẾM THEO GIÁ TIỀN*/

    $sapxep = check_string($_GET['sapxep']);
    if($sapxep == 2) {
        $desc = "ORDER BY card ASC";
    } else if($sapxep == 3) {
        $desc = "ORDER BY card DESC";
    }
}
$tkchuyeu = $str = '';
foreach($_GET as $key => $value) {
    // echo $key.'<br>';
    if(!in_array($key, ['sapxep', 'slug', 'idacc', 'timkiem', 'price', 'page'])) { // không tính nêu như get những cái này
        if(strlen($value) >=1) $tkchuyeu .= "AND `author` LIKE  '%".str_replace('+',' ',$value) . "%' "; // tk chủ yếu
    }
    if(!in_array($key, ['slug']))  // không tính nêu như get những cái này
    $str .= '&'.$key.'='.str_replace(' ','+',$value); // lấy những request đang có để chuyển sang mục phân trang nếu có
}
// echo $str; 
$list_acc = $TUANORI->get_list(" SELECT * FROM `list_acc_game` WHERE `category_game` = '".$tt['id']."' $tkacc $tkgia $tkchuyeu AND  `username` IS NULL $desc LIMIT $from,$sotin1trang");
?>
    <br>
    <br>
    <div class="c-layout-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center c-font-bold">
                    <h2 class="c-center c-font-uppercase c-font-bold" style="color: #19b1ff; font-size: 23px">BÁN NICK NGỌC RỒNG GIÁ SIÊU RẺ</h2>
                    <div style="width: 140px; height: 1px; margin: 20px auto; border-bottom: 4px solid #19b1ff;"></div>
                </div>
            </div>
            <div class="alert alert-info">
                <div class="row">
                    <div class="col-md-12 header-title-buy">
                        <div class="content_post">
                            <?=$tt['mota'];?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($tt['type'] == 'account') { ?>
            <div class="row" style="margin-bottom: 15px">
                <div class="m-l-10 m-r-10">
                    <form class="form-inline m-b-10" action="/chuyenmuc.html" method="GET">
                        <div class="col-md-3 col-sm-4 p-5 field-search">
                            <div class="input-group">
                                <span class="input-group-addon">Mã số</span>
                                <input type="text" class="form-control" style="height: 42px;" value="<?=$idacc ?? ''?>" placeholder="Mã số nick" name="idacc">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                            <div class="input-group">
                                <span class="input-group-addon">Giá tiền</span>
                                <select class="form-control" name="price">
                                    <option value="">Chọn giá tiền</option>
                                    <option value="duoi-50k" <?=(isset($_GET['price']) && $_GET['price'] == 'duoi-50k') ? 'selected' : '';?>>
                                        Dưới 50K
                                    </option>
                                    <option value="tu-50k-200k" <?=(isset($_GET['price']) && $_GET['price'] == 'tu-50k-200k') ?'selected' : '';?>>
                                        Từ 50K - 200K
                                    </option>
                                    <option value="tu-200k-500k" <?=(isset($_GET['price']) && $_GET['price'] == 'tu-200k-500k') ?'selected' : '';?>>
                                        Từ 200K - 500K
                                    </option>
                                    <option value="tu-500k-1-trieu" <?=(isset($_GET['price']) && $_GET['price'] == 'tu-500k-1-trieu') ?'selected' : '';?>>
                                        Từ 500K - 1 Triệu
                                    </option>
                                    <option value="tren-1-trieu" <?=(isset($_GET['price']) && $_GET['price'] == 'tren-1-trieu') ?'selected' : '';?>>
                                        Trên 1 Triệu
                                    </option>
                                    <option value="tren-5-trieu" <?=(isset($_GET['price']) && $_GET['price'] == 'tren-5-trieu') ? 'selected' : '';?>>
                                        Trên 5 Triệu
                                    </option>
                                    <option value="tren-10-trieu" <?=(isset($_GET['price']) && $_GET['price'] == 'tren-10-trieu') ?'selected' : '';?>>
                                        Trên 10 Triệu
                                    </option>
                                </select>
                            </div>
                        </div>
                        <?php foreach($mucchinh as $tm) { ?>
                        <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                            <div class="input-group">
                                <span class="input-group-addon"><?=$tm;?></span>
                                <select class="form-control" name="<?=slug($tm);?>">
                                    <option value=""><?=$tm;?></option>
                                <?php foreach($show[slug($tm)] as $ok) { ?>
                                    <option value="<?=$ok;?>" <?=(isset($_GET[slug($tm)]) && $ok == str_replace('+',' ',$_GET[slug($tm)])) ? 'selected' : ''?> ><?=$ok;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <input name="slug" value="<?=$tt['slug']?>" type="hidden">
                        <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                            <div class="input-group">
                                <span class="input-group-addon">Sắp xếp</span>
                                <select class="form-control" name="sapxep">
                                    <option value="1">Mặc định</option>
                                    <option value="2" <?=($sapxep == 2) ? 'selected': '';?>>Giá từ thấp tới cao</option>
                                    <option value="3" <?=($sapxep == 3) ? 'selected': '';?>>Giá từ cao xuống thấp</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 p-5 no-radius">
                            <button type="submit" class="btn c-theme c-btn-green" style="padding: 9px 30px;" name="timkiem">Tìm kiếm
                            </button>
                            <a class="btn m-l-0 btn-danger" href="/nick/<?=$tt['slug']?>" style="padding: 9px 30px;">Tất cả</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
            <div class="row row-flex item-list" id="start">
            <?php foreach($list_acc as $row){ ?>
                <div class="col-sm-6 col-md-3 p-5">
                    <div class="classWithPad">
                        <div class="image">
                            <a href="/sanpham/<?=$row['id']?>.html">
                                <img class="loading" src="<?=$row['img']?>" onerror="this.src='<?=$TUANORI->site('logo')?>'"> <span class="ms">Mã số: <?=$row['id']?></span>
                                <?php if($row['giacu'] > $row['card']) { ?>
                                    <span class="giamgia" style="text-decoration: line-through;color: white"><?=number_format($row['giacu'])?>đ</span>
                                <?php } ?>
                            </a>
                        </div>
                        <div class="description">
                            ATM/VÍ ĐIỆN TỬ: <?=number_format(round($row['card'] / (1 + $TUANORI->site('ckatm')/100)))?>đ
                        </div>
                        <div class="attribute_info" style="color: rgb(0, 0, 0)">
                            <div class="row">
                                <?php if($tt['type'] == 'account') {
                                $data = explode("\n", $row['author']); $i = 0;
                                foreach($data as $tuann) { ?>
                                <div class="col-xs-6 a_att"><?=$mucchinh[$i++]?>:
                                    <b><?=$tuann;?></b>
                                </div>
                                <?php if($i >=4) break; }  } else {  ?><br/>
                                    <center><b>Nick Ngẫu Nhiên</b></center>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="a-more">
                            <div class="row">
                                <div class="col-xs-7 p-5">
                                    <div class="price_item">
                                        <b><span>CARD: </span><?=number_format($row['card'])?>đ</b>
                                    </div>
                                </div>
                                <div class="col-xs-5 p-5">
                                    <a href="/sanpham/<?=$row['id']?>.html">
                                        <div class="view3">
                                            <B>CHI TIẾT</B>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                
            </div>
            <div class="col-md-12">
                <?php
                    $tong = $TUANORI->num_rows(" SELECT * FROM `list_acc_game` WHERE `category_game` = '".$tt['id']."' $tkacc $tkgia $tkchuyeu AND  `username` IS NULL $desc");
                    if ($tong > $sotin1trang)
                    {
                        echo '<center>' . phantrang('/chuyenmuc.html?slug='.$tt['slug'].$str.'&', $from, $tong, $sotin1trang) . '</center>';
                    }
                ?>
            </div>
        </div>
    </div>
<?php 
    require_once("../../pages/client/Footer.php");
?>
   