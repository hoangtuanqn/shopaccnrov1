<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'EDIT TÀI KHOẢN KHÁCH | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `nhapnick_game` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['EditAcc'])) {
    // if($row['status'] == 1) {
    //     msg_error2_ad("Acc này đã được hoàn thành trước đó, không thể cập nhật lại");
    // }
    $tk         = check_string($_POST['tk']);
    $mk         = check_string($_POST['mk']);
    $server     = check_string($_POST['server']);
    $note       = check_string($_POST['note']);
    $noteadmin  = check_string($_POST['noteadmin']);
    $status     = check_string($_POST['status']);
    $hinhthuc   = check_string($_POST['hinhthuc']);
    $sotien     = check_string(numb($_POST['thucnhan']));
    if(!$tk || !$mk || !$server || !$status || !$hinhthuc) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    if($status == 1) {
        switch($hinhthuc) {
            case 'ngoc':
                 $TUANORI->cong("users", "iteam_ngoc", $sotien, " `username` = '".$row['username']."'");
                break;
            case 'vang':
                 $TUANORI->cong("users", "iteam", $sotien, " `username` = '".$row['username']."'");
                break;
            case 'tien':
                $TUANORI->cong("users", "money", $sotien, " `username` = '".$row['username']."'");
                $getUser = getUser($row['username']);
                $TUANORI->insert("biendongsodu", [
                    'username'  => $getUser['username'],
                    'truoc'     => $getUser['money'],
                    'tongtien'  => $sotien,
                    'sau'       => $getUser['money'] + $sotien,
                    'note'      => 'Nhận được '.number_format($sotien).'đ do bán acc game có tk: '.$row['tk'],
                    'time'      => gettime()
                ]);
                break;
        }
    }
    $TUANORI->update("nhapnick_game", array(
        'tk'        => $tk,
        'mk'        => $mk, 
        'thucnhan'  => $sotien,
        'server'    => $server,
        'note'      => $note,
        'noteadmin' => $noteadmin,
        'hinhthuc'  => $hinhthuc,
        'status'    => $status
    ), " `id` = '".check_string($_GET['id'])."' ");
    msg_success_ad("Đã cập nhật thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh Sửa Thông Tin TK: <b><?=$row['tk']?></b></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/NhapNick');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN CHI TIẾT</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tài khoản game</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="tk" placeholder="Tài khoản game" value="<?=$row['tk'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mật khẩu game</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="mk" placeholder="Mật khẩu game" value="<?=$row['mk'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số tiền khách muốn bán</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=format_cash($row['sotien']);?>" class="form-control fnum" disabled>
                                        <i>Khách hàng muốn nhận lại <?=format_cash($row['sotien']);?> iteam khi bán acc này.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Máy chủ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="server" placeholder="Máy chủ" value="<?=$row['server'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ghi chú từ User</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="note" rows="6"><?=$row['note'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ghi chú từ Admin</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="noteadmin" rows="6"><?=$row['noteadmin'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thời gian đăng bán</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=intg(strtotime($row['thoigian']));?>" class="form-control fnum" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hình thức nhận</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="hinhthuc" required>
                                        <option value="tien" <?=($row['hinhthuc'] == 'tien') ? 'selected' :  '';?>>Tiền trong shop</option>
                                        <option value="vang" <?=($row['hinhthuc'] == 'vang') ? 'selected' :  '';?>>Vàng</option>
                                        <option value="ngoc" <?=($row['hinhthuc'] == 'ngoc') ? 'selected' :  '';?>>Ngọc</option>
                                        <option value="khac" <?=($row['hinhthuc'] == 'khac') ? 'selected' :  '';?>>Khác (Chuyển khoản cho người dùng, ...)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số tiền (Do bạn định giá)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="thucnhan" value="<?=format_cash($row['thucnhan']);?>" class="form-control fnum" required>
                                        <i>Khách hàng sẽ nhận đúng số tiền này, có thể khác với số tiền của khách muốn bán.</i>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái <?=status_nhapnick($row['status'], 'badge');?></label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1" <?=($row['status'] == 1) ? 'selected' :  '';?>>Chấp thuận</option>
                                        <option value="0" <?=($row['status'] == 0) ? 'selected' :  '';?>>Chờ xử lý</option>
                                        <option value="2" <?=($row['status'] == 2) ? 'selected' :  '';?>>Từ chối</option>

                                    </select>
                                </div>
                            </div>
                             
                            <button type="submit" name="EditAcc" class="btn btn-primary btn-block">
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




<?php 
    require_once(__DIR__."/Footer.php");
?>