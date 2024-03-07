<div id="thongbao"></div>
<?=$TUANORI->site('javascript');?>
<script>
    function updateTextView(_obj){
        var num = getNumber(_obj.val());
        if(num==0){
            _obj.val('');
        }else{
            _obj.val(num.toLocaleString());
        }
    }
    function getNumber(_str){
        var arr = _str.split('');
        var out = new Array();
        for(var cnt=0;cnt<arr.length;cnt++){
            if(isNaN(arr[cnt])==false){
                out.push(arr[cnt]);
            }
        }
        return Number(out.join(''));
    }
    $(document).ready(function(){
        $('.fnum').on('keyup',function(){
            updateTextView($(this));
        });
    });
</script>
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" />
        <div class="modal fade" id="noticeModal" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">
                        Thông
                        báo</h4>
                    </div>
                    <div class="modal-body" style="font-family: helvetica, arial, sans-serif;">
                        <p style="text-align:center"><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" /><span style="background-color:#ffffff; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:22px"><span style="color:#e74c3c"><strong>NICK9S.COM</strong></span></span><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" />
                            <br />
                            <span style="color:#27ae60"><span style="font-size:16px"><strong>Shop Đ&atilde; Cập Nhật Dịch Vụ Game</strong></span></span>
                        </p>

                        <p style="text-align:center"><span style="color:#27ae60"><span style="font-size:16px"><strong>nhập nick 9sv: </strong></span></span><span style="color:#3498db"><span style="font-size:18px"><strong><strong>03999.396.34</strong></strong></span></span>
                        </p>

                        <p style="text-align:center"><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" /><span style="color:#3498db"><span style="font-size:18px"><strong><strong>NẠP QUA ATM-V&Iacute; TỰ ĐỘNG 24/24</strong></strong></span></span><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" />
                        </p>

                        <p style="text-align:center"><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" /><span style="color:#3498db"><span style="font-size:18px"><strong><strong>NHẬN TH&Ecirc;M 15% GI&Aacute; TRỊ NẠP</strong></strong></span></span><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" />
                        </p>

                        <p style="text-align:center"><strong><strong><span style="color:#27ae60"><strong><span style="color:#3498db">AE Tha Hồ Lựa Chọn Những Nick Ngon GI&Aacute; CỰC RẺ</span></strong>
                            </span>
                            </strong>
                            </strong>
                        </p>

                        <p style="text-align:center"><strong><strong><span style="color:#27ae60"><strong><span style="color:#3498db">C&aacute;c nick ngon radom tỉ lệ nick ngon cực cao</span></strong>
                            </span>
                            </strong>
                            </strong>
                        </p>

                        <p style="text-align:center"><strong><span style="color:#3498db">DO YOUTUBER</span></strong><strong>: <span style="color:#e74c3c">Rồng Black Vận H&agrave;nh</span></strong>
                        </p>

                        <p style="text-align:center"><span style="color:#e67e22"><strong>Đảm Bảo 100% uy t&iacute;n cho ae</strong></span>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: PAGE CONTENT -->
    </div>
    
    <div class="modal fade" id="noticeModal" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <p style="text-align:center"><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" /><span style="background-color:#ffffff; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:22px"><span style="color:#e74c3c"><strong>NICK9S.COM</strong></span></span><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" />
                    <br />
                    <span style="color:#27ae60"><span style="font-size:16px"><strong>Shop Đ&atilde; Cập Nhật Dịch Vụ Game</strong></span></span>
                </p>

                <p style="text-align:center"><span style="color:#27ae60"><span style="font-size:16px"><strong>nhập nick 9sv: </strong></span></span><span style="color:#3498db"><span style="font-size:18px"><strong><strong>03999.396.34</strong></strong></span></span>
                </p>

                <p style="text-align:center"><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" /><span style="color:#3498db"><span style="font-size:18px"><strong><strong>NẠP QUA ATM-V&Iacute; TỰ ĐỘNG 24/24</strong></strong></span></span><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" />
                </p>

                <p style="text-align:center"><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" /><span style="color:#3498db"><span style="font-size:18px"><strong><strong>NHẬN TH&Ecirc;M 15% GI&Aacute; TRỊ NẠP</strong></strong></span></span><img src="/assets/hot.gif" style="-webkit-text-stroke-width:0px; background-color:#ffffff; border:0px; box-sizing:border-box; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:17px; font-style:normal; font-variant-caps:normal; font-variant-ligatures:normal; font-weight:400; height:29px; letter-spacing:normal; orphans:2; text-align:center; text-decoration-color:initial; text-decoration-style:initial; text-decoration-thickness:initial; text-indent:0px; text-transform:none; white-space:normal; widows:2; width:45px; word-spacing:0px" />
                </p>

                <p style="text-align:center"><strong><strong><span style="color:#27ae60"><strong><span style="color:#3498db">AE Tha Hồ Lựa Chọn Những Nick Ngon GI&Aacute; CỰC RẺ</span></strong>
                    </span>
                    </strong>
                    </strong>
                </p>

                <p style="text-align:center"><strong><strong><span style="color:#27ae60"><strong><span style="color:#3498db">C&aacute;c nick ngon radom tỉ lệ nick ngon cực cao</span></strong>
                    </span>
                    </strong>
                    </strong>
                </p>

                <p style="text-align:center"><strong><span style="color:#3498db">DO YOUTUBER</span></strong><strong>: <span style="color:#e74c3c">Rồng Black Vận H&agrave;nh</span></strong>
                </p>

                <p style="text-align:center"><span style="color:#e67e22"><strong>Đảm Bảo 100% uy t&iacute;n cho ae</strong></span>
                </p>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            if ($.cookie('noticeModal') != '1') {
                $('#noticeModal').modal('show');
                $.cookie('noticeModal', '1');
            }
            // $('#noticeModal').modal('show');

        });
    </script>
    </div>
    <div class="modal fade" id="LoadModal" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="loader" style="text-align: center"><img src="/assets/frontend/images/loader.gif" style="width: 50px;height: 50px;display: none">
            </div>
            <div class="modal-content">
            </div>
        </div>
    </div>
    <script>
        $('img').load(function() {
            $(this).removeClass("loading");
        });
    </script>
    </div>
    <div class="modal fade" id="LoadModal" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="loader" style="text-align: center"><img src="/giaodien/assets/frontend/images/loader.gif" style="width: 50px;height: 50px;display: none">
            </div>
            <div class="modal-content">
            </div>
        </div>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script id="PHT_TUANORIVN">
        setInterval(function() {
            var minimalUserResponseInMiliseconds = 100;
            var before = new Date().getTime();
            debugger;
            var after = new Date().getTime();
            if (after - before > minimalUserResponseInMiliseconds) {
                document.querySelector("html").innerHTML = "";
                window.location.reload(true);
            }
        }, 100);
        document.getElementById("PHT_TUANORIVN").remove();
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            $('.load-modal').each(function(index, elem) {
                $(elem).unbind().click(function(e) {
                    e.preventDefault();
                    e.preventDefault();
                    var curModal = $('#LoadModal');
                    curModal.find('.modal-content').html("<div class=\"loader\" style=\"text-align: center\"><img src=\"/giaodien/assets/frontend/images/loader.gif\" style=\"width: 50px;height: 50px;\"></div>");
                    curModal.modal('show').find('.modal-content').load($(elem).attr('rel'));
                });
            });
        });
    </script>
    <script>
        window.addEventListener('load', (event) => {
            $("img").removeClass("loading");
        });
    </script>
 

    <div class="c-content-box c-size-md c-bg-white groomsmen-bridesmaids" style="padding-bottom:20px;">
        <div class="container">
            <div class="row">
                <div class="row-flex-safari game-list">
                    <div class="col-sm-3 col-xs-6 p-5">
                        <img src="<?=BASE_URL('uploads/img/xcrLpVB.png');?>" alt="">
                    </div>
                    <div class="col-sm-3 col-xs-6 p-5">
                        <img src="<?=BASE_URL('uploads/img/oAeeq5w.png');?>" alt="">
                    </div>
                    <div class="col-sm-3 col-xs-6 p-5">
                        <img src="<?=BASE_URL('uploads/img/JDIyaix.png');?>" alt="">
                    </div>
                    <div class="col-sm-3 col-xs-6 p-5">
                        <img src="<?=BASE_URL('uploads/img/M3fu9Va.png');?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="c-layout-footer c-layout-footer-3 c-bg-dark">
        <div class="c-prefooter">
            <div class="container">
                <div class="col-md-4">
                    <div class="c-container c-first">
                        <div class="c-content-title-2">
                            <h3 class="c-font-uppercase c-font-bold c-font-white" style="color:#d8d8d8 !important;">Về <span class="c-theme-font" style="color:#0b93a3 !important"><?=strtoupper($_SERVER['HTTP_HOST']);?></span>
                        </h3>
                            <div class="c-line-left hide"></div>
                            <p class="c-text" style="font-size: 17px;font-weight: 300;color: #d8d8d8;margin: 30px 0;"><?=$TUANORI->site('mota');?></p>
                        </div>
                        <ul class="c-links">
                            <li class="c-font-uppercase c-font-white" style="font-size: 15px;text-transform: uppercase;font-weight: 200;border-bottom: 1px solid #d8d8d8;">
                                <a href="#">GIỚI THIỆU</a>
                            </li>
                            <li class="c-font-uppercase c-font-white" style="font-size: 15px;text-transform: uppercase;font-weight: 200;border-bottom: 1px solid #d8d8d8;">
                                <a href="#">ĐIỀU KHOẢN</a>
                            </li>
                            <li class="c-font-uppercase c-font-white" style="font-size: 15px;text-transform: uppercase;font-weight: 200;border-bottom: 1px solid #d8d8d8;">
                                <a href="#">UY TÍN CỦA SHOP</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4" style="z-index: 1;">
                    <div class="c-container c-last">
                        <div class="c-content-title-2">
                            <h3 class="c-font-uppercase c-font-bold c-font-white" style="color:#d8d8d8 !important;">CHI TIẾT
                            LIÊN HỆ</h3>
                            <div class="c-line-left hide"></div>
                            <p></p>
                        </div>
                        <ul class="c-socials">
                            <li><a href="<?=$TUANORI->site('fbadmin');?>" target="_blank"><i
                                        class="icon-social-facebook"></i></a>
                            </li>
                            <li><a href="<?=$TUANORI->site('ytbadmin');?>" target="_blank"><i
                                        class="icon-social-youtube"></i></a>
                            </li>
                        </ul>
                        <ul class="c-address">
                            <li><i class="icon-call-end c-theme-font"></i>
                                <a href="tel:<?=$TUANORI->site('phone');?>" class="c-font-regular" style="font-size: 15px;text-transform: uppercase;font-weight: 200;">Hotline: <?=$TUANORI->site('phone');?></a>
                            </li>
                            <li><i class="icon-user c-theme-font"></i>
                                <a href="mailto:<?=$TUANORI->site('email');?>" class="c-font-regular" style="font-size: 15px;text-transform: uppercase;font-weight: 200;">Email:
                                <span><?=$TUANORI->site('email');?></span></a>
                            </li>
                            <li><i class="icon-check c-theme-font"></i>
                                <a href="https://zalo.me/0812665001" class="c-font-regular-cpr" style="font-size: 15px;font-weight: 200;" target="_blank">Vận hành bởi <b style="color: #ff0000;">TUANORI.VN</b></a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
                <div class="col-md-4" style="padding-right: 6px; display: block; max-width: 100%">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F107037674595404%2F&amp;tabs=timeline&amp;width=360&amp;height=270&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId=922183248608214" width="100%" height="270" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                </div>
                <div class="col-sm-12 c-col" style="padding-bottom:5px;padding-top:25px;">
                    <p style="color: #d8d8d8 !important; font-weight: 600">
                        Shop Acc Uy Tín © <?=date('Y');?> </p>
                </div>
            </div>
        </div>
    </footer>
    <div style="z-index: 9669;">
        <div class="c-layout-go2top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/jquery.easing.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/reveal-animate/wow.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/demos/default/js/scripts/reveal-animate/reveal-animate.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/global/plugins/magnific/magnific.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/smooth-scroll/jquery.smooth-scroll.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/js-cookie/js.cookie.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/base/js/components.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/base/js/app.js" type="text/javascript"></script>

    <script src="/giaodien/assets/frontend/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            App.init(); // init core
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(".menu-main-mobile a").click(function() {

            if ($(this).closest("li").hasClass("c-open")) {
                $(this).closest("li").removeClass("c-open");
            } else {
                $(this).closest("li").addClass("c-open");
            }
        });
    </script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/moment.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/theme/assets/demos/default/js/scripts/pages/datepicker.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js" type="text/javascript"></script>
    <script src="/giaodien/assets/frontend/js/common.js" type="text/javascript"></script>
    <script src="/assets/NoSleep.min.js" type="text/javascript"></script>
    <script>
        window.addEventListener('load', (event) => {
            var noSleep = new NoSleep();
            document.addEventListener('click', function enableNoSleep() {
                document.removeEventListener('click', enableNoSleep, false);
                noSleep.enable();
            }, false);
        });
    </script>
</body>
<!-- CODE BY TUANORI.VN NĂM <?=date('Y');?> - ZALO: 0812665001 NHẬN LÀM WEBSITE BÁN ACC GAME, DỊCH VỤ MXH-->

</html>
