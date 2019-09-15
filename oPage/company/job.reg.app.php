<?php
date_default_timezone_set('Asia/Seoul');
$now_date = date(YmdHis);

$c_idx = $_SESSION['c_idx'];
$m_idx = $_SESSION['LOGGED_INFO'];
$h_idx = $document_srl;

if(!$h_idx || $h_idx < 1) {
  $h_idx = 0;
}

if($h_idx > 0){
  //공고정보
  $oDB->where("h_idx",$h_idx);
  $edit_row = $oDB->get("TF_hire_tb");
}

//자격증불러오기
$oDB->where("h_idx",$h_idx);
$edit_certificate = $oDB->get("TF_hire_certificate");

//이전공고 불러오기
$oDB->where("c_idx",$c_idx);
$oDB->where("job_end_date",$now_date,"<");
$hire_call_row = $oDB->get("TF_hire_tb");

//직종리스트
$oDB->orderBy("o_idx","ASC");
$oDB->where("o_idx","1","!=");
$oDB->where("o_is_show","Y");
$occupation_row = $oDB->get("TF_occupation",null,"o_idx,o_name,o_is_show");

//직무리스트
$oDB->orderBy("duty_name","ASC");
$oDB->orderBy("o_idx","ASC");
$duty_row = $oDB->get("TF_duty");

// 자격증리스트
$oDB->orderBy("seq","ASC");
$certificate_row = $oDB->get("TF_certificate",null,"certificate_name");
$certificate_list = array();
foreach($certificate_row as $val){
  array_push($certificate_list, $val['certificate_name']);
}

//근무리스트
$oDB->orderBy("w_idx","ASC");
$oDB->where("w_is_show","Y");
$w_list = $oDB->get("TF_work",null,"w_idx, w_name, w_is_show");

//지역리스트
//근무지역 local
$oDB->orderBy("visible_idx","ASC");
$oDB->where("local_visible","Y");
$local_arr = $oDB->get("TF_local_tb",null,"local_idx, local_name");

//근무지역 city
$oDB->orderBy("city_idx","ASC");
$oDB->orderBy("local_idx","ASC");
$oDB->where("city_visible","Y");
$city_arr = $oDB->get("TF_city_tb",null,"city_idx, city_name, local_idx");

//근무지역 distinct
$oDB->orderBy("district_idx","ASC");
$oDB->orderBy("local_idx","ASC");
$oDB->where("district_visible","Y");
$district_arr = $oDB->get("TF_district_tb",null," district_idx, district_name, local_idx");

//급여리스트
$oDB->orderBy("salary_idx","ASC");
$oDB->where("salary_is_show","Y");
$salary_list = $oDB->get("TF_salary",null,"salary_idx, salary_name, salary_is_show");

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section class="bg-white">
    <div class="p-3 mt-4 pt-5 d-lg-none">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">공고등록</h4>
    </div>
    <div class="container pt-lg-5 col-md-8 col-lg-6 mx-auto">
        <div class="px-lg-5">
    <ul class="nav nav-tabs nav-justified mt-0 pt-0 mb-5 mx-0 px-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link weight_bold" href="<?=getUrl('company','job_register')?>">
                1단계<br />기업정보 등록
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link weight_bold" href="<?=getUrl('company','job_appRegister')?>" >
                2단계<br />공고등록
            </a>
        </li>
    </ul>
        </div>
        <div class="p-2 mt-0 pt-0 mb-5">
            <div class="container">
                <div class="row">
                  <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                  <!--이전 채용공고 불러오기-->
                  </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                        <select class="form-control" id="hire_call_select" onchange="hire_call()">
                          <?if(count($hire_call_row) < 1){?>
                            <option>마감된 공고가 없습니다.</option>
                              <?}else{?>
                                <option>이전 채용공고 불러오기</option>
                                <?php foreach($hire_call_row as $val){ ?>
                                  <option value="<?=$val['h_idx']?>">[마감] <?=$val['h_title']?></option>
                                <?php } ?>
                              <?}?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mx-0 px-0">
                        <h6 class="mt-sm-1">공고제목</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                        <input type="text" class="form-control" id="h_title" value="<?=$edit_row[0]['h_title']?>" placeholder="공고제목을 입력해주세요." required>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mx-0 px-0">
<!--                        단기일자리 체크-->
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="short_term_check">
                            <label class="custom-control-label xs_content" for="short_term_check">단기일자리 (3개월이내)</label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>직종</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <select class="form-control" id="o_idx" onchange="occupation(this)">
                          <?php
                            foreach($occupation_row as $val){
                              if($val["o_idx"] == $edit_row[0]["o_idx"]){
                                echo "<option value=\"" . $val["o_idx"] . "\" selected=\"selected\">" . $val["o_name"] . "</option>";
                              }else{
                                echo "<option value=\"" . $val["o_idx"] . "\">" . $val["o_name"] . "</option>";
                              }
                            } ?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>직무</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <select class="form-control" id="select_duty"></select>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>직무 상세내용</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <textarea class="form-control" id="job_description"><?=$edit_row[0]['job_description']?></textarea>
                    </div>

                    <div class="d-none d-sm-block col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>필요자격증</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <div class="d-sm-none">
                            <h6 class="pull-left pt-1">필요자격증</h6>
                            <button class="btn btn-primary btn-xs ml-2" onclick="add_item()">추가하기</button>
                        </div>
                        <button class="d-none d-sm-inline-block btn btn-primary ml-2" onclick="add_item()">추가하기</button>
                        <div id="field" class="mt-2">
                          <?php
                            foreach ($edit_certificate as $val) { ?>
                              <div style="margin:1px; display:flex">
                                <input type="text" name="h_certificate" maxlength="25" value="<?=$val['certificate_name']?>" style="width:90%; height:35px" />
                                <div style="flex:1; position:relative"><img src="../../../img/close.png" alt="삭제" style="max-width:15px; position:absolute; margin:auto; top:0; bottom:0; left:0; right:0" onclick="remove_item(this)" /></div>
                              </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>급여</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <div class="input-group">
                            <select class="form-control" id="job_salary" onchange="salary_select_change(this)">
                              <?php
                                foreach($salary_list as $val) {
                                  if($val["salary_idx"] == $edit_row[0]["salary_idx"]) {
                                    echo "<option value=\"" . $val["salary_idx"] . "\" selected=\"selected\">" . $val["salary_name"] . "</option>";
                                  } else {
                                    echo "<option value=\"" . $val["salary_idx"] . "\">" . $val["salary_name"] . "</option>";
                                  }
                                }
                              ?>
                            </select>

                            <input type="text" class="form-control" id="salary" style="width:50px;" maxlength="10" value="<?=$edit_row[0]["job_salary"]?>" onkeyup="onlyNumber(this)" />

                            <div class="input-group-append">
                                <span class="input-group-text pr-2" id="salary_text">만원 이상</span>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>신입/경력</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <select class="form-control" id="job_is_career">
                          <?php
                            $job_is_career_arr = array("무관", "신입", "경력 최소 1년", "경력 최소 2년", "경력 최소 3년", "경력 최소 5년", "경력 최소 7년", "경력 최소 10년", "경력 최소 15년");

                            for($i = 0; $i < count($job_is_career_arr); $i++) {

                              if($job_is_career_arr[$i] == $edit_row[0]["job_is_career"]) {
                                echo "<option value=\"" . $job_is_career_arr[$i] . "\" selected=\"selected\">" . $job_is_career_arr[$i] . "</option>";
                              } else {
                                echo "<option value=\"" . $job_is_career_arr[$i] . "\">" . $job_is_career_arr[$i] . "</option>";
                              }
                            }
                          ?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>학력</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <select class="form-control" id="job_achievement">
                          <?php
                            $job_achievement_arr = array("무관", "고졸", "초대졸", "대졸", "석사", "박사");

                            for($i = 0; $i < count($job_achievement_arr); $i++) {

                              if($job_achievement_arr[$i] == $edit_row[0]["job_achievement"]) {
                                echo "<option value=\"" . $job_achievement_arr[$i] . "\" selected=\"selected\">" . $job_achievement_arr[$i] . "</option>";
                              } else {
                                echo "<option value=\"" . $job_achievement_arr[$i] . "\">" . $job_achievement_arr[$i] . "</option>";
                              }
                            }
                          ?>
                        </select>
                    </div>


                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>근무형태</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <select class="form-control" id="w_idx">
                          <?php
      											foreach($w_list as $val) {
      												if($val["w_idx"] == $edit_row[0]["w_idx"]) {
      													echo "<option value=\"" . $val["w_idx"] . "\" selected=\"selected\">" . $val["w_name"] . "</option>";
      												} else {
      													echo "<option value=\"" . $val["w_idx"] . "\">" . $val["w_name"] . "</option>";
      												}
      											}
      										?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>근무지역</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <div class="input-group">
                            <select class="form-control" id="local_select" onchange="workPlace(this)">
                              <?php
                                foreach($local_arr as $val){
                                  $selected = ($val['local_idx'] == $edit_row[0]['local_idx']) ? "selected":"";
                              ?>
                                  <option value="<?= $val['local_idx']; ?>" <?= $selected; ?>><?= $val['local_name']; ?></option>
                              <? } ?>
                            </select>
                            <select class="form-control" id="city_select" disabled>
                              <option value=""></option>
                              <?php
                                foreach($city_arr as $val){
                                  if($value['local_idx'] == $edit_row[0]['local_idx']){
                                    $selected = ($val['city_idx']==$edit_row[0]['city_idx']) ? "selected":"";
                              ?>
                                    <option value="<?= $val['city_idx']; ?>" <?= $selected; ?>><? echo $val['city_name'];?></option>
                              <?php
                                  }
                                }
                              ?>
                            </select>
                            <select class="form-control" id="district_select" disabled>
                              <option value=""></option>
                              <?php
                                foreach($district_arr as $val){
                                  if($val['local_idx'] == $edit_row[0]['local_idx']){
                                    $selected = ($val['district_idx'] == $edit_row[0]['district_idx']) ? "selected":"";
                                ?>
                                    <option value="<?= $val['district_idx']; ?>" <?= $selected; ?>><?= $val['district_name']; ?></option>
                                <?php
                                  }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>공고시작</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3 pr-1 position-relative">
                        <input type="text" class="form-control xiso_date" id="job_start_date" value="<?=substr($edit_row[0]["job_start_date"], 0, 10)?>" />
                        <i class="xi-calendar-check right-icon"></i>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>공고종료</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3 pr-1 position-relative">
                        <input type="text" class="form-control xiso_date" id="job_end_date" value="<?=substr($edit_row[0]["job_start_date"], 0, 10)?>"/>
                        <i class="xi-calendar-check right-icon"></i>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                        <h6>기타정보</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
                        <textarea class="form-control"><?=$edit_row[0]['job_manager']?></textarea>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0 d-sm-none">
                        <h6>담당자 정보</h6>
                    </div>

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0 d-none d-sm-block">
                        <h6>담당자이름</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 pl-1 mb-2 mt-sm-3">
                        <label style="font-size:13px;" class="d-sm-none">담당자 이름</label>
                        <input type="text" class="form-control" id="job_manager" placeholder="담당자명을 입력합니다." value="<?=$logged_info['select7']?>">
                    </div>


                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0 d-none d-sm-block">
                        <h6>담당자 연락처</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 pl-1 mb-2 mt-sm-3">
                      <label style="font-size:13px;" class="d-sm-none">담당자 연락처</label>
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

                    <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0 d-none d-sm-block">
                        <h6>담당자 이메일</h6>
                    </div>
                    <div class="col-12 col-sm-9 mx-0 px-0 pl-1 mb-2 mt-sm-3">
                      <label style="font-size:13px;" class="d-sm-none">담당자 이메일</label>
                        <?php $email = explode("@", $logged_info['select6']); ?>
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?=$email[0]?>" placeholder="이메일 주소 입력">

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

                    <div class="d-none d-md-block col-md-4"></div>
                    <!-- <div class="col-6 col-md-4 mt-4 px-0 mx-0 pr-1">
                        <button type="submit" class="btn border-primary btn-block btn-round">임시저장</button>
                    </div> -->
                    <div class="col-12 col-md-4 mt-4 px-0 mx-0 pr-1">
                       <button type="button" class="btn btn-primary btn-block btn-round" onclick="hire_ok()">등록완료</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="job_reg_complete" style="display:none;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <iframe src="<?=getUrl('company','job_appRegisterComplete')?>" id="job_iframe" frameborder="0" scrolling="no" width="100%" style="height:90vh"></iframe>
        </div>
    </div>
</div>

<script type="text/javascript">


jQuery(document).ready(function($){
  //공고등록완료시 뜨는 팝업인데 디자인 확인을 위해 추가
  //jQuery('#job_reg_complete').modal('show');
  $("#o_idx").change();
});

function closs_complete() {
  jQuery('#job_reg_complete').modal('hide');
  location.href = "<?=getUrl('company','job')?>";
}
function closs_complete2() {
  jQuery('#job_reg_complete').modal('hide');
  location.href = "<?=getUrl('member','myprofile')?>";
}


var duty_arr = <? echo json_encode($duty_row); ?>;
var local_arr = <? echo json_encode($local_arr); ?>;
var city_arr = <? echo json_encode($city_arr); ?>;
var district_arr = <? echo json_encode($district_arr); ?>;

function occupation(obj){
  $("#select_duty").empty();

  for(var i = 0; i < duty_arr.length; i++){
    if(obj.value == duty_arr[i]["o_idx"]){
      var option = $('<option value="' +duty_arr[i]["duty_name"]+ '">' +duty_arr[i]["duty_name"]+ '</option>');
      $("#select_duty").append(option);
    }
  }

  if(<?=$h_idx?> > 0){
    $("#select_duty").val("<?=$edit_row[0]['duty_name']?>").attr("selected", "selected");
  }
}

/*
*  @brief 필요자격증 항목 추가
*/
function add_item(){
  var div = document.createElement('div');
  div.style.margin = "1px";
  div.style.display = "flex";
  div.innerHTML = '<input type="text" name="h_certificate" maxlength="25" style="width:90%; height:35px" /><div style="flex:1; position:relative"><img src="../../img/close.png" alt="삭제" style="max-width:15px; position:absolute; margin:auto; top:0; bottom:0; left:0; right:0" onclick="remove_item(this)" /></div>';
  document.getElementById('field').appendChild(div);

  certificateAutocomplete();
}

function remove_item(obj){
  document.getElementById('field').removeChild(obj.parentNode.parentNode);
}

/*
* @brief 자격증리스트 자동완성 기능
* @author 윤흥준
*/
var certificate_list = <? echo json_encode($certificate_list) ?>;
function certificateAutocomplete() {
  $("input[name=h_certificate]").autocomplete({
    source: certificate_list
  });
}

function click_email(email) {
  $("#c_email2").val(email);
}

function hire_call(){
  var hire_sel = $("#hire_call_select option:selected").val();
  location.href = './' + hire_sel;
}

function hire_ok(){
  if($("#short_term_check").is(":checked")){ //단기일자리 체크했을 때,
      var short_term_check = 1;
  }else{
    var short_term_check = 0;
  }
  var title = $("#h_title").val();
  var description = $("#job_description").val();
  var job_salary = $("#salary").val();
  var job_start_date = $("#job_start_date").val();
  var job_end_date = $("#job_end_date").val();
  var h_certificate_count = $('input[name=h_certificate]').length;
  var h_certificate_array = new Array(h_certificate_count);
  for(var i=0; i<h_certificate_count; i++){
       h_certificate_array[i] = $('input[name=h_certificate]')[i].value;
  }
  var phonenumber = $('#c_phone1').val() + "-" + $('#c_phone2').val() + "-" + $('#c_phone3').val();
  var select6 = $('#c_email1').val() + "@" + $('#c_email2').val();

  if(!title) {
    $('#h_title').focus();
    return toastr.error("공고제목을 입력하세요.");
  }

  if(!description) {
    $('#job_description').focus();
    return toastr.error("직무상세내용을 입력하세요.");
  }

  if(!job_salary) {
    $('#salary').focus();
    return toastr.error("급여를 입력하세요.");
  }

  if(!job_start_date) {
    $('#job_start_date').focus();
    return toastr.error("공고시작일을 입력하세요.");
  }

  if(!job_end_date) {
    $('#job_end_date').focus();
    return toastr.error("공고종료일을 입력하세요.");
  }


  var params = {};
  params["h_idx"] = <?=$h_idx?>;
  params["c_idx"] = <?=$c_idx?>;
  params["m_idx"] = <?=$m_idx?>;
  params["h_title"] = title;
  params["job_description"] = description;
  params["o_idx"] = $("#o_idx option:selected").val();
  params["duty_name"] = $("#select_duty option:selected").val();
  params["salary_idx"] = $("#job_salary option:selected").val();
  params["job_salary"] = job_salary;
  params["job_is_career"] = $("#job_is_career option:selected").val();
  params["job_achievement"] = $("#job_achievement option:selected").val();
  params["w_idx"] = $("#w_idx option:selected").val();
  params["local_idx"] = $("#local_select option:selected").val();
  params["city_idx"] = $("#city_select option:selected").val();
  params["district_idx"] = $("#district_select option:selected").val();
  params["job_start_date"] = job_start_date;
  params["job_end_date"] = job_end_date;
  params["job_manager"] =  $("#job_manager").val();
  params["phonenumber"] = phonenumber;
  params["select6"] = select6;
  params["h_certificate_array"] = h_certificate_array;
  params["h_certificate_count"] = h_certificate_count;
  params["short_term_check"] = short_term_check;

  exec_json("company.job_register_success",params,function(ret_obj){
     //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
     // alert(ret_obj.message); // alert 해도되지만 toastr 권장
     if(ret_obj.message == 1){
       location.href = "<?=getUrl('company','job')?>";
     }else{
       toastr.success(ret_obj.message);
       jQuery('#job_reg_complete').modal('show');
     }
  });
}


</script>

<?php
$footer_false = true;

?>
