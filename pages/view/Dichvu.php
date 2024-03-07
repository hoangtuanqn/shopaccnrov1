<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    $id = check_string($_GET['id']);
    $tt = $TUANORI->get_row(" SELECT * FROM `history_dichvu` WHERE `id` = '$id' AND `username` = '".$getUser['username']."' ");
    if(!$tt && isset($_COOKIE['token'])) die;

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
    <h4 class="modal-title">Thông tin thuê dịch vụ</h4>
</div>
<div class="modal-body">
    <div class="c-content-tab-4 c-opt-3" role="tabpanel">
        <ul class="nav nav-justified" role="tablist">
            <li role="presentation" class="active">
                <a href="javascript:void(0)" role="tab" data-toggle="tab" class="c-font-16">ĐƠN DỊCH VỤ<br><font color="yellow">#<?=$id?></font></a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="payment">
                <ul class="c-tab-items p-t-0 p-b-0 p-l-5 p-r-5">
                    <li class="c-font-dark">
                        <table class="table table-striped">
                            <tbody  >
                                <tr>
                                    <td width="100px">Tên dịch vụ:</td>
                                    <th><?=$TUANORI->get_row(" SELECT * FROM `banggia_dichvu` WHERE `id` = '".$tt['dichvu']."' ")['title'];?></th>
                                </tr>
                                <tr>
                                    <td>Máy chủ:</td>
                                    <th>Vũ Trụ <?=$tt['server']?></th>
                                </tr>
                                <tr>
                                    <td>Thanh toán:</td>
                                    <th class="text-info" style="color: green"><font><?=number_format($tt['tongtien']);?>đ</font></th>
                                </tr>
                                
                                <tr>
                                    <td>Trạng Thái:</td>
                                    <th><?=status_dichvu($tt['status'])?></th>
                                </tr>
                                <?php if($tt['noteadmin']) { ?>
                                <tr>
                                    <td>Ghi chú:</td>
                                    <th><?=$tt['noteadmin']?></th>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>
        </div>
    </div>
   
    <div style="clear: both"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
</div>