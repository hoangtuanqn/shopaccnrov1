<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'DANH SÁCH ĐƠN HÀNG | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>200 ĐƠN HÀNG MUA NGỌC GẦN ĐÂY</h1>
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
                                        <th>USERNAME</th>
                                        <th>THÔNG TIN</th>
                                        <th>SỐ NGỌC</th>
                                        <th>SỐ TIỀN</th>
                                        <th>NGÀY MUA</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `history_dichvu` WHERE `dichvu` = '-2' ORDER BY id DESC LIMIT 200") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><a target="_blank" href="<?=BASE_URL('Admin/EditUsers/'.$TUANORI->getUser($row['username'])['id']);?>"><?=$row['username'];?></a></td>
                                        <td><b style="color: black"><?=$row['tk'];?></b> - Máy chủ <?=$row['server'];?></td>
                                        <td><b style="color: green"><?=format_cash($row['iteam']);?> ngọc</b></td>
                                        <td><?=format_cash($row['tongtien']);?>đ</td>
                                        <td><?=intg(strtotime($row['thoigian']));?></td>
                                        <td><?=status_dichvu($row['status'], 'badge');?></td>
                                        <td>
                                            <a aria-label=""  href="/Admin/EditDonMuaNgoc/<?=$row['id'];?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
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
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>