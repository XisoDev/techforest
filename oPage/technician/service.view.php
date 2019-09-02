<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">유료서비스 안내</h4>
    </div>
</section>
<div class="container pt-lg-5 bg-secondary" style="min-height:1000px;">
    랜딩페이지 들어갈 공간
</div>

<div class="fixed-bottom bg-white purchaseBox">
    <a class="toggleTip d-lg-none xxs_content" href="#" onclick="jQuery(this).parent('div').toggleClass('active');"><i class="xi-angle-up"></i><i class="xi-angle-down"></i></a>
    <form>
        <div class="px-2 py-2">
            <div class="row flex-lg-column-reverse">
                <div class="col-4 col-lg-12">
                    <div class="thumbnail bg-secondary square" style=" max-height:90px; background-image:url('/oPage/technician/images/tech_service.jpg'); background-size:cover;">

                    </div>
                </div>
                <div class="col-8 pt-2 col-lg-12 text-lg-center">
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
                <a href="#" class="btn btn-block btn-light py-2 mb-2">견적서보기</a>
            </div>
        </div>
        <a href="#" class="btn btn-block btn-danger py-2 rounded-0" data-toggle="modal" data-target="#paymentModal">결제하기</a>
    </form>
</div>


<!-- payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="techforestPaymentModalWindow" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">결제수단 선택</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="xi-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="custom-control custom-radio border rounded pl-4 px-3 py-2 mb-3 bigger_control">
                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label weight_lighter ml-2" for="customRadio1">
                            <img src="/oPage/images/imgicons/card.png" height="24" class="imgicon pl-3" />
                            <span style="vertical-align:7px;" class="pl-2">신용카드・체크카드</span>
                        </label>
                    </div>
                    <div class="custom-control custom-radio border rounded pl-4 px-3 py-2 mb-3 bigger_control">
                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label weight_lighter ml-2" for="customRadio2">
                            <img src="/oPage/images/imgicons/banking.png" height="24" class="imgicon pl-3" />
                            <span style="vertical-align:7px;" class="pl-2">무통장 입금</span>
                        </label>
                    </div>
                    <div style="min-height:300px;" class="d-none d-md-block">
                    </div>
                    <input type="button" class="btn btn-block btn-warning" value="결제하기" />
                </form>
            </div>
        </div>
    </div>
</div>


<?php
$footer_false = true;
?>