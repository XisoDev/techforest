<style media="screen">
  .btn_style{
    border:0;
    background-color: #FFF;
    outline:0;
  }
  #naver_log{
    cursor: pointer;
  }
</style>
<div class="container pt-lg-5">
    <div class="bigger_logo d-lg-none">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <img class="align-self-center mr-3" src="/oPage/images/logo_blue.png" alt="기술자 숲">
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
                           class="form-control form-round" name="user_id" id="user_id" placeholder="아이디" required>
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
                <a class="xxs_content text-dark m-0 p-0 btn_style" data-toggle="modal" data-target="#modal_search_id">아이디 찾기</a>
                <span class="xxs_content px-0">|</span>
                <a class="xxs_content text-dark m-0 p-0 btn_style" data-toggle="modal" data-target="#modal_search_pw">비밀번호 찾기</a>
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

    <h6 class="text-center weight_bold xxs_content pb-3">SNS 간편 로그인</h6>
    <!-- <div class="row"> -->
    <div class="W50_Mauto pb-5">
        <!-- <div class="col-1">
        </div> -->
        <!-- <div class="col-5 text-center">
            <img src="/oPage/member/assets/images/facebook_icon.png" height="40" />
            <span class="btn btn-light xxs_content btn-block py-1 px-2 btn-round border">페이스북 로그인</span>
        </div> -->
        <div class="text-center">
            <img id="naver_log" src="/oPage/member/assets/images/naver_icon.png" height="40"  />
            <div class="row naver_row" style="display:none;">
              <span id="modal_naver_ok1" class="btn btn-light xxs_content btn-block py-1 px-2 border" style="margin: 10px 0; background: #00000000;color:#595959;">네이버 개인 로그인</span>
              <span id="modal_naver_ok2" class="btn btn-light xxs_content btn-block py-1 px-2 border" style="background: #00000000; color:#595959;">네이버 기업 로그인</span>
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


<div class="modal fade" id="modal_search_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">아이디찾기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="col-12 mx-0 px-0 mb-2">
                <h6>이름</h6>
                <input type="text" class="form-control mb-2" id="searchid_name" placeholder="이름" required>
              </div>

              <div class="col-12 mx-0 px-0 mb-2">
                <h6>전화번호</h6>
                  <div class="input-group">
                    <input type="text" class="form-control" id="searchid_phone1" placeholder="전화번호">
                    <button class="dropdown-toggle" type="button" id="phone_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span></button>
                    <ul id="phone1_list" class="dropdown-menu" aria-labelledby="phone_btn" style="">
                      <li class="" onclick="click_phone_id('010')">010</li>
                      <li role="separator" class="divider"></li>
                      <li class="" onclick="click_phone_id('017')">017</li>
                      <li role="separator" class="divider"></li>
                      <li class="" onclick="click_phone_id('016')">016</li>
                      <li role="separator" class="divider"></li>
                      <li class="" onclick="click_phone_id('011')">011</li>
                      <li role="separator" class="divider"></li>
                      <li class="" onclick="click_phone_id('018')">018</li>
                    </ul>
                      </select>
                      <div class="input-group-prepend">
                          <span class="input-group-text">-</span>
                      </div>
                      <input type="text" class="form-control" id="searchid_phone2" placeholder="0000">
                      <div class="input-group-prepend">
                          <span class="input-group-text">-</span>
                      </div>
                      <input type="text" class="form-control" id="searchid_phone3" placeholder="0000">
                  </div>
              </div>
              <p id="result_list" class="mt-3"></p>
              <div class="row px-2">
                  <div class="col-sm-2"></div>
                  <div class="col-6 col-sm-4">
                      <input type="button" class="btn btn-block btn-primary btn-round btn-lg my-3" onclick="search_id()" value="찾기" />
                  </div>
                  <div class="col-6 col-sm-4">
                      <input type="button" class="btn btn-block btn-light border-primary text-primary btn-round btn-lg my-3" onclick="jQuery('#modal_search_id').modal('hide');" value="취소" />
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_search_pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">비밀번호찾기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div id="searchpw_layout1" style="display:block">
                <div class="col-12 mx-0 px-0 mb-2">
                  <h6>이름</h6>
                  <input type="text" class="form-control mb-2" id="searchpw_name" placeholder="이름" required>
                </div>

                <div class="col-12 mx-0 px-0 mb-2">
                  <h6>아이디</h6>
                  <input type="text" class="form-control mb-2" id="searchpw_id" placeholder="아이디" required>
                </div>

                <div class="col-12 mx-0 px-0 mb-2">
                  <h6>전화번호</h6>
                    <div class="input-group">
                      <input type="text" class="form-control" id="searchpw_phone1" placeholder="전화번호">
                      <button class="dropdown-toggle" type="button" id="phone_btn_pw" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span></button>
                      <ul id="phone2_list" class="dropdown-menu" aria-labelledby="phone_btn_pw" style="">
                        <li class="" onclick="click_phone_pw('010')">010</li>
                        <li role="separator" class="divider"></li>
                        <li class="" onclick="click_phone_pw('017')">017</li>
                        <li role="separator" class="divider"></li>
                        <li class="" onclick="click_phone_pw('016')">016</li>
                        <li role="separator" class="divider"></li>
                        <li class="" onclick="click_phone_pw('011')">011</li>
                        <li role="separator" class="divider"></li>
                        <li class="" onclick="click_phone_pw('018')">018</li>
                      </ul>
                        </select>
                        <div class="input-group-prepend">
                            <span class="input-group-text">-</span>
                        </div>
                        <input type="text" class="form-control" id="searchpw_phone2" placeholder="0000">
                        <div class="input-group-prepend">
                            <span class="input-group-text">-</span>
                        </div>
                        <input type="text" class="form-control" id="searchpw_phone3" placeholder="0000">
                    </div>
                </div>
                <div class="row px-2">
                    <div class="col-sm-2"></div>
                    <div class="col-6 col-sm-4">
                        <input type="button" class="btn btn-block btn-primary btn-round btn-lg my-3" onclick="search_pw()" value="찾기" />
                    </div>
                    <div class="col-6 col-sm-4">
                        <input type="button" class="btn btn-block btn-light border-primary text-primary btn-round btn-lg my-3" onclick="jQuery('#modal_search_pw').modal('hide');" value="취소" />
                    </div>
                </div>
              </div>
              <input id="searchpw_idx" type="hidden">
              <input id="searchpw_check" type="hidden">
              <div id="searchpw_layout2" style="display:none;">
                <div class="col-12 mx-0 px-0 mb-2">
                  <h6>새 비밀번호</h6>
                  <input type="text" class="form-control mb-2" id="new_pw1" placeholder="새 비밀번호" required>
                </div>

                <div class="col-12 mx-0 px-0 mb-2">
                  <h6>새 비밀번호 확인</h6>
                  <input type="text" class="form-control mb-2" id="new_pw2" placeholder="새 비밀번호 확인" required>
                </div>

                <div class="row px-2">
                    <div class="col-sm-2"></div>
                    <div class="col-6 col-sm-4">
                        <input type="button" class="btn btn-block btn-primary btn-round btn-lg my-3" onclick="change_pw()" value="변경" />
                    </div>
                    <div class="col-6 col-sm-4">
                        <input type="button" class="btn btn-block btn-light border-primary text-primary btn-round btn-lg my-3" onclick="jQuery('#modal_search_pw').modal('hide');" value="취소" />
                    </div>
                </div>
              </div>

            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
  $("#naver_log").click(function(){
    if($('.naver_row').css('display')=='none'){
      $('.naver_row').css('display','block');
    }else{
      $('.naver_row').css('display','none');
    }
  });
  function click_phone_id(콜) {
    $("#searchid_phone1").val(콜);
  }

  function click_phone_pw(콜) {
    $("#searchpw_phone1").val(콜);
  }

  function search_id(){
    var m_name = $("#searchid_name").val();
    var phone1 = $("#searchid_phone1").val();
    var phone2 = $("#searchid_phone2").val();
    var phone3 = $("#searchid_phone3").val();

    var m_phone1 = phone1 + "-" + phone2 + "-" + phone3;
    var m_phone2 = phone1 + phone2 + phone3;

    if(m_name == ""){
      $('#searchid_name').focus();
      return toastr.error("이름을 입력해주세요.");
    }

    if(phone1 == ""){
      $('#searchid_phone1').focus();
      return toastr.error("전화번호를 입력해주세요.");
    }

    if(phone2 == ""){
      $('#searchid_phone2').focus();
      return toastr.error("전화번호를 입력해주세요.");
    }

    if(phone3 == ""){
      $('#searchid_phone3').focus();
      return toastr.error("전화번호를 입력해주세요.");
    }

    var params = {};
    params["m_name"] = m_name;
    params["m_phone1"] = m_phone1;
    params["m_phone2"] = m_phone2;

    exec_json("member.search_id",params,function(ret_obj){
        $("#result_list").html(ret_obj.message);
        //location.reload();
    });
  }

  function search_pw(){
    var m_name = $("#searchpw_name").val();
    var m_id = $("#searchpw_id").val();
    var phone1 = $("#searchpw_phone1").val();
    var phone2 = $("#searchpw_phone2").val();
    var phone3 = $("#searchpw_phone3").val();

    var m_phone1 = phone1 + "-" + phone2 + "-" + phone3;
    var m_phone2 = phone1 + phone2 + phone3;

    if(m_name == ""){
      $('#searchpw_name').focus();
      return toastr.error("이름을 입력해주세요.");
    }

    if(m_id == ""){
      $('#searchpw_id').focus();
      return toastr.error("아이디를 입력해주세요.");
    }

    if(phone1 == ""){
      $('#searchpw_phone1').focus();
      return toastr.error("전화번호를 입력해주세요.");
    }

    if(phone2 == ""){
      $('#searchpw_phone2').focus();
      return toastr.error("전화번호를 입력해주세요.");
    }

    if(phone3 == ""){
      $('#searchpw_phone3').focus();
      return toastr.error("전화번호를 입력해주세요.");
    }

    var params = {};
    params["m_name"] = m_name;
    params["m_id"] = m_id;
    params["m_phone1"] = m_phone1;
    params["m_phone2"] = m_phone2;

    exec_json("member.search_pw",params,function(ret_obj){
      $("#searchpw_layout1").css("display","none");
      $("#searchpw_layout2").css("display","block");
      $("#searchpw_idx").val(ret_obj.message);
      $("#searchpw_check").val('1');
    });
  }

  function change_pw(){

    var new_pw1= $("#new_pw1").val();
    var new_pw2 = $("#new_pw2").val();
    var m_idx= $("#searchpw_idx").val();

    if(new_pw1 == ""){
      $('#new_pw1').focus();
      return toastr.error("비밀번호를 입력해주세요.");
    }
    if(new_pw2 == ""){
      $('#new_pw2').focus();
      return toastr.error("비밀번호를 확인해주세요.");
    }
    if(new_pw1 && new_pw1 != new_pw2){
      $('#new_pw2').focus();
      return toastr.error("비밀번호를 확인해주세요.");
    }
    if(new_pw1.length < 6){
      $('#new_pw1').focus();
      return toastr.error("비밀번호는 6자리 이상으로 지정해주세요.");
    }

    var params = {};

    params["m_pw"] = new_pw1;
    params["m_idx"] = m_idx;

    exec_json("member.change_pw",params,function(ret_obj){
      // $("#searchpw_name").val("");
      // $("#searchpw_id").val("");
      // $("#searchpw_phone1").val("");
      // $("#searchpw_phone2").val("");
      // $("#searchpw_phone3").val("");
      //
      // $("#searchpw_m_idx").val("");
      // $("#searchpw_check").val("");
      // $("#searchpw_layout1").css("display", "block");
      // $("#searchpw_layout2").css("display", "none");
      $("#modal_search_pw").modal("hide");
      toastr.success(ret_obj.message);
      location.reload();
    });
  }


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
		var url = "https://nid.naver.com/oauth2.0/authorize?client_id=cXstjgkmgg8Oiz8d7zHx&response_type=code&redirect_uri=http://127.0.0.1:8080/login_naver.php?type=2&state=" + state;

		try {
			location.replace(url);
		}
		catch(exception){
			location.href = url;
		}

	});

</script>
