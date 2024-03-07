<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA DỊCH VỤ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `banggia_dichvu` WHERE `id` = '".check_string($_GET['id'])."'    ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['btnUpdate'])) {
    $title  = check_string($_POST['title']);
    if(!$title) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    $server = check_string($_POST['server']);
    $gia = explode("\n", check_string($_POST['money']));
    $serverArray = explode("\n", $server);
    $serverArray = array_map('trim', $serverArray);
    $data = [];
    foreach ($serverArray as $key => $value) {
        $data['gia'][$value] = trim($gia[$key]);
    }
    $data['server'] = array_map('intval', $serverArray);
    $jsonData = json_encode($data);
    $TUANORI->update("banggia_dichvu", array(
        'title'             => $title,
        'author'            => $jsonData,
        'status'            => check_string($_POST['status'])
    ), " `id` = '".$row['id']."' ");
    msg_success_ad("Thêm dịch vụ vào mục thành công", '', 500);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm dịch vụ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/AddDichvu/'.$row['category_dichvu']);?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM DỊCH VỤ </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên dịch vụ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="title" placeholder="Tên chuyên mục" value="<?=$row['title'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Các server hỗ trợ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="server" rows="6"><?php foreach(json_decode($row['author'], true)['server'] as $ok) { echo $ok."\n"; } ?></textarea>
                                        <i>Mỗi server trên 1 dòng, thêm theo thứ tự</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá tiền</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="money" rows="6"><?php foreach(json_decode($row['author'], true)['gia'] as $key => $value) { echo $value."\n"; } ?></textarea>
                                        <i>Mỗi giá tiền trên 1 dòng, theo thứ tự</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1" <?=($row['status'] == 1) ? 'selected' : '';?>>Hoạt động</option>
                                        <option value="0" <?=($row['status'] == 0) ? 'selected' : '';?>>Ngưng</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="btnUpdate" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT NGAY</span></button>
                      
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