<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CÀI ĐẶT SỰ LỰA CHỌN | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `select_category` WHERE `category_game` = '".check_string($_GET['id'])."'  ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
$dulieu = [];
$dulieu['nameselect'] = []; // bắt buộc có nameselect;
if(isset($_POST['Update'])) {
    foreach(json_decode($row['author'], true)['nameselect'] as $ok) {
        array_push($dulieu['nameselect'], trim($ok));
    }
}
foreach($_POST as $key => $value) {
    if($key == '' || $key == 'Update') continue;
    $$key = [];
    foreach(explode("\n",$value) as $dl) {
        if($dl == '') continue;
        array_push($$key, trim($dl));
    }
    $dulieu +=[$key => $$key]; // cộng vào
}
$dulieu = json_encode($dulieu, JSON_UNESCAPED_UNICODE);
if(isset($_POST['Update'])) {
    $TUANORI->update("select_category", array(
        'author'     => $dulieu
    ), " `category_game` = '".check_string($_GET['id'])."' ");
    msg_success_ad("Đã cập nhật dữ liệu thành công", '', 1000);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh Sửa Sự Lựa Chọn</h1>
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
                        <h3 class="card-title">CÀI ĐẶT LỰA CHỌN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên chuyên mục game</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=$TUANORI->get_row(" SELECT * FROM `category_game` WHERE `id` = '".check_string($_GET['id'])."'  ")['title'];?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <?php $i = 0; foreach(json_decode($row['author'], true)['nameselect'] as $data) { ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=$data;?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="<?=slug($data);?>" placeholder="Cài đặt lựa chọn <?=$data;?>" rows="6"><?php foreach(json_decode($row['author'], true)[slug($data)] as $ok)  { 
                                            echo $ok."\n";} ?></textarea>
                                        <i>Thêm lựa chọn, mỗi lựa chọn trên 1 hàng.</i>
                                    </div>
                                </div>
                            </div>
                            <?php } ++$i; ?>
                            <button type="submit" name="Update" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT</span></button>
                            
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
d
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