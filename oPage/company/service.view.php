<?php
//공고등록권 없을때, 구매하고 다시 그 지원자 상세보기로 돌아가기 위함
$m_num = $_REQUEST['num'];
$h_num = $_REQUEST['h_idx'];
if(!$m_num){
  $m_num = 0;
}

$row = $output->get('pay_row');
$choose_hire = $output->get('choose_hire');

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


<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">유료서비스 안내</h4>
    </div>
</section>
<div class="container pt-lg-5 bg-secondary" style="min-height:1000px;">
    랜딩페이지 들어갈 공간
</div>

<div class="fixed-bottom bg-white purchaseBox" id="pay_box">
    <a class="toggleTip d-lg-none xxs_content" onclick="jQuery(this).parent('div').toggleClass('active');"><i class="xi-angle-up"></i><i class="xi-angle-down"></i></a>
        <div class="px-2 py-2">
            <div class="row flex-lg-column-reverse">
                <div class="col-4 col-lg-12">
                    <div class="thumbnail bg-secondary square" style="background-image:url('/oPage/technician/images/tech_service.jpg'); background-size:cover; max-height:90px;"></div>
                </div>
                <div class="col-8 pt-2 col-lg-12 text-lg-center">
                    <h5>후불공고등록</h5>
                    <h6>상품 금액 : 50,000원</h6>
                </div>
            </div>
            <div class="toggleBox mt-3">
              <label class="xs_content mb-0 pb-1">공고선택</label>
              <select class="form-control" id="service_hire_option" name="service_hire_option">
                <option value="">공고를 선택해주세요</option>
                <?foreach ($choose_hire as $val) {?>
                  <option value="<?=$val['h_idx']?>"><?=$val['h_title']?></option>
                <?}?>
              </select>
                <!-- <label class="xs_content mb-0 pb-1">상품선택</label>
                <select class="form-control" id="service_option" name="service_option" onchange="javascript:service_list(this)">
                  <option value="0,0">상품을 선택해주세요</option>
                  <option value="2,5000">면접제안권 5회</option>
                  <option value="3,10000">면접제안권 10회</option>
                </select> -->
                <!-- <label class="xs_content mb-0 pb-1">쿠폰할인</label>
                <select class="form-control"><option value="">첫회원가입 기념 10%할인쿠폰</option></select> -->
                <input type="hidden" name="hidden_discount" id="hidden_discount" value="0">
                <input type="hidden" name="hidden_amount" id="hidden_amount" value="<?=$row['price']?>">
                <h6 class="weight_normal pt-2 text-right">할인 금액 <span class="red" name="discount" id="discount">0</span><span class="red">원</span></h6>
                <h6 class="weight_normal pt-2 text-right">총 결제 금액 <span class="red" name="amount" id="amount"><?=$row['price']?></span><span class="red">원</span></h6>
<!--                <a href="#" class="btn btn-block btn-light py-2 mb-2">견적서보기</a>-->
            </div>
        </div>
        <!-- <a class="btn btn-block btn-danger rounded-0" data-toggle="modal" data-target="#paymentModal">결제하기</a> -->
        <a class="btn btn-block btn-danger py-2 rounded-0 text-white" onclick="pay_check()">결제하기</a>
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
                      <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" onclick="radio2_check()">
                      <label class="custom-control-label weight_lighter ml-2" for="customRadio2">
                          <img src="/oPage/images/imgicons/banking.png" height="24" class="imgicon pl-3" />
                          <span style="vertical-align:7px;" class="pl-2">무통장 입금</span>
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
        </div>
    </div>
</div>



<script type="text/javascript">
  // 면접제안권 기능
  // function service_list(obj){
  //   var getObj = obj.options[obj.selectedIndex].value.split(",");
  //   document.getElementById("amount").innerHTML = getObj[1];
  // }
  // function forhidden(){
  //   var discount = $('#discount').text();
  //   var amount = $('#amount').text();
  //
  //   $('#hidden_discount').val(discount);
  //   $('#hidden_amount').val(amount);
  // }

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

  function pay_check(){
    var service_hire_option = $('#service_hire_option option:selected').val();

    if(service_hire_option == ""){
      $('#pay_box').addClass('active');
      return toastr.error("공고를 선택해주세요.");
    }else{
      $('#paymentModal').modal('show');
    }
  }

  function doPay(){
    var radio1 = $('#customRadio1').is(':checked');
    var radio2 = $('#customRadio2').is(':checked');
    var m_idx = "<?=$logged_info['m_idx']?>";
    var m_name = "<?=$logged_info['m_name']?>";
    var m_phone = "<?=$logged_info['m_phone']?>";
    var pay_service = "<?=$row['pay_service']?>";
    var amount = $('#hidden_amount').val();
    var discount = $('#hidden_discount').val();
    var h_idx = $('#service_hire_option option:selected').val();

    if(radio1 == true){
      var IMP = window.IMP; // 생략해도 괜찮습니다.
      IMP.init("imp24082824"); // "imp00000000" 대신 발급받은 "가맹점 식별코드"를 사용합니다.

      IMP.request_pay({ // param
        pg : "uplus",
        pay_method: "card",
        merchant_uid : 'merchant_' + new Date().getTime(),
        name: pay_service,
        amount: amount,
        buyer_email: "",
        buyer_name: m_name,
        buyer_tel: m_phone
      }, function (rsp) { // callback
        if (rsp.success) {
            // 결제 성공 시 로직,
            var params = {};
            params["m_idx"] = m_idx;
            params["ps_idx"] = <?=$row['ps_idx'] ? $row['ps_idx'] : 0 ?>;
            params['merchant_uid'] = 'merchant_' + new Date().getTime();
            params["amount"] = amount;
            params["discount"] = discount;
            params["account_holder"] = m_name;

            exec_json("company.service_order_success",params,function(ret_obj){
              var params = {};
              params["m_idx"] = m_idx;
              params["h_idx"] = h_idx;
              params["ps_idx"] = <?=$row['ps_idx'] ? $row['ps_idx'] : 0 ?>;
              params["all_count"] = <?=$row['service_count'] ? $row['service_count'] : 0?>;
              params['remain_count'] = <?=$row['service_count'] ? $row['service_count'] : 0?>;

              exec_json("company.add_voucher",params,function(ret_obj){
                if(hidden_m_idx > 1){
                  document.location.href="<?=getUrl('company','application',$m_num,array('h_idx'=>$h_num))?>";
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
      params["ps_idx"] = <?=$row['ps_idx'] ? $row['ps_idx'] : 0?>;
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
