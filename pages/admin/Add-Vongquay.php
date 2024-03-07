<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'THÊM VÒNG QUAY | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_POST['ThemChuyenMuc'])) {
    $name       = check_string($_POST['title']);
    $img        = check_string($_POST['img']);
    $img_anh    = check_string($_POST['img_anh']);
    $sotien     = check_string(numb($_POST['sotien']));
    if(!$name || !$img || !$img_anh || !$sotien) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 1000);
    }
    $tong = 0;
    for ($i = 1; $i <= 8; $i++) {
        $tyle       = check_string(trim($_POST['tyle_' . $i]));
        $iteam      = check_string(trim(numb($_POST['iteam_' . $i])));
        $text       = check_string(trim($_POST['text_' . $i]));
        $hinhthuc   = check_string(trim($_POST['hinhthuc_' . $i]));
        
        if(!$text) {
            msg_error_ad("Vui lòng không bỏ trống thông tin", "", 1000);
        }
        $tong +=$tyle;
        $data[] = array(
            'text' => $text,
            'iteam' => $iteam,
            'tyle' => $tyle,
            'hinhthuc' => $hinhthuc
        );
    }
    if($tong != 100) {
        msg_error_ad("Tổng tỷ lệ phải bằng 100%", '', 1000);
    }
    $sql = $TUANORI->insert('mini_game', array(
        'title'     => $name,
        'sotien'    => $sotien,
        'img'       => $img,
        'img_anh'   => $img_anh,
        'status'    => check_string($_POST['status']),
        'note'      => $_POST['note'],
        'slug'      => slug($name, 2)
    ));
    $last_id = $TUANORI->get_row("SELECT * FROM `mini_game` ORDER BY id DESC LIMIT 1");
    $TUANORI->insert('mini_game_gift', array(
        'id_vongquay' => $last_id['id'],
        'o_1' => json_encode($data[0]),
        'o_2' => json_encode($data[1]),
        'o_3' => json_encode($data[2]),
        'o_4' => json_encode($data[3]),
        'o_5' => json_encode($data[4]),
        'o_6' => json_encode($data[5]),
        'o_7' => json_encode($data[6]),
        'o_8' => json_encode($data[7])
    ));
    msg_success_ad("Thêm vòng quay thành công", BASE_URL('Admin/Vongquay'), 1000);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>THÊM VÒNG QUAY</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Vongquay');?>"
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
                                        <label for="exampleInputEmail1">Tên vòng quay</label>
                                        <input type="text" class="form-control" id="inputEmail3" name="title">
                                        <i>Up ảnh lấy hình <a style="font-weight: bold" href="https://tuanori.com/upanh" target="_blank">tại đây</a></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ảnh đại diện</label>
                                        <input type="text" class="form-control" id="inputEmail3" name="img">
                                        <i>Up ảnh lấy hình <a style="font-weight: bold" href="https://tuanori.com/upanh" target="_blank">tại đây</a></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ảnh vòng quay</label>
                                        <input type="text" class="form-control" id="inputEmail3" name="img_anh">
                                        <i><b style="color: green">Lưu ý: Ảnh này phải có đúng và đủ 8 phần tử, kích thước cần thiết là 500x500</b></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả dịch vụ</label>
                                        <textarea class="textarea" name="note" rows="6">MÔ TẢ DỊCH VỤ</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền mỗi lượt quay</label>
                                        <input type="text" class="form-control fnum" id="inputEmail3" value="0" name="sotien">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Trạng thái</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Hoạt động</option>
                                            <option value="0">Tạm ngưng</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <center>
                                            <h3 style="color: red">CÀI ĐẶT PHẦN THƯỞNG</h3>
                                            <i>Xem thứ tự vòng quay: <a href="/uploads/img//TUANORI_VONGQUAY.png" target="_blank">Tại đây</a></i>
                                        </center>
                                    </div>
                                </div>
                                <?php for($i = 1; $i <=8; ++$i) { ?>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nội dung trúng thưởng (Ô <?=$i;?>)</label>
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Chúc mừng bạn đã nhận được ..." name="text_<?=$i;?>">
                                        <i><b style="color: green">Sẽ hiện lên khi quay trúng ô này</b></i>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vật phẩm nhận được (Ô <?=$i;?>)</label>
                                        <input type="text" class="form-control fnum" placeholder="200.000" value="0" id="inputEmail3" name="iteam_<?=$i;?>">
                                        <i><b style="color: green">Vui lòng ghi số lượng</b></i>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tỷ lệ (%) quay trúng vào ô này (Ô <?=$i;?>)</label>
                                        <input type="text" class="form-control" placeholder="20" id="inputEmail3" name="tyle_<?=$i;?>">
                                        <i><b style="color: green">Là số nguyên, tỷ lệ các ô cộng lại phải bằng 100%</b></i>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình thức nhận (Ô <?=$i;?>)</label>
                                        <select class="form-control" name="hinhthuc_<?=$i;?>">
                                            <option value="vang">Vàng</option>
                                            <option value="ngoc">Ngọc</option>
                                            <option value="tien">Tiền trong shop</option>
                                        </select>
                                        <i><b style="color: green">Vàng, ngọc, tiền shop</b></i>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <button type="submit" name="ThemChuyenMuc" class="btn btn-primary btn-block">
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