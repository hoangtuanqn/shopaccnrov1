<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CẤU HÌNH MUA VÀNG | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_POST['btnUpdate'])) {
    $data = [];
    foreach ($_POST as $key => $value) {
        if(isset(explode('tuan_', $key)[1])) {
            $key = explode('tuan_', $key)[1];
            $$key = [];
            foreach(explode("\n",$value) as $dl) {
                if($dl == '') continue;
                array_push($$key, trim($dl));
            }
            $data +=[$key => $$key];
        } else {
            $TUANORI->update("options", array(
                'value' => numb($value)
            ), " `key` = '$key' ");
        }
    }
    $data = json_encode($data, JSON_UNESCAPED_UNICODE);
    $TUANORI->update("options", array(
        'value' => $data
    ), " `key` = 'server_banvang' ");
    msg_success_ad('Lưu thành công', '', 500);
}
$tuan = json_decode($TUANORI->site('server_banvang'), true);
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cấu hình MUA NGỌC</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH ĐỊA CHỈ BÁN/RÚT VÀNG</h3>
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
                                        <label for="exampleInputEmail1">Tình trạng bán vàng</label>
                                        <select class="custom-select" name="status_banvang">
                                            <option value="0" <?=($TUANORI->site('status_banvang') == 0) ? 'selected' : '';?>>Đóng</option>
                                            <option value="1" <?=($TUANORI->site('status_banvang') == 1) ? 'selected' : '';?>>Mở bán</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền mua tối thiểu</label>
                                        <input type="text" name="min_banvang" class="form-control fnum" value="<?=format_cash($TUANORI->site('min_banvang'));?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền mua tối đa</label>
                                        <input type="text" name="max_banvang" class="form-control fnum" value="<?=format_cash($TUANORI->site('max_banvang'));?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Server máy chủ</label>
                                        <textarea type="text" class="form-control" name="tuan_maychu"
                                            rows="6"><?php foreach($tuan['maychu'] as $ok) echo $ok."\n"; ?></textarea>
                                        <i>Mỗi máy chủ trên 1 dòng, theo thứ tự.</i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vị trí BOT máy chủ</label>
                                        <textarea type="text" class="form-control" name="tuan_vitri"
                                            rows="6"><?php foreach($tuan['vitri'] as $ok) echo $ok."\n"; ?></textarea>
                                        <i>Mỗi vị trí trên 1 dòng, theo thứ tự.</i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên BOT của máy chủ</label>
                                        <textarea type="text" class="form-control" name="tuan_tennv"
                                            rows="6"><?php foreach($tuan['tennv'] as $ok) echo $ok."\n"; ?></textarea>
                                        <i>Mỗi tên trên 1 dòng, theo thứ tự.</i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Trạng thái máy chủ</label>
                                        <textarea type="text" class="form-control" name="tuan_status"
                                            rows="6"><?php foreach($tuan['status'] as $ok) echo $ok."\n"; ?></textarea>
                                        <i>1: Hoạt động, 0: Tạm ngưng, điền theo thứ tự.</i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hệ số bán vàng máy chủ</label>
                                        <textarea type="text" class="form-control" name="tuan_heso"
                                            rows="6"><?php foreach($tuan['heso'] as $ok) echo $ok."\n"; ?></textarea>
                                        <i>Mỗi hệ số trên 1 dòng, theo thứ tự.</i>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="btnUpdate" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT</span></button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN MÁY CHỦ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>MÁY CHỦ</th>
                                        <th>TÊN NV</th>
                                        <th>VỊ TRÍ</th>
                                        <th>HỆ SỐ</th>
                                        <th>TRẠNG THÁI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php for($i = 0; $i < count($tuan['maychu']); ++$i) { ?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><b><?=$tuan['maychu'][$i];?> sao</b></td>
                                    <td><b><?=$tuan['tennv'][$i];?></b></td>
                                    <td><?=$tuan['vitri'][$i];?></td>
                                    <td><?=$tuan['heso'][$i];?></td>
                                    <td><?=status_dichvu_ad($tuan['status'][$i],'badge');?></td>

                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

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