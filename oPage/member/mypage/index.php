

<div class="container pt-lg-5">
    <div class="content_padding px-0 d-lg-none">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>

        <a href="/proc.php?act=member.procLogout" class="pull-right btn btn-primary btn-round btn-xs">로그아웃</a>
    </div>

    <div class="pt-lg-5 pt-lg-3 position-relative mx-auto col-sm-10 col-md-9 col-lg-8">
        <h4 class="d-none d-lg-block mb-4"><i class="xi-lightbulb-o text-warning"></i> 내 정보 관리</h4>
    </div>

    <div class="mx-auto col-sm-10 col-md-9 col-lg-8">
        <div class="rounded border pt-4 mb-4 ">
            <div class="py-0 text-right mr-4 d-none d-lg-block">
                <a href="/proc.php?act=member.procLogout" class="btn btn-light border-secondary btn-round btn-xs">로그아웃</a>
            </div>
        <div class="col-5 mx-auto px-auto col-md-4 col-lg-3">
          <div class="position-relative">
              <?
              if(!$logged_info['m_picture']) {
                  $img_url = "/layout/none/assets/images/no_avatar.png";
              }else {
                  $img_url = "../../img/" . $logged_info['m_picture'];
              }
              ?>
              <div class="avatar square" style="background-image:url('<?=$img_url?>');">
              </div>
              <label for="picture_upload" class="position-absolute" style="right:0;bottom:0;">
                <i class="xi-camera position-absolute text-white" style="right:0;bottom:0; font-size:28px;"></i>
                <i class="xi-camera position-absolute text-secondary" style="right:1px;bottom:1px; font-size:26px;"></i>
              </label>
              <input type="file" id="picture_upload" style="display:none;">
          </div>
        </div>

        <div class="content_padding text-center weight_lighter">
            <span class="btn-round btn-xs btn-primary"><?=$logged_info['m_id']?></span>
            <h6 class="weight_lighter mt-3"><i class="xi-mail text-secondary"></i> <?=$logged_info['m_email']?></h6>
            <h6 class="weight_lighter"><i class="xi-call text-secondary"></i> <?=$logged_info['m_phone']?></h6>
        </div>
        </div>
    </div>


    <div class="pt-lg-5 pt-lg-3 position-relative mx-auto col-sm-10 col-md-9 col-lg-8">
        <h4 class="d-none d-lg-block mb-4"><i class="xi-lightbulb-o text-warning"></i> 설정</h4>
    </div>
    <div class="mb-4 mx-auto col-sm-10 col-md-9 col-lg-8">
        <div class="row d-none d-lg-flex">
            <div class="text-center col-md-4" onclick="document.location.href='<?=getUrl('member','myprofile')?>';">
                <div class="py-5 border rounded">
                <i class="xi-user-o xi-3x"></i>
                <h6 class="pt-2">내 정보 설정</h6>
                </div>
            </div>
            <div class="text-center col-md-4" onclick="document.location.href='<?=getUrl('member','updateIdpw')?>';">
                <div class="py-5 border rounded">
                <i class="xi-cog xi-3x"></i>
                <h6 class="pt-2">아이디・비밀번호 관리</h6>
                </div>
            </div>
            <div class="text-center col-md-4" onclick="document.location.href='<?=getUrl('member','settingAlert')?>';">
                <div class="py-5 border rounded">
                <i class="xi-bell-o xi-3x"></i>
                <h6 class="pt-2">알림 설정</h6>
                </div>
            </div>
        </div>
        <ul class="list-group d-lg-none">
            <li onclick="document.location.href='<?=getUrl('member','myprofile')?>';"
                class="list-group-item d-flex justify-content-between align-items-center border-0">
                <span><i class="xi-user-o"></i> 내 정보 설정</span>
                <span class="badge"><i class="xi-angle-right"></i></span>
            </li>
            <li onclick="document.location.href='<?=getUrl('member','updateIdpw')?>';"
                class="list-group-item d-flex justify-content-between align-items-center border-0">
                <span><i class="xi-cog"></i> 아이디・비밀번호 관리</span>
                <span class="badge"><i class="xi-angle-right"></i></span>
            </li>
            <li onclick="document.location.href='<?=getUrl('member','settingAlert')?>';"
                class="list-group-item d-flex justify-content-between align-items-center border-0">
                <span><i class="xi-bell-o"></i> 알림 설정</span>
                <span class="badge"><i class="xi-angle-right"></i></span>
            </li>
        </ul>
    </div>
</div>

<script type="text/javascript">

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#my_picture').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#picture_upload").change(function(){
      readURL(this);
    });

</script>
