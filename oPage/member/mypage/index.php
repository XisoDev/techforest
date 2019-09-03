

<div class="container pt-lg-5">
    <div class="p-3 d-lg-none">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>

        <a href="/proc.php?act=member.procLogout" class="pull-right btn btn-primary btn-round btn-xs">로그아웃</a>
    </div>

    <div class="pt-lg-5 pt-lg-3 position-relative mx-auto col-sm-10 col-md-9 col-lg-8">
        <h4 class="d-none d-lg-block mb-4"><img src="/oPage/images/imgicons/bulb_yellow.png" height="30" class="imgicon" /> 내 정보 관리</h4>
    </div>

    <div class="mx-auto col-sm-10 col-md-9 col-lg-8">
        <div class="rounded border mobile-border-0 pt-4 mb-4 ">
            <div class="py-0 text-right mr-4 d-none d-lg-block">
                <a href="/proc.php?act=member.procLogout" class="btn btn-light border-secondary btn-round btn-xs">로그아웃</a>
            </div>
      <form id="theuploadform">
        <div class="col-5 mx-auto px-auto col-md-4 col-lg-3">
          <?if($logged_info['is_commerce'] == 'Y'){?>
              <?
              if(!$logged_info['image']) {
                  $img_url = "/layout/none/assets/images/no_company.png";
              }else {
                  $img_url = "../../m_picture/" . $logged_info['image'];
              }
              ?>
            <div class="position-relative">
                <div class="avatar square" id="my_picture" style="background-image:url('<?=$img_url?>');"></div>
            </div>
          <?}else{?>
            <?if($logged_info['is_commerce'] == 'Y'){?>
              <?
              if(!$logged_info['m_picture']) {
                  $img_url = "/layout/none/assets/images/no_avatar.png";
              }else {
                  $img_url = "../../m_picture/" . $logged_info['m_picture'];
              }
              ?>
              <div class="position-relative">
                  <div class="avatar square" id="my_picture" style="background-image:url('<?=$img_url?>');"></div>
                  <label for="userfile" class="position-absolute mb-0 pb-0" style="right:0;bottom:0;">
                    <img src="/oPage/images/imgicons/camera_gray.png" height="16" />
                  </label>
                  <input type="file" id="userfile" name="userfile" style="display:none;">
              </div>
          <?}?>
        <?}?>
        </div>
      </form>

        <div class="content_padding text-center weight_lighter">
            <span class="btn-round btn-xs btn-primary"><?=$logged_info['m_id']?></span>
            <h6 class="weight_lighter mt-3 mb-2"><i class="xi-mail text-secondary"></i> <?=$logged_info['m_email']?></h6>
            <h6 class="weight_lighter"><i class="xi-call text-secondary"></i> <?=$logged_info['m_phone']?></h6>
        </div>
        </div>
    </div>


    <div class="pt-lg-5 pt-lg-3 position-relative mx-auto col-sm-10 col-md-9 col-lg-8">
        <h4 class="d-none d-lg-block mb-4"><img src="/oPage/images/imgicons/bulb_yellow.png" height="30" class="imgicon" /> 설정</h4>
    </div>
    <div class="mb-4 mx-auto col-sm-10 col-md-9 col-lg-8">
        <div class="row d-none d-lg-flex">
            <div class="text-center col-md-4" onclick="document.location.href='<?=getUrl('member','myprofile')?>';">
                <div class="py-5 border rounded">
                    <img src="/oPage/images/imgicons/user.png" height="50" />
                <h6 class="pt-2">내 정보 설정</h6>
                </div>
            </div>
            <div class="text-center col-md-4" onclick="document.location.href='<?=getUrl('member','updateIdpw')?>';">
                <div class="py-5 border rounded">
                    <img src="/oPage/images/imgicons/cog.png" height="50" />
                <h6 class="pt-2">아이디・비밀번호 관리</h6>
                </div>
            </div>
            <div class="text-center col-md-4" onclick="document.location.href='<?=getUrl('member','settingAlert')?>';">
                <div class="py-5 border rounded">
                    <img src="/oPage/images/imgicons/bell_on.png" height="50" />
                    <h6 class="pt-2">알림 설정</h6>
                </div>
            </div>
        </div>
        <ul class="list-group d-lg-none">
            <li onclick="document.location.href='<?=getUrl('member','myprofile')?>';"
                class="list-group-item d-flex mt-2 justify-content-between align-items-center border-0">
                <span><img src="/oPage/images/imgicons/user.png" height="16" />  내 정보 설정</span>
                <span class="badge"><i class="xi-angle-right"></i></span>
            </li>
            <li onclick="document.location.href='<?=getUrl('member','updateIdpw')?>';"
                class="list-group-item d-flex mt-2 justify-content-between align-items-center border-0">
                <span><img src="/oPage/images/imgicons/cog.png" height="16" />  아이디・비밀번호 관리</span>
                <span class="badge"><i class="xi-angle-right"></i></span>
            </li>
            <li onclick="document.location.href='<?=getUrl('member','settingAlert')?>';"
                class="list-group-item d-flex mt-2 justify-content-between align-items-center border-0">
                <span><img src="/oPage/images/imgicons/bell_on.png" height="16" />  알림 설정</span>
                <span class="badge"><i class="xi-angle-right"></i></span>
            </li>
        </ul>
    </div>
</div>

<script type="text/javascript">

  $("#userfile").change(function(){
    readURL(this);

    var iframe = $('<iframe name="postiframe" id="postiframe" width=0 height=0 style="display:none"></iframe>');

    $('body').append(iframe);

    var form = $('#theuploadform');
    form.attr("action", "/proc.php?act=member.procFileUpload");
    form.attr("method", "post");

    form.attr("encoding", "multipart/form-data");
    form.attr("enctype", "multipart/form-data");

    form.attr("target", "postiframe");
    form.attr("file", $('#userfile').val());
    form.submit();

    $("#postiframe").on('load',function () {
        // alert("파일이 업로드 되었습니다.");
        // location.reload();
    });

    return false;

  });

  function readURL(input) {
    if(input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#my_picture').css('background-image','url('+e.target.result+')');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }




</script>
