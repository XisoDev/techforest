<?php
//면접제안권없을때, 구매하고 다시 그 지원자 상세보기로 돌아가기 위함
$m_num = $_REQUEST['num'];
$h_num = $_REQUEST['h_idx'];
if(!$m_num){
  $m_num = 0 ;
}
?>
<section class="bg-white d-lg-none">
    <div class="content_padding mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">유료서비스 안내</h5>
    </div>
</section>
<div class="container pt-lg-5 bg-secondary" style="min-height:1000px;">
    랜딩페이지 들어갈 공간
</div>

<div class="fixed-bottom bg-white purchaseBox">
    <a class="toggleTip d-lg-none xxs_content" href="#" onclick="jQuery(this).parent('div').toggleClass('active');"><i class="xi-angle-up"></i><i class="xi-angle-down"></i></a>
    <form method="post" action="<?=getUrl('company','servicePayment')?>" onsubmit="return forhidden()">
        <div class="content_padding">
            <div class="row flex-lg-column-reverse">
                <div class="col-4 col-lg-12">
                    <div class="thumbnail bg-secondary square" style="background-image:url('/oPage/technician/images/tech_service.jpg'); background-size:cover;">

                    </div>
                </div>
                <div class="col-8 pt-3 col-lg-12 text-lg-center">
                    <h5>면접제안권</h5>
                    <!-- <h6>상품 금액 : 50,000원</h6> -->
                </div>
            </div>
            <div class="toggleBox mt-3">
                <label class="xs_content mb-0 pb-1">상품선택</label>
                <select class="form-control" id="service_option" name="service_option" onchange="javascript:service_list(this)">
                  <option value="0,0">상품을 선택해주세요</option>
                  <option value="2,5000">면접제안권 5회</option>
                  <option value="3,10000">면접제안권 10회</option>
                </select>
                <!-- <label class="xs_content mb-0 pb-1">쿠폰할인</label>
                <select class="form-control"><option value="">첫회원가입 기념 10%할인쿠폰</option></select> -->
                <input type="hidden" name="hidden_discount" id="hidden_discount" value="">
                <input type="hidden" name="hidden_amount" id="hidden_amount" value="">
                <input type="hidden" name="hidden_m_idx" value="<?=$m_num?>">
                <input type="hidden" name="hidden_h_idx" value="<?=$h_num?>">
                <h6 class="weight_normal pt-2 text-right">할인 금액 <span class="red" name="discount" id="discount">0</span><span class="red">원</span></h6>
                <h6 class="weight_normal pt-2 text-right">총 결제 금액 <span class="red" name="amount" id="amount">0</span><span class="red">원</span></h6>
                <a href="#" class="btn btn-block btn-light">견적서보기</a>
            </div>
        </div>
        <a href="#" class="btn btn-block btn-danger rounded-0" data-toggle="modal" data-target="#paymentModal">결제하기</a>
    </form>
</div>


<!-- payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="techforestPaymentModalWindow" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">결제수단 선택</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="xi-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="custom-control custom-radio border rounded content_padding mb-3 pl-5 bigger_control">
                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label weight_lighter" for="customRadio1">
                            <i class="ml-3 xi-credit-card xi-2x" style="vertical-align: -7px;"></i>
                            신용카드・체크카드
                        </label>
                    </div>
                    <div class="custom-control custom-radio border rounded content_padding mb-3 pl-5 bigger_control">
                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label weight_lighter" for="customRadio2">
                            <i class="ml-3 xi-bank xi-2x" style="vertical-align: -7px;"></i>
                            무통장 입금
                        </label>
                    </div>
                    <input type="button" class="btn btn-block btn-primary" value="결제하기" />
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
 function service_list(obj){
   var getObj = obj.options[obj.selectedIndex].value.split(",");
   document.getElementById("amount").innerHTML = getObj[1];
 }
 function forhidden(){
   var discount = $('#discount').text();
   var amount = $('#amount').text();

   $('#hidden_discount').val(discount);
   $('#hidden_amount').val(amount);
 }
</script>

<?php
$footer_false = true;
?>
