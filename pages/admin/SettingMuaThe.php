<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'CẤU HÌNH MUA THẺ | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_POST['btnUpload'])) {
    $nhamang    = check_string($_POST['nhamang']);
    $menhgia    = check_string($_POST['menhgia']);
    if(!$title || !$menhgia) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    if($TUANORI->get_row(" SELECT * FROM `category_banthe` WHERE `nhamang` = '$nhamang'  ")) {
        msg_error_ad("Nhà mạng này đã tồn tại trước đó", '', 500);
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
    $TUANORI->insert("category_banthe", array(
        'nhamang'   => $nhamang,
        'menhgia'   => trim($data),
        'ck'        => trim($data2),
        'status'    => check_string($_POST['status'])
    ));
    msg_success_ad("Đã thêm nhà mạng thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông tin</h1>
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
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhà mạng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="nhamang" placeholder="VIETTEL" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông tin mệnh giá</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="menhgia" placeholder="Mỗi mệnh giá trên 1 dòng" rows="6"></textarea>
                                        <i>Mỗi mệnh giá trên 1 dòng.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chiết khấu</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="ck" placeholder="Mỗi giá trị trên 1 dòng" rows="6"></textarea>
                                        <i>Ghi theo thứ tự của phần mệnh giá.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="1">ON</option>
                                        <option value="0">OFF</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="btnUpload" class="btn btn-primary btn-block">
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
                        <h3 class="card-title">DANH SÁCH NHÀ MẠNG</h3>
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
                                        <th>NHÀ MẠNG</th>
                                        <th>MỆNH GIÁ</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `category_banthe` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td><b><?=$row['nhamang'];?></b></td>
                                        <td>
                                            <?php $ok = explode("\n", $row['menhgia']);
                                                  $ok2 = explode("\n", $row['ck']);
                                            ?>
                                            <ul>
                                                <?php for($i = 0; $i < count($ok); ++$i) { ?>
                                                    <li><?=format_cash($ok[$i])?>đ - <b style="color:red"><?=$ok2[$i]?>%</b></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td><?=status_category($row['status']);?></td>
                                        <td>
                                            <a aria-label="" href="/Admin/EditMuaThe/<?=$row['id'];?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit mr-1"></i></i><span class="">EDIT</span>
                                            </a>
                                            <a aria-label="" href="<?=BASE_URL('Admin/AddThe/');?><?=$row['id'];?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-file-medical mr-1"></i></i><span class="">THÊM THẺ</span>
                                            </a>
                                            <button style="color:white;" onclick="RemoveRow(<?=$row['id']?>, '<?=$row['nhamang']?>')"
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