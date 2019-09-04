<style media="screen">
  .border_none{
    border : none;
    outline: none;
    width : 40px;
    text-align: center;
  }
  .border_none_1{
    border : none;
    outline: none;
    width : 90px;
    text-align: center;
  }
</style>


<div class="container pt-lg-5">
    <div class="p-3 px-0 d-lg-none">
<!--        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>-->
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">내 정보 설정</h4>
    </div>

    <div class="pt-lg-5 pt-lg-3 position-relative mx-auto col-sm-10 col-md-9 col-lg-8">
        <h4 class="d-none d-lg-block mb-4"><img src="/oPage/images/imgicons/user.png" height="30" /> 내 정보 설정</h4>
    </div>

    <div class="mx-auto col-sm-10 col-md-9 col-lg-8 rounded border mobile-border-0 p-3 p-md-5 ">
    <?if($logged_info['is_commerce'] == 'Y'){?>
    <form class="tf_underline_form">
        <div class="form-group">
            <label for="" class="mt-md-3"><i class="xi-building"></i> <span class="weight_bold">기업명</span></label>
            <input type="text" class="form-control" id="" value="<?=$logged_info['c_name']?>" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="" class="mt-md-3"><i class="xi-call"></i> <span class="weight_bold">휴대폰번호</span></label>
              <div class="form-control" style="border:none;">
                <select id="change_phone" style="display:none;float:left;width: 50px;">
                  <?
                    $phonenumber = explode("-", $logged_info['m_phone']);
                    $phone_arr = array("선택", "02", "031", "032", "033", "041", "042", "043", "044", "051", "052", "053", "054", "055", "061", "062", "063", "064", "010", "070");

                    for($i = 0; $i < count($phone_arr); $i++) {
                      if($phone_arr[$i] == $phonenumber[0]) {
                        echo "<option value=\"" . $phone_arr[$i] . "\" selected=\"selected\">" . $phone_arr[$i] . "</option>";
                      } else {
                        echo "<option value=\"" . $phone_arr[$i] . "\">" . $phone_arr[$i] . "</option>";
                      }
                    }
                  ?>
                </select>
                <input type="text" class="border_none" id="m_phonenumber1" maxlength="3" value="<?=$phonenumber[0]?>"  readonly="readonly">-
                <input type="text" class="border_none" id="m_phonenumber2" maxlength="4" value="<?=$phonenumber[1]?>"  readonly="readonly">-
                <input type="text" class="border_none" id="m_phonenumber3" maxlength="4" value="<?=$phonenumber[2]?>"  readonly="readonly">
              </div>
            <button type="button" id="change_phone_btn" onclick="phonenumber()" class="bg-red btn btn-xs btn-round">변경</button>
            <button type="button" id="change_phone_btn_ok" class="bg-red btn btn-xs btn-round" style="display:none;">수정완료</button>
        </div>
        <div class="form-group">
            <label for="" class="mt-md-3"><i class="xi-mail"></i> <span class="weight_bold">이메일</span></label>
            <div class="form-control" style="border:none;">
              <? $email = explode("@", $logged_info['m_email']); ?>
              <input type="email" class="border_none" id="m_email1" placeholder="이메일 주소를 입력하세요" value="<?=$email[0]?>" readonly="readonly">@
              <input type="text" class="border_none_1" id="m_email2" value="<?=$email[1]?>" readonly="readonly">
              <select id="select_email" style="display:none;">
                  <option value="" selected="selected">메일 주소 선택</option>
                  <option value="naver.com">naver.com</option>
                  <option value="gmail.com">gmail.com</option>
                  <option value="">직접입력</option>
              </select>
            <button type="button" id="change_email_btn" onclick="email()" class="bg-red btn btn-xs btn-round">변경</button>
            <button type="button" id="change_email_btn_ok" class="bg-red btn btn-xs btn-round" style="display:none;">수정완료</button>
        </div>
      </div>
        <div class="form-group">
            <label for="" class="mt-md-3"><i class="xi-user"></i> <span class="weight_bold">채용담당자</span></label>
            <input type="text" class="form-control" id="InCharge_name" placeholder="담당자명을 입력합니다." value="<?=$logged_info['select7']?>" readonly>
            <button type="button" id="change_name_btn" onclick="ThePersonInCharge()" class="bg-red btn btn-xs btn-round">변경</button>
            <button type="button" id="change_name_btn_ok" class="bg-red btn btn-xs btn-round" style="display:none;">수정완료</button>
        </div>
    </form>
    <?}else{?>
      <form class="tf_underline_form">
          <div class="form-group">
              <label for="" class="mt-md-3"><i class="xi-building"></i> 이름</label>
              <input type="text" class="form-control" id="" value="<?=$logged_info['m_name']?>" readonly="readonly">
          </div>
          <div class="form-group">
              <label for="" class="mt-md-3"><i class="xi-call"></i> 휴대폰번호</label>
                <div class="form-control" style="border:none;">
                  <select id="change_phone" style="display:none;float:left;width: 50px;">
                    <?
                      $phonenumber = explode("-", $logged_info['m_phone']);
                      $phone_arr = array("선택", "02", "031", "032", "033", "041", "042", "043", "044", "051", "052", "053", "054", "055", "061", "062", "063", "064", "010", "070");

                      for($i = 0; $i < count($phone_arr); $i++) {
                        if($phone_arr[$i] == $phonenumber[0]) {
                          echo "<option value=\"" . $phone_arr[$i] . "\" selected=\"selected\">" . $phone_arr[$i] . "</option>";
                        } else {
                          echo "<option value=\"" . $phone_arr[$i] . "\">" . $phone_arr[$i] . "</option>";
                        }
                      }
                    ?>
                  </select>
                  <input type="text" class="border_none" id="m_phonenumber1" maxlength="3" value="<?=$phonenumber[0]?>"  readonly="readonly">-
                  <input type="text" class="border_none" id="m_phonenumber2" maxlength="4" value="<?=$phonenumber[1]?>"  readonly="readonly">-
                  <input type="text" class="border_none" id="m_phonenumber3" maxlength="4" value="<?=$phonenumber[2]?>"  readonly="readonly">
                </div>
              <button type="button" id="change_phone_btn" onclick="phonenumber()" class="bg-red btn btn-xs btn-round">변경</button>
              <button type="button" id="change_phone_btn_ok" class="bg-red btn btn-xs btn-round" style="display:none;">수정완료</button>
          </div>
          <div class="form-group">
              <label for="" class="mt-md-3"><i class="xi-mail"></i> 이메일</label>
              <div class="form-control" style="border:none;">
                <? $email = explode("@", $logged_info['m_email']); ?>
                <input type="email" class="border_none" id="m_email1" placeholder="이메일 주소를 입력하세요" value="<?=$email[0]?>" readonly="readonly">@
                <input type="text" class="border_none_1" id="m_email2" value="<?=$email[1]?>" readonly="readonly">
                <select id="select_email" style="display:none;">
                    <option value="" selected="selected">메일 주소 선택</option>
                    <option value="naver.com">naver.com</option>
                    <option value="gmail.com">gmail.com</option>
                    <option value="">직접입력</option>
                </select>
              <button type="button" id="change_email_btn" onclick="email()" class="bg-red btn btn-xs btn-round">변경</button>
              <button type="button" id="change_email_btn_ok" class="bg-red btn btn-xs btn-round" style="display:none;">수정완료</button>
            </div>
          </div>
      </form>
    <?}?>

        <div class="text-center d-none d-md-block">
            <a href="#" class="btn btn-round border-primary mr-1 px-4 ">취소</a>
            <a href="#" class="btn btn-round btn-primary ml-1 px-4">수정완료</a>
        </div>
    </div>
</div>

<script type="text/javascript">

function click_email(email) {
	$("#email2").val(email);
}

function phonenumber(){
  $('#change_phone_btn').css("display","none");
  $('#change_phone_btn_ok').css("display","block");
  $('#m_phonenumber1,#m_phonenumber2,#m_phonenumber3').css("border","solid 1px #cccccc");
  $('#change_phone').css("display","block");
  $('#m_phonenumber2,#m_phonenumber3').prop('readonly', false);
  $('#m_phonenumber1').css("display","none");

  $('#change_phone_btn_ok').click(function(){
    var phonenumber	=	$("#change_phone").val() + "-" + $("#m_phonenumber2").val() + "-" + $("#m_phonenumber3").val();

    if($("#m_phonenumber2").val() == ""){
      $('#m_phonenumber2').focus();
      return toastr.error("휴대폰번호를 입력해주세요.");
    }

    if($("#m_phonenumber3").val() == ""){
      $('#m_phonenumber3').focus();
      return toastr.error("휴대폰번호를 입력해주세요.");
    }

    var params = {};
    params["m_phone"] = phonenumber;
    exec_json("member.edit_phone",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        //toastr.success(ret_obj.message);
        location.reload();
    });
  });
}

function email(){
  $('#change_email_btn').css("display","none");
  $('#change_email_btn_ok').css("display","block");
  $('#m_email1,#m_email2').css("border","solid 1px #cccccc");
  $('#select_email').css("display","inline-block");
  $('#m_email1,#m_email2').prop('readonly', false);


  $('#change_email_btn_ok').click(function(){
    var email	=	$("#m_email1").val() + "@" + $("#m_email2").val();

    if($("#m_email1").val() == ""){
      $('#m_email1').focus();
      return toastr.error("이메일을 입력해주세요.");
    }

    if($("#m_email2").val() == ""){
      $('#m_email2').focus();
      return toastr.error("이메일 주소를 입력해주세요.");
    }

    var params = {};
    params["m_email"] = email;
    exec_json("member.edit_email",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        //toastr.success(ret_obj.message);
        location.reload();
    });
  });

}

$('#select_email').change(function(){
   $("#select_email option:selected").each(function () {
      if($(this).val()== ''){ //직접입력일 경우
        $("#m_email2").val(''); //값 초기화
        $("#m_email2").attr("readonly",false); //활성화
        $("#m_email2").focus();
      }else{ //직접입력이 아닐경우
        $("#m_email2").val($(this).text()); //선택값 입력
        $("#m_email2").attr("readonly",true); //비활성화
      }
    });
  });

  function ThePersonInCharge(){
    $('#change_name_btn').css("display","none");
    $('#change_name_btn_ok').css("display","block");
    $('#InCharge_name').prop('readonly', false);
    $("#InCharge_name").focus();

    $('#change_name_btn_ok').click(function(){

      if($("#InCharge_name").val() == ""){
        $('#InCharge_name').focus();
        return toastr.error("담당자를 입력해주세요.");
      }

      var params = {};
      params["InCharge_name"] = $("#InCharge_name").val();
      exec_json("member.edit_InCharge_name",params,function(ret_obj){
         //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
         // alert(ret_obj.message); // alert 해도되지만 toastr 권장
          //toastr.success(ret_obj.message);
          location.reload();
      });
    });
  }

</script>
