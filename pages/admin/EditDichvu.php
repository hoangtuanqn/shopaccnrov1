<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'EDIT CHUYÊN MỤC DỊCH VỤ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `category_dichvu` WHERE `id` = '".check_string($_GET['id'])."'    ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['EditChuyenMuc'])) {
    $title  = check_string($_POST['title']);
    $img    = check_string($_POST['img']);
    if(!$title || !$img) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    $lines = explode("\n", check_string($_POST['server']));
    $numbers = array_map('trim', $lines);
    $jsonData = json_encode($numbers, JSON_UNESCAPED_UNICODE);;
    $TUANORI->update("category_dichvu", array(
        'title'     => $title,
        'img'       => $img,
        'stt'       => check_string($_POST['stt'] ?? 0),
        'mota'      => $_POST['mota'],
        'slug'      => slug($title),
        'server'    => $jsonData,
        'status'    => check_string($_POST['status'])
    ), " `id` = '".check_string($_GET['id'])."' ");
    msg_success_ad("Cập nhật danh mục thành công", '', 500);
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
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Dichvu');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM CHUYÊN MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số thứ tự xuất hiện</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="stt" placeholder="Thứ tự xuất hiện" value="<?=$row['stt']?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên chuyên mục</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="title" placeholder="Tên chuyên mục" value="<?=$row['title']?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="img" placeholder="Ảnh mô tả"  value="<?=$row['img']?>" class="form-control" required>
                                        <!-- <img src="" -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả dịch vụ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="mota" rows="6"><?=$row['mota']?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Các server hỗ trợ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="server" rows="6"><?php foreach(json_decode($row['server'], true) as $ok) echo $ok."\n";?></textarea>
                                        <i>Mỗi server trên 1 dòng</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1" <?=($row['status'] == 1) ? 'selected' : '';?>>SHOW</option>
                                        <option value="0" <?=($row['status'] == 0) ? 'selected' : '';?>>HIDE</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="EditChuyenMuc" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT NGAY</span></button>
                          
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHI TIẾT NHÓM</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <img width="100%" src="<?=$row['img'];?>" />
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