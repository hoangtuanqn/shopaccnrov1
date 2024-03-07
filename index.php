<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once(__DIR__."/core/config.php");
    require_once(__DIR__."/core/function.php");
    $title = "TRANG CHỦ";
    require_once(__DIR__."/pages/client/Head.php");
    require_once(__DIR__."/pages/client/Header.php");
?>
    <!-- BEGIN: PAGE CONTAINER -->
    <div class="c-layout-page">
        <!-- BEGIN: PAGE CONTENT -->
        <div class="c-content-box">
            <div id="slider" class="owl-theme section section-cate slideshow_full_width ">
                <div id="slide_banner" class="owl-carousel">
                    <div class="item">
                        <a href="#" alt="">
                            <img src="<?=$TUANORI->site('banner1');?>" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" alt="">
                            <img src="<?=$TUANORI->site('banner2');?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- BEGIN: DICH VU NOI BAT -->
        <div class="c-content-box c-size-md c-bg-white">
            <div class="container">
                <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
                    <div class="c-content-title-1">
                        <h3 class="c-center c-font-uppercase c-font-bold">Danh mục nổi bật</h3>
                        <div class="c-line-center" style="width: 100px; height: 1px; margin: 20px auto; border-bottom: 4px solid #32c5d2;"></div>
                    </div>
                    <div class="owl-carousel owl-theme c-theme owl-bordered1 c-owl-nav-center" data-slide-speed="5000" data-rtl="false">
                        <div class="item hover" style="padding-top: 10px;padding-bottom:10px;transition: 0.2s;">
                            <a href="/profile/info">
                                <img src="/uploads/img/info.jpg" alt="tai_khoan" style="width: 94%; opacity: 1.0;">
                            </a>
                        </div>
                        <div class="item hover" style="padding-top: 10px;padding-bottom:10px;transition: 0.2s;">
                            <a href="/profile/nhap-nick">
                                <img src="/uploads/img/nhapnick.jpg" alt="nhap_nick" style="width: 94%; opacity: 1.0;">
                            </a>
                        </div>
                        <div class="item hover" style="padding-top: 10px;padding-bottom:10px;transition: 0.2s;">
                            <a href="/nap-the">
                                <img src="/uploads/img/napthe.jpg" alt="nap_the" style="width: 94%; opacity: 1.0;">
                            </a>
                        </div>
                        <div class="item hover" style="padding-top: 10px;padding-bottom:10px;transition: 0.2s;">
                            <a href="javascript:void(0)">
                                <img src="/uploads/img/muanick.jpg" alt="ngoc_rong" style="width: 94%; opacity: 1.0;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $(".owl-carousel").owlCarousel({
                    autoplay: true,
                    dots: false,
                    loop: true,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 4,
                            autoplay: false
                        }
                    }
                });
            });
        </script>
        <!-- END: DICH VU NOI BAT -->
        <div class="c-content-box c-size-md c-bg-white" style="margin-top: 10px">
            <div class="container">
                <!-- Begin: Testimonals 1 component -->
                <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
                    <!-- Begin: Title 1 component -->
                    <div class="c-content-title-1">
                        <h3 class="c-center c-font-uppercase c-font-bold">Danh mục game</h3>
                        <div class="c-line-center c-theme-bg"></div>
                    </div>
                    <div class="row row-flex-safari game-list">
                        <?php foreach($TUANORI->get_list(" SELECT * FROM `category_game` WHERE `type` = 'account' AND `status` = '1' ORDER BY stt ASC") as $row){ ?>
                    
                            <div class="col-sm-3 col-xs-6 p-5">
                                <div class="classWithPad">
                                    <div class="news_image">
                                        <a href="/nick/<?=$row['slug']?>" title="<?=$row['title']?>" class=""><img class="loading" src="<?=$row['img'];?>" width="290px" height="150px" alt="<?=$row['title'];?>">
                                        </a>
                                    </div>
                                    <div class="news_title">
                                        <h2>
                                            <a href="/nick/<?=$row['slug']?>"
                                            title="<?=$row['title']?>"><?=$row['title']?></a>
                                        </h2>
                                    </div>
                                    <div class="news_description">
                                        <p class="ppp">
                                            Số tài khoản: <?=format_cash($row['num_all'])?> 
                                        </p>
                                        <p class="ppp">
                                            Đã bán: <?=format_cash($row['num_sell'])?> 
                                        </p>
                                    </div>
                                    <div class="a-more">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <a href="/nick/<?=$row['slug']?>" title="<?=$row['title']?>">
                                                    <div class="view">XEM THÊM</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php } ?>
                    </div>
                    <!-- End-->
                </div>
            </div>
        </div>
        <div class="c-content-box c-size-md c-bg-white">
            <div class="container">
                <!-- Begin: Testimonals 1 component -->
                <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
                    <!-- Begin: Title 1 component -->
                    <div class="c-content-title-1">
                        <h3 class="c-center c-font-uppercase c-font-bold">Danh mục game random</h3>
                        <div class="c-line-center c-theme-bg"></div>
                    </div>
                    <div class="row row-flex-safari game-list">
                        <?php foreach($TUANORI->get_list(" SELECT * FROM `category_game` WHERE `type` = 'random'  AND `status` = '1' ORDER BY stt ASC") as $row){ ?>
                        <div class="col-sm-3 col-xs-6 p-5">
                            <div class="classWithPad">
                                <div class="news_image">
                                    <a href="/nick/<?=$row['slug'];?>" title="<?=$row['title'];?>" class=""><img  width="290px" height="150px" class="loading" src="<?=$row['img'];?>" alt="<?=$row['title'];?>">
                                    </a>
                                </div>
                                <div class="news_title">
                                    <h2>
                                        <a href="/nick/<?=$row['slug'];?>"
                                           title="<?=$row['title'];?>"><?=$row['title'];?></a>
                                    </h2>
                                </div>
                                <div class="news_description">
                                    <p class="ppp">
                                        Số tài khoản: <?=number_format($row['num_all']);?> </p>
                                    <p class="ppp">
                                        Đã bán: <?=number_format($row['num_sell']);?> </p>
                                </div>
                                <div class="a-more">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="/nick/<?=$row['slug'];?>" title="<?=$row['title'];?>">
                                                <div class="view">XEM THÊM</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                    <!-- End-->
                </div>
            </div>
        </div>
        <div class="c-content-box c-size-md c-bg-white">
            <div class="container">
                <!-- Begin: Testimonals 1 component -->
                <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
                    <!-- Begin: Title 1 component -->
                    <div class="c-content-title-1">
                        <h3 class="c-center c-font-uppercase c-font-bold">Khu vực dịch vụ</h3>
                        <div class="c-line-center c-theme-bg"></div>
                    </div>
                    <div class="row row-flex-safari game-list">
                    <?php if($TUANORI->site('status_banvang') == '1') { ?>
                    <div class="col-sm-3 col-xs-6 p-5">
                        <div class="classWithPad">
                            <div class="news_image">
                                <a href="/ban-vang" title="<?=$TUANORI->site('title_banvang');?>" class=""><img  width="290px" height="150px" class="loading" src="<?=$TUANORI->site('img_banvang');?>" alt="<?=$TUANORI->site('title_banvang');?>">
                                </a>
                            </div>
                            <div class="news_title">
                                <h2>
                                    <a href="/ban-vang"
                                        title="<?=$TUANORI->site('title_banvang');?>"><?=$TUANORI->site('title_banvang');?></a>
                                </h2>
                            </div>
                            <div class="news_description">
                                <p class="ppp">
                                    Đã mua: <?=format_cash($TUANORI->site('num_sell_banvang'));?>
                                </p>
                            </div>
                            <div class="a-more">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="/ban-vang" title="<?=$TUANORI->site('title_banvang');?>">
                                            <div class="view">XEM THÊM</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($TUANORI->site('status_banngoc') == '1') { ?>
                    <div class="col-sm-3 col-xs-6 p-5">
                        <div class="classWithPad">
                            <div class="news_image">
                                <a href="/ban-ngoc" title="<?=$TUANORI->site('title_banngoc');?>" class=""><img  width="290px" height="150px" class="loading" src="<?=$TUANORI->site('img_banngoc');?>" alt="<?=$TUANORI->site('title_banngoc');?>">
                                </a>
                            </div>
                            <div class="news_title">
                                <h2>
                                    <a href="/ban-ngoc"
                                        title="<?=$TUANORI->site('title_banngoc');?>"><?=$TUANORI->site('title_banngoc');?></a>
                                </h2>
                            </div>
                            <div class="news_description">
                                <p class="ppp">
                                    Đã mua: <?=format_cash($TUANORI->site('num_sell_banngoc'));?>

                                </p>
                            </div>
                            <div class="a-more">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="/ban-ngoc" title="<?=$TUANORI->site('title_banngoc');?>">
                                            <div class="view">XEM THÊM</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php foreach($TUANORI->get_list(" SELECT * FROM `category_dichvu` WHERE `status` = '1' ORDER BY stt ASC ") as $row){ ?>
                    <div class="col-sm-3 col-xs-6 p-5">
                        <div class="classWithPad">
                            <div class="news_image">
                                <a href="/dich-vu/<?=$row['slug'];?>" title="<?=$row['title'];?>" class=""><img  width="290px" height="150px" class="loading" src="<?=$row['img'];?>" alt="<?=$row['title'];?>">
                                </a>
                            </div>
                            <div class="news_title">
                                <h2>
                                    <a href="/dich-vu/<?=$row['slug'];?>"
                                        title="<?=$row['title'];?>"><?=$row['title'];?></a>
                                </h2>
                            </div>
                            <div class="news_description">
                                <p class="ppp">
                                    Đã thuê: <?=number_format($row['num_sell']);?>
                                </p>
                            </div>
                            <div class="a-more">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="/dich-vu/<?=$row['slug'];?>" title="<?=$row['title'];?>">
                                            <div class="view">XEM THÊM</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    </div>
                </div>
                <!-- End-->
            </div>
            <!-- End-->
        </div>
        <div class="c-content-box c-size-md c-bg-white">
            <div class="container">
                <!-- Begin: Testimonals 1 component -->
                <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
                    <!-- Begin: Title 1 component -->
                    <div class="c-content-title-1">
                        <h3 class="c-center c-font-uppercase c-font-bold">Danh mục vòng quay</h3>
                        <div class="c-line-center c-theme-bg"></div>
                    </div>
                    <div class="row row-flex-safari game-list">
                    <?php foreach($TUANORI->get_list(" SELECT * FROM `mini_game` WHERE `status` = '1' ORDER BY stt ASC") as $row){ ?>
                        <div class="col-sm-3 col-xs-6 p-5">
                            <div class="classWithPad">
                                <div class="news_image">
                                    <a href="/vongquay/<?=$row['slug']?>.html" title="<?=$row['title']?>" class=""><img  width="290px" height="150px" class="loading" src="<?=$row['img']?>" alt="<?=$row['title']?>">
                                    </a>
                                </div>
                                <div class="news_title">
                                    <h2>
                                            <a href="/vongquay/<?=$row['slug']?>.html"
                                               title="<?=$row['title']?>"><?=$row['title']?></a>
                                        </h2>
                                </div>
                                <div class="news_description">
                                    <p class="ppp">
                                        Đã quay: <?=number_format($row['num_sell'])?> </p>
                                    <p class="ppp">
                                    </p>
                                </div>
                                <div class="a-more">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="/vongquay/<?=$row['slug']?>.html" title="<?=$row['title']?>">
                                                <div class="view">Quay Ngay</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    <!-- End-->
                </div>
            </div>
        </div>
        <link href="/giaodien/assets/frontend/css/custom9173.css?18012022" rel="stylesheet" type="text/css" />
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="box box-danger collapsed-box box-solid" style="padding: 0;">
                        <div class="box-header with-border">
                            <h3 class="box-title">TOP NẠP THÁNG <?=date('m');?></h3>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="min-height: 480px;">
                            <div class="tab-content">
                                <div id="top10" class="tab-pane fade active in">
                                    <div id="evenstop10" style="color: #505050;">
                                        <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `users` WHERE `total_topnapthe` != '0' ORDER BY total_topnapthe DESC LIMIT 10") as $row){ ++$i; ?>
                                        <div class="row">
                                            <div class="col-xs-8" style="padding-right: 0px;">
                                                <label class="control-label">
                                                    <span class="fa-stack">
                                                        <span class="fa fa-circle fa-stack-2x color color_<?=$i;?>"></span><strong class="fa-stack-1x" style="color:white;"><?=$i;?></strong>
                                                    </span>
                                                    <img src="/uploads/img/people.png" class="img-top" alt="" title="" onerror="this.src='/uploads/img/people.png'" media-simple="true">
                                                    <?=$row['fullname']?>
                                            </label>
                                            </div>
                                            <div class="col-xs-4" style="text-align: right;">
                                                <label class="control-label">
                                                    <button type="button" class="btn btn-danger tops"><?=number_format($row['total_topnapthe'])?></button>
                                                </label>
                                            </div>
                                        </div>
                                        <?php } ?>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-lg-6">
                    <div class="box box-danger collapsed-box box-solid" style="padding: 0;">
                        <div class="box-header with-border">
                            <h3 class="box-title">PHẦN THƯỞNG</h3>
                            <!-- /.box-tools -->
                        </div>
                        <div class="box-body" style="color: #505050;padding:20px;min-height: 480px;line-height: 2;">
                        <p style="margin-left:0; margin-right:0; text-align:center"><strong><span style="color:#e25041">TOP NẠP THẺ THÁNG <?=date('m');?></span></strong>
                        </p>
                        <?php $data = explode("\n", $TUANORI->site('note_topnap')); ?>
                        <p style="margin-left:0; margin-right:0; text-align:center"><strong><span style="color:#61bd6d">TOP 1: NHẬN <?=$data[0];?></span></strong>
                        </p>
                        <p style="margin-left:0; margin-right:0; text-align:center"><span style="color:#61bd6d"><strong>TOP 2: NHẬN <?=$data[1];?></strong></span>
                        </p>
                        <p style="margin-left:0; margin-right:0; text-align:center"><strong><span style="color:#61bd6d">TOP 3: NHẬN <?=$data[2];?></span></strong>
                        </p>
                           <?=$TUANORI->site('phanthuong_top')?>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <?php if(empty($getUser['username']) || !$getUser['bonus']) { //bonus = 0 có nghĩa là chưa nhận quà ?>
        <style type="text/css">
            #bonus {
                position: fixed;
                bottom: 15px;
                left: 15px;
                width: 13%;
                z-index: 1;
                cursor: pointer;
            }
            
            #bonus img {
                width: 100%;
            }
            
            @media only screen and (max-width: 640px) {
                #bonus {
                    width: 50%!important;
                }
            }
            
            #bonusModal .modal-body p,
            #bonusModal .modal-body b {
                display: inline;
                color: #000
            }
        </style>
        <a id="bonus" href="javascript:void(0)" title="Click để nhận quà!">
            <img src="/uploads/img/nhanqua.png">
            <div id="result_qua"></div>
        </a>
        <script type="text/javascript">
            var isMobile = {
                Android: function() {
                    return navigator.userAgent.match(/Android/i);
                },
                BlackBerry: function() {
                    return navigator.userAgent.match(/BlackBerry/i);
                },
                iOS: function() {
                    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                },
                Opera: function() {
                    return navigator.userAgent.match(/Opera Mini/i);
                },
                Windows: function() {
                    return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
                },
                any: function() {
                    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
                }
            };
            if (isMobile.any()) {
                document.getElementById("bonus").style = "width: 45%!important;";
            }
            $('#bonus').click(function() {
                $.ajax({
                    url: '/controller/client/Bonus.php',
                    type: 'post',
                    success: function(data) {
                        $("#result_qua").html(data);
                    },
                    error: function() {
                        swal("Lỗi", "Có lỗi xảy ra, vui lòng thử lại!", "error");
                    }
                });
            })
        </script>
    <?php } ?>
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    require_once(__DIR__."/pages/client/Footer.php");
?>
