<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CHUYÊN MỤC TÀI KHOẢN | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_POST['ThemChuyenMuc']) && $getUser['level'] == 'admin' ) {
    $title  = check_string($_POST['title']);
    $img    = check_string($_POST['img']);
    $stt    = check_string($_POST['stt']);

    if(!$title || !$img) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    $data   = "";
    $dm     = explode(',', check_string($_POST['author']));
    for($i = 0; $i < count($dm); ++$i) {
        $data.=$dm[$i];
        if($i < count($dm)-1) {
            $data.="\n";
        }
    }
    $TUANORI->insert("category_game", array(
        'type'      => 'account',
        'stt'       => $stt,
        'title'     => $title,
        'img'       => $img, 
        'mota'      => $_POST['mota'],
        'author'    => $data,
        'slug'      => slug($title, 2),
        'status'    => check_string($_POST['status'])
    ));
    msg_success_ad("Thêm thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chuyên mục</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM CHUYÊN MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số thứ tự xuất hiện</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="stt" placeholder="Thứ tự xuất hiện" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên chuyên mục</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="title" placeholder="Tên chuyên mục" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="img" placeholder="Ảnh mô tả" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả dịch vụ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="mota" rows="6">MÔ TẢ DỊCH VỤ</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông tin chính (Dùng để tìm kiếm)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="author" placeholder="Máy chủ, Hành tinh,Bông tai, Đăng ký" rows="6"></textarea>
                                        <i>Mỗi thông tin cách nhau bằng 1 dấu phẩy, vui lòng ghi đúng thứ tự hiển thị.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1">HIỂN THỊ</option>
                                        <option value="0">ẨN</option>
                                    </select>
                                </div>
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
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH CHUYÊN MỤC</h3>
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
                                        <th>ẢNH</th>
                                        <th>CHUYÊN MỤC</th>
                                        <th>THÔNG TIN</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `category_game` WHERE `type` = 'account' ORDER BY stt ASC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td width="10%"><img width="100%" src="<?=$row['img'];?>" /></td>
                                        <td>
                                            <ul>
                                                <li>Tên: <?=$row['title'];?></li>
                                                <li>Thứ tự hiện: <b><?=$row['stt'];?></b></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Tổng tài khoản: <b style="color:red"><?=number_format($row['num_all']);?></b></li>
                                                <li>Tài khoản đã bán: <b style="color:black"><?=number_format($row['num_sell']);?></b></li>
                                                <li>Trạng thái: <?=status_category($row['status']);?></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a aria-label="" href="/Admin/AddSelect/<?=$row['id'];?>" style="color:white;" class="btn btn-primary btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit"></i><span class="">EDIT LỰA CHỌN</span>
                                            </a>
                                            <a aria-label="" href="/Admin/EditCategory/<?=$row['id'];?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit mr-1"></i></i><span class="">EDIT</span>
                                            </a>
                                            <a aria-label="" href="<?=BASE_URL('Admin/Accounts/');?><?=$row['id'];?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-file-medical mr-1"></i></i><span class="">THÊM TÀI KHOẢN</span>
                                            </a>
                                            <button style="color:white;" onclick="RemoveRow(<?=$row['id']?>, '<?=$row['title']?>')"
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
            url: "/controller/admin/DeleteCategory.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire("Thông Báo","Đã xóa thành công chuyên mục: " + username, "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire("Thông Báo", "Đã xảy ra lỗi khi xoá chuyên mục: " + username, "success");
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