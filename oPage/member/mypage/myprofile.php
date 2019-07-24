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

<div class="container">
    <div class="content_padding px-0">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">내 정보 설정</h5>
    </div>
    <?if($logged_info['is_commerce'] == 'Y'){?>
    <form class="tf_underline_form">
        <div class="form-group">
            <label for=""><i class="xi-building"></i> 기업명</label>
            <input type="text" class="form-control" id="" placeholder="기술자숲" readonly="readonly">
        </div>
        <div class="form-group">
            <label for=""><i class="xi-call"></i> 휴대폰번호</label>
            <input type="text" class="form-control" id="" placeholder="휴대전화번호를 입력하세요." value="<?=$logged_info['m_phone']?>" readonly="readonly">
            <a href="#" onclick="jQuery(this).prev().removeAttr('readonly');" class="bg-red btn btn-xs btn-round">변경</a>
        </div>
        <div class="form-group">
            <label for=""><i class="xi-mail"></i> 이메일</label>
            <input type="email" class="form-control" id="" placeholder="이메일 주소를 입력하세요" value="<?=$logged_info['m_email']?>" readonly="readonly">
            <a href="#" onclick="jQuery(this).prev().removeAttr('readonly');" class="bg-red btn btn-xs btn-round">변경</a>
        </div>
        <div class="form-group">
            <label for=""><i class="xi-user"></i> 채용담당자</label>
            <input type="text" class="form-control" id="" placeholder="담당자명을 입력합니다." value="" readonly="readonly">
            <a href="#" onclick="jQuery(this).prev().removeAttr('readonly');" class="bg-red btn btn-xs btn-round">변경</a>
        </div>
    </form>
    <?}else{?>
      <form class="tf_underline_form">
          <div class="form-group">
              <label for=""><i class="xi-building"></i> 이름</label>
              <input type="text" class="form-control" id="" value="<?=$logged_info['m_name']?>" readonly="readonly">
          </div>
          <div class="form-group">
              <label for=""><i class="xi-call"></i> 휴대폰번호</label>
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
              <label for=""><i class="xi-mail"></i> 이메일</label>
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
      </form>
    <?}?>
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
    var params = {};
    params["m_phone"] = phonenumber;
    params["m_idx"] = "<?=$_SESSION['LOGGED_INFO']?>";
    exec_json("technician.edit_phone",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        toastr.success(ret_obj.message);
        location.reload();
    });
  });
}

function email(){
  $('#change_email_btn').css("display","none");
  $('#change_email_btn_ok').css("display","block");
  $('#m_email1,#m_email2').css("border","solid 1px #cccccc");
  $('#select_email').css("display","block");
  $('#m_email1,#m_email2').prop('readonly', false);

  $('#change_email_btn_ok').click(function(){
    var email	=	$("#m_email1").val() + "@" + $("#m_email2").val();
    var params = {};
    params["m_email"] = email;
    params["m_idx"] = "<?=$_SESSION['LOGGED_INFO']?>";
    exec_json("technician.edit_email",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        toastr.success(ret_obj.message);
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

</script>
