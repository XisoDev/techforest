<section class="bg-white">
    <div class="content_padding mt-4 pt-5">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">문의하기</h5>
    </div>
    <ul class="nav nav-tabs nav-justified mt-0 pt-0 mb-5 mx-0 px-0" role="tablist">
        <li class="nav-item active py-3 position-relative">
            <a class="nav-link weight_bold" href="<?=getUrl('contact')?>">
                문의하기
            </a>
        </li>
        <li class="nav-item py-3 position-relative">
            <span class="badge badge-danger xxs_content btn-round position-absolute" style="top:5px; right:10px;">NEW</span>
            <a class="nav-link weight_bold py-2" href="<?=getUrl('contact','replies')?>">
                내 문의 답변
            </a>
        </li>
    </ul>
    <div class="content_padding mt-0 pt-0">
        <div class="col-5 mx-auto">
            <div class="avatar square" style="background-image:url('/oPage/contact/images/contact_icon.png'); background-size:60%;"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 mx-0 px-0 pl-1 mb-2">
                    <label style="font-size:13px;">이름</label>
                    <input type="text" class="form-control" id="job_manager" placeholder="담당자명을 입력합니다." value="<?=$logged_info['select7']?>">
                </div>
                <div class="col-12 mx-0 px-0 pl-1 mb-2">
                    <label style="font-size:13px;">휴대폰번호</label>
                    <div class="input-group">
                        <select class="form-control" id="c_phone1">
                            <?
                            $phonenumber = explode("-", $logged_info['m_phone']);
                            $phone_arr = array("선택", "02", "031", "032", "033", "041", "042", "043", "044", "051", "052", "053", "054", "055", "061", "062", "063", "064", "010", "070");

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
                        <input type="text" class="form-control" id="c_phone2" value="<?=$phonenumber[1]?>" maxlength="4" placeholder="0000" onkeyup="onlyNumber(this)">
                        <div class="input-group-prepend">
                            <span class="input-group-text">-</span>
                        </div>
                        <input type="text" class="form-control" id="c_phone3" value="<?=$phonenumber[2]?>" maxlength="4" placeholder="0000" onkeyup="onlyNumber(this)">
                    </div>
                </div>

                <div class="col-12 mx-0 px-0 pl-1 mb-2">
                    <label style="font-size:13px;">내용입력</label>
                    <textarea rows="3" placeholder="내용을 입력해 주세요." class="form-control"></textarea>
                </div>
                <button type="button" class="btn btn-primary btn-block btn-round">문의하기</button>
                <a class="btn btn-light border-primary btn-block btn-round" href="tel:+821057595999"><i class="xi-call"></i> 전화로 문의하기</a>
            </div>
        </div>
    </div>
</section>
<?php
$footer_false = true;

?>
