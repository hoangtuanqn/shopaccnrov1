<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHỈNH SỬA TÀI KHOẢN | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `list_acc_game` WHERE `id` = '".check_string($_GET['id'])."' ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 500);
    }
    $selec = $TUANORI->get_row(" SELECT * FROM `select_category` WHERE `id` = '".check_string($row['category_game'])."' ");
    $tuanne = explode("\n", $row['author']);  
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['EditTaiKhoan']) ) {
    if($row['username']) {
        msg_error_ad("Tài khoản đã bán, vui lòng không chỉnh sửa gì thêm!", "", 2000);
    }
    $listacc    = explode("\n",check_string($_POST['listacc']));
    $img        = check_string($_POST['img']);
    $listimg    = check_string($_POST['listimg']);
    $amount     = check_string(numb($_POST['card']));
    $giamgia    = check_string($_POST['giamgia']);
    $ctv        = check_string($_POST['ctv']);
    if($giamgia >= 100) {
        msg_error_ad("Giảm giá không hợp lệ", '', 1000);
    }
    if(!$img || !$listimg || !$amount) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 1000);
    }
    if(!$ctv) {
        msg_error_ad("Vui lòng thông tin người bán", '', 1000);
    }
    $author = "";
    foreach($_POST as $key => $value) {
        $ha = explode('tuanori_' , $key);
        if(isset($ha[1]) && $ha[1]) {
            $author.= $value."\n";
        }
    }
    if(empty(getUser($ctv)['username'])) {
        msg_error_ad("Người bán không hợp lệ, vui lòng kiểm tra lại", '', 1000);
    }
    foreach($listacc as $data) {
        $ok = explode("|", $data);
        $TUANORI->update("list_acc_game", array(
            'img'           => $img,
            'listimg'       => $listimg,
            'card'          => $amount,
            'giacu'         => round($amount / (1-$giamgia/100)),
            'tk'            => $ok[0],
            'mk'            => $ok[1],
            'giamgia'       => $giamgia,
            'noibat'        => trim($_POST['noibat']),
            'timeup'        => gettime(),
            'author'        => trim($author),
            'ctv'           => $ctv
        ), " `id` = '".$_GET['id']."' ");
        if($_POST['username']) {
            $TUANORI->update("list_acc_game", array(
                'username'  => $getUser['username'],
                'timemua'   => gettime(),
                'thanhtoan' => $amount
            ), " `id` = '".$_GET['id']."' ");
        }
    }
    msg_success_ad("Cập nhật tài khoản thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông tin acc mã <b style="color: red">#<?=$row['id'];?></b></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Accounts/'.$row['category_game']);?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                            <h3 class="card-title">EDIT TÀI KHOẢN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="img" class="form-control" placeholder="Link ảnh mô tả" value="<?=$row['img']?>" required>
                                        <i>Up ảnh lấy hình <a style="font-weight: bold" href="https://tuanori.com/upanh" target="_blank">tại đây</a></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">List hình ảnh</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea rows="5" name="listimg"
                                            placeholder="Mỗi ảnh 1 hàng"
                                            class="form-control"><?=$row['listimg']?></textarea>
                                        <i>Up ảnh lấy hình <a style="font-weight: bold" href="https://tuanori.com/upanh" target="_blank">tại đây</a></i>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <?php $i = 0; $tuanne = explode("\n", $row['author']);
                            foreach(json_decode($selec['author'], true)['nameselect'] as $data) { ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?=$data;?></label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <select  class="form-control" name="tuanori_<?=slug($data);?>">
                                                <option value="">Chọn <?=$data;?></option>
                                            <?php foreach(json_decode($selec['author'], true)[slug($data)] as $ok) { ?>
                                                <option value="<?=$ok;?>" <?=($ok == $tuanne[$i]) ? 'selected' : '';?>><?=$ok;?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php ++$i; } ?>
                                <div class="alert alert-info">
                                    Cài đặt thông tin để chọn <a href="/Admin/AddSelect/<?=$row['id'];?>">Tại Đây</a>
                                </div>
                            <hr/>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông tin</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=$row['tk'].'|'.$row['mk'];?>" name="listacc" class="form-control" placeholder="Định dạng: Tài khoản | Mật khẩu (1 dòng 1 nick nếu cần nhập nhiều nick 1 lần)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá bán (VNĐ)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=format_cash($row['card']);?>" name="card" class="form-control fnum" required>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giảm giá (%)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" value="<?=$row['giamgia'];?>" name="giamgia" class="form-control">
                                        <i>Không làm thay đổi giá tiền bán, chỉ hiển thị thêm ra giá cũ và giảm giá</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả tài khoản</label>
                                <div class="col-sm-9">  
                                    <div class="form-line">
                                        <textarea class="form-control" name="noibat" rows="6"><?=$row['noibat'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="form-control" name="username">
                                            <option value="0" <?=(!$row['username']) ? 'selected': ''?>>Chưa bán</option>
                                            <option value="1" <?=($row['username']) ? 'selected': ''?>>Đã bán</option>
                                        </select>
                                        <i><b style="color: green">Sau khi xác nhận đã bán, hệ thống sẽ cộng tiền CTV bán acc này.</b></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Người bán (CTV)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=$row['ctv'];?>" name="ctv" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="EditTaiKhoan" class="btn btn-primary btn-block">
                                <span>CẬP NGAY</span></button>
                        
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
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHI TIẾT ACC </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <img width="100%" src="<?=$row['img'];?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">200 TÀI KHOẢN CHUNG DANH MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID</th>
                                        <th>ẢNH</th>
                                        <th>TÀI KHOẢN</th>
                                        <th>THÔNG TIN</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `list_acc_game` WHERE `category_game` = '".check_string($row['category_game'])."' AND `id` != '".$_GET['id']."'  ORDER BY id DESC LIMIT 200") as $row){
                                    ?>
                                    <tr>
                                        <td width="5%"><?=++$i;?></td>
                                        <td width="5%">#<?=$row['id'];?></td>
                                        <td width="8%"><img width="100%" src="<?=$row['img'];?>" /></td>
                                        <td><?=$row['tk'];?></td>
                                        <td>
                                            <ul>
                                                <li>Số tiền bán: <b style="color: green"><?=format_cash($row['card']);?>đ</b></li>
                                                <li>Giảm giá: <b><?=$row['giamgia'];?>%</b></li>
                                                <li>Ngày đăng bán: <?=intg(strtotime($row['timeup']));?></li>
                                                <?php if($row['username'] != NULL) { ?>
                                                    <li>Ngày mua: <?=intg(strtotime($row['timemua']));?></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if($row['username'] != NULL) { ?>
                                                    <li>Người mua: <a style="font-weight: bold" target="_blank" href="<?=BASE_URL('Admin/EditUsers/'.getUser($row['username'])['id']);?>"><?=$row['username'];?></a></li>
                                                <?php }?>
                                                <li>Trạng thái: 
                                                    <?php if($row['username'] != NULL) {
                                                        echo '<span class="badge badge-danger">Đã bán</span>';} else { 
                                                        echo '<span class="badge badge-success">Đang bán</span>';};
                                                    ?>  
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a aria-label="" href="<?=BASE_URL('Admin/Account/Edit/'.$row['id']);?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                                            </a>
                                            <button style="color:white;" onclick="RemoveRow(<?=$row['id']?>, '<?=$row['tk']?>')"
                                                class="btn btn-danger btn-sm btn-icon-left m-b-10"
                                                type="button">
                                                <i class="fas fa-trash mr-1"></i><span class="">Delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    function postRemove(id,username) {
        $.ajax({
            url: "/controller/admin/DeleteAccount.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire("Thông Báo","Đã xóa thành công acc có tài khoản:  " + username, "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire("Thông Báo", "Đã xảy ra lỗi khi acc có tài khoản: " + username, "success");
                }
            }
        });
    }
    function RemoveRow(id, username) {
        if (confirm("Cân nhác, khách hàng sẽ không thể xem lại acc đã mua này, khi bạn đã xóa chúng?")) 
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