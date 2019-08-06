<script type="text/javascript">
function company_id_check(){
    var params = {};
    params["m_id"] = $("#signup_id").val();
    exec_json("company.procCompanyCheckHasID",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        toastr.success(ret_obj.message);
    });
}
</script>

<form action="/proc.php?act=company.procMemberSignupCompany" method="post">
    <input type="hidden" name="success_return_url" value="<?=getUrl('company')?>" />
<div class="container">
    <div class="row">
        <div class="col-12 mt-3 mx-0 px-0">
            <h6>회원종류 선택</h6>
        </div>

        <div class="col-6 mx-0 px-0 pr-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type" => "technician"))?>" class="btn btn-block btn-round btn-light">개인 회원가입</a>
        </div>
        <div class="col-6 mx-0 px-0 pl-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type" => "company"))?>" class="btn btn-block btn-round btn-primary">기업 회원가입</a>
        </div>

        <div class="col-12 mt-3 mx-0 px-0 mt-4">
            <h6>정보입력</h6>

            <div class="input-group mb-2">
                <input type="text" class="form-control" id="signup_id" name="m_id" value="<?=$_SESSION['signup']['m_id']?>" placeholder="아이디" required>
                <button class="btn btn-primary rounded-0" onclick="company_id_check(); return false;">중복확인</button>
            </div>

            <input type="password" class="form-control mb-2" name="m_pw1" id="m_pw1" value="<?=$_SESSION['signup']['m_pw1']?>" placeholder="비밀번호(6자리 이상)" required>
            <input type="password" class="form-control mb-2" name="m_pw2" id="m_pw2" value="<?=$_SESSION['signup']['m_pw2']?>"placeholder="비밀번호 확인" required>
        </div>

        <div class="col-6 mx-0 px-0 pr-1 mb-2">
            <input type="text" class="form-control" name="c_name" value="<?=$_SESSION['signup']['c_name']?>" placeholder="회사명" required>
        </div>
        <div class="col-6 mx-0 px-0 pl-1 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            직급
                        </span>
                </div>
                <select class="form-control" name="c_position" onchange="if(this.value == 99){jQuery(this).hide(); jQuery(this).next().show();}">
                    <option value="" selected="selected">직급 선택</option>
                    <option value="대표">대표</option>
                    <option value="이사">이사</option>
                    <option value="99">직접입력</option>
                </select>
                <input type="text" class="form-control" placeholder="직접입력" style="display:none;">
            </div>
        </div>
        <div class="col-12 mx-0 px-0 pl-1 mb-2">
          <input type="text" class="form-control mb-2" name="select7" id="select7" placeholder="담당자 이름" required>
        </div>
        <div class="col-12 mx-0 px-0 pl-1 mb-2">
            <div class="input-group">
                <select class="form-control" name="phone1">
                    <option value="010" selected="selected">010</option>
                    <option value="011">011</option>
                    <option value="017">017</option>
                    <option value="051">051</option>
                </select>
                <div class="input-group-prepend">
                    <span class="input-group-text">-</span>
                </div>
                <input type="text" class="form-control" value="<?=$_SESSION['signup']['phone2']?>" name="phone2" placeholder="0000">
                <div class="input-group-prepend">
                    <span class="input-group-text">-</span>
                </div>
                <input type="text" class="form-control" value="<?=$_SESSION['signup']['phone3']?>" name="phone3" placeholder="0000">
            </div>
            <p class="xxs_content px-0 mx-0"><span class="red"><i class="xi-error"></i> 휴대전화 권장</span> : 매칭결과 안내문자를 받을 수 있습니다.</p>
        </div>

        <div class="col-12 mx-0 px-0 pl-1 mb-2">
            <div class="input-group">
                <input type="text" class="form-control"  value="<?=$_SESSION['signup']['m_email1']?>" name="m_email1" placeholder="이메일 주소 입력">

                <div class="input-group-prepend">
                        <span class="input-group-text">
                            @
                        </span>
                </div>
                <select class="form-control" name="m_email2" onchange="if(this.value == 99){jQuery(this).hide(); jQuery(this).next().show();}">
                    <option value="" selected="selected">메일 주소 선택</option>
                    <option value="1">naver.com</option>
                    <option value="2">gmail.com</option>
                    <option value="99">직접입력</option>
                </select>
                <input type="text" class="form-control" placeholder="직접입력" style="display:none;">
            </div>

        </div>

        <div class="col-12 text-left mt-0 mx-0 px-0 mt-4">
            <h6>약관동의</h6>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="agree1" id="customCheck2" checked>
                <label class="custom-control-label xs_content" for="customCheck2">기술자숲 이용약관에 동의합니다.</label>
                <a href="#" class="btn btn-xxs btn-light btn-round">내용보기</a>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="agree2" id="customCheck3" checked>
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
