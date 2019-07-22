<script type="text/javascript">
function id_check(){
    var params = {};
    params["m_id"] = $("#signup_id").val();
    exec_json("member.procMemberCheckHasID",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        toastr.success(ret_obj.message);
    });
  // $.ajax({
  //   type :'POST',
  //   url : "../../id_check.php",
  //   data : {
  //     "m_id" : m_id
  //   },
  //   dataType : 'JSON',
  //   success: function (response) {
  //     if (response.result == 1) {
  //         alert(response.message);
  //     } else {
  //         alert(response.message);
  //     }
  //   },
  //   error: function (request, status, error) {
  //       alert("ERROR Code : " + request.status + "\n" + "ERROR Message : " + request.responseText + "\n" + "ERROR : " + error);
  //   }
  // });
}

</script>
<form action="/proc.php?act=member.procMemberSignupTechnician" method="post">
    <input type="hidden" name="success_return_url" value="<?=getUrl('technician')?>" />
<div class="container">
    <div class="row">
        <div class="col-12 mt-3 mx-0 px-0">
            <h6>회원종류 선택</h6>
        </div>

        <div class="col-6 mx-0 px-0 pr-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type" => "technician"))?>" class="btn btn-block btn-round btn-primary">개인 회원가입</a>
        </div>
        <div class="col-6 mx-0 px-0 pl-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type" => "company"))?>" class="btn btn-block btn-round btn-light">기업 회원가입</a>
        </div>

        <div class="col-12 mt-3 mx-0 px-0 mt-4">
            <h6>정보입력</h6>

            <div class="input-group mb-2">
                <input type="text" class="form-control" id="signup_id" name="m_id" value="<?=$_SESSION['signup']['m_id']?>" placeholder="아이디" required>
                <!-- <a href="/proc.php?act=member.id_check" class="btn btn-primary rounded-0">중복확인</a> -->
                <button class="btn btn-primary rounded-0" onclick="id_check(); return false;">중복확인</button>
            </div>

            <input type="password" class="form-control mb-2" name="m_pw1" id="m_pw1" value="<?=$_SESSION['signup']['m_pw1']?>" placeholder="비밀번호(6자리 이상)" required>
            <input type="password" class="form-control mb-2" name="m_pw2" id="m_pw2" value="<?=$_SESSION['signup']['m_pw2']?>" placeholder="비밀번호 확인" required>
        </div>

        <div class="col-12 mx-0 px-0 pl-1 mb-2">
            <div class="input-group">
                <input type="text" class="form-control" name="m_email1" value="<?=$_SESSION['signup']['m_email1']?>" placeholder="이메일 주소 입력">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            @
                        </span>
                </div>
                <select class="form-control" name="m_email2" value="<?=$_SESSION['signup']['m_email2']?>" onchange="if(this.value == 99){jQuery(this).hide(); jQuery(this).next().show();}">
                    <option value="" selected="selected">이메일 주소 선택</option>
                    <option value="1">naver.com</option>
                    <option value="2">gmail.com</option>
                    <option value="99">직접입력</option>
                </select>
                <input type="text" class="form-control" placeholder="직접입력" style="display:none;">
            </div>
            <p class="xxs_content px-0 mx-0"><span class="red"><i class="xi-error"></i> 일자리정보 & 이벤트정보를 안내 해 드립니다.</span></p>

        </div>

        <div class="col-12 text-left mt-0 mx-0 px-0 mt-4">
            <h6>약관동의</h6>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck2">
                <label class="custom-control-label xs_content" for="customCheck2">기술자숲 이용약관에 동의합니다.</label>
                <a href="#" class="btn btn-xxs btn-light btn-round">내용보기</a>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck3">
                <label class="custom-control-label xs_content" for="customCheck3">개인정보 수집 및 이용약관에 동의합니다.</label>
                <a href="#" class="btn btn-xxs btn-light btn-round">내용보기</a>
            </div>
        </div>
        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary btn-block btn-round">회원가입</button>
        </div>

    </div>
</div>
</form>
