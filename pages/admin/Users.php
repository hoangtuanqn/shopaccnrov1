<?php
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $title = 'QUẢN LÝ THÀNH VIÊN | '.$TUANORI->site('title');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý thành viên</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH THÀNH VIÊN</h3>
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
                                        <th>TÀI KHOẢN</th>
                                        <th>VÍ</th>
                                        <th>BẢO MẬT</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TUANORI->get_list(" SELECT * FROM `users` WHERE `level` = 'member' ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td>
                                            <ul>
                                                <li>Tên đăng nhập: <b><?=$row['username'];?></b> [ID <b><?=$row['id'];?></b>]</li>
                                                <li>Địa chỉ Email: <b style="color:green"><?=$row['email'];?></b>
                                                </li>
                                                <li>Họ và tên: <b style="color:blue"><?=$row['fullname'];?></b>
                                                </li>
                                                <li>Banned: <?=status_users($row['banned']);?></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Số dư khả dụng: <b style="color:blue"><?=number_format($row['total_money']);?>đ</b>
                                                </li>
                                                <li>Tổng số tiền nạp: <b style="color:red"><?=number_format($row['money']);?>đ</b>
                                                </li>
                                                
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Thời gian đăng ký: <b><?=intg(strtotime($row['timereg']));?></b></li>
                                                <li>Thời gian on gần đây: <b><?=intg(strtotime($row['timeon']));?></b></li>
                                                <li>Trạng thái: <?=status_online($row['online']);?></li>
                                            </ul>
                                        </td>

                                        <td>
                                            <a aria-label="" href="/Admin/EditUsers/<?=$row['id'];?>" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                                            </a>
                                            <button style="color:white;" onclick="RemoveRow(<?=$row['id'];?>, '<?=$row['username'];?>')"
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
            url: "/controller/admin/DeleteUser.php",
            type: 'POST',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire("Thông Báo","Đã xóa thành công người dùng " + username, "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    Swal.fire("Thông Báo", "Đã xảy ra lỗi khi xoá người dùng " + username, "success");
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
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>