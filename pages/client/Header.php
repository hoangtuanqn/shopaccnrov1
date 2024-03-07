<body class="c-layout-header-fixed c-layout-header-mobile-fixed c-layout-header-topbar c-layout-header-topbar-collapse">
    <header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
        <div class="c-topbar c-topbar-light">
            <div class="container">
                <nav class="c-top-menu c-pull-left">
                    <ul class="c-icons c-theme-ul">
                        <li>
                            <a href="<?=$TUANORI->site('fbadmin');?>" target="_blank">
                                <i class="icon-social-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?=$TUANORI->site('ytbadmin');?>" target="_blank">
                                <i class="icon-social-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <nav class="c-top-menu c-pull-right m-t-10">
                    <ul class="c-links c-theme-ul">
                        <li>
                            Hotline: <a href="tel:<?=$TUANORI->site('phone');?>"><?=$TUANORI->site('phone');?> </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="c-navbar">
            <div class="container">
                <div class="c-navbar-wrapper clearfix">
                    <div class="c-brand c-pull-left">
                        <h1 style="margin: -20px;margin-left: 0px;display: inline-block">
                        <a href="/" class="c-logo"
                           alt="<?=$TUANORI->site('mota');?>">
                            <img height="60px"
                                 src="<?=$TUANORI->site('logo');?>"
                                 alt="" class="c-desktop-logo" style="margin-top: 8px;">
                            <img height="65px"
                                 src="<?=$TUANORI->site('logo');?>"
                                 alt="" class="c-desktop-logo-inverse" style="margin-top: 7.7px;">
                            <img height="55px"
                                 src="<?=$TUANORI->site('logo');?>"
                                 alt="" class="c-mobile-logo" style="margin-top: 2.7px; margin-left: -6px;"> </a>
                    </h1>
                        <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                            <span class="c-line"></span>
                            <span class="c-line"></span>
                            <span class="c-line"></span>
                        </button>
                        <button class="c-topbar-toggler" type="button">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                    </div>
                    <nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold d-none hidden-xs hidden-sm">
                        <ul class="nav navbar-nav c-theme-nav">
                            <li class="c-menu-type-classic"><a href="/" class="c-link dropdown-toggle ">Trang chủ</a>
                            </li>
                            <li class="c-menu-type-classic"><a href="<?=BASE_URL('mua-the');?>" class="c-link dropdown-toggle ">Mua thẻ</a>
                            </li>
                            <li class="c-menu-type-classic"><a rel="" href="javascript:void(0)" class="c-link dropdown-toggle ">Liên hệ ADMIN <span class="c-arrow c-toggler"></span></a>
                                <ul id="children-of-41" class="dropdown-menu c-menu-type-classic c-pull-left ">
                                    <li class="c-menu-type-classic"><a href="<?=$TUANORI->site('fbadmin');?>" target="_blank" class="">Facebook</a></li>
                                    <li class="c-menu-type-classic"><a href="<?=$TUANORI->site('ytbadmin');?>" target="_blank" class="">Youtube</a></li>
                                </ul>
                            </li>
                            <li class="c-menu-type-classic"><a rel="" href="javascript:void(0)" class="c-link dropdown-toggle ">Nạp tiền <span class="c-arrow c-toggler"></span></a>
                                <ul id="children-of-41" class="dropdown-menu c-menu-type-classic c-pull-left ">
                                    <?php if($TUANORI->site('status_card')): ?>
                                        <li class="c-menu-type-classic"><a rel="" href="/nap-the" class="">Nạp thẻ cào tự động</a></li>
                                    <?php endif;?>
                                    <li class="c-menu-type-classic"><a rel="/view/Atm.html" <?=(empty($_COOKIE['token'])) ? ' href="/login" ' : ' class="load-modal" href="javascript:void(0)" ';?>>Nạp tiền từ ATM/Ví điện tử</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="c-menu-type-classic"><a rel="" href="<?=BASE_URL('profile/nhap-nick');?>" class="c-link dropdown-toggle ">Nhập Nick Game</a>
                            </li>
                            <?php if(empty($_COOKIE['token'])) { ?>
                            <li>
                                <a href="/login" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">
                                    <i class="icon-user"></i> Đăng nhập</a>
                            </li>
                            <li>
                                <a href="/register" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">
                                    <i class="icon-key"></i> Đăng ký</a>
                            </li>
                            <?php } else { ?>
                            <li>
                                <a href="<?=BASE_URL('profile/info');?>" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">
                                    <i class="icon-user"></i> <?=$getUser['username'];?> -
                                    <tuan id="infouu"><?=format_cash($getUser['money']);?></tuan><sup style="text-transform: lowercase;">₫</sup>
                                </a>
                            </li>
                            <li>
                                <a href="<?=BASE_URL('logout');?>" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold" onclick="return confirm('Bạn có muốn đăng xuất?');">
                                    <i class="icon-logout"></i> Đăng xuất</a>
                            </li>
                            
                            <?php } ?>
 
                        </ul>
                    </nav>
                    <nav class="menu-main-mobile c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold hidden-md hidden-lg" style="margin-top: 11px;">
                        <ul class="nav navbar-nav c-theme-nav">
                            <li class="c-menu-type-classic"><a rel="" href="/" class="c-link dropdown-toggle ">Trang chủ</a>
                            </li>
                            <li class="c-menu-type-classic"><a rel="" href="<?=BASE_URL('mua-the');?>" class="c-link dropdown-toggle ">Mua thẻ</a>
                            </li>
                            <li class="c-menu-type-classic"><a rel="" href="javascript:void(0)" class="c-link dropdown-toggle ">Liên hệ<span class="c-arrow c-toggler"></span></a>
                                <ul id="children-of-41" class="dropdown-menu c-menu-type-classic c-pull-left ">
                                    <li class="c-menu-type-classic"><a rel="" href="<?=$TUANORI->site('fbadmin');?>" target="_blank" class="">FACEBOOK</a></li>
                                    <li class="c-menu-type-classic"><a rel="" href="<?=$TUANORI->site('ytbadmin');?>"  target="_blank" class="">YOUTUBE</a></li>
                                </ul>
                            </li>

                            <li class="c-menu-type-classic"><a rel="" href="javascript:void(0)" class="c-link dropdown-toggle ">Nạp tiền<span class="c-arrow c-toggler"></span></a>
                                <ul id="children-of-41" class="dropdown-menu c-menu-type-classic c-pull-left ">
                                    <li class="c-menu-type-classic"><a rel="" href="<?=BASE_URL('/nap-the');?>" class="">Nạp thẻ cào tự động</a>
                                    </li>
                                    <li class="c-menu-type-classic"><a rel="/view/Atm.html" <?=(empty($_COOKIE['token'])) ? ' href="/login" ' : '';?>>Nạp tiền từ ATM/Ví điện tử</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="c-menu-type-classic"><a rel="" href="<?=BASE_URL('profile/nhap-nick');?>" class="c-link dropdown-toggle ">Nhập Nick Game</a></li>
                            <?php if(empty($_COOKIE['token'])) { ?>
                            <li>
                                <a href="/login" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">
                                    <i class="icon-user"></i> Đăng nhập</a>
                            </li>
                            <li>
                                <a href="/register" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">
                                    <i class="icon-key"></i> Đăng ký</a>
                            </li>
                            <?php } else { ?>
                            <li>
                                <a href="<?=BASE_URL('profile/info');?>" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">
                                    <i class="icon-user"></i> <?=$getUser['username'];?> -
                                    <tuan id="infouuu"><?=format_cash($getUser['money']);?></tuan><sup style="text-transform: lowercase;">₫</sup>
                                </a>
                            </li>
                            <li>
                                <a href="<?=BASE_URL('logout');?>" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold" onclick="return confirm('Bạn có muốn đăng xuất?');">
                                    <i class="icon-logout"></i> Đăng xuất</a>
                            </li>
                            <?php } ?>

                          
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>


    
    <style>
        .loading {
            min-height: 100px;
            min-width: 100%;
            width: 100%;
            background: transparent url('/giaodien/assets/frontend/images/loader.gif') center no-repeat;
        }
        
        .hover:hover {
            transition: 0.2s;
            transform: scale(1.08);
            z-index: 69696;
        }
        
        .row-centered {
            text-align: center;
        }
        
        .col-centered {
            display: inline-block;
            float: none;
        }
        
        @media only screen and (max-width: 991px) {
            .col-centered {
                width: 100%;
            }
            .row-flex-safari .classWithPad {
                max-height: 100%;
            }
        }
        
        .ppp {
            font-weight: 300;
        }
        
        .color {
            color: #000
        }
        
        .color_1 {
            color: red
        }
        
        .color_2 {
            color: #07840d
        }
        
        .color_3 {
            color: #fc9605
        }
    </style>
    