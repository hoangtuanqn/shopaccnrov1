
<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $slug   = check_string($_GET['slug']);
    $tt     = $TUANORI->get_row(" SELECT * FROM `mini_game` WHERE `slug` = '$slug' AND `status` = '1'");
    if(!$tt) {
        header("Location: /");
        die;
    }
    $title = $tt['title'];
    require_once("../../pages/client/Head.php");
    require_once("../../pages/client/Header.php");
?>
    <div class="c-layout-page">

        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
        <style>
            .ui-autocomplete {
                max-height: 500px;
                overflow-y: auto;
                overflow-x: hidden;
            }
            
            .input-group-addon {
                background-color: #FAFAFA;
            }
            
            .input-group .input-group-btn > .btn,
            .input-group .input-group-addon {
                background-color: #FAFAFA;
            }
            
            .modal {
                text-align: center;
            }
            
            @media screen and (min-width: 768px) {
                .modal:before {
                    display: inline-block;
                    vertical-align: middle;
                    content: " ";
                    height: 100%;
                }
            }
            
            @media (min-width: 992px) and (max-width: 1200px) {
                .c-layout-header-fixed.c-layout-header-topbar .c-layout-page {
                    margin-top: 245px;
                }
            }
            
            @media screen and (max-width: 767px) {
                .modal-dialog:before {
                    margin-top: 75px;
                    display: inline-block;
                    vertical-align: middle;
                    content: " ";
                    height: 100%;
                }
                .modal-dialog {
                    width: 100%;
                }
                .modal-content {
                    margin-right: 20px;
                }
            }
            
            .modal-dialog {
                display: inline-block;
                text-align: left;
            }
            
            .mfp-wrap {
                z-index: 20000 !important;
            }
            
            .c-content-overlay .c-overlay-wrapper {
                z-index: 6;
            }
            
            .z7 {
                z-index: 7 !important;
            }
            
            .nickdaquay {
                position: fixed;
                z-index: 9999;
                bottom: 170px;
                right: 0px;
                max-width: 15%;
                min-width: 120px;
                min-height: 120px;
            }
            
            .anhbymanh {
                position: fixed;
                z-index: 9999;
                bottom: 80px;
                left: 0px;
                max-width: 29%;
                min-height: 20px;
            }
            
            .napthebymanh {
                position: fixed;
                z-index: 9999;
                bottom: 100px;
                right: 0px;
                max-width: 15%;
                min-height: 40px;
                min-width: 100px;
            }
            
            .flex-list .item {
                width: 50%;
                padding: 0 30px;
            }
            
            .rotation {
                text-align: center;
            }
            
            section {
                padding: 30px 0;
            }
            
            .rotation .play-spin {
                width: 100%;
                position: relative;
                margin: 0 auto;
            }
            
            .rotation .play-spin .ani-zoom {
                position: absolute;
                display: block;
                width: 110px;
                z-index: 5;
                top: calc(50% - 70px);
                left: calc(50% - 55px);
            }
            
            .ani-zoom {
                -webkit-transition: all .2s linear;
                -moz-transition: all .2s linear;
                -ms-transition: all .2s linear;
                -o-transition: all .2s linear;
                transition: all .2s linear;
            }
            
            img {
                max-width: 100%;
            }
            
            img {
                vertical-align: middle;
            }
            
            img {
                border: 0;
            }
            
            .text-center {
                text-align: center;
            }
            
            li {
                list-style: none;
            }
            
            .form-notication-bottom {
                position: fixed;
                bottom: 20px;
                left: 10px;
                width: 330px;
                height: auto;
                background-color: #fff;
                border-radius: 40px;
                z-index: 1;
                box-shadow: 2px 2px 10px 2px hsla(0, 0%, 60%, .2);
                animation: example 8s infinite;
                max-width: calc(90% - 10px);
                overflow: hidden;
            }
            
            @keyframes example {
                0% {
                    bottom: -100px;
                }
                25% {
                    bottom: 20px;
                }
                50% {
                    bottom: 20px;
                }
                100% {
                    bottom: -100px;
                }
            }
            
            li {
                list-style-type: none
            }
            
            .history {
                width: 40% !important;
            }
            
            @media only screen and (max-width: 800px) {
                .c-content-client-logos-slider-1 .item {
                    width: 90%;
                    margin: auto;
                }
                #rotate-play {
                    width: 100% !important;
                    max-width: 100% !important;
                }
                .rotation .play-spin .ani-zoom img {
                    width: 85% !important;
                }
                .history {
                    width: 100% !important;
                }
            }
            
            .c-content-box.c-size-md {
                padding: 0
            }
            
            .pd50 {
                padding-top: 50px;
            }
            
            .list-roll {
                margin-top: 30px;
                margin-bottom: 30px;
            }
            
            @media screen and (min-width: 800px) {
                .list-roll-inner {
                    width: 85%;
                    margin-top: 30px;
                    max-height: 400px;
                    overflow-y: scroll;
                    margin: 0 auto;
                }
            }
            
            @media screen and (min-width: 1600px) {
                .list-roll-inner {
                    width: 85%;
                    margin-top: 30px;
                    max-height: 600px;
                    overflow-y: scroll;
                    margin: 0 auto;
                }
            }
            
            .btn-top {
                display: flex;
                justify-content: center;
                margin-bottom: 30px
            }
            
            .btn-top .btn {
                margin-left: 15px;
                margin-right: 15px;
                padding: 6px 20px;
            }
            
            .btn-top span {
                font-size: 25px;
            }
            
            @media screen and (max-width: 640px) {
                .btn-top span {
                    font-size: 17px;
                }
            }
        </style>

        <div class="c-content-title-1 pd50">
            <h3 class="c-center c-font-uppercase c-font-bold">QUAY LÀ TRÚNG 25K ( SĂN NICK NGON )</h3>
            <div class="c-line-center c-theme-bg"></div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="c-content-box c-size-md c-bg-white">

                <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
                    <div class="row row-flex-safari game-list" style="display: flex; flex-wrap: wrap">
                        <div class="item item-left">
                            <section class="rotation">
                                <div class="play-spin">
                                    <a class="ani-zoom" id="start-played1"><img src="/uploads/img/quay.png" alt="Play Center">
                                    </a>
                                    <img style="width: 80%;max-width: 80%;opacity: 1;" src="<?=$tt['img_anh'];?>" alt="Play" id="rotate-play">
                                </div>
                                <div class="text-center">           
                                    <h3 class="num-play">Bạn còn <span><?=number_format(floor($getUser['money']/$tt['sotien']));?></span> lượt quay.</h3>
                                    <?php // if($tt['sotien'] >=$getUser]) ?>
                                    <li>
                                        <a class="ani-zoom btn-img deposit-btn disabled" href="/nap-the" style="width:60%; display:none">
                                            <img src="/uploads/img/mualuot.png" alt="">
                                        </a>
                                    </li>
                                </div>
                            </section>
                            
                        </div>
                    </div>
                    <div class="table-body scrollbar-inner">
                        <table class="table table-bordered">
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-6 col-md-12 list-roll">
            <div class="btn-top">
                <a href="#" class="thele btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill">
                    <span><i class="la la-cloud-upload"></i><span>Thể Lệ</span>
                    </span>
                </a>
                <a href="/profile/vong-quay" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill">
                    <span><i class="la la-cloud-upload"></i><span>Lịch sử quay</span>
                    </span>
                </a>
            </div>
            <div class="modal fade" id="theleModal" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thể Lệ</h4>
                        </div>
                        <div class="modal-body" style="font-family: helvetica, arial, sans-serif;">
                            <?=$tt['note']?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(".thele").on("click", function() {
                        $("#theleModal").modal('show');
                    })
                    $(".uytin").on("click", function() {
                        $("#uytinModal").modal('show');
                    })
                });
            </script>
            <div class="modal fade" id="uytinModal" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Uy
                                Tín</h4>
                        </div>
                        <div class="modal-body" style="font-family: helvetica, arial, sans-serif;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-content-title-1" style="margin: 0 auto">
                <h3 class="c-center c-font-uppercase c-font-bold">LƯỢT QUAY GẦN ĐÂY</h3>
            </div>
            <div class="list-roll-inner">
                <table cellpadding="10" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tài khoản</th>
                            <th>Giải thưởng</th>
                            <th>Thời gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `history_vongquay` ORDER BY id DESC LIMIT 20 ") as $row){ ?>
                        <tr>
                            <td>#<?=++$i;?></td>
                            <td><?=substr($row['username'], 0, 5);?>****</td>
                            <td><?=$row['note'];?></td>
                            <td><?=timeAgo(strtotime($row['thoigian']));?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="noticeModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thông báo</h4>
                    </div>
                    <div class="modal-body content-popup" style="font-family: helvetica, arial, sans-serif;">

                    </div>
                    <div class="modal-footer" id="kimhung">
                        <a href="/profile/rut-vang" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill">Rút quà</a>
                        <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            #start-played1 {
                cursor: pointer;
            }
            
            .c-content-client-logos-slider-1 .item {
                width: 85%;
            }
        </style>
            <input type="hidden" id="numgift" value="8">
            <script type="text/javascript">
                $(document).ready(function(e){
                var roll_check = true;
                var num_loop = 4;
                var angle_gift = '';
                var num_gift = $("#numgift").val();
                var gift_detail = '';
                var num_roll_remain = 0;
                var angles = 0;
                //Click nút quay
                $('body').delegate('#start-played1', 'click', function(){
                    if(roll_check){
                        roll_check = false;
                        $.ajax({
                            url: '/xuly-quay.html',
                            dataType: 'json',
                            type: 'post',
                            data:{
                                id: <?=$tt['id'];?>
                            },
                            success: function(data) {
                                if(data.status=='ERROR'){
                                    roll_check = true;
                                    $('#rotate-play').css({"transform": "rotate(0deg)"});
                                    $('.content-popup').text(data.msg);
                                    $('#noticeModal').modal('show');
                                    return;
                                }
                                if(data.status=='LOGIN'){
                                    location.href='/login';
                                    return;
                                }
                                gift_detail = data.msg;
                                num_roll_remain = gift_detail.num_roll_remain;
                                $('#rotate-play').css({"transform": "rotate(0deg)"});
                                angles = 0;
                                angle_gift = gift_detail.pos*(360/num_gift);
                                loop();
                            },
                            error: function() {
                                $('.content-popup').text('Có lỗi xảy ra. Vui lòng thử lại!');
                                $('#noticeModal').modal('show');
                            }
                        });

                    }
                });
                function loop() {
                    $('#rotate-play').css({"transform": "rotate("+angles+"deg)"});
                    
                    if((parseInt(angles)-10)<=-(((num_loop*360)+angle_gift))){
                        angles = parseInt(angles) - 2;
                    }else{
                        angles = parseInt(angles) - 10;
                    }
                    
                    if(angles >= -((num_loop*360)+angle_gift)){
                        requestAnimationFrame(loop);
                    }else{
                        roll_check = true;
                        $('.content-popup').text('Kết quả: '+gift_detail.name);
                        $('#noticeModal').modal('show');
                        $('.num-play span').text(num_roll_remain);
                        if(num_roll_remain==0){
                            $('.deposit-btn').show();
                        }else{
                            $('.deposit-btn').hide();
                        }
                    }
                }
            });
            </script>
    </div>
<?php 
    require_once("../../pages/client/Footer.php");
?>