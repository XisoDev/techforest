<section class="bg-white">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">유료서비스 안내</h4>
    </div>
</section>
<div class="content_padding">
    랜딩페이지 들어갈 공간
</div>

<div class="fixed-bottom bg-white purchaseBox">
    <a class="toggleTip xxs_content" href="#" onclick="jQuery(this).parent('div').toggleClass('active');"><i class="xi-angle-up"></i><i class="xi-angle-down"></i></a>
    <form method="post" action="<?=getUrl('technician','servicePayment')?>">
        <div class="content_padding">
            <div class="row">
                <div class="col-4">
                    <div class="thumbnail bg-secondary square" style="background-image:url('/oPage/technician/images/tech_service.jpg'); background-size:cover;">

                    </div>
                </div>
                <div class="col-8 pt-3">
                    <h5>프리미엄 회원 이용권</h5>
                    <h6>상품 금액 : 50,000원</h6>
                </div>
            </div>
            <div class="toggleBox mt-3">
                <label class="xs_content mb-0 pb-1">이용기간</label>
                <select class="form-control"><option value="">이용기간 선택</option></select>
                <label class="xs_content mb-0 pb-1">쿠폰할인</label>
                <select class="form-control"><option value="">첫회원가입 기념 10%할인쿠폰</option></select>
                <h6 class="weight_normal pt-2 text-right">총 결제 금액 <span class="red">27,000원</span></h6>
                <a href="#" class="btn btn-block btn-light">견적서보기</a>
            </div>
        </div>
        <input type="submit" class="btn btn-block btn-danger rounded-0" value="결제하기" />
    </form>
</div>



<?php
$footer_false = true;
?>