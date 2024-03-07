<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA NHÀ MẠNG | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id']))  {
    $row = $TUANORI->get_row(" SELECT * FROM `category_banthe` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        msg_error_ad("Nhà mạng này không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['btnUpload'])) {
    $nhamang    = check_string($_POST['nhamang']);
    $menhgia    = check_string($_POST['menhgia']);
    if(!$title || !$menhgia) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    $data = $data2  = "";
    $dm     = explode("\n", check_string($_POST['menhgia']));
    for($i = 0; $i < count($dm); ++$i) {
        $data.=trim($dm[$i]);
        if($i < count($dm)-1) {
            $data.="\n";
        }
    }
    $dm     = explode("\n", check_string($_POST['ck']));
    for($i = 0; $i < count($dm); ++$i) {
        $data2.=$dm[$i];
        if($i < count($dm)-1) {
            $data2.="\n";
        }
    }
    $TUANORI->update("category_banthe", array(
        'nhamang'   => $nhamang,
        'menhgia'   => trim($data),
        'ck'        => trim($data2),
        'status'    => check_string($_POST['status'])
    ), " `id` = '".$row['id']."' ");
    msg_success_ad("Đã lưu thông tin thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa loại thẻ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/SettingMuaThe');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">EDIT LOẠI THẺ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhà mạng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="nhamang" value="<?=$row['nhamang'];?>" placeholder="VIETTEL" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông tin mệnh giá</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="menhgia" placeholder="Mỗi mệnh giá trên 1 dòng" rows="6"><?=$row['menhgia'];?></textarea>
                                        <i>Mỗi mệnh giá trên 1 dòng.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chiết khấu</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="ck" placeholder="Mỗi giá trị trên 1 dòng" rows="6"><?=$row['ck'];?></textarea>
                                        <i>Ghi theo thứ tự của phần mệnh giá.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1" <?=($row['status'] == 1) ? 'selected' : '';?>>ON</option>
                                        <option value="0" <?=($row['status'] == 0) ? 'selected' : '';?>>OFF</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="btnUpload" class="btn btn-primary btn-block">
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