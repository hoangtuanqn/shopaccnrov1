<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA THÀNH VIÊN | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin')  {
    $row = $TUANORI->get_row(" SELECT * FROM `users` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        msg_error_ad("Người dùng này không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['btnCongTien']) && isset($_POST['value'])) {
    $value = check_string(numb($_POST['value']));
    $ghichu = check_string($_POST['ghichu']);
    if($value <= 0) {
        msg_error_ad("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    $create = $TUANORI->insert("biendongsodu", [
        'truoc'     => $row['money'],
        'tongtien'  => $value,
        'sau'       => $row['money'] + $value,
        'time'      => gettime(),
        'note'      => 'Admin cộng tiền ('.$ghichu.')',
        'username'  => $row['username']
    ]);
    if($create) {
        $TUANORI->cong("users", "money", $value, " `username` = '".$row['username']."' ");
        msg_success_ad("Cộng tiền thành công!", "", 2000);
    } else {
        msg_error_ad("Vui lòng liên hệ kỹ thuật Zalo 0812665001", "", 12000);
    }
    
}

if(isset($_POST['btnTruTien']) && isset($_POST['value']))
{
    $value = check_string(numb($_POST['value']));
    $ghichu = check_string($_POST['ghichu']);
    if($value <= 0) {
        msg_error_ad("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    if($row['money'] - $value) {
        msg_error_ad("Số tiền trừ không thể lớn hơn số tiền hiện tại", "", 2000);
    }
    $create = $TUANORI->insert("biendongsodu", [
        'truoc'     => $row['money'],
        'tongtien'  => $value,
        'sau'       => $row['money'] - $value,
        'time'      => gettime(),
        'note'      => 'Admin trừ tiền ('.$ghichu.')',
        'username'  => $row['username']
    ]);
    if($create) {
        $TUANORI->tru("users", "money", $value, " `username` = '".$row['username']."' ");
        msg_success_ad("Trừ tiền thành công!", "", 2000);
    } else {
        msg_error_ad("Vui lòng liên hệ kỹ thuật Zalo 0812665001", "", 12000);
    }
    
}
if(isset($_POST['btnSaveUser']) && isset($_GET['id'])) {
    $fullname       = check_string($_POST['fullname']);
    $total_money    = check_string($_POST['total_money']);
    $money          = check_string($_POST['money']);
    $level          = check_string($_POST['level']);
    $status         = check_string($_POST['banned']);
    $password       = check_string($_POST['password']);
    $email          = check_string($_POST['email']);
    if($row['money'] != $money) {
        $TUANORI->insert("biendongsodu", array(
            'truoc'         => $row['money'],
            'sau'           => $money,
            'tongtien'      => abs($money - $row['money']),
            'note'          => 'Admin thay đổi số dư ',
            'time'          => gettime(),
            'username'      => $row['username']
        ));
    }
    $TUANORI->update("users", array(
        'fullname'      => $fullname,
        'email'         => $email,
        'password'      => (($password)) ? md5($password) : $row['password'],
        'money'         => $money,
        'total_money'   => $total_money,
        'level'         => $level,
        'banned'        => $status,
        'iteam_ngoc'    => numb($_POST['iteam_ngoc']),
        'iteam'         => numb($_POST['iteam'])
    ), " `id` = '".$row['id']."' ");
    msg_success_ad("Đã cập nhật thông tin thành công", "", 1000);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa thành viên</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Users');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHỈNH SỬA THÀNH VIÊN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Họ và tên</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3"
                                            value="<?=$row['fullname'];?>" name="fullname">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3" name="username"
                                            value="<?=$row['username'];?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3" name="email"
                                            value="<?=$row['email'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Mật khẩu</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="password" placeholder="Bỏ qua nếu không đổi">
                                        <i>Nhập mật khẩu cần thay đổi, hệ thống sẽ tự động mã hoá (để trống nếu không muốn thay đổi)</i>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="inputEmail3" value="<?=$row['username'];?>"
                                name="username" required>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Số dư</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" id="inputPassword3" name="money"
                                            value="<?=format_cash($row['money']);?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Số vàng</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" id="inputPassword3" name="iteam"
                                            value="<?=format_cash($row['iteam']);?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Số ngọc</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" id="inputPassword3" name="iteam_ngoc"
                                            value="<?=format_cash($row['iteam_ngoc']);?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tổng nạp</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" id="inputPassword3" name="total_money"
                                            value="<?=format_cash($row['total_money']);?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Chức vụ</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <select class="custom-select" name="level">
                                            <option value="member" <?=($row['level'] == 'member') ? 'selected' : '';?>>Thành viên</option>
                                            <option value="ctv" <?=($row['level'] == 'ctv') ? 'selected' : '';?>>Cộng tác viên</option>
                                            <option value="admin" <?=($row['level'] == 'admin') ? 'selected' : '';?>>Quản trị viên</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Trạng thái</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" name="banned">
                                        <option value="ON" <?=($row['banned'] == 'ON') ? 'selected' : '';?>>Hoạt động</option>
                                        <option value="OFF" <?=($row['banned'] == 'OFF') ? 'selected' : '';?>>Banned</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày đăng ký</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3"
                                            value="<?=intg(strtotime($row['timereg']))?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày Online gần đây</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3"
                                            value="<?=intg(strtotime($row['timeon']))?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveUser" class="btn btn-primary btn-block waves-effect">
                                <span>LƯU</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">CỘNG TIỀN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Số tiền cộng</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" name="value" value="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Ghi chú</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <textarea class="form-control" name="ghichu" rows="3"
                                            placeholder="Nhập ghi chú cộng tiền nếu có"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnCongTien" class="btn btn-primary btn-block waves-effect">
                                <span>XÁC NHẬN</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">TRỪ TIỀN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Số tiền trừ</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="text" class="form-control fnum" name="value" value="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Ghi chú</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <textarea class="form-control" name="ghichu" rows="3"
                                            placeholder="Nhập ghi chú trừ tiền nếu có"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnTruTien" class="btn btn-primary btn-block waves-effect">
                                <span>XÁC NHẬN</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DÒNG TIỀN</h3>
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
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `biendongsodu` WHERE `username` = '".$row['username']."' ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=format_cash($row['truoc']);?></td>
                                        <td><?=format_cash($row['tongtien']);?></td>
                                        <td><?=format_cash($row['sau']);?></td>
                                        <td><span class="badge badge-dark px-3"><?=intg(strtotime($row['time']));?></span></td>
                                        <td><?=$row['note'];?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </tfoot>
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
</script>

<?php 
    require_once(__DIR__."/Footer.php");
?>