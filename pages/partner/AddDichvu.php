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
                <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('Partner/Dichvu');?>"
                    type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
        </section>
        <section class="col-lg-6"></section>
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