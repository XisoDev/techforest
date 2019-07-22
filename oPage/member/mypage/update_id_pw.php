<div class="container">
    <div class="content_padding px-0">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">아이디・비밀번호 관리</h5>
    </div>
    <form class="tf_underline_form">
        <div class="form-group">
            <label for=""><i class="xi-key"></i> 아이디</label>
            <input type="text" class="form-control" id="" placeholder="아이디를 입력합니다." value="<?=$logged_info['m_id']?>" readonly="readonly">
            <a href="#" onclick="jQuery(this).prev().removeAttr('readonly');" class="bg-red btn btn-xs btn-round">전환</a>
        </div>
        <div class="form-group">
            <label for=""><i class="xi-lock"></i> 비밀번호</label>
            <input type="password" class="form-control" id="" placeholder="∙∙∙∙∙∙∙∙" value="" readonly="readonly">
            <a href="#" onclick="jQuery(this).prev().removeAttr('readonly');" class="bg-red btn btn-xs btn-round">변경</a>
        </div>
    </form>
</div>