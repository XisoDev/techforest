

<div class="container">
    <div class="content_padding px-0">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>

        <a href="/proc.php?act=member.procLogout" class="pull-right btn btn-primary btn-round btn-xs">로그아웃</a>
    </div>

      <div class="row">
          <div class="col-5 mx-auto px-auto">
              <div class="position-relative">
                  <div class="">
                    <?if(!$logged_info['m_picture']){?>
                        <img src="/layout/none/assets/images/no_avatar.png" alt="basic_picture">
                    <?}else{?>
                      <img src="../../img/<?=$logged_info['m_picture']?>" class="avatar" id="my_picture" alt="picture">
                    <?}?>
                  </div>
                  <label for="picture_upload" class="position-absolute" style="right:0;bottom:0;">
                    <i class="xi-camera position-absolute text-white" style="right:0;bottom:0; font-size:28px;"></i>
                    <i class="xi-camera position-absolute text-secondary" style="right:1px;bottom:1px; font-size:26px;"></i>
                  </label>
                  <input type="file" id="picture_upload" style="display:none;">
              </div>
          </div>
      </div>

    <div class="content_padding text-center weight_lighter">
        <span class="btn-round btn-xs btn-primary"><?=$logged_info['m_id']?></span>
        <h6 class="weight_lighter mt-3"><i class="xi-mail text-secondary"></i> <?=$logged_info['m_email']?></h6>
        <h6 class="weight_lighter"><i class="xi-call text-secondary"></i> <?=$logged_info['m_phone']?></h6>
    </div>
</div>

<ul class="list-group">
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
