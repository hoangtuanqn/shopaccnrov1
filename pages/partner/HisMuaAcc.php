<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'TÀI KHOẢN ĐÃ BÁN | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>200 TÀI KHOẢN ĐÃ BÁN GẦN</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN CHI TIẾT</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID</th>
                                        <th>ẢNH</th>
                                        <th>TÀI KHOẢN</th>
                                        <th>THÔNG TIN</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($TUANORI->get_list(" SELECT * FROM `list_acc_game` WHERE `username` IS NOT NULL AND `ctv` = '".$getUser['username']."' ORDER BY timemua DESC LIMIT 200") as $row){
                                    ?>
                                    <tr>
                                        <td width="5%"><?=$i++;?></td>
                                        <td width="5%">#<?=$row['id'];?></td>
                                        <td width="8%"><img width="100%" src="<?=$row['img'];?>" /></td>
                                        <td>
                                            <ul>
                                                <li>Tài khoản acc: <b style="color: red"><?=$row['tk'];?></b></li>
                                                <li>Người bán: <a><?=inkq($row['ctv'], 'Lỗi');?></a></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Số tiền bán: <b style="color: green"><?=format_cash($row['card']);?>đ</b></li>
                                                <li>Giảm giá: <b><?=$row['giamgia'];?>%</b></li>
                                                <li>Ngày đăng bán: <?=intg(strtotime($row['timeup']));?></li>
                                                <?php if($row['username'] != NULL) { ?>
                                                    <li>Ngày mua: <?=intg(strtotime($row['timemua']));?></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if($row['username'] != NULL) { ?>
                                                    <li>Người mua: <a><?=$row['username'];?></a></li>
                                                <?php }?>
                                                <li>Trạng thái: 
                                                    <?php if($row['username'] != NULL) {
                                                        echo '<span class="badge badge-danger">Đã bán</span>';} else { 
                                                        echo '<span class="badge badge-success">Đang bán</span>';};
                                                    ?>  
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a aria-label="" href="<?=BASE_URL('Partner/Account/Edit/'.$row['id']);?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable2").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>