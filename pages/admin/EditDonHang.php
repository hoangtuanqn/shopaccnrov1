<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'THÔNG TIN ĐƠN HÀNG | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php")
?>
<?php
if(isset($_GET['id'])) {
    $id = check_string($_GET['id']);
    $row = $TUANORI->get_row(" SELECT * FROM `history_dichvu` WHERE `id` = '$id' AND `dichvu` > 0 ");
    if(!$row) {
        msg_error_ad("Không tồn tại", BASE_URL(''), 1000);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
$title = $TUANORI->get_row(" SELECT * FROM `banggia_dichvu` WHERE `id` = '".$row['dichvu']."' ")['title'] ?? '';

if(isset($_POST['btnUpload'])) {
    /*VUI LÒNG ĐỂ NGUYÊN THEO THỨ TỰ XỬ LÝ - NẾU CHỈNH SỬA VUI LÒNG HIỂU VỀ CÁCH SỬ LÝ*/
    $username   = check_string($_POST['username']);
    $server     = check_string($_POST['server']);
    $tk         = check_string($_POST['tk']);
    $mk         = check_string($_POST['mk']);
    $tongtien   = check_string(numb($_POST['tongtien']));
    $status     = check_string($_POST['status']);
    $ctv        = check_string($_POST['ctv'] ?? "");
    $noteadmin  = check_string($_POST['noteadmin']);
    if(!$username || !$server || !$tk || !$mk || !$tongtien) {
        msg_error_ad("Vui lòng điền đầy đủ thông tin", "", 1000);
    }
    if(in_array($row['status'], [1,2])) {
        msg_error_ad("Đơn hàng này đã được xử lý từ trước, không thể thay đổi nữa", "", 5000);
    }
    if($status == 4 && $row['ctv']) {
        msg_error_ad("Đã có người nhận đơn hàng này", "", 5000);
    }
    
    if($status == 1 && $row['ctv']) {
        /*CỘNG TIỀN CHO CTV - NẾU CÓ*/
        $getUs = getUser($row['ctv']);
        $tienctv = ($tongtien - $tongtien*$TUANORI->site('ctv_dichvu')/100);
        $TUANORI->cong("users", "money", $tienctv, " `username` = '".$row['ctv']."' ");
        $TUANORI->insert("biendongsodu", array(
            'truoc'         => $getUs['money'],
            'tongtien'      => $tongtien,
            'sau'           => $getUs['money'] + $tienctv,
            'note'          => 'Cộng tiền đơn hàng cho dịch vụ '.$title,
            'time'          => gettime(),
            'username'      => $ctv
        ));
    }
    if($status == 1 && $row['ctv']) {
        /*CỘNG TIỀN CHO CTV - NẾU CÓ*/
        $getUs = getUser($row['ctv']);
        $tienctv = ($tongtien - $tongtien*$TUANORI->site('ctv_dichvu')/100);
        $TUANORI->cong("users", "money", $tienctv, " `username` = '".$row['ctv']."' ");
        $TUANORI->insert("biendongsodu", array(
            'truoc'         => $getUs['money'],
            'tongtien'      => $tongtien,
            'sau'           => $getUs['money'] + $tienctv,
            'note'          => 'Cộng tiền đơn hàng cho dịch vụ '.$title,
            'time'          => gettime(),
            'username'      => $ctv
        ));
    }
    if($status == 2) { 

        
        /*CỘNG TIỀN LẠI CHO NGƯỜI MUA - DO HỦY*/
        $getUs = getUser($row['username']);
        $TUANORI->cong("users", "money", $tongtien, " `username` = '".$row['username']."' ");
        $TUANORI->insert("biendongsodu", array(
            'truoc'         => $getUs['money'],
            'tongtien'      => $tongtien,
            'sau'           => $getUs['money'] + $tongtien,
            'note'          => 'Hoàn tiền đơn hàng cho dịch vụ '.$title,
            'time'          => gettime(),
            'username'      => $row['username']
        ));
    }
    $TUANORI->update("history_dichvu", array(
        'username'  => $username,
        'server'    => $server,
        'tk'        => $tk,
        'mk'        => $mk,
        'tongtien'  => $tongtien,
        'status'    => $status,
        'ctv'       => $ctv,
        'noteadmin' => $noteadmin
    ), " `id` = '".$row['id']."' ");
    if($status == 4) {
        $TUANORI->update("history_dichvu", array(
            'ctv'       => $getUser['username'],
            'timectv'   => gettime(),
            'status'    => 0
        ), " `id` = '".$row['id']."' ");
    }
    if($status == 5) {
        $TUANORI->update("history_dichvu", array(
            'ctv'       => '',
            'timectv'   => gettime(),
            'status'    => 0
        ), " `id` = '".$row['id']."' ");
    }
    msg_success_ad("Cập nhật đơn hàng thành công", '', 1000);
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ĐƠN HÀNG</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/DonDichVu');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN ĐƠN HÀNG</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                               
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Người mua</label>
                                        <input type="text" value="<?=$row['username'];?>" name="username" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Danh mục</label>
                                        <input type="text" value="<?=$TUANORI->get_row(" SELECT * FROM `category_dichvu` WHERE `id` = '".$row['category_dichvu']."' ")['title'];?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Dịch vụ</label>
                                        <input type="text" value="<?=$title;?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><b style="color: red">Tài khoản game</b></label>
                                        <input type="text" value="<?=$row['tk'];?>" name="tk" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><b style="color: red">Mật khẩu game</b></label>
                                        <input type="number" name="mk" value="<?=$row['mk'] ;?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Máy chủ</label>
                                        <input type="number" name="server" value="<?=$row['server'];?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><b style="color: green">Tổng thanh toán</b></label>
                                        <input type="text" name="tongtien" value="<?=format_cash($row['tongtien']);?>" class="form-control fnum" required>
                                    </div>
                                </div>
                                
                                <?php if($row['coupon']) { ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mã giảm giá</label>
                                        <input type="text"value="<?=$row['coupon'];?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if($row['ctv'] && $row['timectv']) { ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Người nhận đơn</label>
                                        <input type="text"value="<?=$row['ctv'];?>" class="form-control" name="ctv">
                                        <i>ADMIN có thể chỉnh sửa lại CTV, để trống không có CTV</i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Thời gian nhận</label>
                                        <input type="text"value="<?=$row['timectv'];?> - (<?=timeAgo(strtotime($row['timectv']));?>)" class="form-control" disabled>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tình trạng</label>
                                        <select class="custom-select" name="status">
                                            <option value="0" <?=($row['status'] == 0) ? 'selected' : ''?>>Chờ xử lý</option>
                                            <option value="1" <?=($row['status'] == 1) ? 'selected' : ''?>>Thành công</option>
                                            <option value="2" <?=($row['status'] == 2) ? 'selected' : ''?>>Hủy đơn</option>
                                            <option value="3" <?=($row['status'] == 3) ? 'selected' : ''?>>Sai thông tin</option>
                                            <?php if(!$row['ctv']) { ?>
                                                <option value="4">Nhận đơn này</option>
                                            <?php } ?>
                                            <?php if($row['ctv'] == $getUser['username']) { ?>
                                                <option value="5">Không nhận đơn này nữa</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="alert alert-info">
                                        <i>Nếu bạn nhận đơn hàng này thì chọn: <b style="color: red">Nhận đơn này</b>, nếu không vui lòng chọn cái khác.</i> <br/>
                                        <?php if($row['ctv']) { ?>
                                            <i>Nếu chọn: <b style="color: red">Thành công</b>, hệ thống sẽ tự động cộng tiền cho CTV</i> <br/>
                                        <?php } ?>
                                        <?php if($row['ctv'] == $getUser['username']) { ?>
                                            <i>Nếu chọn: <b style="color: red">Không nhận đơn</b>, hệ thống sẽ đưa đơn hàng về chờ xử lý và chờ người khác nhận</i> <br/>
                                        <?php } ?>
                                        <i>Nếu chọn: <b style="color: red">Thất bại</b>, hệ thống sẽ tự động cộng tiền lại cho Người mua</i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ghi chú cho người mua</label>
                                        <textarea type="text" class="form-control" name="noteadmin"><?=$row['noteadmin']?></textarea>
                                    </div>
                                </div>
                                

                            </div>
                            <button type="submit" name="btnUpload" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT ĐƠN HÀNG</span></button>
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
$(function() {
    // Summernote
    $('.textarea').summernote()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
})
</script>

<?php 
    require_once("../../pages/admin/Footer.php");
?>