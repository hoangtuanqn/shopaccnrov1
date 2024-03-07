<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'DASHBROAD | '.$TUANORI->site('title');
    require_once("../../pages/admin/Header.php");
    require_once("../../pages/admin/Sidebar.php");
?>

<?php
$donhang = ($TUANORI->num_rows(" SELECT * FROM `history_dichvu` WHERE `status` = '1' ") ?? 0);
$tongtien = $TUANORI->get_row("SELECT SUM(`tongtien`) FROM `history_dichvu` WHERE `status` = '1' ")['SUM(`tongtien`)'] ?? 0; 
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-12">
            <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=format_cash($donhang);?></h3>
                        <p>Đơn hàng thành công</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?=format_cash($TUANORI->get_row("SELECT SUM(`num_sell`) FROM `category_game` WHERE `num_sell` > 0 ")['SUM(`num_sell`)'] ?? 0);?></h3>
                        <p>Tài khoản đã bán</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?=BASE_URL('Admin/HisMuaAcc');?>" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?=format_cash($TUANORI->num_rows(" SELECT * FROM `users` ") ?? 0);?></h3>
                        <p>Tổng thành viên</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?=BASE_URL('Admin/Users');?>" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?=number_format($tongtien);?>đ</h3>
                        <p>Doanh thu đơn hàng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <?php
                function doanhthu($where) {
                    global $TUANORI;
                    $a = $TUANORI->get_row("SELECT SUM(`tongtien`) FROM `history_dichvu` $where ")['SUM(`tongtien`)'] ?? 0;
                    // $b = $TUANORI->get_row("SELECT SUM(`num_sell`) FROM `category_game` $where ")['SUM(`num_sell`)'] ?? 0;
                    return $a;
                }
                function taikhoan($where) {
                    global $TUANORI;
                    $a = $TUANORI->num_rows(" SELECT * FROM `list_acc_game` $where ") ?? 0;
                    return $a;
                }
                function user($where) {
                    global $TUANORI;
                    $a = $TUANORI->num_rows(" SELECT * FROM `users` $where ") ?? 0;
                    return $a;
                }
                ?>
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Thống kê tháng <?=date('m');?></h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-success text-xl">
                                    <i class="ion ion-ios-refresh-empty"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold"><?=number_format(doanhthu("WHERE YEAR(thoigian) = ".date('Y')." AND MONTH(thoigian) = ".date('m')."  "));?>đ</span>
                                    <span class="text-muted">DOANH THU ĐƠN HÀNG</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold"><?=number_format(taikhoan("WHERE YEAR(timemua) = ".date('Y')." AND MONTH(timemua) = ".date('m')." "));?></span>
                                    <span class="text-muted">TÀI KHOẢN ĐÃ BÁN</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <p class="text-danger text-xl">
                                    <i class="ion ion-ios-people-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold"><?=number_format(user("WHERE YEAR(timereg) = ".date('Y')." AND MONTH(timereg) = ".date('m')." "));?></span>
                                    <span class="text-muted">THÀNH VIÊN MỚI</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Thống kê tuần</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-success text-xl">
                                    <i class="ion ion-ios-refresh-empty"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold"><?=number_format(doanhthu("WHERE WEEK(thoigian, 1) = WEEK(CURDATE(), 1) "));?>đ</span>
                                    <span class="text-muted">DOANH THU ĐƠN HÀNG</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold"><?=number_format(taikhoan("WHERE WEEK(timemua, 1) = WEEK(CURDATE(), 1) "));?></span>
                                    <span class="text-muted">TÀI KHOẢN ĐÃ BÁN</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <p class="text-danger text-xl">
                                    <i class="ion ion-ios-people-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold"><?=number_format(user("WHERE WEEK(timereg, 1) = WEEK(CURDATE(), 1) "));?></span>
                                    <span class="text-muted">THÀNH VIÊN MỚI</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Thống kê hôm nay</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-success text-xl">
                                    <i class="ion ion-ios-refresh-empty"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold"><?=number_format(doanhthu("WHERE `thoigian` >= DATE(NOW()) AND `thoigian` < DATE(NOW()) + INTERVAL 1 DAY "));?>đ</span>
                                    <span class="text-muted">DOANH THU ĐƠN HÀNG</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold"><?=number_format(taikhoan("WHERE `timemua` >= DATE(NOW()) AND `timemua` < DATE(NOW()) + INTERVAL 1 DAY "));?></span>
                                    <span class="text-muted">TÀI KHOẢN ĐÃ BÁN</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <p class="text-danger text-xl">
                                    <i class="ion ion-ios-people-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold"><?=number_format(user("WHERE `timereg` >= DATE(NOW()) AND `timereg` < DATE(NOW()) + INTERVAL 1 DAY "));?></span>
                                    <span class="text-muted">THÀNH VIÊN MỚI</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                        </div>
                    </div>
                </div>
                <?php
                /*TỔNG NẠP TOÀN THỜI GIAN*/
                $card = $TUANORI->get_row("SELECT SUM(`thucnhan`) FROM `napcard` WHERE `status` = '1' ")['SUM(`thucnhan`)'] ?? 0;
                $atm = $TUANORI->get_row("SELECT SUM(`sotien`) FROM `napatm` ")['SUM(`sotien`)'] ?? 0;
                /*TỔNG NẠP TRONG NGÀY*/
                $card1 = $TUANORI->get_row("SELECT SUM(`thucnhan`) FROM `napcard` WHERE `status` = '1' AND `thoigian` >= DATE(NOW()) AND `thoigian` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`thucnhan`)'] ?? 0;
                $atm1 = $TUANORI->get_row("SELECT SUM(`sotien`) FROM `napatm` WHERE `thoigian` >= DATE(NOW()) AND `thoigian` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`sotien`)'] ?? 0;

                /*TỔNG NẠP TRONG 1 THÁNG*/
                $card2 = $TUANORI->get_row("SELECT SUM(`thucnhan`) FROM `napcard` WHERE YEAR(thoigian) = ".date('Y')." AND MONTH(thoigian) = ".date('m')." AND `status` = '1' ")['SUM(`thucnhan`)'] ?? 0;
                $atm2 = $TUANORI->get_row("SELECT SUM(`sotien`) FROM `napatm` WHERE YEAR(thoigian) = ".date('Y')." AND MONTH(thoigian) = ".date('m')." ")['SUM(`sotien`)'] ?? 0;
                /*TỔNG NẠP TRONG 1 TUẦN*/
                $card3 = $TUANORI->get_row("SELECT SUM(`thucnhan`) FROM `napcard` WHERE `status` = '1' AND WEEK(thoigian, 1) = WEEK(CURDATE(), 1) ")['SUM(`thucnhan`)'] ?? 0;
                $atm3 = $TUANORI->get_row("SELECT SUM(`sotien`) FROM `napatm` WHERE WEEK(thoigian, 1) = WEEK(CURDATE(), 1)  ")['SUM(`sotien`)'] ?? 0;
                ?>
                <div class="col-lg-12 col-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="far fa-money-bill-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tổng tiền nạp toàn thời gian</span>
                                            <span class="info-box-number"><?=number_format($atm + $card);?>đ</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-3 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i
                                                class="far fa-money-bill-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tổng tiền nạp tháng <?=date('m');?></span>
                                            <span class="info-box-number"><?=number_format($atm2 + $card2);?>đ</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-3 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i
                                                class="far fa-money-bill-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tổng tiền nạp tuần</span>
                                            <span class="info-box-number"><?=number_format($atm3 + $card3);?>đ</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-3 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-danger"><i
                                                class="far fa-money-bill-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tổng tiền nạp hôm nay</span>
                                            <span class="info-box-number"><?=number_format($atm1 + $card1);?>đ</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
            
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DÒNG TIỀN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                            <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
                                        <th>Trước GD</th>
                                        <th>Số tiền</th>
                                        <th>Sau GD</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `biendongsodu` ORDER BY id DESC LIMIT 20") as $row){ ?>
                                    <tr>
                                        <td><?=++$i?></td>
                                        <td><b><?=$row['username'];?></b></td>
                                        <td><b><?=format_cash($row['truoc'])?>đ</b></td>
                                        
                                        <td>
                                            <?php if($row['truoc'] > $row['sau']) {
                                                echo '<b style="color: red">-'.format_cash($row['tongtien']).'đ</b>';
                                            } else {
                                                echo '<b style="color: green">+'.format_cash($row['tongtien']).'đ</b>';
                                            } ?>
                                        </td>
                                        <td><b><?=format_cash($row['sau'])?>đ</b></td>
                                        <td><?=$row['note']?></td>

                                        <td><b><?=intg(strtotime($row['time']));?></b></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
                                        <th>Trước GD</th>
                                        <th>Số tiền</th>
                                        <th>Sau GD</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end align-items-center border-top-table p-2">
                            <a type="button" href="<?=BASE_URL('Admin/Dongtien');?>" class="btn btn-primary">Xem Thêm 
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>





<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>

<?php 
    require_once(__DIR__."/Footer.php");
?>