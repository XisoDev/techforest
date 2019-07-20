<div class="container">
    <div class="bigger_logo">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <img class="align-self-center mr-3" src="/oPage/images/logo.png" alt="기술자 숲">
        </div>
        <div class="col-3"></div>
    </div>
    </div>
    
    <!-- 모듈명.액션명(함수명) -->
    <form action="/proc.php?act=member.procMemberLogin" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text form-round" id="validationTooltipUsernamePrepend">
                            <i class="xi-key"></i>
                        </span>
                    </div>
                    <input type="text"
                           onfocus="jQuery('.bigger_logo').addClass('focus');"
                           onblur="jQuery('.bigger_logo').removeClass('focus');"
                           class="form-control form-round" name="user_id" placeholder="이메일 주소 또는 아이디" required>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text form-round" id="validationTooltipUsernamePrepend">
                            <i class="xi-lock"></i>
                        </span>
                    </div>
                    <input type="password"
                           onfocus="jQuery('.bigger_logo').addClass('focus');"
                           onblur="jQuery('.bigger_logo').removeClass('focus');"
                           class="form-control form-round" name="password" id="validationTooltipUsername" placeholder="비밀번호" aria-describedby="validationTooltipUsernamePrepend" required>
                </div>
            </div>
        </div>
        <div class="col-5 text-left mt-0">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label xs_content" for="customCheck1">아이디 저장</label>
            </div>
        </div>
        <div class="col-7 text-right mt-0">
            <a href="#" class="xs_content">아이디 찾기</a>
            <span class="xxs_content">|</span>
            <a href="#" class="xs_content">비밀번호 찾기</a>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary btn-block btn-round">로그인</button>
        </div>
        <div class="col-12 mt-1">
            <button type="button" class="btn btn-info btn-block btn-round" data-toggle="modal" data-target="#signupModal">회원가입</button>

        </div>
    </div>
    </form>

</div>

<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">회원가입</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include _XISO_PATH_ . "/oPage/member/signup.php"; ?>
            </div>
        </div>
    </div>
</div>
