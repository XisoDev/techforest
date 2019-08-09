<?php
    $row = $output->get('pay_row');
    $discount = $output->get('discount');
    $amount = $output->get('amount');
?>

<style>
    body{background:#FFF;}
</style>
<section class="bg-white">
    <div class="content_padding mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">결제수단 선택</h5>
    </div>
    <div class="content_padding">
    <form>
        <div class="custom-control custom-radio border rounded content_padding mb-3 pl-5 bigger_control">
            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
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
        <div class="" id="" style="display:none">
          IBK 기업은행 312-092320-01-016 <br>
          예금주 : 기술자숲 주식회사
          <input type="checkbox" name="" value="현금영수증 신청">
            <input type="text" name="" value="" style="display:none">
          <input type="checkbox" name="" value="세금계산서 신청">
          <input type="checkbox" name="" value="신청안함" checked>
        </div>
          <input type="button" onclick="doPay()" class="btn btn-block btn-primary" value="결제하기" />
    </form>
    </div>
</section>

<script type="text/javascript">

  function doPay(){
    var radio1 = $('#customRadio1').is(':checked');
    var radio2 = $('#customRadio2').is(':checked');
    var m_idx = "<?=$logged_info['m_idx']?>";
    var m_email = "<?=$logged_info['m_email']?>";
    var m_name = "<?=$logged_info['m_name']?>";
    var m_phone = "<?=$logged_info['m_phone']?>";
    var pay_service = "<?=$row['pay_service']?>";
    var amount = "<?=$amount?>";
    var discount = "<?=$discount?>";

    if(radio1 == true){
      var IMP = window.IMP; // 생략해도 괜찮습니다.
      IMP.init("imp24082824"); // "imp00000000" 대신 발급받은 "가맹점 식별코드"를 사용합니다.

      IMP.request_pay({ // param
        pg : "uplus",
        pay_method: "card",
        merchant_uid : 'merchant_' + new Date().getTime(),
        name: pay_service,
        amount: amount,
        buyer_email: m_email,
        buyer_name: m_name,
        buyer_tel: m_phone
      }, function (rsp) { // callback
        if (rsp.success) {
            // 결제 성공 시 로직,
            var params = {};
            params["m_idx"] = m_idx;
            params["ps_idx"] = <?=$row['ps_idx']?>;
            params['merchant_uid'] = 'merchant_' + new Date().getTime();
            params["amount"] = amount;
            params["discount"] = discount;

            exec_json("company.service_order_success",params,function(ret_obj){
              var params = {};
              params["m_idx"] = m_idx;
              params["ps_idx"] = <?=$row['ps_idx']?>;
              params["all_count"] = <?=$row['count']?>;
              params['remain_count'] = <?=$row['count']?>;

              exec_json("company.add_voucher",params,function(ret_obj){

              });
            });
        } else {
          // 결제 실패 시 로직,
          alert("결제에 실패하였습니다." +  rsp.error_msg);
        }
      });
    }
  }
</script>
<?php
$footer_false = true;
?>
