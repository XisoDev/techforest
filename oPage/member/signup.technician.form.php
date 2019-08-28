<div class="container">
    <div class="row">
        <div class="col-12 mt-3 mx-0 px-0">
            <h6>회원종류 선택</h6>
        </div>

        <div class="col-6 mx-0 px-0 pr-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type"=>"technician"))?>" class="btn btn-block btn-round btn-primary xs_content">개인 회원가입</a>
        </div>
        <div class="col-6 mx-0 px-0 pl-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type"=>"company"))?>" class="btn btn-block btn-round btn-light xs_content">기업 회원가입</a>
        </div>

        <div class="col-12 mt-3 mx-0 px-0 mt-4">
            <h6>정보입력</h6>

            <div class="input-group mb-2">
                <input type="text" class="form-control" id="m_id" placeholder="아이디">
                <!-- <a href="/proc.php?act=member.id_check" class="btn btn-primary rounded-0">중복확인</a> -->
                <button class="btn btn-primary rounded rounded-0-left btn-xs" onclick="technician_id_check(); return false;">중복확인</button>
            </div>

            <input type="password" class="form-control mb-2" id="m_pw1" placeholder="비밀번호(6자리 이상)">
            <input type="password" class="form-control mb-2" id="m_pw2" placeholder="비밀번호 확인">
        </div>

        <div class="col-6 mx-0 px-0 mb-2">
          <input type="text" class="form-control" id="m_name" placeholder="이름">
        </div>
        <div class="col-6 mx-0 px-0 pl-1 mb-2">
          <select class="form-control" id="birth_year">
            <?php
            $right_now = getdate();
            $this_year = $right_now['year'];
            $start_year = 1950;
            while ($start_year <= $this_year) {
              if($start_year == 1975){
                echo "<option value='0000' selected='selected'>출생 연도</option>";}
                echo "<option value='$start_year'>{$start_year}</option>";
                $start_year++;
            }
            ?>
          </select>
        </div>
        <div class="col-12 mx-0 px-0 mb-2">
            <div class="input-group">
                <select class="form-control" id="phone1">
                    <option value="010" selected="selected">010</option>
                    <option value="011">011</option>
                    <option value="017">017</option>
                    <option value="051">051</option>
                </select>
                <div class="input-group-prepend">
                    <span class="input-group-text">-</span>
                </div>
                <input type="text" class="form-control" id="phone2" placeholder="0000">
                <div class="input-group-prepend">
                    <span class="input-group-text">-</span>
                </div>
                <input type="text" class="form-control" id="phone3" placeholder="0000">
            </div>
            <p class="xxs_content px-0 mx-0"><span class="red"><i class="xi-error"></i> 휴대전화 권장</span> : 매칭결과 안내문자를 받을 수 있습니다.</p>
        </div>

        <div class="col-12 mx-0 px-0 mb-2">
            <div class="input-group">
                <input type="text" class="form-control" id="m_email1" placeholder="이메일 주소 입력">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      @
                  </span>
                </div>
                <input type="text" class="form-control" id="m_email2" placeholder="직접입력" style="">
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
            <p class="xxs_content px-0 mx-0"><span class="red"><i class="xi-error"></i>이메일 입력 시 이벤트 및 일자리정보를 받을 수 있습니다.</span></p>
        </div>

        <div class="col-12 text-left mt-0 mx-0 px-0 mt-4">
            <div class="pull-right pr-3">
                <div class="custom-control right-checkbox custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                    <label class="custom-control-label text-dark xs_content weight_bold m-0 p-0" for="customCheck1">전체동의</label>
                </div>
            </div>
            <h6>약관동의</h6>

            <div class="pull-right pr-3">
                <div class="custom-control right-checkbox custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="agree1" checked>
                    <label class="custom-control-label xs_content" for="customCheck2">동의</label>
                </div>
            </div>
            <p class="xxs_content px-0 mx-0 weight_lighter">기술자숲 이용약관 <a class="badge-light px-2 py-0 border btn-round">전문보기</a></p>

            <div class="clearfix"></div>
            <div class="pull-right pr-3">
                <div class="custom-control right-checkbox custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="agree1" checked>
                    <label class="custom-control-label xs_content" for="customCheck3">동의</label>
                </div>
            </div>
            <p class="xxs_content px-0 mx-0 weight_lighter">개인정보 수집 및 이용에 대한 안내 <a class="badge-light px-2 py-0 border btn-round">전문보기</a></p>
        </div>
        <div class="col-12 mt-4">
            <button type="button" class="btn btn-primary btn-block btn-round" onclick="join()">회원가입</button>
        </div>
    </div>
</div>

<script type="text/javascript">
var id_check = 0;

function technician_id_check(){

    var m_id = $("#m_id").val();

    if(m_id == ""){
      $('#m_id').focus();
      return toastr.error("아이디를 입력해주세요.");
    }

    if(m_id.length < 2 || m_id.length > 16){
      return toastr.error("아이디는 2 ~ 16자 내로 입력해주세요.");
    }

    var params = {};
    params["m_id"] = m_id;
    exec_json("member.procMemberCheckHasID",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        toastr.success(ret_obj.message);
        id_check = 1;
    });
}

function click_email(email) {
  $("#c_email2").val(email);
}

function join(){
  var m_id = $("#m_id").val();
  var m_pw1 = $("#m_pw1").val();
  var m_pw2 = $("#m_pw2").val();
  var m_name = $("#m_name").val();
  var birth_year = $("#birth_year").val();
  var phone1 = $("#phone1").val();
  var phone2 = $("#phone2").val();
  var phone3 = $("#phone3").val();
  var agree1 = $("#agree1").val();
  var agree2 = $("#agree2").val();
  var m_email1 = $("#m_email1").val();
  var m_email2 = $("#m_email2").val();


  var m_phone = phone1 + "-" + phone2 + "-" + phone3;
  var m_email = m_email1 + "@" + m_email2;

  if(m_id == ""){
    $('#m_id').focus();
    return toastr.error("아이디를 입력해주세요.");
  }

  if(id_check == 0){
    return toastr.error("아이디 중복확인을 해주세요.");
  }

  if(m_pw1 == ""){
    $('#m_pw1').focus();
    return toastr.error("비밀번호를 입력해주세요.");
  }
  if(m_pw2 == ""){
    $('#m_pw2').focus();
    return toastr.error("비밀번호를 확인해주세요.");
  }
  if(m_pw1 && m_pw1 != m_pw2){
    $('#m_pw2').focus();
    return toastr.error("비밀번호를 확인해주세요.");
  }
  if(m_pw1.length < 6){
    $('#m_pw1').focus();
    return toastr.error("비밀번호는 6자리 이상으로 지정해주세요.");
  }
  if(m_name == ""){
    $('#m_name').focus();
    return toastr.error("이름을 입력해주세요.");
  }
  if(phone2 == ""){
    $('#phone2').focus();
    return toastr.error("휴대폰 번호를 입력해주세요.");
  }
  if(phone3 == ""){
    $('#phone3').focus();
    return toastr.error("휴대폰 번호를 입력해주세요.");
  }
  if(birth_year == '0000'){
    return toastr.error("출생 연도를 선택해주세요.");
  }
  if(agree1 == 0 || agree2 == 0){
    return toastr.error("약관에 동의해주세요.");
  }


  var params = {};
  params["m_id"] = m_id;
  params["m_pw1"] = m_pw1;
  params["m_name"] = m_name;
  params["birth_year"] = birth_year;
  params["m_phone"] = m_phone;
  params["m_email"] = m_email;

  exec_json("member.procMemberSignupTechnician",params,function(ret_obj){
     //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
     // alert(ret_obj.message); // alert 해도되지만 toastr 권장
      toastr.success(ret_obj.message);
      document.location.href="<?=getUrl('technician')?>";
  });
}
</script>
