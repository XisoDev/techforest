
<div class="container pt-lg-5">
    <div class="bigger_logo d-lg-none">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <img class="align-self-center mr-3" src="/oPage/images/logo.png" alt="기술자 숲">
        </div>
        <div class="col-3"></div>
    </div>
    </div>

    <!-- 모듈명.액션명(함수명) -->
    <div class="mx-auto col-12 col-sm-10 col-md-8 col-lg-6 p-4 p-md-5 ">
    <form action="/proc.php?act=member.procMemberLogin" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text form-round pl-3" id="validationTooltipUsernamePrepend">
                            <i class="xi-key"></i>
                        </span>
                    </div>
                    <input type="text"
                           onfocus="jQuery('.bigger_logo').addClass('focus');"
                           onblur="jQuery('.bigger_logo').removeClass('focus');"
                           class="form-control form-round" name="user_id" id="user_id" placeholder="이메일주소 또는 아이디" required>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text form-round pl-3" id="validationTooltipUsernamePrepend">
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

        <div class="col-12">
            <div class="pull-left">
                <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                    <label class="custom-control-label text-dark xxs_content m-0 p-0" for="customCheck1">아이디저장</label>
                </div>
            </div>
            <div class="pull-right">
                <a href="#" class="xxs_content text-dark m-0 p-0">아이디 찾기</a>
                <span class="xxs_content px-0">|</span>
                <a href="#" class="xxs_content text-dark m-0 p-0">비밀번호 찾기</a>
            </div>
        </div>


        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary btn-block btn-round xs_content py-2">로그인</button>
        </div>
        <div class="col-12 mt-1">
            <a href="<?=getUrl('member','signUp')?>" style="background-color:#E0E7F6;" class="btn xs_content py-2 btn-light btn-block btn-round">회원가입</a>
<!--            <button type="button" class="btn btn-info btn-block btn-round" data-toggle="modal" data-target="#signupModal">회원가입</button>-->
        </div>
    </div>
    </form>
    </div>

    <h6 class="text-center weight_lighter">SNS 간편 로그인</h6>
    <!-- <div class="row"> -->
    <div class="W50_Mauto">
        <!-- <div class="col-1">
        </div> -->
        <!-- <div class="col-5 text-center">
            <img src="/oPage/member/assets/images/facebook_icon.png" height="40" />
            <span class="btn btn-light xxs_content btn-block py-1 px-2 btn-round border">페이스북 로그인</span>
        </div> -->
        <div class="text-center">
            <img src="/oPage/member/assets/images/naver_icon.png" height="40"  />
            <div class="row">
              <span id="modal_naver_ok1" class="btn btn-light xxs_content btn-block py-1 px-2 btn-round border" style="margin: 10px 20px;">개인 로그인</span>
              <span id="modal_naver_ok2" class="btn btn-light xxs_content btn-block py-1 px-2 btn-round border" style="margin: 0 20px;">기업 로그인</span>
            </div>
        </div>
    </div>
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
                <?php include _XISO_PATH_ . "/oPage/member/signup.technician.form.php"; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

  // 네이버 - 개인회원가입
	$("#modal_naver_ok1").click(function(e) {
    var state = '<?=$_SESSION['state']?>';
		var href = location.href.replace("#", "");
		var url = "https://nid.naver.com/oauth2.0/authorize?client_id=cXstjgkmgg8Oiz8d7zHx&response_type=code&redirect_uri=http://127.0.0.1:8080/login_naver.php?type=1&state=" + state;

		//var popOption = "width=700, height=500, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)
		//window.open(url,"",popOption);
		try {
			location.replace(url);
		}
		catch(exception){
			location.href = url;
		}

	});

	// 네이버 - 기업회원가입
	$("#modal_naver_ok2").click(function(e) {
		var state = '<?=$_SESSION['state']?>';
		var href = location.href.replace("#", "");
		var url = "https://nid.naver.com/oauth2.0/authorize?client_id=cXstjgkmgg8Oiz8d7zHx&response_type=code&redirect_uri=https://http://127.0.0.1:8080/login_naver.php?type=2&state=" + state;

		try {
			location.replace(url);
		}
		catch(exception){
			location.href = url;
		}

	});

</script>
