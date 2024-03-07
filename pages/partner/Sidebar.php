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
                <a href="<?=BASE_URL('Partner/Home');?>" class="brand-link">
                    <span class="brand-text font-weight-light"><center>CỘNG TÁC</center></span>
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
                            <a href="<?=BASE_URL('Partner/Home');?>" class="d-block"><?=$getUser['username'];?></a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item has-treeview">
                                <a href="<?=BASE_URL('Partner/Home');?>" class="nav-link <?=active_ad(['Home', '', '/']);?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">ĐƠN HÀNG</li>
                           
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Partner/DonDichVu');?>" class="nav-link <?=active_ad(['DonDichVu', 'EditDonHang']);?>">
                                    <i class="nav-icon fas fa-cart-plus"></i>
                                    <p>
                                        Dịch vụ game <span class="badge badge-info right"><?=$TUANORI->num_rows("SELECT * FROM `history_dichvu` WHERE `status` = '0' AND `dichvu` > 0 AND `ctv` = '' ") ;?></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Partner/DonDichVuMe');?>" class="nav-link <?=active_ad(['DonDichVuMe']);?>">
                                    <i class="nav-icon fas fa-cart-plus"></i>
                                    <p>
                                        Dịch vụ game đang làm <span class="badge badge-info right"><?=$TUANORI->num_rows("SELECT * FROM `history_dichvu` WHERE `status` = '0' AND `dichvu` > 0 AND `ctv` = '".$getUser['username']."' ") ;?></span>
                                    </p>
                                </a>
                            </li>
                        
                            <li class="nav-header">QUẢN LÝ</li>
                            
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Partner/Coupon');?>" class="nav-link <?=active_ad(['Coupon', 'Add-Coupon', 'EditCoupon']);?>">
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
                                        <a href="<?=BASE_URL('Partner/Partner');?>"
                                            class="nav-link <?=active_ad(['Partner']);?>">
                                            <i class="fa-regular fa-handshake nav-icon"></i>
                                            <p>Cộng tác viên</p>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Partner/Category');?>" class="nav-link <?=active_ad(['Category', 'EditCategory', 'AddSelect', 'Accounts', 'Account']);?>">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Chuyên mục game
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Partner/Random');?>" class="nav-link <?=active_ad(['Random', 'EditRandom', 'Randoms']);?>">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Chuyên mục random
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Partner/Dichvu');?>" class="nav-link <?=active_ad(['Dichvu', 'EditDichvu', 'AddDichvu', 'EditListDichvu']);?>">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Chuyên mục dịch vụ
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item <?=active_ad(['Dongtien', 'HisMuaAcc']) ? 'menu-open': '';?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-history"></i>
                                    <p>
                                        Lịch Sử
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Partner/Dongtien');?>"
                                            class="nav-link <?=active_ad(['Dongtien']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Biến động số dư</p>
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="<?=BASE_URL('Partner/HisMuaAcc');?>"
                                            class="nav-link <?=active_ad(['HisMuaAcc']);?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lịch sử mua nick</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?=BASE_URL('Partner/Ruttien');?>" class="nav-link <?=active_ad(['Ruttien']);?>">
                                    <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                                    <p>
                                        Rút tiền <span class="badge badge-info right"><?=$TUANORI->num_rows("SELECT * FROM `history_dichvu` WHERE `status` = '0' AND `dichvu` > 0 AND `ctv` = '".$getUser['username']."' ") ;?></span>
                                    </p>
                                </a>
                            </li>
                           
                            
                       
                        </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>