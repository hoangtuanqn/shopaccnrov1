<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'LỊCH SỬ NẠP THẺ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
  


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>200 LỊCH SỬ NẠP THẺ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">LỊCH SỬ NẠP THẺ</h3>
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
                                            <th>THÔNG TIN</th>
                                            <th>MỆNH GIÁ</th>
                                            <th>THỰC NHẬN</th>
                                            <th>THỜI GIAN</th>
                                            <th>TRẠNG THÁI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach($TUANORI->get_list(" SELECT * FROM `napcard` WHERE `username` IS NOT NULL ORDER BY id DESC ") as $row){
                                        ?>
                                        <tr>
                                            <td><?=++$i;?></td>
                                            <td><a target="_blank" href="<?=BASE_URL('Admin/EditUsers/  '.getUser($row['username'])['id']);?>"><?=$row['username'];?></a></td>
                                            <td>
                                                <ul>
                                                    <li>Loại thẻ: <?=$row['loaithe'];?></li>
                                                    <li>Mã thẻ: <b><?=$row['pin'];?></b></li>
                                                    <li>Seri: <b><?=$row['seri'];?></b></li>
                                                    <li>Trạng thái: <?=status_napthe($row['status'], 'badge');?></li>
                                                </ul>
                                            </td>
                                            <td style="color: green; font-weight: bold"><?=format_cash($row['menhgia']);?>đ</td>
                                            <td style="color: green; font-weight: bold"><?=format_cash($row['thucnhan']);?>đ</td>
                                            <td><span class="badge badge-dark"><?=intg(strtotime($row['thoigian']));?></span></td>
                                            <td>
                                                <a aria-label="" href="/Admin/Cards?id=<?=$row['id'];?>&status=0" style="color:white;" class="btn btn-warning btn-sm btn-icon-left m-b-10" type="button">
                                                    <i class="fas fa-spinner mr-1"></i><span class="">Chờ xử lý</span>
                                                </a>
                                                <a aria-label="" href="/Admin/Cards?id=<?=$row['id'];?>&status=2" style="color:white;" class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
                                                    <i class="fas fa-circle-xmark mr-1"></i></i><span class="">Thẻ sai</span>
                                                </a>
                                                <a aria-label="" href="/Admin/Cards?id=<?=$row['id'];?>&status=1" style="color:white;" class="btn btn-success btn-sm btn-icon-left m-b-10" type="button">
                                                    <i class="fas fa-check mr-1"></i></i><span class="">Thẻ đúng</span>
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
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>