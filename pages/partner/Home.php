<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'DASHBROAD | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
$donhang = ($TUANORI->num_rows(" SELECT * FROM `history_dichvu` WHERE `status` = '1' AND `ctv` = '".$getUser['username']."' ") ?? 0);
$tongtien = $TUANORI->get_row("SELECT SUM(`ctv_tongtien`) FROM `history_dichvu` WHERE `status` = '1' AND `ctv` = '".$getUser['username']."' ")['SUM(`ctv_tongtien`)'] ?? 0; 
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
                        <h3><?=format_cash($TUANORI->num_rows(" SELECT * FROM `list_acc_game` WHERE `username` IS NULL AND `ctv` = '".$getUser['username']."' ") ?? 0);?></h3>
                        <p>Tài khoản đang bán</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?=BASE_URL('Partner/HisMuaAcc');?>" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?=format_cash($TUANORI->num_rows(" SELECT * FROM `history_dichvu` WHERE `status` = '0' AND `ctv` = '".$getUser['username']."' ") ?? 0);?></h3>
                        <p>Đơn hàng chưa xong</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?=BASE_URL('Partner/DonDichVuMe');?>" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
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
                    $a = $TUANORI->get_row("SELECT SUM(`ctv_tongtien`) FROM `history_dichvu` $where ")['SUM(`ctv_tongtien`)'] ?? 0;
                    return $a;
                }
                function taikhoan($where) {
                    global $TUANORI;
                    $a = $TUANORI->num_rows(" SELECT * FROM `list_acc_game` $where ") ?? 0;
                    return $a;
                }
                function doanhthu2($where) {
                    global $TUANORI;
                    $a = $TUANORI->get_row("SELECT SUM(`ctv_tongtien`) FROM `list_acc_game` $where ")['SUM(`ctv_tongtien`)'] ?? 0;
                    return $a;
                }
                function donhang($where) {
                    global $TUANORI;
                    $a = $TUANORI->num_rows(" SELECT * FROM `history_dichvu` $where ") ?? 0;
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
                                    <span class="font-weight-bold">
                                        <?=number_format(doanhthu("WHERE YEAR(upthoigian) = ".date('Y')." AND MONTH(upthoigian) = ".date('m')." AND `ctv` = '".$getUser['username']."' AND `status` = '1' "));?>đ
                                    </span>
                                    <span class="text-muted">DOANH THU ĐƠN HÀNG</span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <?=number_format(donhang("WHERE YEAR(upthoigian) = ".date('Y')." AND MONTH(upthoigian) = ".date('m')." AND `ctv` = '".$getUser['username']."' AND `status` = '1' "));?>
                                    </span>
                                    <span class="text-muted">ĐƠN HÀNG ĐÃ XONG</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-refresh-empty"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <?=number_format(doanhthu2("WHERE YEAR(timemua) = ".date('Y')." AND MONTH(timemua) = ".date('m')." AND `ctv` = '".$getUser['username']."' AND `username` IS NOT NULL "));?>đ
                                    </span>
                                    <span class="text-muted">DOANH THU BÁN ACC</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <p class="text-danger text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <?=number_format(taikhoan("WHERE YEAR(timemua) = ".date('Y')." AND MONTH(timemua) = ".date('m')." AND `ctv` = '".$getUser['username']."' AND `username` IS NOT NULL"));?>
                                    </span>
                                    <span class="text-muted">TÀI KHOẢN ĐÃ BÁN</span>
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
                                    <span class="font-weight-bold">
                                        <?=number_format(doanhthu("WHERE WEEK(upthoigian, 1) = WEEK(CURDATE(), 1) AND `ctv` = '".$getUser['username']."' AND `status` = '1' "));?>đ
                                    </span>
                                    <span class="text-muted">DOANH THU ĐƠN HÀNG</span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <?=number_format(donhang("WHERE WEEK(upthoigian, 1) = WEEK(CURDATE(), 1) AND `ctv` = '".$getUser['username']."' AND `status` = '1' "));?>
                                    </span>
                                    <span class="text-muted">ĐƠN HÀNG ĐÃ XONG</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-refresh-empty"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <?=number_format(doanhthu2("WHERE WEEK(timemua, 1) = WEEK(CURDATE(), 1) AND `ctv` = '".$getUser['username']."' AND `username` IS NOT NULL "));?>đ
                                    </span>
                                    <span class="text-muted">DOANH THU BÁN ACC</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <p class="text-danger text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <?=number_format(taikhoan("WHERE WEEK(timemua, 1) = WEEK(CURDATE(), 1) AND `ctv` = '".$getUser['username']."' AND `username` IS NOT NULL"));?>
                                    </span>
                                    <span class="text-muted">TÀI KHOẢN ĐÃ BÁN</span>
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
                                    <span class="font-weight-bold">
                                        <?=number_format(doanhthu("WHERE `upthoigian` >= DATE(NOW()) AND `upthoigian` < DATE(NOW()) + INTERVAL 1 DAY AND `ctv` = '".$getUser['username']."' AND `status` = '1' "));?>đ
                                    </span>
                                    <span class="text-muted">DOANH THU ĐƠN HÀNG</span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <?=number_format(donhang("WHERE `upthoigian` >= DATE(NOW()) AND `upthoigian` < DATE(NOW()) + INTERVAL 1 DAY AND `ctv` = '".$getUser['username']."' AND `status` = '1' "));?>
                                    </span>
                                    <span class="text-muted">ĐƠN HÀNG ĐÃ XONG</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-refresh-empty"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <?=number_format(doanhthu2("WHERE `timemua` >= DATE(NOW()) AND `timemua` < DATE(NOW()) + INTERVAL 1 DAY AND `ctv` = '".$getUser['username']."' AND `username` IS NOT NULL "));?>đ
                                    </span>
                                    <span class="text-muted">DOANH THU BÁN ACC</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <p class="text-danger text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <?=number_format(taikhoan("WHERE `timemua` >= DATE(NOW()) AND `timemua` < DATE(NOW()) + INTERVAL 1 DAY AND `ctv` = '".$getUser['username']."' AND `username` IS NOT NULL"));?>
                                    </span>
                                    <span class="text-muted">TÀI KHOẢN ĐÃ BÁN</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                        </div>
                    </div>
                </div>
                <?php
                /*TỔNG NẠP TOÀN THỜI GIAN*/
                $card = $TUANORI->get_row("SELECT SUM(`ctv_tongtien`) FROM `list_acc_game` WHERE `username` IS NULL AND `ctv` = '".$getUser['username']."' ")['SUM(`ctv_tongtien`)'] ?? 0;
                $atm = $TUANORI->get_row("SELECT SUM(`ctv_tongtien`) FROM `history_dichvu` WHERE `status` = '1' AND `ctv` = '".$getUser['username']."' ")['SUM(`ctv_tongtien`)'] ?? 0;
                
                /*TỔNG NẠP TRONG 1 THÁNG*/
                $card2 = $TUANORI->get_row("SELECT SUM(`ctv_tongtien`) FROM `list_acc_game` WHERE YEAR(timemua) = ".date('Y')." AND MONTH(timemua) = ".date('m')." AND  `username` IS NULL AND `ctv` = '".$getUser['username']."' ")['SUM(`ctv_tongtien`)'] ?? 0;
                $atm2 = $TUANORI->get_row("SELECT SUM(`ctv_tongtien`) FROM `history_dichvu` WHERE YEAR(upthoigian) = ".date('Y')." AND MONTH(upthoigian) = ".date('m')." AND `status` = '1' AND `ctv` = '".$getUser['username']."' ")['SUM(`ctv_tongtien`)'] ?? 0;

                /*ĐƠN HÀNG BẠN CÓ THỂ NHẬN*/
                $don = $TUANORI->num_rows(" SELECT * FROM `history_dichvu` WHERE `status` = '0' AND `ctv` = '' ");
                ?>
                <div class="col-lg-12 col-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="far fa-money-bill-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Doanh thu toàn thời gian</span>
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
                                            <span class="info-box-text">Doanh thu tháng <?=date('m');?></span>
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
                                            <span class="info-box-text">Đơn hàng bạn có thể nhận</span>
                                            <span class="info-box-number"><?=number_format($don);?></span>
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
                                            <span class="info-box-text">Số tiền hiện tại của bạn</span>
                                            <span class="info-box-number"><?=number_format($getUser['money']);?>đ</span>
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
                                    <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `biendongsodu` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC LIMIT 20") as $row){ ?>
                                    <tr>
                                        <td><?=++$i?></td>
                                        <td><a target="_blank" href="<?=BASE_URL('Partner/EditUsers/'.$TUANORI->getUser($row['username'])['id']);?>"><?=$row['username'];?></a></td>
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
                            <a type="button" href="<?=BASE_URL('Partner/Dongtien');?>" class="btn btn-primary">Xem Thêm 
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