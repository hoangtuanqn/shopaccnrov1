<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'QUẢN LÝ NẠP THẺ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php

if(isset($_POST['btnSaveOption']) && $getUser['level'] == 'admin') {
    foreach ($_POST as $key => $value) {
        if($key == 'web_api' && $value != $TUANORI->site('web_api')) {
            // kiểm tra nếu api dc
            
            $url = $value."/chargingws/v2";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36';
            curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $response = curl_exec($ch);
            $ok = json_decode($response, true);
            if(empty($ok['status'])) {
                msg_error_ad('Không thể API qua website: '. $value, '/Admin/Cards', 5000);
            }
        }
        $TUANORI->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
    msg_success_ad('Lưu thành công', '', 500);
}
if(isset($_GET['id']) && isset($_GET['status'])) {
    $id     = check_string($_GET['id']);
    $status = check_string($_GET['status']);
    $row = $TUANORI->get_row(" SELECT * FROM `napcard` WHERE `id` = '$id' ");
    if(!$row) {
        msg_error_ad("Thẻ không hợp lệ", "/Admin/Cards", 1000);
    }
    if($row['status'] == 1) {
        msg_error_ad("Thẻ này đã được duyệt thành công", "/Admin/Cards", 1000);
    }
    $thucnhan = $row['thucnhan'];
    if($status == 1) {
        $getUser = getUser($row['username']);
        $TUANORI->insert("biendongsodu", [
            'username'  => $getUser['username'],
            'truoc'     => $getUser['money'],
            'tongtien'  => $row['thucnhan'],
            'sau'       => $getUser['money'] + $row['thucnhan'],
            'note'      => 'Nạp thẻ cào có seri #'.$row['seri'].' và thực nhận '.number_format($row['thucnhan']).'đ',
            'time'      => gettime()
        ]);
        $isMoney = $TUANORI->cong("users", "money", $row['thucnhan'], " `username` = '".$row['username']."'");
    } else if($status == 2) {
        $thucnhan = 0;
    }
    $TUANORI->update("napcard", array(
        'status'   => $status,
        'thucnhan'  => $thucnhan
    ), " `id` = '$id' ");
    msg_success_ad("Đã cập nhật thẻ thành công", "/Admin/Cards" , 1000);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nạp thẻ cào</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NẠP THẺ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Website muốn API</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="web_api" value="<?=$TUANORI->site('web_api');?>"
                                            class="form-control">
                                         <i>Chỉ hỗ trợ với 1 số website nhất định</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Partner ID</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="partner_id" value="<?=$TUANORI->site('partner_id');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Partner KEY</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="partner_key" value="<?=$TUANORI->site('partner_key');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="status_card" required>
                                            <option value="1" <?=($TUANORI->site('status_card') == 1) ? 'selected' : '';?>>ON</option>
                                            <option value="0" <?=($TUANORI->site('status_card') == 0) ? 'selected' : '';?>>OFF</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
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
    // Summernote
    $('.textarea').summernote()
})
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once("./Footer.php");
?>