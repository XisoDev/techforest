<?php

if(!isset($footer_false)){
    echo "<div style=\"height:80px;\"></div>";
}
?>

<footer class="d-none d-sm-block bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-3 pt-5">
<!--                logo ?-->
                <a href="<?=getUrl()?>">
                <img src="/oPage/images/logo_gray.png" height="49" />
                </a>
            </div>
            <div class="col-9 pt-3">
                <h6 class="text-warning mt-4 mb-0 pt-0 pb-0">CONTACT</h6>
                <p class="text-light weight_lighter xs_content">
                    경남 창원시 마산회원구 봉암북7길 21, ICT 진흥센터 5동 706호<br />
                    <a class="text-light" href="tel:+82218009665">1800-9665</a> | <a class="text-light" href="tel:+8255-259-5315">055-259-5315</a>
                </p>

                <h6 class="text-warning mt-4 mb-0 pt-0 pb-0">COMPANY</h6>
                <p class="text-light weight_lighter xs_content">
                    상호 : 기술자숲주식회사 | 사업자등록번호 : 592-81-00527 | 대표 <b class="weight_normal">공태영</b><br />
                    통신판매업 신고번호 : 2016-마산회원-0136호 | 직업정보제공사업 : 창원제 2016-3호
                </p>


                <h6 class="text-warning mt-4 mb-0 pt-0 pb-0">INFO</h6>
                <div class="pull-right">
                    <a href="#" class="text-light"><i class="xi-facebook xi-2x"></i></a>
                    <a href="#" class="text-light"><i class="xi-blogger xi-2x"></i></a>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light m-0 p-0">
                <ul class="navbar-nav">
                    <li class="nav-item xs_content weight_normal"><a class="text-secondary ml-0 pl-0 nav-link" href="#">이용약관</a></li>
                    <li class="nav-item xs_content weight_normal"><a class="text-secondary nav-link xs_content">|</a></li>
                    <li class="nav-item xs_content weight_normal"><a class="text-secondary nav-link" href="#">문의하기</a></li>
                    <li class="nav-item xs_content weight_normal"><a class="text-secondary nav-link xs_content">|</a></li>
                    <li class="nav-item xs_content weight_normal"><a class="text-secondary nav-link" href="#">회원탈퇴</a></li>
                </ul>
                </nav>

                <p class="text-secondary py-4">copyright c 기술자숲 주식회사 all right reserverd.</p>
            </div>
        </div>
    </div>
</footer>
