
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $id = check_string($_GET['id']) ?? 0;
    $tt = $TUANORI->get_row(" SELECT * FROM `list_acc_game` WHERE `id` = '$id'");
    if(!$tt) {
        header("Location: /");
        die;
    }
    $category = $TUANORI->get_row(" SELECT * FROM `category_game` WHERE `id` = '".$tt['category_game']."'");
    $title = "Thông Tin Tài Khoản ".$category['title']." #$id" ?? 404;
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
    $mucchinh = [];
    foreach(explode("\n", $category['author']) as $tuan) {
        array_push($mucchinh, $tuan);
    }
?>
    <div class="c-layout-page">
        <style>
            .zoom {
                cursor: zoom-in;
            }
            
            .col-xs-6 .btn {
                margin-top: 5px;
            }
        </style>
        <div class="container">
            <div class="col-sm-12 text-center" style="margin-bottom: 20px;margin-top:55px;">
                <h2 class="c-center c-font-uppercase c-font-bold" style="color: #e7505a; font-size: 23px"><?php echo $name = $category['title'];?></h2>
                <div style="width: 140px; height: 1px; margin: 20px auto; border-bottom: 4px solid #00bff3;"></div>
            </div>
            <div class="col-sm-12 text-center" style=" margin-bottom: 50px;">
                <h2 class="c-font-uppercase c-font-bold"><span>THÔNG TIN TÀI KHOẢN </span><span
                                    style="color:#e7505a;">#<?=$tt['id']?></span></h2>
                <span style="font-weight: 200;">Để Xem Thêm Chi Tiết Về Tài Khoản Vui Lòng Kéo Xuống Bên Dưới</span>
            </div>
            <div class="c-shop-product-details-4">
                <div class="row">
                    <div class="col-md-4 m-b-20">
                        <div class="c-product-header">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="c-product-meta">
                            <div class="c-product-price c-theme-font" style="float: none;text-align: center">
                                    <?=number_format(round($tt['card'] / (1 + $TUANORI->site('ckatm')/100)))?> ATM/VÍ
                                <br/> 
                                    <?=number_format($tt['card']);?> CARD
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="c-product-header">
                            <div class="c-content-title-1">
                                <button type="button" class="btn c-btn btn-lg c-theme-btn c-font-uppercase c-font-bold m-t-20 load-modal" rel="/mua-ngay/html?id=<?=$id?>">Mua ngay </button>
                                <a class="btn c-btn btn-lg c-bg-green-4 c-font-white c-font-uppercase c-font-bold m-t-20" href="/nap-the" target="_blank">Nạp thẻ cào</a>
                                <button type="button" class="btn c-btn btn-lg btn-danger c-font-white c-font-uppercase c-font-bold m-t-20" onclick="window.location.href='/nap-the';">ATM - Ví điện tử
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-product-meta">
                    <div class="c-content-divider">
                        <i class="icon-dot"></i>
                    </div>
                    <div class="row">
                        <?php if($category['type'] == 'account') {
                        $data = explode("\n", $tt['author']); $i = 0;
                        foreach($data as $tuann) { ?>
                        <div class="col-xs-2 col-sm-3 col-xs-6 c-product-variant">
                            <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold"><?=$mucchinh[$i++]?>: <span class="c-font-red"><?=$tuann?></span>
                            </p>
                        </div>
                        <?php } } ?>
                        <div class="col-sm-12 col-xs-12 c-product-variant">
                            <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">
                                Nổi bật: <span class="c-font-red"><?=$tt['noibat'];?></span>
                            </p>
                        </div>
                        <div class="col-sm-12 col-xs-12 c-product-variant">
                            <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">
                                Giảm giá: <span class="c-font-red"><?=$tt['giamgia'];?>%</span>
                            </p>
                        </div>
                    </div>
                    <div class="c-content-divider">
                        <i class="icon-dot"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container m-t-20 content_post">
            <div class="col-sm-12 text-center" style=" margin-bottom: 50px;">
                <h2 style="font-size:17px;"><span>Hình ảnh chi tiết của tài khoản </span>
                <span style="color:#e7505a;"><?=$name;?> #<?=$id;?></span></h2>
            </div>
            <?php foreach(explode("\n", $tt['listimg']) as $ok) { ?>
            <p>
                <img src="<?=$ok;?>" class="loading zoom" onerror="this.src='<?=$TUANORI->site('logo');?>'">
            </p>
            <?php } ?>
            <div class="buy-footer" style="text-align: center">
                <!-- <button type="button" class="btn c-btn btn-lg c-theme-btn c-font-uppercase c-font-bold m-t-20" rel="/mua-ngay/html?id=<?=$id?>">Mua ngay
                </button> -->
                <button type="button" class="btn c-btn btn-lg c-theme-btn c-font-uppercase c-font-bold m-t-20 load-modal" rel="/mua-ngay/html?id=<?=$id?>">Mua ngay </button>

            </div>
            <br>
            <br>
        </div>

        
        <div class="container m-t-20 ">
            <div class="game-item-view" style="margin-top: -20px">
                <div class="c-content-title-1">
                    <h3 class="c-center c-font-uppercase c-font-bold">Tài khoản liên quan</h3>
                    <div class="c-line-center c-theme-bg"></div>
                </div>
                <div class="row row-flex  item-list">
                <?php foreach($TUANORI->get_list(" SELECT * FROM `list_acc_game` WHERE `category_game` = '".$tt['category_game']."' AND `id` != '$id' AND  `username` IS NULL ORDER BY id DESC LIMIT 8") as $row){ ?>
                    <div class="col-sm-6 col-md-3 p-5">
                        <div class="classWithPad">
                            <div class="image">
                                <a href="/sanpham/<?=$row['id']?>.html">
                                    <img class="loading" src="<?=$row['img']?>" onerror="this.src='<?=$TUANORI->site('logo')?>'"> <span class="ms">Mã số: <?=$row['id']?></span>
                                    <span class="giamgia" style="text-decoration: line-through;color: white"><?=number_format($row['giacu'])?>đ</span>
                                </a>
                            </div>
                            <div class="description">
                                ATM/VÍ ĐIỆN TỬ: <?=number_format($row['atm'])?>đ
                            </div>
                            <div class="attribute_info" style="color: rgb(0, 0, 0)">
                                <div class="row">
                                    <?php if($category['type'] == 'account') {
                                    $data = explode("\n", $row['author']); $i = 0;
                                    foreach($data as $tuann) { ?>
                                    <div class="col-xs-6 a_att"><?=$mucchinh[$i++]?>:
                                        <b><?=$tuann;?></b>
                                    </div>
                                    <?php }  } else {  ?><br/>
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
            </div>
        </div>
    </div>
    <div class="modal fade" id="enlargeImageModal" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" class="enlargeImageModalSource" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
    <script>
        $('img').load(function(){
           $(this).removeClass("loading");
        });
    </script>
    <script>
        $('.zoom').on('click', function () {
            $('.enlargeImageModalSource').attr('src', $(this).attr('src'));
            $('#enlargeImageModal').modal('show');
        });
    </script>

<?php 
    require_once("../../pages/client/Footer.php");
?>
   