<div class="c-layout-sidebar-menu c-theme ">
    <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-6 m-t-15 m-b-20">
            <div class="c-content-title-3 c-title-md c-theme-border">
                <h3 class="c-left c-font-uppercase">Menu tài khoản</h3>
                <div class="c-line c-dot c-dot-left "></div>
            </div>

            <div class="c-content-ver-nav">
                <ul class="c-menu c-arrow-dot c-square c-theme">
                    <li><a href="<?=BASE_URL('profile/info');?>" class="<?=active(['/profile/info'])?>">Thông Tin Tài Khoản</a></li>
                    <li><a href="<?=BASE_URL('profile/tai-khoan-da-mua');?>"  class="<?=active(['/profile/tai-khoan-da-mua'])?>">Tài Khoản Đã Mua</a></li>
                    <li><a href="<?=BASE_URL('profile/random-da-mua');?>"  class="<?=active(['/profile/random-da-mua'])?>">Random Đã Mua</a></li>
                    <li><a href="<?=BASE_URL('profile/dich-vu');?>" class="<?=active(['/profile/dich-vu'])?>">Lịch Sử Dịch Vụ</a></li>
                    <li><a href="<?=BASE_URL('profile/bien-dong-so-du');?>" class="<?=active(['/profile/bien-dong-so-du'])?>">Biến Động Số Dư</a></li>
                    <li><a href="<?=BASE_URL('profile/rut-vang');?>" class="<?=active(['/profile/rut-vang'])?>">Rút Vàng</a></li>
                    <li><a href="<?=BASE_URL('profile/rut-ngoc');?>" class="<?=active(['/profile/rut-ngoc'])?>">Rút Ngọc</a></li>
                    <li><a href="<?=BASE_URL('profile/vong-quay');?>" class="<?=active(['/profile/vong-quay'])?>">Lịch Sử Vòng Quay</a></li>
                    <li><a href="<?=BASE_URL('profile/mua-vang');?>" class="<?=active(['/profile/mua-vang'])?>">Lịch Sử Mua Vàng</a></li>
                    <li><a href="<?=BASE_URL('profile/mua-ngoc');?>" class="<?=active(['/profile/mua-ngoc'])?>">Lịch Sử Mua Ngọc</a></li>
                    <li><a href="<?=BASE_URL('profile/mua-the');?>" class="<?=active(['/profile/mua-the'])?>">Lịch Sử Mua Thẻ</a></li>

            </div>
        </div>
        <div class="col-md-12 col-sm-6 col-xs-6 m-t-15">
            <div class="c-content-title-3 c-title-md c-theme-border">
                <h3 class="c-left c-font-uppercase">Menu giao dịch</h3>
                <div class="c-line c-dot c-dot-left "></div>
            </div>
            <div class="c-content-ver-nav m-b-20">
                <ul class="c-menu c-arrow-dot c-square c-theme">
                    <?php if($TUANORI->site('status_card')): ?>
                        <li><a href="/nap-the" class="<?=active(['/nap-the'])?>"><b>Nạp Thẻ Cào Tự Động</b></a></li>
                    <?php endif;?>
                    <li><a class="load-modal" href="javascript:void(0)" rel="/view/Atm.html">Nạp Tiền Từ ATM - Ví Điện Tử</a></li>
                    <li><a href="<?=BASE_URL('profile/doimatkhau');?>" class="<?=active(['/profile/doimatkhau'])?>"><b>Đổi Mật Khẩu</b></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="c-layout-sidebar-content ">
    <div class="text-center">
        <center>
            <img width="256" height="256" class="img-responsive img-thumbnail hidden-xs" src="/uploads/img/user.png" alt="">
            <h2 class="c-font-bold c-font-28"></h2>
            <h2 class="c-font-bold c-font-28"><a><?=$getUser['email']?></a></h2>
            <h2 class="c-font-22">
                <?php
                switch($getUser['level']) {
                    case 'member':
                        $cv = 'Thành Viên';
                    break;
                    case 'admin':
                        $cv = '<a style="color: blue" href="/admin" target="_blank">Quản trị viên</a>';
                    break;
                    default:
                    $cv =  '<a style="color: blue" href="/partner" target="_blank">Cộng tác viên</a>';
                }
                echo $cv;
                ?>
            </h2>
            <h2 class="c-font-22"></h2>
            <?php if(active(['/profile/rut-vang'])) { ?>
                <h2 class="c-font-22 c-font-red"><tuan><?=number_format($getUser['iteam'])?></tuan> vàng</h2>
            <?php } else if(active(['/profile/rut-ngoc'])) { ?>
                <h2 class="c-font-22 c-font-red"><tuan><?=number_format($getUser['iteam_ngoc'])?></tuan> ngọc</h2>
            <?php } else { ?>
                <h2 class="c-font-22 c-font-red"><tuan><?=number_format($getUser['money'])?></tuan>đ</h2>
            <?php } ?>
        </center>

    </div>