
<div class="container">
    <div class="row">
        <div class="col-12 mt-3 mx-0 px-0">
            <h6>회원종류 선택</h6>
        </div>

        <div class="col-6 mx-0 px-0 pr-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type" => "technician"))?>" class="btn btn-block btn-round btn-light xs_content">개인 회원가입</a>
        </div>
        <div class="col-6 mx-0 px-0 pl-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type" => "company"))?>" class="btn btn-block btn-round btn-primary xs_content">기업 회원가입</a>
        </div>

        <div class="col-12 mt-3 mx-0 px-0 mt-4">
            <h6>정보입력</h6>

            <div class="input-group mb-2">
                <input type="text" class="form-control" id="m_id" placeholder="아이디" required>
                <button class="btn btn-primary rounded rounded-0-left btn-xs" onclick="company_id_check(); return false;">중복확인</button>
            </div>

            <input type="password" class="form-control mb-2" id="m_pw1" placeholder="비밀번호(6자리 이상)" required>
            <input type="password" class="form-control mb-2" id="m_pw2" placeholder="비밀번호 확인" required>
        </div>

        <div class="col-6 mx-0 px-0 pr-1 mb-2">
            <input type="text" class="form-control" id="m_name" placeholder="회사명" required>
        </div>
        <div class="col-6 mx-0 pl-1 px-0 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text xs_content pl-2">
                      직급
                  </span>
                </div>
                <input type="text" class="form-control" id="c_position" placeholder="직접입력">
                <button class="dropdown-toggle" type="button" id="position_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span></button>
                <ul id="position_list" class="dropdown-menu" aria-labelledby="position_btn" style="">
                  <li class="" onclick="click_position('사원')">사원</li>
                  <li role="separator" class="divider"></li>
                  <li class="" onclick="click_position('대리')">대리</li>
                  <li role="separator" class="divider"></li>
                  <li class="" onclick="click_position('팀장')">팀장</li>
                  <li role="separator" class="divider"></li>
                  <li class="" onclick="click_position('과장')">과장</li>
                  <li role="separator" class="divider"></li>
                  <li class="" onclick="click_position('대표')">대표</li>
                </ul>
            </div>
        </div>
        <div class="col-12 mx-0 px-0 mb-2">
          <input type="text" class="form-control mb-2" id="select7" placeholder="담당자 이름" required>
        </div>
        <div class="col-12 mx-0 px-0 mb-2">
            <div class="input-group">
              <input type="text" class="form-control" id="phone1" placeholder="직접입력">
              <button class="dropdown-toggle" type="button" id="phone_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span></button>
              <ul id="phone1_list" class="dropdown-menu" aria-labelledby="phone_btn" style="">
                <li class="" onclick="click_phone('010')">010</li>
                <li role="separator" class="divider"></li>
                <li class="" onclick="click_phone('017')">017</li>
                <li role="separator" class="divider"></li>
                <li class="" onclick="click_phone('016')">016</li>
                <li role="separator" class="divider"></li>
                <li class="" onclick="click_phone('011')">011</li>
                <li role="separator" class="divider"></li>
                <li class="" onclick="click_phone('018')">018</li>
              </ul>
                </select>
                <div class="input-group-prepend">
                    <span class="input-group-text">-</span>
                </div>
                <input type="text" class="form-control" id="phone2" maxlength="4" placeholder="0000" onkeyup="onlyNumber(this)">
                <div class="input-group-prepend">
                    <span class="input-group-text">-</span>
                </div>
                <input type="text" class="form-control" id="phone3" maxlength="4" placeholder="0000" onkeyup="onlyNumber(this)">
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
                    <input type="checkbox" class="custom-control-input" id="customCheck2" checked>
                    <label class="custom-control-label xs_content" for="customCheck2">동의</label>
                </div>
            </div>
            <p class="xxs_content px-0 mx-0 weight_lighter">기술자숲 이용약관 <button class="badge-light px-2 py-0 border btn-round" data-toggle="modal" data-target="#company_terms">전문보기</button></p>

            <div class="clearfix"></div>
            <div class="pull-right pr-3">
                <div class="custom-control right-checkbox custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck3" checked>
                    <label class="custom-control-label xs_content" for="customCheck3">동의</label>
                </div>
            </div>
            <p class="xxs_content px-0 mx-0 weight_lighter">개인정보 수집 및 이용에 대한 안내 <button class="badge-light px-2 py-0 border btn-round" data-toggle="modal" data-target="#privacy_policy">전문보기</button></p>
        </div>
        <div class="col-12 mt-4">
            <button class="btn btn-primary btn-block btn-round" onclick="join()">회원가입</button>
        </div>
    </div>
</div>

<div class="modal fade" id="company_terms" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
             <?php include "company_terms.php"; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="privacy_policy" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
             <?php include "privacy_policy.php"; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
var id_check = 0;

function company_id_check(){

    var m_id = $("#m_id").val();

    if(m_id == ""){
      $('#signup_id').focus();
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
  $("#m_email2").val(email);
}

function click_position(position) {
  $("#c_position").val(position);
}

function click_phone(phone) {
  $("#phone1").val(phone);
}

function join(){
  var m_id = $("#m_id").val();
  var m_pw1 = $("#m_pw1").val();
  var m_pw2 = $("#m_pw2").val();
  var m_name = $("#m_name").val();
  var c_position = $("#c_position").val();
  var phone1 = $("#phone1").val();
  var phone2 = $("#phone2").val();
  var phone3 = $("#phone3").val();
  var agree1 = $("#customCheck2").prop("checked");
  var agree2 = $("#customCheck3").prop("checked");
  var m_email1 = $("#m_email1").val();
  var m_email2 = $("#m_email2").val();
  var select7 = $("#select7").val();

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
    return toastr.error("회사명을 입력해주세요.");
  }
  if(c_position == ""){
    $('#c_position').focus();
    return toastr.error("직급을 입력해주세요.");
  }

  if(select7 == ""){
    $('#select7').focus();
    return toastr.error("담당자명을 입력해주세요.");
  }

  if(phone1 == ""){
    $('#phone1').focus();
    return toastr.error("연락처를 입력해주세요.");
  }

  if(phone2 == ""){
    $('#phone2').focus();
    return toastr.error("연락처를 입력해주세요.");
  }

  if(phone3 == ""){
    $('#phone3').focus();
    return toastr.error("연락처를 입력해주세요.");
  }

  if(agree1 == false || agree2 == false){
    return toastr.error("약관에 동의해주세요.");
  }


  var params = {};
  params["m_id"] = m_id;
  params["m_pw1"] = m_pw1;
  params["m_name"] = m_name;
  params["select7"] = select7;
  params["c_position"] = c_position;
  params["m_phone"] = m_phone;
  params["m_email"] = m_email;

  exec_json("company.procMemberSignupCompany",params,function(ret_obj){
     //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
     // alert(ret_obj.message); // alert 해도되지만 toastr 권장
      toastr.success(ret_obj.message);
      document.location.href="<?=getUrl('company')?>";
  });
}
</script>
