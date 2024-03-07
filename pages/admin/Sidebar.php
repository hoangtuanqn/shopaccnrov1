    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?=BASE_URL('');?>" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="https://tuanori.vn/" class="nav-link">Liên hệ</a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="<?=BASE_URL('Admin/Home');?>" class="brand-link">
                    <span class="brand-text font-weight-light"><center>QUẢN TRỊ</center></span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="/uploads/img/people.png" class="img-circle elevation-2"
                                alt="TUANORI">
                        </div>
                        <div class="info">
                            <a href="<?=BASE_URL('Admin/Home');?>" class="d-block"><?=$getUser['username'];?></a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item has-treeview">
                                <a href="<?=BASE_URL('Admin/Home');?>" class="nav-link <?=active_ad(['Home', '', '/']);?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">ĐƠN HÀNG</li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/DonMuaVang');?>" class="nav-link <?=active_ad(['DonMuaVang']);?>">
                                    <i class="nav-icon fas fa-cart-plus"></i>
                                    <p>
                                        <?php $num1 = $TUANORI->num_rows("SELECT * FROM `history_dichvu` WHERE `status` = '0' AND `dichvu` = '-1'") ;?>
                                        Đơn mua vàng
                                        <?php if($num1 > 0) { ?>
                                            <span class="badge badge-info right"><?=number_format($num1);?></span>
                                        <?php } ?>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/DonMuaNgoc');?>" class="nav-link <?=active_ad(['DonMuaNgoc']);?>">
                                    <i class="nav-icon fas fa-cart-plus"></i>
                                    <p>
                                        Đơn mua ngọc 
                                        <?php $num2 = $TUANORI->num_rows("SELECT * FROM `history_dichvu` WHERE `status` = '0' AND `dichvu` = '-2'");?>
                                        <?php if($num2 > 0) { ?>
                                            <span class="badge badge-info right"><?=number_format($num2);?></span>
                                        <?php } ?>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/DonDichVu');?>" class="nav-link <?=active_ad(['DonDichVu', 'EditDonHang']);?>">
                                    <i class="nav-icon fas fa-cart-plus"></i>
                                    <p>
                                        Dịch vụ game 
                                        <?php $num3 = $TUANORI->num_rows("SELECT * FROM `history_dichvu` WHERE `status` = '0' AND `dichvu` > 0");?>
                                        <?php if($num3 > 0) { ?>
                                            <span class="badge badge-info right"><?=number_format($num2);?></span>
                                        <?php } ?>
                                    </p>
                                </a>
                            </li>
                        
                            <li class="nav-header">QUẢN LÝ</li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/IpBlack');?>" class="nav-link <?=active_ad(['IpBlack']);?>">
                                    <i class="nav-icon fas fa-lock"></i>
                                    <p>
                                        IP Black
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/Coupon');?>" class="nav-link <?=active_ad(['Coupon', 'Add-Coupon', 'EditCoupon']);?>">
                                    <i class="nav-icon fas fa-percent"></i>
                                    <p>
                                        Mã giảm giá
                                    </p>
                                </a>
                            </li>
                         
                            <li class="nav-item <?=active_ad(['Administrator', 'Partner', 'Users']) ? 'menu-open': '';?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Người dùng
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/Administrator');?>"
                                            class="nav-link <?=active_ad(['Administrator']);?>">
                                            <i class="fa-solid fa-user-tie nav-icon"></i>
                                            <p>Quản trị viên</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/Partner');?>"
                                            class="nav-link <?=active_ad(['Partner']);?>">
                                            <i class="fa-regular fa-handshake nav-icon"></i>
                                            <p>Cộng tác viên</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/Users');?>"
                                            class="nav-link <?=active_ad(['Users']);?>">
                                            <i class="fa-solid fa-user nav-icon"></i>
                                            <p>Thành viên</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/Category');?>" class="nav-link <?=active_ad(['Category', 'EditCategory', 'AddSelect', 'Accounts', 'Account']);?>">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Chuyên mục game
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/Random');?>" class="nav-link <?=active_ad(['Random', 'EditRandom', 'Randoms']);?>">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Chuyên mục random
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/Dichvu');?>" class="nav-link <?=active_ad(['Dichvu', 'EditDichvu', 'AddDichvu', 'EditListDichvu']);?>">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Chuyên mục dịch vụ
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/Vongquay');?>" class="nav-link <?=active_ad(['Vongquay', 'EditVongquay', 'Add-Vongquay']);?>">
                                    <i class="nav-icon fas fa-gamepad"></i>
                                    <p>
                                        Chuyên mục vòng quay
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/BellTele');?>" class="nav-link <?=active_ad(['BellTele']);?>">
                                    <i class="nav-icon fas fa-bell"></i>
                                    <p>
                                        Thông báo Telegram
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item <?=active_ad(['Dongtien', 'HisNapthe', 'HisMuaAcc', 'HisVongQuay', 'NhapNick', 'Rutvang', 'EditRutVang', 'Rutngoc', 'EditRutngoc', 'Ruttien', 'EditRuttien']) ? 'menu-open': '';?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-history"></i>
                                    <p>
                                        Lịch Sử
                                        <i class="fas fa-angle-left right"></i>
                                        <?php 
                                            $num = $TUANORI->num_rows("SELECT * FROM `nhapnick_game` WHERE `status` = '0'") ?? 0;
                                            $num2 = $TUANORI->num_rows("SELECT * FROM `ctv_ruttien` WHERE `status` = '0'") ?? 0;
                                            $num3 = $TUANORI->num_rows("SELECT * FROM `history_rutvang` WHERE `status` = '0'") ?? 0;
                                            $num4 = $TUANORI->num_rows("SELECT * FROM `history_rutngoc` WHERE `status` = '0'") ?? 0;
                                            $tong = $num+$num2+$num3 + $num4;
                                        ?>
                                        <?php if($tong > 0) { ?>
                                            <span class="badge badge-info right"><?=number_format($tong);?></span>
                                        <?php } ?>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/Dongtien');?>"
                                            class="nav-link <?=active_ad(['Dongtien']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Biến động số dư</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/HisNapthe');?>"
                                            class="nav-link <?=active_ad(['HisNapthe']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lịch sử Nạp Thẻ</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/HisNapthe');?>"
                                            class="nav-link <?=active_ad(['HisNapthe']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lịch sử Nạp ATM</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/HisMuaAcc');?>"
                                            class="nav-link <?=active_ad(['HisMuaAcc']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lịch sử mua nick</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/HisVongQuay');?>"
                                            class="nav-link <?=active_ad(['HisVongQuay']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lịch sử vòng quay</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/NhapNick');?>"
                                            class="nav-link <?=active_ad(['NhapNick']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Nhập nick</p>
                                            <?php if($num > 0) { ?>
                                                <span class="badge badge-info right"><?=number_format($num);?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/Rutvang');?>"
                                            class="nav-link <?=active_ad(['Rutvang', 'EditRutvang']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lịch sử rút vàng</p>
                                            <?php if($num3 > 0) { ?>
                                                <span class="badge badge-info right"><?=number_format($num3);?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/Rutngoc');?>"
                                            class="nav-link <?=active_ad(['Rutngoc', 'EditRutngoc']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lịch sử rút ngọc</p>
                                            <?php if($num4 > 0) { ?>
                                                <span class="badge badge-info right"><?=number_format($num3);?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Admin/Ruttien');?>"
                                            class="nav-link <?=active_ad(['Ruttien', 'EditRuttien']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Rút tiền từ CTV</p>
                                            <?php if($num2 > 0) { ?>
                                                <span class="badge badge-info right"><?=number_format($num2);?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                
                                </ul>
                            </li>
                            <li class="nav-header">NẠP TIỀN</li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/Cards');?>" class="nav-link <?=active_ad(['Cards']);?>">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        Nạp thẻ cào
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/Bank');?>" class="nav-link <?=active_ad(['Bank']);?>">
                                    <i class="nav-icon fas fa-university"></i>
                                    <p>
                                        Ngân hàng
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">CÀI ĐẶT</li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/Setting');?>" class="nav-link <?=active_ad(['Setting']);?>">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Cấu hình
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/SettingMuaVang');?>" class="nav-link <?=active_ad(['SettingMuaVang']);?>">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Mua vàng
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/SettingMuaNgoc');?>" class="nav-link <?=active_ad(['SettingMuaNgoc']);?>">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Mua ngọc
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/SettingMuaThe');?>" class="nav-link <?=active_ad(['SettingMuaThe','EditMuaThe', 'AddThe', 'EditThe']);?>">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Mua thẻ
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/Topnap');?>" class="nav-link <?=active_ad(['Topnap']);?>">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Top Nạp
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">TÍCH HỢP LOGIN (<b style="color: red">VIP</b>)</li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/LoginZALO');?>" class="nav-link <?=active_ad(['LoginZALO']);?>">
                                    <i class="fa-sharp fa-solid fa-right-to-bracket nav-icon"></i>
                                    <p>
                                        Đăng nhập ZALO
                                        <?=status_onoff($TUANORI->site('status_zalo'));?>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Admin/LoginGOOGLE');?>" class="nav-link <?=active_ad(['LoginGOOGLE']);?>">
                                    <i class="fa-sharp fa-solid fa-right-to-bracket nav-icon"></i>
                                    <p>
                                        Đăng nhập GOOGLE
                                        <?=status_onoff($TUANORI->site('status_google'));?>
                                    </p>
                                </a>
                            </li>
                        </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>