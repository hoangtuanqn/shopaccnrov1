<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'QUẢN LÝ NGÂN HÀNG | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php

if(isset($_POST['btnUpload']) ) {
    $namebank   = check_string($_POST['namebank']);
    $name       = check_string($_POST['name']);
    $stk        = check_string($_POST['stk']);
    $status     = check_string($_POST['status']);

    if(!$namebank || !$name || !$stk) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 500);
    }
    $TUANORI->insert("listbank", array(
        'bank'      => $namebank,
        'stk'       => $stk,
        'name'      => $name,
        'status'    => $status
    ));
    msg_success_ad("Thêm ngân hàng này thành công", '', 500);
}
if(isset($_POST['btnSaveOption'])) {
    foreach ($_POST as $key => $value)
    {
        $TUANORI->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
    msg_success_ad('Cập nhật thông tin thành công', '', 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nạp ngân hàng</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NẠP AUTO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TOKEN MOMO</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="token_momo" value=" <?=$TUANORI->site('token_momo')?>" placeholder="LIÊN HỆ TUANORI ĐỂ BIẾT THÔNG TIN"
                                            class="form-control">
                                        <i>Hiện tại chúng tôi đang hỗ trợ auto bank <b>MBBANK</b> và <b>MOMO</b>. Muốn thêm ngân hàng khác vui lòng liên hệ <a href="//zalo.me/0812665001">TUANORI</a> để tham khảo giá.</i>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái <?=status_bank($TUANORI->site('status_momo'), 'badge');?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="status_momo" required>
                                            <option value="1" <?=($TUANORI->site('status_momo') == '1') ? 'selected' : '';?>>ON</option>
                                            <option value="0" <?=($TUANORI->site('status_momo') == '0') ? 'selected' : '';?>>OFF</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NẠP AUTO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TOKEN BANK</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="token_bank" value=" <?=$TUANORI->site('token_bank')?>" placeholder="LIÊN HỆ TUANORI ĐỂ BIẾT THÔNG TIN"
                                            class="form-control">
                                        <i>Hiện tại chúng tôi đang hỗ trợ auto bank <b>MBBANK</b> và <b>MOMO</b>. Muốn thêm ngân hàng khác vui lòng liên hệ <a href="//zalo.me/0812665001">TUANORI</a> để tham khảo giá.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">STK BANK</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="stk_bank" value=" <?=$TUANORI->site('stk_bank')?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">MK BANK</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" name="mk_bank" value=" <?=$TUANORI->site('mk_bank')?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái <?=status_bank($TUANORI->site('status_bank'), 'badge');?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="status_bank" required>
                                            <option value="1" <?=($TUANORI->site('status_bank') == '1') ? 'selected' : '';?>>ON</option>
                                            <option value="0" <?=($TUANORI->site('status_bank') == '0') ? 'selected' : '';?>>OFF</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>CẬP NHẬT</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NẠP ATM</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TÊN NGÂN HÀNG</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="namebank" placeholder="MBBANK"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">STK</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="stk" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TÊN CHỦ NGÂN HÀNG</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="status" required>
                                            <option value="1">ON</option>
                                            <option value="0">OFF</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" name="btnUpload" class="btn btn-primary btn-block">
                                <span>THÊM NGÂN HÀNG</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN NGÂN HÀNG</h3>
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
                                        <th>NGÂN HÀNG</th>
                                        <th>STK</th>
                                        <th>TÊN CHỦ THẺ</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `listbank` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td><b><?=$row['bank'];?></b></td>
                                        <td><b><?=$row['stk'];?></b></td>
                                        <td><b><?=$row['name'];?></b></td>
                                        <td><?=status_category($row['status']);?></td>
                                        <td>
                                            <a aria-label="" href="<?=BASE_URL('Admin/EditBank/'.$row['id']);?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit mr-1"></i></i><span class="">EDIT</span>
                                            </a>
                                            <button style="color:white;" onclick="RemoveRow(<?=$row['id'];?>, '<?=$row['bank'];?>')"
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
            url: "/controller/admin/DeleteAtm.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire("Thông Báo","Đã xóa thành công ngân hàng: " + username, "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire("Thông Báo", "Đã xảy ra lỗi khi xoá ngân hàng: " + username, "success");
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
    // Summernote
    $('.textarea').summernote()
})
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once("./Footer.php");
?>