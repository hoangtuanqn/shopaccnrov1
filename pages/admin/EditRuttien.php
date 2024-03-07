<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA ĐƠN RÚT TIỀN | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_GET['id'])) {
    $id = check_string($_GET['id']);
    $row = $TUANORI->get_row(" SELECT * FROM `ctv_ruttien` WHERE `id` = '$id' ");
    if(!$row) {
        msg_error_ad("Không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['Update'])) {
    $username   = check_string($_POST['username']);
    $status     = check_string($_POST['status']);
    if(!$username) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 1000);
    }
    if(in_array($row['status'], [2,3])) {
        msg_error_ad("Đơn này đã được hoàn tiền từ trước, vui lòng không thao tác gì thêm", '', 1000);
    }
    if(in_array($status, [2,3])) {
        $getUser = getUser($row['username']);
        $TUANORI->insert("biendongsodu", [
            'truoc'     => $getUser['money'],
            'tongtien'  => $row['sotien'],
            'sau'       => $getUser['money'] + $row['sotien'],
            'time'      => gettime(),
            'note'      => 'Rút tiền thất bại, hoàn '.number_format($row['sotien']).'đ',
            'username'  => $getUser['username']
        ]);
        $TUANORI->cong("users", "money", $row['sotien'], " `username` = '".$getUser['username']."' ");
    }
    $TUANORI->update("ctv_ruttien", array(
        'username'  => $username,
        'status'    => $status
    ), " `id` = '".$row['id']."' ");
    msg_success_ad("Đã cập nhật thành công", '', 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CHỈNH SỬA ĐƠN RÚT TIỀN</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Ruttien');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Người rút</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=$row['username'];?>" name="username" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên ngân hàng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=$row['bank'];?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên chủ thẻ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" value="<?=$row['name'];?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số tiền rút</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=format_cash($row['sotien']);?>" class="form-control fnum" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thời gian rút</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=intg(strtotime($row['thoigian']));?>" class="form-control fnum" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái <?=status_dichvu($row['status'], 'badge');?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="custom-select" name="status">
                                            <option value="0" <?=($row['status'] == 0) ? 'selected' : ''?>>Chờ xử lý</option>
                                            <option value="1" <?=($row['status'] == 1) ? 'selected' : ''?>>Thành công</option>
                                            <option value="2" <?=($row['status'] == 2) ? 'selected' : ''?>>Hủy đơn</option>
                                            <option value="3" <?=($row['status'] == 3) ? 'selected' : ''?>>Sai thông tin</option>
                                            <option value="4" <?=($row['status'] == 4) ? 'selected' : ''?>>Giam tiền</option>
                                        </select>
                                        <i>Sau khi chọn "Hủy đơn" hoặc "Sai thông tin" thì hệ thống sẽ tự động hoàn tiền cho người rút.</i>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="Update" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT NGAY</span></button>
                          
                        </form>
                    </div>
                </div>
            </div>
          
        </div>
    </section>
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