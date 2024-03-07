<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA NGÂN HÀNG | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `listbank` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['btnUpdate']) ) {
    $namebank   = check_string($_POST['namebank']);
    $name       = check_string($_POST['name']);
    $stk        = check_string($_POST['stk']);
    $status     = check_string($_POST['status']);

    if(!$namebank || !$name || !$stk) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    $TUANORI->update("listbank", array(
        'bank'      => $namebank,
        'stk'       => $stk,
        'name'      => $name,
        'status'      => $status
    ), " `id` = '".check_string($_GET['id'])."' ");
    msg_success_ad("Cập nhật ngân hàng này thành công", '', 500);
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CHỈNH SỬA NGÂN HÀNG</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Bank');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NẠP ATM</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TÊN NGÂN HÀNG</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="namebank" placeholder="MBBANK" value="<?=$row['bank']?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">STK</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="stk" class="form-control" value="<?=$row['stk']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TÊN CHỦ NGÂN HÀNG</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" value="<?=$row['name']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="status" required>
                                            <option value="1" <?=($row['status'] == 1) ? 'selected' : ''?>>ON</option>
                                            <option value="0" <?=($row['status'] == 0) ? 'selected' : ''?>>OFF</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" name="btnUpdate" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT</span></button>
                        </form>
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