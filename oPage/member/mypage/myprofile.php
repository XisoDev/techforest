<style media="screen">
  .border_none{
    border : none;
    outline: none;
    width : 40px;
    text-align: center;
  }
</style>

<div class="container">
    <div class="content_padding px-0">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">내 정보 설정</h5>
    </div>
    <?if($logged_info['is_commerce'] == 'Y'){?>
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
    <?}else{?>
      <form class="tf_underline_form">
          <div class="form-group">
              <label for=""><i class="xi-building"></i> 이름</label>
              <input type="text" class="form-control" id="" value="<?=$logged_info['m_name']?>" readonly="readonly">
          </div>
          <div class="form-group">
              <label for=""><i class="xi-call"></i> 휴대폰번호</label>
                <select id="change_phone" style="display:none;">
                  <?
                    $phonenumber = explode("-", $logged_info['m_phone']);
                    $phone_arr = array("전화번호 선택", "02", "031", "032", "033", "041", "042", "043", "044", "051", "052", "053", "054", "055", "061", "062", "063", "064", "010", "070");

                    for($i = 0; $i < count($phone_arr); $i++) {
                      if($phone_arr[$i] == $logged_info[0]) {
                        echo "<option value=\"" . $phone_arr[$i] . "\" selected=\"selected\">" . $phone_arr[$i] . "</option>";
                      } else {
                        echo "<option value=\"" . $phone_arr[$i] . "\">" . $phone_arr[$i] . "</option>";
                      }
                    }
                  ?>
                </select>
                <div class="form-control" style="border:none;">
                  <input type="text" class="border_none" id="m_phonenumber1" maxlength="3" value="<?=$phonenumber[0]?>"  readonly="readonly">-
                  <input type="text" class="border_none" id="m_phonenumber2" maxlength="4" value="<?=$phonenumber[1]?>"  readonly="readonly">-
                  <input type="text" class="border_none" id="m_phonenumber3" maxlength="4" value="<?=$phonenumber[2]?>"  readonly="readonly">
                </div>
              <button type="button" id="change_phone_btn" onclick="" class="bg-red btn btn-xs btn-round">변경</button>
              <button type="button" id="change_phone_btn_ok" onclick="" class="bg-red btn btn-xs btn-round" style="display:none;">수정완료</button>
          </div>
          <div class="form-group">
              <label for=""><i class="xi-mail"></i> 이메일</label>
              <input type="email" class="form-control" id="" placeholder="이메일 주소를 입력하세요" value="<?=$logged_info['m_email']?>" readonly="readonly">
              <a href="#" onclick="jQuery(this).prev().removeAttr('readonly');" class="bg-red btn btn-xs btn-round">변경</a>
          </div>
      </form>
    <?}?>
</div>
