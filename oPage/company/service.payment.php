<?php
    $row = $output->get('pay_row');
    // $discount = $output->get('discount');
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
          <input type="button" onclick="pay()" class="btn btn-block btn-primary" value="결제하기" />
    </form>
    </div>
</section>

<script type="text/javascript">
  function pay(){
    var radio1 = $('#customRadio1').is(':checked');
    var radio2 = $('#customRadio2').is(':checked');
    var m_idx = "<?=$logged_info['m_idx']?>";
    var m_email = "<?=$logged_info['m_email']?>";
    var m_name = "<?=$logged_info['m_name']?>";
    var m_phone = "<?=$logged_info['m_phone']?>";
    var pay_service = "<?=$row['pay_service']?>";
    var price = "<?=$row['price']?>";
    var discount = 0;


    if(radio1 == true){
      var IMP = window.IMP; // 생략해도 괜찮습니다.
      IMP.init("imp24082824"); // "imp00000000" 대신 발급받은 "가맹점 식별코드"를 사용합니다.

      IMP.request_pay({ // param
        pg : "uplus",
        pay_method: "card",
        merchant_uid : 'merchant_' + new Date().getTime(),
        name: pay_service,
        amount: price,
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
            params["amount"] = price;
            params["discount"] = discount;

            exec_json("company.service_order_success",params,function(ret_obj){
                alert("결제성공!!!");
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
