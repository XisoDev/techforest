<section class="bg-white">
    <div class="content_padding mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">서비스 이용현황</h5>
    </div>
</section>
<div class="content_padding">
    <h6 class="weight_normal">사용가능한 쿠폰 <span class="red">3개</span></h6>

    <?php
        for($i=1; $i <= 3; $i++){
            ?>
            <div class="coupon rounded bg-white py-2 px-2 my-2">
                <div class="row">
                    <div class="col-4 border-right pr-2"><div class="avatar square" style="background-image:url('/oPage/images/coupon_icon.png')"></div></div>
                    <div class="col-8">
                        <p class="xs_content weight_normal py-0 my-0">바로검색서비스 체험권</p>
                        <h6 class=" py-0 my-0">선 면접제안 <span class="red">3회 무료</span></h6>
                        <p class="pb-0 mb-0 px-0 mx-0 xxs_content text-secondary">잔여횟수 1회 / 총 3회</p>
                        <p class="pt-0 mt-0 px-0 mx-0 xxs_content text-secondary">유효기간 : 18.06.21 ~ 19.07.31</p>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
    <form>
    <div class="input-group rounded overflow-hidden">
        <input type="text" class="form-control" placeholder="쿠폰 코드를 입력하세요." />
        <button class="rounded-0 btn btn-danger">적용</button>
    </div>
    </form>
</div>


<div class="content_padding">
    <h6 class="weight_normal">이용중인 서비스 내역</h6>
    <div class="tech_card text-left">
        <h6 class="bg-light weight_normal px-2 py-2 text-left my-0">이용상품</h6>
        <div class="bg-white content_padding">
            <h5 class="weight_normal my-0">바로검색서비스 선면접 제안권</h5>
            <p class="xs_content px-0 weight_lighter">
                잔여횟수 : <span class="red">7회</span> / 총 10회
            </p>
            <p class="xxs_content px-0 weight_lighter">
                이용기한 : 19.06.21 ~ 19.07.31
            </p>
        </div>
    </div>
</div>


<div class="content_padding">
    <h6 class="weight_normal">결제내역</h6>
    <div class="tech_card text-left bg-white">
        <div class="xxs_content text-right py-2">주문일시 : 2019.06.21</div>
        <div class="px-2 pb-1">
            <h6 class="xs_content weight_lighter"><span class="xxs_content text-secondary">결제번호</span> 190626001</h6>
            <h6 class="xs_content weight_bold red"><span class="xxs_content text-secondary">이용상품</span> 바로검색 서비스 선면접 제안권</h6>
            <h6 class="xs_content weight_bold"><span class="xxs_content text-secondary">결제금액</span> 50,000원</h6>
            <h6 class="xs_content weight_lighter"><span class="xxs_content text-secondary">결제상태</span> 완료</h6>
        </div>
        <a href="#" class="btn btn-primary btn-block rounded-0">전자 세금계산서 발행하기</a>
    </div>
</div>


<?php
$footer_false = true;
?>