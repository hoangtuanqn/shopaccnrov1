<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA VÒNG QUAY | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id'])) {
    $id = check_string($_GET['id']);
    $row = $TUANORI->get_row(" SELECT * FROM `mini_game` WHERE `id` = '$id'  ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['EditChuyenMuc'])) {
    $name       = check_string($_POST['title']);
    $img        = check_string($_POST['img']);
    $img_anh    = check_string($_POST['img_anh']);
    $sotien     = check_string(numb($_POST['sotien'] ?? 0));
    if(!$name || !$img || !$img_anh || !$sotien) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    $sql = $TUANORI->update("mini_game", array(
        'title'     => $name,
        'sotien'    => $sotien,
        'stt'       => check_string($_POST['stt'] ?? 0),
        'img'       => $img,
        'img_anh'   => $img_anh,
        'status'    => check_string($_POST['status']),
        'note'      => $_POST['note'],
        'slug'      => slug($name, 2)
    ), " `id` = '".$row['id']."' ");
    if ($sql) {
        $tong = 0;
        $last_id = $TUANORI->get_row("SELECT * FROM `mini_game` WHERE `id` = '$id' ORDER BY id DESC LIMIT 1");
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
                'text'      => $text,
                'iteam'     => $iteam,
                'tyle'      => $tyle,
                'hinhthuc'  => $hinhthuc
            );
        }
        if($tong != 100) {
            msg_error_ad("Tổng tỷ lệ phải bằng 100%", '', 500);
        }
        $TUANORI->update("mini_game_gift", array(
            'o_1' => json_encode($data[0]),
            'o_2' => json_encode($data[1]),
            'o_3' => json_encode($data[2]),
            'o_4' => json_encode($data[3]),
            'o_5' => json_encode($data[4]),
            'o_6' => json_encode($data[5]),
            'o_7' => json_encode($data[6]),
            'o_8' => json_encode($data[7])
        ), " `id_vongquay` = '".$row['id']."' ");
        msg_success_ad("Cập nhật vòng quay thành công", '', 1000);
    }
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa vòng quay <b style="color: red">#<?=$id;?></b></h1>
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
                        <h3 class="card-title">Chỉnh sửa vòng quay <b style="color: red">#<?=$id;?></b></h3>
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
                                        <label for="exampleInputEmail1">Thứ tự xuất hiện</label>
                                        <input type="text" class="form-control" id="inputEmail3" name="stt" value="<?=$row['stt']?>">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên vòng quay</label>
                                        <input type="text" class="form-control" id="inputEmail3" name="title" value="<?=$row['title']?>">
                                        <i>Up ảnh lấy hình <a style="font-weight: bold" href="https://tuanori.com/upanh" target="_blank">tại đây</a></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ảnh đại diện</label>
                                        <input type="text" class="form-control" id="inputEmail3" name="img" value="<?=$row['img']?>">
                                        <i>Up ảnh lấy hình <a style="font-weight: bold" href="https://tuanori.com/upanh" target="_blank">tại đây</a></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ảnh vòng quay</label>
                                        <input type="text" class="form-control" id="inputEmail3" name="img_anh" value="<?=$row['img_anh']?>">
                                        <i><b style="color: green">Lưu ý: Ảnh này phải có đúng và đủ 8 phần tử, kích thước cần thiết là 500x500</b></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả dịch vụ</label>
                                        <textarea class="textarea" name="note" rows="6"><?=$row['note']?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền mỗi lượt quay</label>
                                        <input type="text" class="form-control fnum" id="inputEmail3" value="<?=format_cash($row['sotien'])?>" name="sotien">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Trạng thái</label>
                                        <select class="form-control" name="status">
                                            <option value="1" <?=($row['status'] == 1) ? 'selected' : ''?>>Hoạt động</option>
                                            <option value="0" <?=($row['status'] == 0) ? 'selected' : ''?>>Tạm ngưng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <center>
                                            <h3 style="color: red">CÀI ĐẶT PHẦN THƯỞNG</h3>
                                            <i>Theo thứ tự kim đồng hồ</i>
                                        </center>
                                    </div>
                                  
                                </div>
                                
                                <?php $rows = $TUANORI->get_row(" SELECT * FROM `mini_game_gift` WHERE `id_vongquay` = '$id'  ");
                                    for($x=1;$x<=8;$x++) {
                                    $items = $rows['o_'.$x];
                                    $json = json_decode($items, true);
                                ?>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nội dung trúng thưởng (Ô <?=$x;?>)</label>
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Chúc mừng bạn đã nhận được ..." value="<?=$json['text'];?>" name="text_<?=$x;?>">
                                        <i><b style="color: green">Sẽ hiện lên khi quay trúng ô này</b></i>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vật phẩm nhận được (Ô <?=$x;?>)</label>
                                        <input type="text" class="form-control fnum"  placeholder="200.000" id="inputEmail3" value="<?=($json['iteam']);?>" name="iteam_<?=$x;?>">
                                        <i><b style="color: green">Vui lòng ghi số lượng</b></i>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tỷ lệ (%) quay trúng vào ô này (Ô <?=$x;?>)</label>
                                        <input type="text" class="form-control" placeholder="20" id="inputEmail3" value="<?=$json['tyle'];?>" name="tyle_<?=$x;?>">
                                        <i><b style="color: green">Là số nguyên, tỷ lệ các ô cộng lại phải bằng 100%</b></i>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình thức nhận</label>
                                        <select class="form-control" name="hinhthuc_<?=$x;?>">
                                            <option value="vang" <?=($json['hinhthuc'] == 'vang') ? 'selected' : '';?>>Vàng</option>
                                            <option value="ngoc" <?=($json['hinhthuc'] == 'ngoc') ? 'selected' : '';?>>Ngọc</option>
                                            <option value="tien" <?=($json['hinhthuc'] == 'tien') ? 'selected' : '';?>>Tiền trong shop</option>
                                        </select>
                                        <i>Đang chọn: <b style="color: green"><?=vq($json['hinhthuc']);?></b></i>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <button type="submit" name="EditChuyenMuc" class="btn btn-primary btn-block">
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
<script type="text/javascript">
    function postRemove(id,username) {
        $.ajax({
            url: "/controller/admin/DeleteVongQuay.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire("Thông Báo","Đã xóa thành công vòng quay:  " + username, "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire("Thông Báo", "Đã xảy ra lỗi khi xoá vòng quay: " + username, "success");
                }
            }
        });
    }
    function RemoveRow(id, username) {
        if (confirm("Bạn đã chắc chắn xóa chưa, vì không thể nào khôi phục lại được đó?")) 
        postRemove(id, username);
    }
</script>
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