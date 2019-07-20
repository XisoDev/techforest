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
                <input type="text" class="form-control" id="signup_id" placeholder="아이디" required>
                <button type="button" class="btn btn-primary rounded-0">중복확인</button>
            </div>

            <input type="password" class="form-control mb-2" placeholder="비밀번호 (6자리 이상)" required>
            <input type="password" class="form-control mb-2" placeholder="비밀번호 확인" required>
        </div>

        <div class="col-12 mx-0 px-0 pl-1 mb-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="이메일 주소 입력">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            @
                        </span>
                </div>
                <select class="form-control" onchange="if(this.value == 99){jQuery(this).hide(); jQuery(this).next().show();}">
                    <option value="" selected="selected">메일 호스트 선택</option>
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