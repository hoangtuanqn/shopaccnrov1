<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'EDIT CHUYÊN MỤC | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `category_game` WHERE `id` = '".check_string($_GET['id'])."'   AND `type` = 'account'  ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['EditChuyenMuc'])) {
    $title  = check_string($_POST['title']);
    $img    = check_string($_POST['img']);
    $stt    = check_string($_POST['stt']);
    if(!$title || !$img) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    $data   = "";
    $dm     = explode(',', check_string($_POST['author']));
    for($i = 0; $i < count($dm); ++$i) {
        $data.=$dm[$i];
        if($i < count($dm)-1) {
            $data.="\n";
        }
    }
    $TUANORI->update("category_game", array(
        'title'     => $title,
        'stt'       => $stt,
        'img'       => $img, 
        'mota'      => $_POST['mota'],
        'author'    => $data,
        'slug'      => slug($title),
        'status'    => check_string($_POST['status']),
        'num_all'   => check_string($_POST['num_all']),
        'num_sell'  => check_string($_POST['num_sell'])
    ), " `id` = '".check_string($_GET['id'])."' ");
    msg_success_ad("Lưu thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh Sửa Chuyên mục</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Category');?>"
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
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số thứ tự xuất hiện</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="stt" value="<?=$row['stt'];?>" placeholder="Thứ tự xuất hiện" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên chuyên mục</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="title" placeholder="Tên chuyên mục" value="<?=$row['title'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="img" placeholder="Ảnh mô tả" value="<?=$row['img'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả dịch vụ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="mota" rows="6"><?=$row['mota'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông tin chính (Dùng để tìm kiếm)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="author" placeholder="Máy chủ, Hành tinh,Bông tai, Đăng ký" rows="6"><?=$row['author'];?></textarea>
                                        <i>Mỗi thông tin cách nhau bằng 1 dấu phẩy, vui lòng ghi đúng thứ tự hiển thị.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tổng acc đã đăng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input class="form-control" name="num_all" value="<?=$row['num_all'];?>">
                                        <i>Nên để yên để máy chủ thống kê thật.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tổng acc đã bán</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input class="form-control" name="num_sell" value="<?=$row['num_sell'];?>">
                                        <i>Nên để yên để máy chủ thống kê thật.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1" <?=($row['status'] == 1) ? 'selected' :  '';?>>HIỂN THỊ</option>
                                        <option value="0" <?=($row['status'] == 0) ? 'selected' :  '';?>>ẨN ĐI</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="EditChuyenMuc" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>
                           
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