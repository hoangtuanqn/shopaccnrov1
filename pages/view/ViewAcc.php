<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $id = check_string($_GET['id']);
    $tt = $TUANORI->get_row(" SELECT * FROM `list_acc_game` WHERE `id` = '$id' AND `username` = '".$getUser['username']."' ");
    if(!$tt && isset($_COOKIE['token'])) die;
    $mucchinh = [];
    $category = $TUANORI->get_row(" SELECT * FROM `category_game` WHERE `id` = '".$tt['category_game']."'");
    foreach(explode("\n", $category['author']) as $tuan) {
        array_push($mucchinh, $tuan);
    }

?>
<style>
    .ellipsis {
        overflow: hidden;
        display: inline-block;
        vertical-align: bottom;
        -webkit-animation: ellipsis 2s infinite;
        -moz-animation: ellipsis 2s infinite;
    }
    
    @-webkit-keyframes ellipsis {
        from {
            width: 2px;
        }
        to {
            width: 25px;
        }
    }
    
    @-moz-keyframes ellipsis {
        from {
            width: 2px;
        }
        to {
            width: 25px;
        }
    }
</style>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">Thông tin tài khoản</h4>
</div>
<div class="modal-body">
    <div class="c-content-tab-4 c-opt-3" role="tabpanel">
        <ul class="nav nav-justified" role="tablist">
            <li role="presentation" class="active">
                <a href="javascript:void(0)" role="tab" data-toggle="tab" class="c-font-16">THÔNG TIN TÀI KHOẢN<br><font color="yellow">#<?=$id?></font></a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="payment">
                <ul class="c-tab-items p-t-0 p-b-0 p-l-5 p-r-5">
                    <li class="c-font-dark">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Loại:</td>
                                    <th><?=$category['title']?></th>
                                </tr>
                                <tr>
                                    <td>Thông tin: </td>
                                    <th>
                                        <?php if($category['type'] == 'account') {
                                        $data = explode("\n", $tt['author']); $i = 0;
                                        foreach($data as $tuann) { ?>
                                        <?=$mucchinh[$i++]?>: <?=$tuann;?>
                                        <?=($i % 2 == 0)? '<br/>': '' ;?>
                                        <?=($i != count($data) && $i % 2 != 0)? '•': '' ;?>

                                        <?php } } else { ?>
                                            Nick Random
                                        <?php } ?>
                                    </th>
                                </tr>
                                <tr>
                                    <td>Giá tiền:</td>
                                    <th class="text-info"><font><?=number_format($tt['card']);?>đ</font></th>
                                </tr>
                                <tr>
                                    <td>Thanh toán:</td>
                                    <th class="text-info" style="color: green"><font><?=number_format($tt['thanhtoan']);?>đ</font></th>
                                </tr>
                                <?php if(isset($tt['mgg']) && $tt['mgg']) { ?>
                                    <tr>
                                        <td>Mã giảm giá:</td>
                                        <th class="text-info"><font><?=$tt['mgg'];?></font></th>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td>Tài khoản:</td>
                                    <th class="text-info"><font color="red"><?=$tt['tk'];?></font></th>
                                </tr>
                                <tr>
                                    <td>Mật khẩu:</td>
                                    <th class="text-info"><font color="red"><?=$tt['mk'];?></font></th>
                                </tr>
                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <center>
        <p class="c-font-bold c-font-blue">
            Tài khoản #<?=$id?> mua lúc: <?=intg(strtotime($tt['timemua']))?>
        </p>
    </center>
    <div class="alert alert-danger c-font-dark">
        <b>Để tránh các trường hợp xấu xảy ra, quý khách vui lòng thêm thông tin để đảm bảo không có vấn đề sau khi giao dịch tại shop! Xin cảm ơn.</b>
    </div>
    <div class="alert alert-info c-font-dark">
        Sau khi nhận tài khoản mật khẩu bạn hãy thực hiện đổi mật khẩu để bảo mật.
        <br>
    </div>
    <div style="clear: both"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
</div>