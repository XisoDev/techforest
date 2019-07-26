<!-- 다음 주소 api -->
<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>

<section class="bg-white">
    <div class="content_padding mt-4 pt-5">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">공고등록</h5>
    </div>
    <ul class="nav nav-tabs nav-justified mt-0 pt-0 mb-5 mx-0 px-0" role="tablist">
        <li class="nav-item active">
            <a class="nav-link weight_bold" href="<?=getUrl('company','job_register')?>">
                1단계<br />기업정보 등록
            </a>
        </li>
        <li class="nav-item">
            <?if(!$logged_info['c_name'] || !$logged_info['registration'] || !$logged_info['address'] || !$logged_info['address2'] || !$logged_info['phonenumber'] || !$logged_info['select6']){?>
              <a class="nav-link weight_bold" onclick="back()" >
                  2단계<br />공고등록
              </a>
            <?}else{?>
              <a class="nav-link weight_bold" href="<?=getUrl('company','job_appRegister')?>" >
                  2단계<br />공고등록
              </a>
            <?}?>
        </li>
    </ul>
    <div class="content_padding mt-0 pt-0">
        <div class="row">
            <div class="col-5 mx-auto px-auto">
                <div class="position-relative">
                    <div class="avatar square mb-2" style="background-image:url('/layout/none/assets/images/no_company.png');">
                    </div>
                    <i class="xi-camera position-absolute text-white" style="right:0;bottom:0; font-size:28px;"></i>
                    <i class="xi-camera position-absolute text-secondary" style="right:1px;bottom:1px; font-size:26px;"></i>
                </div>
            </div>
        </div>

            <!--성공하면 자동으로 2단계로 보낼수있음.-->
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>회사명</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <input type="text" class="form-control" id="c_name" value="<?=$logged_info['c_name']?>" placeholder="회사명" required>
                    </div>
                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>사업자등록번호</h6>
                    </div>
                    <?php
                      $registration = explode("-", $logged_info["registration"]);

                    ?>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <div class="input-group">
                            <input type="text" class="form-control" id="registration1" value="<?=$registration[0]?>" placeholder="000" maxlength="3" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" id="registration2" value="<?=$registration[1]?>" placeholder="00" maxlength="2" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" id="registration3" value="<?=$registration[2]?>" placeholder="00000" maxlength="5" required>
                        </div>
                    </div>
                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>주소</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="address"  value="<?=$logged_info['address']?>" placeholder="주소검색" readonly>
                            <button type="button" class="btn btn-primary rounded-0" onclick="search_address()">검색</button>
                        </div>
                        <input type="text" class="form-control" id="address2" value="<?=$logged_info['address2']?>" placeholder="상세주소">
                    </div>
                    <div id="wrap" style="display:none;border:1px solid;width:100%;height:50%;margin:5px 0;position:relative">
                      <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
                    </div>
                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>담당자 정보</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 pl-1 mb-2">

                        <div class="input-group">
                            <select class="form-control" id="c_phone1" required>
                              <?
                                $phonenumber = explode("-", $logged_info['phonenumber']);
                                $phone_arr = array("010", "02", "031", "032", "033", "041", "042", "043", "044", "051", "052", "053", "054", "055", "061", "062", "063", "064", "070");

                                for($i = 0; $i < count($phone_arr); $i++) {
                                  if($phone_arr[$i] == $phonenumber[0]) {
                                    echo "<option value=\"" . $phone_arr[$i] . "\" selected=\"selected\">" . $phone_arr[$i] . "</option>";
                                  } else {
                                    echo "<option value=\"" . $phone_arr[$i] . "\">" . $phone_arr[$i] . "</option>";
                                  }
                                }
                              ?>
                            </select>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" id="c_phone2" value="<?=$phonenumber[1]?>" placeholder="0000" maxlength="4" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" id="c_phone3" value="<?=$phonenumber[2]?>" placeholder="0000" maxlength="4" required>
                        </div>
                    </div>

                    <div class="col-12 mx-0 px-0 pl-1 mb-2">
                        <div class="input-group">
                            <? $email = explode("@", $logged_info['select6']); ?>
                            <input type="text" class="form-control" id="c_email1" value="<?=$email[0]?>" placeholder="이메일 주소 입력" required>

                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                @
                            </span>
                            </div>
                            <input type="text" class="form-control" id="c_email2" value="<?=$email[1]?>" placeholder="직접입력" style="">
                            <button class="dropdown-toggle" type="button" id="email_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span></button>
                            <ul id="email_list" class="dropdown-menu" aria-labelledby="email_btn" style="">
                              <li class="" onclick="click_email('naver.com')">naver.com</li>
                              <li role="separator" class="divider"></li>
                              <li class="" onclick="click_email('hanmail.net')">hanmail.net</li>
                              <li role="separator" class="divider"></li>
                              <li class="" onclick="click_email('nate.com')">nate.com</li>
                              <li role="separator" class="divider"></li>
                              <li class="" onclick="click_email('daum.net')">daum.net</li>
                              <li role="separator" class="divider"></li>
                              <li class="" onclick="click_email('google.com')">google.com</li>
                            </ul>
                        </div>

                    </div>

                    <div class="col-12 text-left mt-0 mx-0 px-0 mt-4">
                        <h6>회사 간단소개</h6>
                        <textarea class="form-control" id="c_introduction"><?=$logged_info['c_introduction']?></textarea>
                    </div>

                    <div class="col-6 mt-4 px-0 mx-0 pr-1">
                        <button type="button" onclick="temporary_save()" class="btn border-primary btn-block btn-round">임시저장</button>
                    </div>
                    <div class="col-6 mt-4 px-0 mx-0 pl-1">
                        <button type="button" onclick="company_info_ok()" class="btn btn-primary btn-block btn-round">등록완료</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>



<?php
$footer_false = true;
?>

<script type="text/javascript">
  function temporary_save(){

  }

  function company_info_ok(){
    var c_name = $('#c_name').val();
    var registration = $('#registration1').val() + "-" +  $('#registration2').val() + "-" +  $('#registration3').val();
    var address = $('#address').val();
    var address2 = $('#address2').val();
    var phonenumber = $('#c_phone1').val() + "-" + $('#c_phone2').val() + "-" + $('#c_phone3').val();
    var select6 = $('#c_email1').val() + "@" + $('#c_email2').val();
    var c_introduction = $('#c_introduction').val();

    if(c_name == ""){
      $('#c_name').focus();
      return toastr.error("회사명을 입력해주세요.");
    }

    if($('#registration1').val() == ""){
      $('#registration1').focus();
      return toastr.error("사업자등록번호를 입력해주세요.");
    }

    if($('#registration2').val() == ""){
      $('#registration2').focus();
      return toastr.error("사업자등록번호를 입력해주세요.");
    }

    if($('#registration3').val() == ""){
      $('#registration3').focus();
      return toastr.error("사업자등록번호를 입력해주세요.");
    }

    if(address == ""){
      $('#address').focus();
      return toastr.error("주소를 입력해주세요.");
    }

    if(address2 == ""){
      $('#address2').focus();
      return toastr.error("상세주소를 입력해주세요.");
    }

    if($('#c_phone2').val() == ""){
      $('#c_phone2').focus();
      return toastr.error("담당자연락처를 입력해주세요.");
    }

    if($('#c_phone3').val() == ""){
      $('#c_phone3').focus();
      return toastr.error("담당자연락처를 입력해주세요.");
    }

    if($('#c_email1').val() == ""){
      $('#c_email1').focus();
      return toastr.error("담당자이메일을 입력해주세요.");
    }

    if($('#c_email2').val() == ""){
      $('#c_email2').focus();
      return toastr.error("담당자이메일을 입력해주세요.");
    }

    var params = {};
    params["c_name"] = c_name;
    params["registration"] = registration;
    params["address"] = address;
    params["address2"] = address2;
    params["phonenumber"] = phonenumber;
    params["select6"] = select6;
    params["c_introduction"] = c_introduction;
    exec_json("company.company_info",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        toastr.success(ret_obj.message);
        document.location.href="<?=getUrl('company','job_appRegister')?>";
    });

  }


  // 우편번호 찾기 찾기 화면을 넣을 element
   var element_wrap = document.getElementById('wrap');

   function foldDaumPostcode() {
       // iframe을 넣은 element를 안보이게 한다.
       element_wrap.style.display = 'none';
   }

   function search_address() {
       // 현재 scroll 위치를 저장해놓는다.
       var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
       new daum.Postcode({
           oncomplete: function(data) {
               // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

               // 각 주소의 노출 규칙에 따라 주소를 조합한다.
               // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
               var addr = ''; // 주소 변수
               var extraAddr = ''; // 참고항목 변수

               //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
               if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                   addr = data.roadAddress;
               } else { // 사용자가 지번 주소를 선택했을 경우(J)
                   addr = data.jibunAddress;
               }

               // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
               if(data.userSelectedType === 'R'){
                   // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                   // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                   if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                       extraAddr += data.bname;
                   }
                   // 건물명이 있고, 공동주택일 경우 추가한다.
                   if(data.buildingName !== '' && data.apartment === 'Y'){
                       extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                   }
                   // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                   if(extraAddr !== ''){
                       extraAddr = ' (' + extraAddr + ')';
                   }
                   // 조합된 참고항목을 해당 필드에 넣는다.


               } else {

               }

               // 우편번호와 주소 정보를 해당 필드에 넣는다.
               document.getElementById("address").value = addr + " "+ extraAddr;
               // 커서를 상세주소 필드로 이동한다.
               document.getElementById("address2").focus();

               // iframe을 넣은 element를 안보이게 한다.
               // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
               element_wrap.style.display = 'none';

               // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
               document.body.scrollTop = currentScroll;
           },
           // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
           onresize : function(size) {
               element_wrap.style.height = size.height+'px';
           },
           width : '100%',
           height : '100%'
       }).embed(element_wrap);

       // iframe을 넣은 element를 보이게 한다.
       element_wrap.style.display = 'block';
   }


   function click_email(email) {
     $("#c_email2").val(email);
   }

   function back(){
     toastr.error("기업정보등록 후 이용하실 수 있습니다.");
   }
</script>
