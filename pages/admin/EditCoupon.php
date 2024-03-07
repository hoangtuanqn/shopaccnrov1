<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CẬP NHẬT MÃ GIẢM GIÁ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `coupon` WHERE `id` = '".check_string($_GET['id'])."'    ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['EditCoupon'])) {
    $mgg        = check_string($_POST['code']);
    $luotdung   = check_string(numb($_POST['luotdung']));
    $conlai     = check_string(numb($_POST['conlai']));
    $tt         = check_string(numb($_POST['money_toithieu']));
    $giam       = check_string(numb($_POST['giam']));
    $type       = check_string($_POST['type']);
    $apply      = check_string($_POST['apply']);

    if(!$mgg || !$giam) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 1000);
    }
    if($giam <=0 || $giam > 100) {
        msg_error_ad("Phần trăm giảm phải > 0 và <= 100", '', 1000);
    }
    if($tt < 0) {
        msg_error_ad("Số tiền tối thiếu là 0đ", '', 1000);
    }
    $TUANORI->update("coupon", array(
        'money_toithieu'    => $tt,
        'code'              => $mgg,
        'giam'              => $giam,
        'luotdung'          => $luotdung,
        'conlai'            => $conlai,
        'thoigian'          => gettime(),
        'type'              => $type,
        'apply'             => $apply

    ), " `id` = '".check_string($_GET['id'])."' ");
    msg_success_ad("Cập nhật mã giảm giá thành công", "", 1000);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CẬP NHẬT MÃ GIẢM GIÁ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Coupon');?>"
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mã giảm giá</label>
                                        <div class="row">
                                            <div class="col-lg-7 mr-1 mb-3">
                                                <input type="text" class="form-control" value="<?=$row['code'];?>" id="code" name="code"
                                                    placeholder="Nhập mã giảm giá cần tạo" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="button" onclick="randomCode()" class="btn btn-danger">Tạo mã ngẫu nhiên</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Áp dụng cho</label>
                                        <select class="custom-select" name="apply">
                                            <option value="account" <?=($row['apply'] == 'account') ? 'selected' : '';?>>Mua tài khoản game</option>
                                            <option value="random" <?=($row['apply'] == 'random') ? 'selected' : '';?>>Mua tài khoản random</option>
                                            <option value="caythue" <?=($row['apply'] == 'caythue') ? 'selected' : '';?>>Dịch vụ cày thuê</option>
                                            <option value="vang" <?=($row['apply'] == 'vang') ? 'selected' : '';?>>Dịch vụ bán vàng</option>
                                            <option value="ngoc" <?=($row['apply'] == 'ngoc') ? 'selected' : '';?>>Dịch vụ bán ngọc</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kiểu mã</label>
                                        <select class="custom-select" name="type">
                                            <option value="1" <?=($row['type']) ? 'selected' : '';?>>1 người xài nhiều lần</option>
                                            <option value="0" <?=(!$row['type']) ? 'selected' : '';?>>1 người xài 1 lần</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng</label>
                                        <input type="text" class="form-control fnum" value="<?=format_cash($row['luotdung']);?>" id="inputEmail3" name="luotdung" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng còn lại</label>
                                        <input type="text" class="form-control fnum" value="<?=format_cash($row['conlai']);?>" id="inputEmail3" name="conlai" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền mua tối hiểu</label>
                                        <input type="text" class="form-control  fnum" value="<?=format_cash($row['money_toithieu']);?>" id="inputEmail3" name="money_toithieu">
                                        <i>Ví dụ mua ít nhất 100.000đ mới có thể sử dụng hoặc có thể để 0đ.</i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giảm (%)</label>
                                        <input type="text" class="form-control fnum" id="inputEmail3" placeholde="Nhập phần trăm giảm" value="<?=format_cash($row['giam']);?>" name="giam" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button name="EditCoupon" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                        class="fas fa-save mr-1"></i>Lưu Ngay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
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
            
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script>
function random(length) {
    var result = '';
    var characters = 'QWERTYUPASDFGHJKZXCVBNM123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return result;
}
function randomCode(){
    document.getElementById('code').value = random(8);
}
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