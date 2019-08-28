<?php
  $voucher_list = $output->get('voucher_list');
  $payment_list = $output->get('payment_list');
?>

<section class="d-lg-none bg-white">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">서비스 이용현황</h4>
    </div>
</section>
<div class="container pt-lg-5">
    <div class="py-lg-5 pt-lg-3 position-relative">
        <h4 class="d-none d-lg-block mb-4"><i class="xi-lightbulb-o text-warning"></i> 사용가능한 쿠폰 <span class="red">3개</span></h4>
        <h6 class="d-block d-lg-none weight_normal">사용가능한 쿠폰 <span class="red">3개</span></h6>

        <div class="row">
            <?php
            for($i=1; $i <= 3; $i++){
                ?>
                <div class=" col-12 col-md-6 col-lg-4">
                    <div class="coupon rounded bg-white py-2 px-2 pt-md-4 my-2 shadow">
                        <div class="row">
                            <div class="col-md-3 d-none d-md-block"></div>
                            <div class="col-4 col-md-6 pr-2"><div class="avatar square" style="background-image:url('/oPage/images/coupon_icon.png')"></div></div>
                            <div class="col-md-3 d-none d-md-block"></div>
                            <div class="col-8 col-md-12 text-md-center">
                                <p class="xs_content weight_normal py-0 my-0 pt-md-2">바로검색서비스 체험권</p>
                                <h6 class=" py-0 my-0 py-md-3">선 면접제안 <span class="red">3회 무료</span></h6>
                                <p class="xs_content text-secondary d-none d-md-block">결제금액의 50%를 <br />할인 해 드립니다.</p>
                                <hr class="d-none d-md-block" />
                                <p class="pb-0 mb-0 px-0 mx-0 xxs_content text-secondary">잔여횟수 1회 / 총 3회</p>
                                <p class="pt-0 mt-0 px-0 mx-0 xxs_content text-secondary">유효기간 : 18.06.21 ~ 19.07.31</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <form>
            <div class="input-group rounded overflow-hidden d-lg-none">
                <input type="text" class="form-control" placeholder="쿠폰 코드를 입력하세요." />
                <button class="rounded-0 btn btn-danger" onclick="add_coupon()">적용</button>
            </div>
            <div class="input-group rounded overflow-hidden d-lg-flex d-none position-absolute" style="top:2rem; right:0; width:400px;">
                <input type="text" class="form-control" placeholder="쿠폰 코드를 입력하세요." />
                <button class="rounded-0 btn btn-danger" onclick="add_coupon()">적용</button>
            </div>
        </form>
</div>


    <div class="py-lg-5 pt-lg-3 position-relative">
        <h4 class="d-none d-lg-block mb-4"><i class="xi-lightbulb-o text-warning"></i> 이용중인 서비스 내역</h4>
        <h6 class="d-block d-lg-none weight_normal"> 이용중인 서비스 내역</span></h6>

        <div class="d-none d-lg-block">
            <table class="table table-light table-bordered mt-4  text-center" width="100%">
                <thead class="bg-light">
                <tr><th>이용상품</th><th>잔여횟수</th><th>이용기한</th></tr>
                </thead>
                <tbody>
                <?php foreach($voucher_list as $val){ ?>
                <tr><td><?=$val['pay_service']?></td><td><span class="red"><?=$val['remain_count']?>회</span> / 총 <?=$val['all_count']?>회</td><td><?=date("Y-m-d", strtotime($val["reg_date"]))?> ~ <?=date("Y-m-d", strtotime($val["expire_date"]))?></td></tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="d-block d-lg-none">
            <div class="tech_card text-left">
                <h6 class="bg-light weight_normal px-2 py-2 text-left my-0">이용상품</h6>
                <?php foreach($voucher_list as $val){ ?>
                  <div class="bg-white content_padding">
                      <h5 class="weight_normal my-0"><?=$val['pay_service']?></h5>
                      <p class="xs_content px-0 weight_lighter">
                          잔여횟수 : <span class="red"><?=$val['remain_count']?>회</span> / 총 <?=$val['all_count']?>회
                      </p>
                      <p class="xxs_content px-0 weight_lighter">

                          이용기한 : <?=date("Y-m-d", strtotime($val["reg_date"]))?> ~ <?=date("Y-m-d", strtotime($val["expire_date"]))?>
                      </p>
                  </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="py-lg-5 pt-lg-3 position-relative">
        <h4 class="d-none d-lg-block mb-4"><i class="xi-lightbulb-o text-warning"></i> 결제내역</h4>
        <h6 class="d-block d-lg-none weight_normal"> 결제내역</span></h6>

        <div class="d-none d-lg-block">
            <table class="table table-light table-bordered mt-4  text-center" width="100%">
                <thead class="bg-light">
                <tr><th>주문번호</th><th>주문일시</th><th>이용상품</th><th>금액</th><th>상태</th></tr>
                </thead>
                <tbody>
                <?php foreach($payment_list as $val){ ?>
                <tr><td><?=substr($val['merchant_uid'],9)?></td><td><?=date("Y-m-d", strtotime($val["reg_date"]))?></td><td><?=$val['pay_service']?></td><td><?=$val['amount']?></td><td><?=($val['state'] == "Y") ? "완료" : "대기"?></td></tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="d-block d-lg-none">
            <div class="tech_card text-left bg-white">
                <?php foreach($payment_list as $val){ ?>
                    <div class="xxs_content text-right py-2">주문일시 : <?=date("Y-m-d", strtotime($val["reg_date"]))?></div>
                    <div class="px-2 pb-1">
                        <h6 class="xs_content weight_lighter"><span class="xxs_content text-secondary">결제번호</span> <?=substr($val['merchant_uid'],9)?></h6>
                        <h6 class="xs_content weight_bold red"><span class="xxs_content text-secondary">이용상품</span> <?=$val['pay_service']?></h6>
                        <h6 class="xs_content weight_bold"><span class="xxs_content text-secondary">결제금액</span> <?=$val['amount']?>원</h6>
                        <h6 class="xs_content weight_lighter"><span class="xxs_content text-secondary">결제상태</span> <?=($val['state'] == "Y") ? "완료" : "대기"?></h6>
                    </div>
                <?php } ?>
                <!-- <a href="#" class="btn btn-primary btn-block rounded-0">전자 세금계산서 발행하기</a> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  function add_coupon(){
    alert("올바른 쿠폰코드를 입력해주세요.");
  }
</script>
<?php
$footer_false = true;
?>
