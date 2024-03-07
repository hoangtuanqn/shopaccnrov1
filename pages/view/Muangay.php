<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $id = check_string($_GET['id']);
    $tt = $TUANORI->get_row(" SELECT * FROM `list_acc_game` WHERE `id` = '$id' ");
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
    <h4 class="modal-title">Xác nhận mua tài khoản</h4>
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
                                    <th class="text-info"><font color="red"><?=number_format($tt['card']);?>đ</font>
                                    </th>
                                </tr>
                                <tr>
                                    <td>Mã giảm giá:</td>
                                    <th class="text-info">
                                        <input class="form-control" id="coupon" type="text" placeholder="Mã giảm giá (Nếu có)" required="" value="">
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="form-group ">
        <p style="margin-bottom: 10px;"></p>
        <center class="col-md-12 form-control-label text-danger" style="font-size: 20px; margin: 10px 0 10px 10px;">
            <div id="result">
                <?php if(isset($_COOKIE['token']) && $getUser['money'] < $tt['card']) { ?>
                    <b>Số dư không đủ để thực hiện giao dịch.<br>Vui lòng <a href="/nap-the" target="_blank">nạp thêm</a> <?=number_format($tt['card'] - $getUser['money'])?>đ vào tài khoản!</b>
                <?php } ?>
                <?php if(empty($_COOKIE['token'])) { ?>
                    <b>Vui lòng đăng nhập để mua tài khoản này!</b>
                <?php } ?>
            </div>
        </center>
    </div>
    <div style="clear: both"></div>
</div>
<div class="modal-footer">
    <a onClick="mua(<?=$id;?>);">
        <button type="button" class="btn c-theme-btn c-btn-uppercase c-btn-bold" id="muangay">Mua Ngay</button>
    </a>
    </form>
    <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng
    </button>
</div>

<script>
    function mua(id) {
        $('#result').html('<b id="result" class="text-danger">Đang xử lý<br><span class="ellipsis">....</span></b>');
        document.getElementById('muangay').setAttribute('disabled', 'disabled');
        $.ajax({
            url: '/buy.html?id=' + id,
            type: 'post',
            dataType: 'text',
            data: {
                coupon: $("#coupon").val()
            },
            success: function(response) {
                $('#result').html(response);
                document.getElementById('muangay').removeAttribute('disabled');
            },
            error: function(textStatus, errorThrown) {
                    $('#result').html('<b id="result" class="text-danger">Có lỗi xảy ra, vui lòng thử lại!</b>');
                    document.getElementById('muangay').removeAttribute('disabled');
                }
          
        })
    }
</script>