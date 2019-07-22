<div class="container">
    <div class="content_padding px-0">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">내 정보 설정</h5>
    </div>
    <form class="tf_underline_form">
        <div class="form-group">
            <label for=""><i class="xi-building"></i> 기업명</label>
            <input type="text" class="form-control" id="" placeholder="기술자숲" readonly="readonly">
        </div>
        <div class="form-group">
            <label for=""><i class="xi-call"></i> 휴대폰번호</label>
            <input type="text" class="form-control" id="" placeholder="휴대전화번호를 입력하세요." value="<?=$logged_info['m_phone']?>" readonly="readonly">
            <a href="#" onclick="jQuery(this).prev().removeAttr('readonly');" class="bg-red btn btn-xs btn-round">변경</a>
        </div>
        <div class="form-group">
            <label for=""><i class="xi-mail"></i> 이메일</label>
            <input type="email" class="form-control" id="" placeholder="이메일 주소를 입력하세요" value="<?=$logged_info['m_email']?>" readonly="readonly">
            <a href="#" onclick="jQuery(this).prev().removeAttr('readonly');" class="bg-red btn btn-xs btn-round">변경</a>
        </div>
        <div class="form-group">
            <label for=""><i class="xi-user"></i> 채용담당자</label>
            <input type="text" class="form-control" id="" placeholder="담당자명을 입력합니다." value="" readonly="readonly">
            <a href="#" onclick="jQuery(this).prev().removeAttr('readonly');" class="bg-red btn btn-xs btn-round">변경</a>
        </div>
    </form>
</div>