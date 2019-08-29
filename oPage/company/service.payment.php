<?php
    $row = $output->get('pay_row');
    $discount = $output->get('discount');
    $amount = $output->get('amount');
    $hidden_m_idx = $output->get('hidden_m_idx');
    $hidden_h_idx = $output->get('hidden_h_idx');
?>

<style>
    body{
      background:#FFF;
    }
    table {
      margin: 0px auto;
      width : 100%;
    }
    table td{
      padding : 10px;
    }

    #cash_receipts_check{
      width: 25px;
    }
    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }

</style>
<section class="bg-white">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">결제수단 선택</h4>
    </div>
    <div class="p-3">
    <form>
        <div class="custom-control custom-radio border rounded content_padding mb-3 pl-5 bigger_control">
            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
            <label class="custom-control-label weight_lighter" for="customRadio1">
                <i class="ml-3 xi-credit-card xi-2x" style="vertical-align: -7px;"></i>
                신용카드・체크카드
            </label>
        </div>
        <div class="custom-control custom-radio border rounded content_padding mb-3 pl-5 bigger_control">
            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" onclick="radio2_check()">
            <label class="custom-control-label weight_lighter" for="customRadio2">
                <i class="ml-3 xi-bank xi-2x" style="vertical-align: -7px;"></i>
                무통장 입금
            </label>
        </div>

        <div class="custom-control" id="bank_transfer" style="display:none;width:100%;margin: 0px auto;">
          <table border style="font-size:15px;">
            <tr>
              <td>입금은행</td>
              <td>IBK 기업은행</td>
            </tr>
            <tr>
              <td>입금계좌</td>
              <td>312-092320-01-016</td>
            </tr>
            <tr>
              <td>입금자명</td>
              <td>기술자숲(주)</td>
            </tr>
            <tr>
              <td>예금주명</td>
              <td><input type="text" id="account_holder" style="width:150px;"></td>
            </tr>
            <tr>
              <td>할인금액</td>
              <td><?=$discount?>원</td>
            </tr>
            <tr>
              <td>결제금액</td>
              <td><?=$amount?>원</td>
            </tr>
          </table>
          <img src="/oPage/images/icon_check_off.png" id="cash_receipts_check" alt="check_off">
          <span>현금영수증 신청</span>
          </div>
          <div id="cash_receipts" style="display:none;width:100%;margin: 0px auto;">
            <div class="tab">
              <button type="button" style="width:50%;" class="tablinks" onclick="openCity(event, 'London')">소득공제용</button>
              <button type="button" style="width:50%;" class="tablinks" onclick="openCity(event, 'Paris')" id="defaultOpen">지출증빙용</button>
            </div>
            <div id="London" class="tabcontent">
              <p>
                휴대폰번호 <input type="text" id="receipt_phone" style="width:150px;">
              </p>
            </div>
            <div id="Paris" class="tabcontent">
              <p>
                사업자번호 <input type="text" id="receipt_registration" style="width:150px;">
              </p>
            </div>
          </div>
        <input type="button" onclick="doPay()" class="btn btn-block btn-primary" value="결제하기" />
    </form>
    </div>
</section>

<script type="text/javascript">
  // 현금영수증 체크 이미지 변경

  $("#cash_receipts_check").click(function(e) {
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    var cs_check = $("#cash_receipts_check").attr("src");
    if(cs_check == "/oPage/images/icon_check_on.png") {
      $("#cash_receipts_check").attr("src", "/oPage/images/icon_check_off.png");
      $('#cash_receipts').css('display','none');
    } else {
      $("#cash_receipts_check").attr("src", "/oPage/images/icon_check_on.png");
      $('#cash_receipts').css('display','block');
    }
  });

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
    var hidden_m_idx = <?=$hidden_m_idx?>;


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
            params["account_holder"] = m_name;

            exec_json("company.service_order_success",params,function(ret_obj){
              var params = {};
              params["m_idx"] = m_idx;
              params["ps_idx"] = <?=$row['ps_idx']?>;
              params["all_count"] = <?=$row['service_count']?>;
              params['remain_count'] = <?=$row['service_count']?>;

              exec_json("company.add_voucher",params,function(ret_obj){
                if(hidden_m_idx > 1){
                  document.location.href="<?=getUrl('company','application',$hidden_m_idx,array(h_idx=>$hidden_h_idx))?>";
                }
              });
            });
        } else {
          // 결제 실패 시 로직,
          alert("결제에 실패하였습니다." +  rsp.error_msg);
        }
      });
    }else if(radio2 == true){
      var account_holder = $('#account_holder').val();

      if(account_holder == ""){
        $('#account_holder').focus();
        return toastr.error("예금주명을 입력해주세요.");
      }

      var params = {};
      var cs_check = $("#cash_receipts_check").attr("src");
      if(cs_check == "/oPage/images/icon_check_on.png"){
        var receipt_phone = $('#receipt_phone').val();
        var receipt_registration = $('#receipt_registration').val();

        if(receipt_phone){
          params["receipt_phone"] = receipt_phone;
        }else if(receipt_registration){
          params["receipt_registration"] = receipt_registration;
        }
      }

      params["m_idx"] = m_idx;
      params["ps_idx"] = <?=$row['ps_idx']?>;
      params['merchant_uid'] = 'cash_' + new Date().getTime();
      params["amount"] = amount;
      params["discount"] = discount;
      params["account_holder"] = account_holder;


      exec_json("company.service_order_success2",params,function(ret_obj){
        document.location.href="<?=getUrl('company','serviceHistory')?>";
      });
    }
  }

  function radio2_check(){
    $("#bank_transfer").css("display","block");
  }

  function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }




</script>
<?php
$footer_false = true;
?>
