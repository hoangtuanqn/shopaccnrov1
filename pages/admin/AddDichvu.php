<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'THÊM DỊCH VỤ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_GET['id'])) {
    $row = $TUANORI->get_row(" SELECT * FROM `category_dichvu` WHERE `id` = '".check_string($_GET['id'])."'    ");
    if(!$row) {
        msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 1000);
    }
} else {
    msg_error_ad("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['btnUpdate'])) {
    $title  = check_string($_POST['title']);
    if(!$title) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 1000);
    }
    $server = check_string($_POST['server']);
    $gia = explode("\n", check_string($_POST['money']));
    $serverArray = explode("\n", $server);
    $serverArray = array_map('trim', $serverArray);
    $data = [];
    foreach ($serverArray as $key => $value) {
        $data['gia'][$value] = trim($gia[$key]);
    }
    $data['server'] = array_map('intval', $serverArray);
    $jsonData = json_encode($data);
    $TUANORI->insert("banggia_dichvu", array(
        'category_dichvu'   => $_GET['id'],
        'title'             => $title,
        'author'            => $jsonData,
        'status'            => check_string($_POST['status'])
    ));
    msg_success_ad("Thêm dịch vụ vào mục thành công", '', 1000);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm dịch vụ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Admin/Dichvu');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM DỊCH VỤ </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên dịch vụ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="title" placeholder="Tên chuyên mục" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Các server hỗ trợ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="server" rows="6"></textarea>
                                        <i>Mỗi server trên 1 dòng</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá tiền</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="money" rows="6"></textarea>
                                        <i>Mỗi giá tiền trên 1 dòng, theo thứ tự</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Ngưng</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="btnUpdate" class="btn btn-primary btn-block">
                                <span>THÊM DỊCH VỤ NGAY</span></button>
                           
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
                        <h3 class="card-title">DANH SÁCH DỊCH VỤ</h3>
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
                                        <th>TÊN DỊCH VỤ</th>
                                        <th>THÔNG TIN</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `banggia_dichvu` WHERE `category_dichvu` = '".$_GET['id']."' ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td><b><?=$row['title'];?></b></td>
                                        <td>
                                            <ul>
                                                <?php foreach(json_decode($row['author'], true)['gia'] as $key => $value) { ?>
                                                    <li><b>Server <?=$key;?>:</b>  <b style="color: green"><?=format_cash($value);?>đ</b></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <a aria-label="" href="/Admin/EditListDichvu/<?=$row['id'];?>" style="color:white;" class="btn btn-primary btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit mr-1"></i></i><span class="">EDIT</span>
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
        url: "/controller/admin/DeleteListDichvu.php",
        type: 'POST',
        dataType: "JSON",
        data: {
            id: id
        },
        success: function(response) {
            if (response.status == 'success') {
                Swal.fire("Thông Báo","Đã xóa dịch vụ: " + username, "success");
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                Swal.fire("Thông Báo", "Đã xảy ra lỗi khi xóa dịch vụ: " + username, "success");
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