<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'BIẾN ĐỘNG SỐ DƯ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>200 BIẾN ĐỘNG SỐ DƯ GẦN ĐÂY</h1>
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
                                        <th>Trước GD</th>
                                        <th>Số tiền</th>
                                        <th>Sau GD</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `biendongsodu` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC LIMIT 200") as $row){ ?>
                                    <tr>
                                        <td><?=++$i?></td>
                                        <td><b><?=$row['username'];?></b></td>
                                        <td><b><?=number_format($row['truoc'])?>đ</b></td>
                                        
                                        <td>
                                            <?php if($row['truoc'] > $row['sau']) {
                                                echo '<b style="color: red">-'.number_format($row['tongtien']).'đ</b>';
                                            } else {
                                                echo '<b style="color: green">+'.number_format($row['tongtien']).'đ</b>';
                                            } ?>
                                        </td>
                                        <td><b><?=number_format($row['sau'])?>đ</b></td>
                                        <td><?=$row['note']?></td>

                                        <td><b><?=intg(strtotime($row['time']));?></b></td>
                                    </tr>
                                    <?php } ?>
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