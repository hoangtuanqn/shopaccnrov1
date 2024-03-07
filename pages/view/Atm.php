<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    if(empty($_COOKIE['token'])) die;
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
    <h4 class="modal-title">Thông tin nạp tiền</h4>
</div>
<div class="modal-body">
    <div class="c-content-tab-4 c-opt-3" role="tabpanel">
        <ul class="nav nav-justified" role="tablist">
            <li role="presentation" class="active">
                <a href="javascript:void(0)" role="tab" data-toggle="tab" class="c-font-16">THÔNG NẠP TIỀN</font></a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="payment">
                <ul class="c-tab-items p-t-0 p-b-0 p-l-5 p-r-5">
                    <li class="c-font-dark">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Ngân hàng</td>
                                    <td>STK</td>
                                    <td>Chủ thẻ</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; foreach($TUANORI->get_list(" SELECT * FROM `listbank` WHERE `status` = '1' ORDER BY id DESC") as $row){ ?>
                                <tr>
                                    <td>#<?=++$i;?></td>
                                    <td><?=$row['bank'];?></td>
                                    <td><b style="color: black"><?=$row['stk'];?></b></td>
                                    <td><b style="color: black"><?=$row['name'];?></b></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </li>
                    
                </ul>
                
            </div>
            
        </div>
        
        <p style="color:#19b1ff;">
            Nội dung thanh toán: <strong><?=$TUANORI->site('noidung_naptien').$getUser['id'];?></strong>
        </p>
        <b style="color: red">Nếu nạp 100.000đ bạn sẽ nhận được <?=format_cash(100000 + 100000 * $TUANORI->site('ckatm')/100);?>đ.</b> <br/>
        <b>Hệ thống sẽ tự động cộng tiền từ 1 - 5p. Nếu chờ quá lâu vui lòng liên hệ CSKH để được hỗ trợ.</b>
    </div>
   
</div>
<div class="modal-footer">
    <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng
    </button>
</div>