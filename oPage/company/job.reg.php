<?
$company_info = $output->get('company_info');

?>
<section class="bg-white">
    <div class="p-3 mt-4 pt-5 d-lg-none">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">공고등록</h4>
    </div>
    <div class="container pt-lg-5 col-md-8 col-lg-6 mx-auto">
        <div class="px-lg-5">
        <ul class="nav nav-tabs nav-justified mt-0 pt-0 mb-5 mx-0 px-0" role="tablist">
            <li class="nav-item active">
                <a class="nav-link weight_bold" href="<?=getUrl('company','job_register')?>">
                    1단계<br />기업정보 등록
                </a>
            </li>
            <li class="nav-item">
                <?if(!$company_info[0]['c_name'] || !$company_info[0]['registration'] || !$company_info[0]['address'] || !$company_info[0]['address2'] || !$company_info[0]['phonenumber'] || !$company_info[0]['select6']){?>
                  <a class="nav-link weight_bold" onclick="back()" >
                      2단계<br />공고등록
                  </a>
                <?}else{?>
                  <a class="nav-link weight_bold" href="<?=getUrl('company','job_appRegister')?>" >
                      2단계<br />공고등록
                  </a>
                <?}?>
            </li>
        </ul>
        </div>
    <div class="px-2 mt-0 pt-0 pb-5">
        <div class="row">

            <div class="col-5 mx-auto px-auto col-md-4 col-lg-3 pb-sm-3 pb-md-5">
              <form id="theuploadform">
                <div class="position-relative">
                  <?
                  if(!$company_info[0]['image']) {
                      $img_url = "/layout/none/assets/images/no_company.png";
                  }else {
                      $img_url = "../../company_logo/" . $company_info[0]['image'];
                  }
                  ?>
                    <div class="avatar square" id="company_logo" style="background-image:url('<?=$img_url?>');"></div>
                    <label for="userfile" class="position-absolute mb-0 pb-0" style="right:0;bottom:0;">
                      <i class="xi-camera position-absolute text-white" style="right:0;bottom:0; font-size:28px;"></i>
                      <i class="xi-camera position-absolute text-secondary" style="right:1px;bottom:1px; font-size:26px;"></i>
                    </label>
                    <input type="file" id="userfile" name="userfile" style="display:none;">
                </div>
              </form>
            </div>

        </div>

            <!--성공하면 자동으로 2단계로 보낼수있음.-->
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>회사명</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <input type="text" class="form-control" id="c_name" value="<?=$company_info[0]['c_name']?>" placeholder="회사명" required>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>담당자 연락처</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">

                        <div class="input-group">
                            <select class="form-control" id="c_phone1" required>
                              <?
                                $phonenumber = explode("-", $company_info[0]['phonenumber']);
                                $phone_arr = array("010","011","017");

                                for($i = 0; $i < count($phone_arr); $i++) {
                                  if($phone_arr[$i] == $phonenumber[0]) {
                                    echo "<option value=\"" . $phone_arr[$i] . "\" selected=\"selected\">" . $phone_arr[$i] . "</option>";
                                  } else {
                                    echo "<option value=\"" . $phone_arr[$i] . "\">" . $phone_arr[$i] . "</option>";
                                  }
                                }
                              ?>
                            </select>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" id="c_phone2" value="<?=$phonenumber[1]?>" placeholder="0000" maxlength="4" onkeyup="onlyNumber(this)" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" id="c_phone3" value="<?=$phonenumber[2]?>" placeholder="0000" maxlength="4" onkeyup="onlyNumber(this)" required>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                      <h6>담당자 이메일</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <div class="input-group">
                            <? $email = explode("@", $company_info[0]['select6']); ?>
                            <input type="text" class="form-control" id="c_email1" value="<?=$email[0]?>" placeholder="이메일 주소 입력" required>

                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                @
                            </span>
                            </div>
                            <input type="text" class="form-control" id="c_email2" value="<?=$email[1]?>" placeholder="직접입력" style="">
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

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>사업자등록번호</h6>
                    </div>
                    <?php
                    $registration = explode("-", $company_info[0]["registration"]);

                    ?>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="registration1" value="<?=$registration[0]?>" placeholder="000" maxlength="3" onkeyup="onlyNumber(this)" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" id="registration2" value="<?=$registration[1]?>" placeholder="00" maxlength="2" onkeyup="onlyNumber(this)" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" id="registration3" value="<?=$registration[2]?>" placeholder="00000" maxlength="5" onkeyup="onlyNumber(this)" required>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>주소</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="address"  value="<?=$company_info[0]['address']?>" placeholder="주소검색" readonly>
                            <button type="button" class="btn btn-primary rounded-0 rounded-right" onclick="search_address()">검색</button>
                        </div>
                        <input type="text" class="form-control" id="address2" value="<?=$company_info[0]['address2']?>" placeholder="상세주소">
                    </div>
                    <div id="wrap" style="display:none;border:1px solid;width:100%;height:50%;margin:5px 0;position:relative">
                        <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>회사 간단소개</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <textarea class="form-control" id="c_introduction"><?=$company_info[0]['c_introduction']?></textarea>
                    </div>
                    <div class="d-none d-md-block col-md-2"></div>
                    <div class="col-12 text-center py-4">
                        <!-- 차후 기능추가 -->
                        <!-- <button type="button" onclick="temporary_save()" class="btn border-primary py-2 px-4 px-md-5 mr-1 btn-round">임시저장</button> -->
                        <button type="button" onclick="company_info_ok()" class="btn btn-primary py-2 px-4 px-md-5 ml-1 btn-round">등록완료</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</section>



<?php
$footer_false = true;
?>

<script type="text/javascript">

  $("#userfile").change(function(){
    readURL(this);

    var iframe = $('<iframe name="postiframe" id="postiframe" width=0 height=0 style="display:none"></iframe>');

    $('body').append(iframe);

    var form = $('#theuploadform');
    form.attr("action", "/proc.php?act=company.procFileUpload");
    form.attr("method", "post");

    form.attr("encoding", "multipart/form-data");
    form.attr("enctype", "multipart/form-data");

    form.attr("target", "postiframe");
    form.attr("file", $('#userfile').val());
    form.submit();

    $("#postiframe").on('load',function () {
        //alert("파일이 업로드 되었습니다.");
        // location.reload();
    });

    function readURL(input) {
      if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#company_logo').css('background-image','url('+e.target.result+')');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }


    return false;

  });

  function temporary_save(){

  }

  function company_info_ok(){
    var c_name = $('#c_name').val();
    var registration = $('#registration1').val() + "-" +  $('#registration2').val() + "-" +  $('#registration3').val();
    var address = $('#address').val();
    var address2 = $('#address2').val();
    var phonenumber = $('#c_phone1').val() + "-" + $('#c_phone2').val() + "-" + $('#c_phone3').val();
    var select6 = $('#c_email1').val() + "@" + $('#c_email2').val();
    var c_introduction = $('#c_introduction').val();

    if(c_name == ""){
      $('#c_name').focus();
      return toastr.error("회사명을 입력해주세요.");
    }

    if($('#registration1').val() == ""){
      $('#registration1').focus();
      return toastr.error("사업자등록번호를 입력해주세요.");
    }

    if($('#registration2').val() == ""){
      $('#registration2').focus();
      return toastr.error("사업자등록번호를 입력해주세요.");
    }

    if($('#registration3').val() == ""){
      $('#registration3').focus();
      return toastr.error("사업자등록번호를 입력해주세요.");
    }

    if(address == ""){
      $('#address').focus();
      return toastr.error("주소를 입력해주세요.");
    }

    if(address2 == ""){
      $('#address2').focus();
      return toastr.error("상세주소를 입력해주세요.");
    }

    if($('#c_phone2').val() == ""){
      $('#c_phone2').focus();
      return toastr.error("담당자연락처를 입력해주세요.");
    }

    if($('#c_phone3').val() == ""){
      $('#c_phone3').focus();
      return toastr.error("담당자연락처를 입력해주세요.");
    }

    if($('#c_email1').val() == ""){
      $('#c_email1').focus();
      return toastr.error("담당자이메일을 입력해주세요.");
    }

    if($('#c_email2').val() == ""){
      $('#c_email2').focus();
      return toastr.error("담당자이메일을 입력해주세요.");
    }

    var params = {};
    params["c_name"] = c_name;
    params["registration"] = registration;
    params["address"] = address;
    params["address2"] = address2;
    params["phonenumber"] = phonenumber;
    params["select6"] = select6;
    params["c_introduction"] = c_introduction;
    exec_json("company.company_info",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        toastr.success(ret_obj.message);
        document.location.href="<?=getUrl('company','job_appRegister')?>";
    });

  }

   function click_email(email) {
     $("#c_email2").val(email);
   }

   function back(){
     toastr.error("기업정보등록 후 이용하실 수 있습니다.");
   }
</script>
