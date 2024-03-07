<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CẤU HÌNH TOP NẠP | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_POST['btnSaveOption'])) {
    $data = $data2 = "";
    foreach($_POST as $key => $value) {
        $ha = explode('topnap_', $key);
        if(isset($ha[1]) && $ha[1]) {
            $data.=$value."\n";
        } else {
            $TUANORI->update("options", array(
                'value' => $value
            ), " `key` = '$key' ");
        }

        $ha2 = explode('note_', $key);
        if(isset($ha2[1]) && $ha2[1]) {
            $data2.=$value."\n";
        }
    } 
    $TUANORI->update("options", array(
        'value' => trim($data)
    ), " `key` = 'topnap' ");
    $TUANORI->update("options", array(
        'value' => trim($data2)
    ), " `key` = 'note_topnap' ");
    msg_success_ad('Đã cập nhật thông tin thành công', '', 1000);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cấu hình</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH THÔNG TIN WEBSITE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trả thưởng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="custom-select" name="type_topnap">
                                            <option value="1" <?=($TUANORI->site('type_topnap') == 1) ? 'selected' : '';?>>Tự động</option>
                                            <option value="0" <?=($TUANORI->site('type_topnap') == 0) ? 'selected' : '';?>>Thủ công</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $ok = explode("\n", $TUANORI->site('topnap'));
                            $ok2 = explode("\n", $TUANORI->site('note_topnap'));
                            for($i = 1; $i <=3; ++$i) { ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phần thưởng top #<?=$i;?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="topnap_<?=$i;?>" value="<?=$ok[$i-1] ?? "";?>"
                                            class="form-control">
                                        <i>Nhập số tiền nếu trả thưởng tự động, hệ thống sẽ cộng trực tiếp vào tài khoản</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ghi chú nhận quà top #<?=$i;?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="note_<?=$i;?>" value="<?=$ok2[$i-1] ?? "";?>"
                                            class="form-control">
                                        <i>Sẽ hiện thị ở trang chủ</i>
                                    </div>
                                </div>
                            </div>
                            <hr/>   
                            <?php } ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thời gian trả thưởng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="time_topnap" class="form-control" placeholder="1/<?=date('m')+1;?>/<?=date('Y');?>" value="<?=$TUANORI->site('time_topnap');?>">
                                        <i><b>Tới đúng ngày này, hệ thống sẽ trả thưởng (Nếu chọn "Tự Động"), và sẽ tăng thêm 1 tháng cho đợt tiếp theo</b></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông báo phần quà</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="phanthuong_top"
                                            rows="6"><?=$TUANORI->site('phanthuong_top');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(function() {
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'YYYY/MM/DD/ hh:mm:ss'
        }
    })
   
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