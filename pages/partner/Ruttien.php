<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'RÚT TIỀN | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php

if(isset($_POST['btnRut']) ) {
    $bank       = check_string($_POST['bank']);
    $name       = check_string($_POST['name']);
    $stk        = check_string($_POST['stk']);
    $amount     = check_string($_POST['amount']);

    if(!$bank || !$name || !$stk || !$amount) {
        msg_error_ad("Vui lòng nhập đầy đủ thông tin", '', 1000);
    }
    if($amount < 0) {
        msg_error_ad("Số tiền rút không hợp lệ", '', 1000);
    }
    if($amount > $getUser['money']) {
        msg_error_ad("Số tiền rút lớn hơn số tiền hiện tại", '', 1000);
    }
    $TUANORI->insert("ctv_ruttien", array(
        'username'  => $getUser['username'],
        'bank'      => $bank,
        'stk'       => $stk,
        'name'      => $name,
        'sotien'    => $amount,
        'thoigian'  => gettime(),
        'status'    => 0
    ));
    msg_success_ad("Tạo lệnh rút tiền thành công", '', 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>THÔNG TIN</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH RÚT TIỀN</h3>
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
                                        <select class="form-control" name="bank">
                                            <?=listbank();?>
                                        </select>
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
                                <label class="col-sm-3 col-form-label">SỐ TIỀN RÚT</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="amount" class="form-control fnum">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnRut" class="btn btn-primary btn-block">
                                <span>RÚT TIỀN</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN RÚT TIỀN</h3>
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
                                        <th>SỐ TIỀN</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `ctv_ruttien` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=++$i;?></td>
                                        <td><b><?=$row['bank'];?></b></td>
                                        <td><b><?=$row['stk'];?></b></td>
                                        <td><b><?=$row['name'];?></b></td>
                                        <td><b style="color: green"><?=$row['sotien'];?>đ</b></td>

                                        <td><?=status_dichvu($row['status'], 'badge');?></td>
                                        <td>
                                            <button style="color:white;" onclick="RemoveRow(<?=$row['id'];?>)"
                                                class="btn btn-danger btn-sm btn-icon-left m-b-10"
                                                type="button">
                                                <i class="fa-solid fa-rotate-left"></i><span class=""> Rút lệnh</span>
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
    function postRemove(id) {
        $.ajax({
            url: "/controller/partner/RefundAtm.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire("Thông Báo","Đã rút lệnh thành công", "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire("Thông Báo", "Đã xảy ra lỗi khi yêu cầu rút lệnh: ", "success");
                }
            }
        });
    }
    function RemoveRow(id) {
        if (confirm("Bạn đã chắc chắn rút lệnh chưa, vì không thể nào khôi phục lại được đó?")) 
        postRemove(id);
        
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