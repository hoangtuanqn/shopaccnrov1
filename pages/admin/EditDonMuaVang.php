<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA ĐƠN HÀNG | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_GET['id'])) {
    $id = check_string($_GET['id']);
    $row = $TUANORI->get_row(" SELECT * FROM `history_dichvu` WHERE `id` = '$id' AND `dichvu` = '-1' ");
    if(!$row) {
        msg_error_ad("Không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['Update'])) {
    $TUANORI->update("history_dichvu", array(
        'username'  => check_string($_POST['username']),
        'server'    => check_string($_POST['server']),
        'tk'        => check_string($_POST['tk']),
        'iteam'     => check_string(numb($_POST['iteam'])),
        'tongtien'  => check_string(numb($_POST['tongtien'])),
        'status'    => check_string($_POST['status'])
    ), " `id` = '".$row['id']."' ");
    msg_success_ad("Đã cập nhật đơn hàng thành công", '', 1000);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa ĐƠN HÀNG</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/DonMuaVang');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHỈNH SỬA ĐƠN HÀNG</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Người mua</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=$row['username'];?>" name="username" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên nhân vật</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=$row['tk'];?>" name="tk" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Máy chủ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="server" value="<?=$row['server'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số vàng nhận</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="iteam" value="<?=format_cash($row['iteam']);?>" class="form-control fnum" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tổng thanh toán</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="tongtien" value="<?=format_cash($row['tongtien']);?>" class="form-control fnum" required>
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

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="Update" class="btn btn-primary btn-block">
                                <span>LƯU NGAY</span></button>
                           
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