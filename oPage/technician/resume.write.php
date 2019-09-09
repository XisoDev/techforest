<?php

$m_idx = $_SESSION['LOGGED_INFO'];

//한줄자기소개
$a_line_self = $output->get('a_line_row');

//경력간단요약 및 자기소개
$self_row = $output->get('self_row');

//이력서 정보
$resume_row = $output->get('resume_row');

//급여리스트
$salary_list = $output->get('salary_list');
$salary_arr = array(array("salary_idx"=>0, "salary_name"=>"회사내규에 따름"));
foreach ($salary_list as $value) {
	$result = array(
	"salary_idx" => $value["salary_idx"],
	"salary_name" => $value["salary_name"]
	);
	array_push($salary_arr, $result);
}

//희망급여
$member_order_row = $output->get('member_order_row');

//지역리스트
$local_arr = $output->get('local_arr');
$city_arr = $output->get('city_arr');
$district_arr = $output->get('district_arr');

//직종리스트
$occupation_arr = $output->get('occupation_list');

//직무리스트
$duty_arr = $output->get('duty_list');

//학력리스트
$school_arr = $output->get('school_arr');

// 학교리스트 기본HTML
for($i = 0; $i < count($school_arr); $i++) {
	$s_idx	= $school_arr[$i]["s_idx"];
	$s_name	= $school_arr[$i]["s_name"];
	$school_select_tag .= "<option value=\\\"" . $s_idx . "\\\">" . $s_name . "</option>";
}

// 언어리스트 기본HTML
$language_arr = $output->get('language_arr');
for($i = 0; $i < count($language_arr); $i++) {
	$lc_name	= $language_arr[$i]["lc_name"];
	$language_select_tag .= "<option value=\\\"" . $lc_name . "\\\">" . $lc_name . "</option>";
}

// 시험명리스트 기본HTML
$d_language_arr = $output->get('d_language_arr');
for($i = 0; $i < count($d_language_arr); $i++) {
	if($language_arr[0]["lc_idx"] == $d_language_arr[$i]["lc_idx"] ) {
		$lc_d_name		= $d_language_arr[$i]["lc_d_name"];
		$d_language_select_tag .= "<option value=\\\"" . $lc_d_name . "\\\">" . $lc_d_name . "</option>";
	}
}


//나의 이력서 정보 조회 - 학력
$my_info3 = $output->get('my_info3');

//나의 이력서 정보 조회 - 경력
$my_info4 = $output->get('my_info4');
echo "<script>var member_career_arr = " . json_encode($my_info4) . " || []; </script>";

//나의 이력서 정보 조회 - 자격증
$my_info5 = $output->get('my_info5');

//나의 이력서 정보 조회 - 어학
$my_info6 = $output->get('my_info6');

//나의 이력서 정보 조회 - 희망직무
$my_duty = $output->get('my_duty');

//파일 리스트
$file_list = $output->get('file_list');

//자격증리스트
$certificate_row = $output->get('certificate_row');
$certificate_list = array();
foreach($certificate_row as $val){
  array_push($certificate_list, $val['certificate_name']);
}

//한줄자기소개 랜덤 힌트
// 요거 왠만하면 site.config 에 전역으로 선언해놓고 여기저기서 불러오시는게좋아요 :)
// by xiso
$rand_array = array(
  "최고를 위해 늘 최선을 다하는 기술자",
  "함께 달리고 싶은 열정 지원자 입니다.",
  "새로운 도전을 준비하는 열혈 기술자",
  "최상의 결과를 이끌어 낼 준비된 인재입니다.",
  "적극적인 마인드로 업무를 해내겠습니다",
  "책임감을 가지고 성실히 일하는 지원자입니다.",
  "풍부한 실무경험을 갖고 있는 준비된 인재입니다.",
  "열심히 땀흘리는 성실한 기술자",
  "성실과 열정으로 내일의 가능성을 열겠습니다.",
  "책임감을 갖고 맡은 바 최선을 다하겠습니다.",
  "많은 현장경험으로 최고의 성과를 내겠습니다.",
  "시간약속을 잘 지키는 성실한 기술자입니다.",
  "주인의식을 가지고 성실히 일 할 자신있습니다.",
  "오랜 경력을 바탕으로 열심히 일하겠습니다.",
  "늘 한 길만 묵묵히 걸어온 노력파 인재",
  "오랜 경력으로 쌓은 전문성을 발휘하겠습니다.",
  "모든 일을 책임감있게 할 수 있습니다.",
  "손발이 빠르고 성실한 프로입니다.",
  "오랜 현장경험으로 쌓은 눈썰미로 제 몫을 해내겠습니다.",
  "오랜 현장경험으로 바로 업무투입이 가능합니다.",
  "적극적인 사고와 소통이 특기인 숙련 기술자입니다.",
  "목표를 향해 달리는 마라토너 같은 기술자");
shuffle($rand_array);

?>

<style media="screen">
	.ui-autocomplete {
	  list-style: none !important;
		background-color: #fff !important;
	}

</style>
<section class="sub_visual d-none d-lg-block pb-2" style="background-image:url('<?=$no_auto_bg_url?>');">
    <h4 class="red"><?=$site_info->title?></h4>
    <p class="weight_normal text-secondary pb-0 my-0"><?=$site_info->desc?></h4></p>
    <p class="weight_lighter text-secondary pt-0 pb-2 my-0">기술자숲이 대신 작성해 드립니다.</h4></p>
		<form id="theuploadform_resume">
			<label for="resume_upload">
	    	<span class="btn btn-danger">이력서파일 등록하기</span>
			</label>
			<input type="file" id="resume_upload" name="resume_upload" style="display:none;">
		</form>

    <p class="red xs_content weight_lighter">*영업일 기준 1일 소요됩니다.</p>
</section>
<section class="bg-white d-lg-none border-bottom">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">이력서 등록</h4>
    </div>
</section>
<section class="bg-white">
		<input type="hidden" id="my_info3_count" name="my_info3_count" value="<?if($my_info3){echo count($my_info3); } else { echo "0"; }?>" />
		<input type="hidden" id="my_info5_count" name="my_info5_count" value="<?if($my_info5){echo count($my_info5); } else { echo "0"; }?>" />
		<input type="hidden" id="my_info6_count" name="my_info6_count" value="<?if($my_info6){echo count($my_info6); } else { echo "0"; }?>" />

    <div class="mt-0 pt-0">
        <div class="container">
            <div class="row col-md-10 col-lg-9 mx-md-auto mb-md-4 px-0 mx-0">
                <div class="col-12 mt-3 mt-lg-5 mx-0 px-0">
                    <h6 class="d-block d-lg-none">기본정보</h6>
                    <h4 class="d-none d-lg-block">기본정보</h4>
                </div>
                <div class="col-6 col-sm-5 col-md-4 col-lg-3 mx-auto px-auto mb-3">
									<form id="m_picture_form">
                    <div class="position-relative">
                        <a class="position-absolute text-primary" style="right:0;top:0; font-size:26px;z-index:10;" onclick="m_picture_remove(<?=$m_idx?>)"><i class="xi-close-circle"></i></a>
												<div class="position-relative">
														<?
														if(!$logged_info['m_picture']) {
																$img_url = "/layout/none/assets/images/no_avatar.png";
														}else {
																$img_url = "../../../m_picture/" . $resume_row[0]['m_picture'];
														}
														?>
														<div class="avatar square" id="my_picture" style="background-image:url('<?=$img_url?>');"></div>
														<label for="picture_upload" class="position-absolute mb-0 pb-0" style="left:50%;bottom:-10px;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);transform: translateX(-50%);">
															<img src="/oPage/images/imgicons/camera_gray.png" height="20" />
														</label>
														<input type="file" id="picture_upload" name="picture_upload" style="display:none;">
												</div>

                        <!-- <i class="xi-camera position-absolute text-white" style="right:0;bottom:0; font-size:28px;"></i>
                        <i class="xi-camera position-absolute text-secondary" style="right:1px;bottom:1px; font-size:26px;"></i> -->
                    </div>
									</form>
                </div>
            </div>

            <div class="row col-md-10 col-lg-9 mx-md-auto mb-md-4 px-0 mx-0">
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>한줄자기소개</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <input type="text" class="form-control" id="a_line_self" value="<?=$a_line_self[0]['a_line_self']?>" placeholder="<?=$rand_array[0]?>" />
                </div>
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>이름</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <input type="text" class="form-control" id="m_name" value="<?=$resume_row[0]['m_name']?>"/>
                </div>
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>성별</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <select class="form-control" id="m_human">
                      <option value="M" <?if($resume_row[0]["m_human"] == "M") { echo "selected=\"selected\"";}?>>남자</option>
                      <option value="F" <?if($resume_row[0]["m_human"] == "F") { echo "selected=\"selected\"";}?>>여자</option>
                    </select>
                </div>
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>생년월일</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <input type="text" class="form-control xiso_date" id="m_birthday" value="<?=date("Y-m-d", strtotime($resume_row[0]["m_birthday"]));?>" placeholder="" />
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>전화번호</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <div class="input-group">
                        <select class="form-control" id="m_phone1">
													<?
														$phonenumber = explode("-", $resume_row[0]['m_phone']);
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
                        <input type="text" class="form-control" id="m_phone2" value="<?=$phonenumber[1]?>" placeholder="0000">
                        <div class="input-group-prepend">
                            <span class="input-group-text">-</span>
                        </div>
                        <input type="text" class="form-control" id="m_phone3" value="<?=$phonenumber[2]?>" placeholder="0000">
                    </div>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>이메일</h6>
                </div>
								<?php $email = explode("@", $resume_row[0]['m_email']); ?>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <div class="input-group">
                        <input type="text" class="form-control" id="m_email1" value="<?=$email[0]?>" placeholder="이메일 주소 입력">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                      @
                  </span>
                        </div>
                        <input type="text" class="form-control" id="m_email2" value="<?=$email[1]?>" placeholder="직접입력" style="">
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
                    <h6>주소</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <div class="input-group mb-2 overflow-hidden rounded">
                        <input type="text" class="form-control" id="address"  value="<?=$resume_row[0]['m_address']?>" placeholder="주소검색" readonly>
                        <button type="button" class="btn-sm btn btn-primary rounded-0 rounded-right" onclick="search_address()">주소검색</button>
                    </div>
                    <input type="text" class="form-control" id="address2" value="<?=$resume_row[0]['m_address2']?>" placeholder="상세주소">
                </div>

								<div id="wrap" style="display:none;border:1px solid;width:100%;height:50%;margin:5px 0;position:relative">
									<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
								</div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>희망급여</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <select class="form-control" id="job_salary" onchange="salary_select_change(this)">
                          <?php
													echo $resume_row[0]["salary_idx"];
                            foreach($salary_arr as $val) {
                              if($val["salary_idx"] == $member_order_row[0]["salary_idx"]) {
                                echo "<option value=\"" . $val["salary_idx"] . "\" selected=\"selected\">" . $val["salary_name"] . "</option>";
                              } else {
                                echo "<option value=\"" . $val["salary_idx"] . "\">" . $val["salary_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                        </div>
                        <input type="text" class="form-control" id="salary" style="width:50px;text-align:right;" maxlength="10" value="<?=$member_order_row[0]["desired_salary"]?>" onkeyup="onlyNumber(this)" />
                        <div class="input-group-append" id="salary_text">
                            <span class="input-group-text px-1" style="font-size:12px;">만원 이상</span>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text px-1" style="font-size:12px;">&nbsp;</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>희망근무지</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <div class="input-group">
                        <select class="form-control" id="local_select" onchange="workPlace(this)">
                          <?php
                            foreach($local_arr as $val){
                              $selected = ($val['local_idx'] == $resume_row[0]['m_local_idx']) ? "selected":"";
                          ?>
                              <option value="<?= $val['local_idx'] ?>" <?= $selected; ?>><?= $val['local_name'] ?></option>
                          <? } ?>
                        </select>
                        <select class="form-control" id="city_select" disabled>
                          <option value=""></option>
                          <?php
                            foreach($city_arr as $val){
                              if($val['local_idx'] == $resume_row[0]['m_local_idx']){
                                $selected = ($val['m_city_idx'] == $resume_row[0]['m_city_idx']) ? "selected":"";
                          ?>
                                <option value="<?=$val['m_city_idx']?>" <?= $selected; ?>><?=$val['city_name']?></option>
                          <?php
                              }
                            }
                          ?>
                        </select>
                        <select class="form-control" id="district_select" disabled>
                          <option value=""></option>
                          <?php
                            foreach($district_arr as $val){
                              if($val['local_idx'] == $resume_row[0]['m_local_idx']){
                                $selected = ($val['district_idx'] == $resume_row[0]['m_district_idx']) ? "selected":"";
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
                    <h6>희망직종</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                    <select class="form-control" id="occupation_select" onchange="occupation(this)">
                      <?php
                        foreach($occupation_arr as $val){
                          $selected = ($resume_row[0]['o_idx'] == $val['o_idx']) ? "selected":"";
                          echo '<option value="' .$val[o_idx]. '" ' .$selected. '>' .$val[o_name]. '</option>';
                        }
                      ?>
                    </select>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>희망직무</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2 mt-md-3 ">
                  <div id="duty_field" class="height_35" style="display:table-cell; vertical-align:middle"></div>
                    <!-- <span class="selected_item text-secondary xs_content" onclick="jQuery(this).remove();"><i class="xi-close-circle"></i> 기계/제조 관리직</span>
                    <span class="selected_item text-secondary xs_content" onclick="jQuery(this).remove();"><i class="xi-close-circle"></i> 주물사</span> -->
                    <div class="input-group overflow-hidden rounded mt-2">
                        <select class="form-control" id="select_duty" placeholder="직무를 선택해주세요. (최대 3개 추가가능)">
                        </select>
                        <button type="button" class="btn-sm btn btn-primary rounded-0 rounded-right" onclick="dutyAddItem($('#occupation_select').val(), $('#select_duty').val())">추가</button>
                    </div>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6 class="d-none d-sm-block mt-0">자기소개 및<br />경력 간단 요약</h6>
                    <h6 class="d-block d-sm-none bg-primary text-white mb-0 pb-0 text-center py-2 rounded-top">경력간단요약 및 자기소개</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mt-0 pt-0 mb-2 mt-md-3">
                    <textarea rows="7" class="form-control rounded-0 rounded-bottom" id="about_me"><?=$self_row[0]['self_introduction']?></textarea>
                </div>

            </div>

            <div class="row col-md-10 col-lg-9 mx-md-auto mb-md-4 px-0 mx-0">
                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">학력</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        학력
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2 mt-md-3 ">
									<div id="my_info3_2">
										<? if(count($my_info3) == 0){ ?>
											<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0">
												<div class="row pb-2 px-2">
													<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교구분</h6>
													<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
															<select class="form-control" id="s_idx0" name="s_idx0" onchange="school_changed(0)">
																<?
																	for($j = 0; $j < count($school_arr); $j++) {
																		echo "<option value=\"" . $school_arr[$j]["s_idx"] . "\">" . $school_arr[$j]["s_name"] . "</option>";
																	}
																?>
															</select>
															<div class="input-group-append" id="ged0">
																<span class="input-group-text sm_content pr-2 pl-3">검정고시 <i class="pl-1 xi-check-circle-o" onclick="jQuery(this).toggleClass('xi-check-circle-o');jQuery(this).toggleClass('xi-check-circle')"></i></span>
															</div>
                              <div class="input-group-append">
                                  <span class="input-group-text">&nbsp;</span>
                              </div>
                            </div>
                              <div class="col-6 pr-sm-2 mx-0 px-0">
                                  <div class="row px-3 px-sm-2">
                                  <h6 class="col-12 col-sm-6 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교명</h6>
                                  <div class="col-12 col-sm-6 px-0 mb-2 mr-1 mx-sm-0 mt-sm-3">
                                      <input type="text" class="form-control" id="school_name0"  placeholder="학교명"/>
                                  </div>
                                  </div>
                              </div>
                              <div class="col-6 pr-sm-2 mx-0 px-0">
                                  <div class="row px-3 px-sm-2">
                                  <h6 class="col-12 col-sm-6 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">졸업연도</h6>
                                  <div class="col-12 col-sm-6 px-0 mb-2 ml-1 mx-sm-0 mt-sm-3">
                                      <input type="text" class="form-control monthpicker" id="school_graduated0" placeholder="졸업연도"/>
                                  </div>
                                  </div>
                              </div>
													<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">전공</h6>
													<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
														<input type="text" class="form-control" id="school_major0" placeholder="전공"/>
													</div>
													<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0" id="school_grade_title0" style="display:none">학점</h6>
													<div class="input-group col-6 col-sm-3 mx-0 px-0 mb-2 mt-sm-3" id="grade0" style="display:none;">
														<input type="text" class="form-control text-center" id="school_grade0" placeholder="학점"/>
														<div class="input-group-prepend">
															<span class="input-group-text">/</span>
														</div>
															<input type="text" class="form-control text-center" id="max_grade0" placeholder="최대학점"/>
													</div>
												</div>
											</div>
											<? }else{
												foreach($my_info3 as $idx => $val){?>

													<!--수정된 엘리먼트로 변경-->
												<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0" id="school_div<?=$idx?>">
													<a class="position-absolute" style="right:10px; top:10px;" id="school_del<?=$idx?>" onclick="my_info3_del1(<?=$idx?>)"><i class="xi-close"></i></a>
													<div class="row pb-2 px-2">
													<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교구분</h6>
													<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
															<select class="form-control" id="s_idx<?=$idx?>" onchange="school_changed(<?=$idx?>)">
																<?
																	for($j = 0; $j < count($school_arr); $j++) {
																		if($val["s_idx"] == $school_arr[$j]["s_idx"]) {
																			echo "<option value=\"" . $school_arr[$j]["s_idx"] . "\" selected=\"selected\">" . $school_arr[$j]["s_name"] . "</option>";
																		} else {
																			echo "<option value=\"" . $school_arr[$j]["s_idx"] . "\">" . $school_arr[$j]["s_name"] . "</option>";
																		}
																	}
																?>
															</select>
															<?
																$is_ged_visible = "none";
																if($val["s_idx"] == 1){
																	$is_ged_visible = "flex";
																}
															?>
															<div class="input-group-append" id="ged<?=$idx?>" style="display:<?=$is_ged_visible?>">
																<? //검정고시면
																	if($val["s_idx"] == 1 && $val['is_ged'] == 1){?>
																		<span class="input-group-text sm_content pr-2 pl-3">검정고시 <i class="xi-check-circle" onclick="jQuery(this).toggleClass('xi-check-circle-o');jQuery(this).toggleClass('xi-check-circle')"></i></span>
																<? }else if($val["s_idx"] == 1 && $val['is_ged'] == 0){ ?>
																		<span class="input-group-text sm_content pr-2 pl-3">검정고시 <i class="xi-check-circle-o" onclick="jQuery(this).toggleClass('xi-check-circle-o');jQuery(this).toggleClass('xi-check-circle')"></i></span>
																<? } ?>
															</div>
                              <div class="input-group-append">
                                  <span class="input-group-text">&nbsp;</span>
                              </div>
													</div>
                          <div class="col-6 pr-sm-2 mx-0 px-0">
                              <div class="row px-3 px-sm-2">
                                  <h6 class="col-12 col-sm-6 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교명</h6>
                                  <div class="col-12 col-sm-6 p-0 mb-2 mr-1 mx-sm-0 mt-sm-3">
                                      <input type="text" class="form-control" id="school_name<?=$idx?>"  value="<?=$val['school_name']?>" placeholder="학교명"/>
                                  </div>
                              </div>
                          </div>
                          <div class="col-6 pr-sm-2 mx-0 px-0">
                              <div class="row px-3 px-sm-2">
                                  <h6 class="col-12 col-sm-6 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">졸업연도</h6>
                                  <div class="col-12 col-sm-6 px-0 mb-2 ml-1 mx-sm-0 mt-sm-3">
                                      <input type="text" class="form-control monthpicker" id="school_graduated<?=$idx?>" value="<?=substr($val['school_graduated'],0,7)?>" placeholder="졸업연도"/>
                                  </div>
                              </div>
                          </div>

														<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">전공</h6>
														<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
															<input type="text" class="form-control" id="school_major<?=$idx?>" value="<?=$val['school_major']?>" placeholder="전공"/>
														</div>
														<?
															$is_grade_visible = "none";
															$is_grade_visible2 = "none";
															if($val["s_idx"] != 1){
																$is_grade_visible = "block";
																$is_grade_visible2 = "fixed";
															}
														?>
													<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0" id="school_grade_title<?=$idx?>" style="display:<?=$is_grade_visible?>">학점</h6>
													<div class="input-group col-6 col-sm-3 mx-0 px-0 mb-2 mt-sm-3" id="grade<?=$idx?>" style="display:<?=$is_grade_visible2?>;">
														<input type="text" class="form-control text-center" id="school_grade<?=$idx?>" value="<?=$val['school_grade']?>" placeholder="학점"/>
														<div class="input-group-prepend">
															<span class="input-group-text">/</span>
														</div>
															<input type="text" class="form-control text-center" id="max_grade<?=$idx?>" value="<?=$val['max_grade']?>" placeholder="최대학점"/>
													</div>
												</div>
											</div>
													<?}
													}
													?>
									</div>
                    <div class="text-center">
                        <button class="my-3 d-sm-inline-block d-none btn btn-warning" onclick="my_info3_add();">학력 추가하기</button>
                    </div>
                    <button class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom" onclick="javascript:my_info3_add();">학력 추가하기</button>
								</div>

                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">경력</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        경력
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2 mt-sm-3">
									<div id="my_info4_2"></div>
                    <div class="text-center">
                        <a class="my-3 d-sm-inline-block d-none btn btn-warning" onclick="javascript:addViewMemberCareer();">경력 추가하기</a>
                    </div>
                    <a class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom" onclick="javascript:addViewMemberCareer();">경력 추가하기</a>
                </div>

                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">자격증</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        자격증
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2 mt-sm-3" >
									<div id="my_info5_2">
									<? if(count($my_info5) == 0){ ?>
										<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0">
												<!-- <a class="position-absolute" style="right:10px; top:10px;" onclik><i class="xi-close"></i></a> -->
												<div class="row pb-2 px-2" id="certificate_div0">
														<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">자격증명</h6>
														<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
															<input type="text" class="form-control" id="certificate_name0" name="h_certificate" placeholder="자격증명"/>
															<input type="text" class="form-control monthpicker" id="certificate_date0" placeholder="취득일자"/>
														</div>
												</div>
										</div>
									<?}else{?>
										<?foreach ($my_info5 as $idx => $val) {?>
											<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0" id="certificate_div<?=$idx?>">
													<a class="position-absolute" style="right:10px; top:10px;" id="certificate_del<?=$idx?>" onclick="javascript:my_info5_del1(<?=$idx?>)"><i class="xi-close"></i></a>
													<div class="row pb-2 px-2">
															<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">자격증명</h6>
															<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
																<input type="text" class="form-control" id="certificate_name<?=$idx?>" name="h_certificate" value="<?=$val['certificate_name']?>" placeholder="자격증명"/>
																<input type="text" class="form-control monthpicker" id="certificate_date<?=$idx?>" value="<?=substr($val['certificate_date'],0,7)?>" placeholder="취득일자"/>
															</div>
													</div>
											</div>
										<? } ?>
									<? } ?>
									</div>
                    <div class="text-center">
                      <button class="my-3 d-sm-inline-block d-none btn btn-warning" onclick="javascript:my_info5_add()">자격증 추가하기</button>
                    </div>
                    <button class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom" onclick="javascript:my_info5_add()">자격증 추가하기</button>
                </div>


                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">어학</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        어학
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2 mt-sm-3">
									<div id="my_info6_2">
										<?if(count($my_info6) == 0){?>
											<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0" id="language_div0">
	                        <div class="row pb-2 px-2">
	                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">언어</h6>
	                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
	                               <input type="text" class="form-control" id="lc_name_txt0" name="lc_name_txt0" value="">
																 <select class="form-control" id="lc_name0" name="lc_name0" onchange="languageChange(this.value,0)">
																	<?
																		$lang_check = 0;
																		for($j = 0; $j < count($language_arr); $j++) {
																			if($my_info6[$i]["lc_idx"] == $language_arr[$j]["lc_name"]) {
																			 echo "<option value=\"" . $language_arr[$j]["lc_name"] . "\" selected=\"selected\">" . $language_arr[$j]["lc_name"] . "</option>";
																				$lang_check++;
																			} else {
																				if($j == count($language_arr) - 1) {
																					if($lang_check > 0) {
																						echo "<option value=\"" . $language_arr[$j]["lc_name"] . "\">" . $language_arr[$j]["lc_name"] . "</option>";
																					} else {
																						echo "<option value=\"" . $language_arr[$j]["lc_name"] . "\" selected=\"selected\" >" . $language_arr[$j]["lc_name"] . "</option>";
																					}
																				} else {
																					echo "<option value=\"" . $language_arr[$j]["lc_name"] . "\">" . $language_arr[$j]["lc_name"] . "</option>";
																				}
																			}
																	}
																?>
																</select>
	                            </div>
	                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">시험명</h6>
	                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
																<input type="text" class="form-control" id="lc_d_name_txt0" name="lc_d_name_txt0">
	                                <select class="form-control" id="lc_d_idx0" name="lc_d_idx0" onchange="d_languageChange(this.value,0);">
	                                   <?
																		 for($j = 0; $j < count($d_language_arr); $j++) {
																			 if($my_info6[$i]["lc_idx"] == $d_language_arr[$j]["lc_name"]) {
																				 echo "<option value=\"" . $d_language_arr[$j]["lc_d_name"] . "\" >" . $d_language_arr[$j]["lc_d_name"] . "</option>";
																			 }
																			}
																		 ?>
	                                </select>
	                            </div>
	                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">점수</h6>
	                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
	                                <input type="text" class="form-control" id="score0"/>
	                                <div class="input-group-append">
	                                    <span class="input-group-text">점(급)</span>
	                                </div>
	                            </div>
	                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">취득날짜</h6>
	                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
	                                <input type="text" class="form-control monthpicker" id="language_date0"/>
	                            </div>
	                        </div>
	                    </div>
									  <?}else{?>
											<?foreach ($my_info6 as $idx => $val) {?>
												<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0" id="language_div<?=$idx?>">
		                        <a class="position-absolute" style="right:10px; top:10px;" id="language_del<?=$idx?>" onclick="javascript:my_info6_del1(<?=$idx?>)"><i class="xi-close"></i></a>
		                        <div class="row pb-2 px-2">
		                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">언어</h6>
		                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
		                               <input type="text" class="form-control" id="lc_name_txt<?=$idx?>" name="lc_name_txt<?=$idx?>" value="<?=$val['lc_idx']?>">
																	 <select class="form-control" id="lc_name<?=$idx?>" name="lc_name<?=$idx?>" onchange="languageChange(this.value,<?=$idx?>)">
																		<?
																			$lang_check = 0;
																			for($j = 0; $j < count($language_arr); $j++) {
																				if($val["lc_idx"] == $language_arr[$j]["lc_name"]) {
																				 echo "<option value=\"" . $language_arr[$j]["lc_name"] . "\" selected=\"selected\">" . $language_arr[$j]["lc_name"] . "</option>";
																					$lang_check++;
																				} else {
																					if($j == count($language_arr) - 1) {
																						if($lang_check > 0) {
																							echo "<option value=\"" . $language_arr[$j]["lc_name"] . "\">" . $language_arr[$j]["lc_name"] . "</option>";
																						} else {
																							echo "<option value=\"" . $language_arr[$j]["lc_name"] . "\" selected=\"selected\" >" . $language_arr[$j]["lc_name"] . "</option>";
																						}
																					} else {
																						echo "<option value=\"" . $language_arr[$j]["lc_name"] . "\">" . $language_arr[$j]["lc_name"] . "</option>";
																					}
																				}
																		}
																	?>
																	</select>
		                            </div>
		                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">시험명</h6>
		                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
																	<input type="text" class="form-control" id="lc_d_name_txt<?=$idx?>" name="lc_d_name_txt<?=$idx?>" value="<?=$val['lc_d_idx']?>">
		                                <select class="form-control" id="lc_d_idx<?=$idx?>" name="lc_d_idx<?=$idx?>" onchange="d_languageChange(this.value,<?=$idx?>);">
		                                   <?
																			 for($j = 0; $j < count($d_language_arr); $j++) {
																				 if($val["lc_idx"] == $d_language_arr[$j]["lc_name"]) {
																					 echo "<option value=\"" . $d_language_arr[$j]["lc_d_name"] . "\" >" . $d_language_arr[$j]["lc_d_name"] . "</option>";
																				 }
																				}
																			 ?>
		                                </select>
		                            </div>
		                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">점수</h6>
		                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
		                                <input type="text" class="form-control" id="score<?=$idx?>" value="<?=$val['score']?>"/>
		                                <div class="input-group-append">
		                                    <span class="input-group-text">점(급)</span>
		                                </div>
		                            </div>
		                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">취득날짜</h6>
		                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">
		                                <input type="text" class="form-control monthpicker" id="language_date<?=$idx?>" value="<?=substr($val['language_date'],0,7)?>" />
		                            </div>
		                        </div>
		                    </div>
											<?}?>
										<?}?>
									</div>
                    <div class="text-center">
                      <a class="my-3 d-sm-inline-block d-none btn btn-warning" onclick="javascript:my_info6_add()">어학 추가하기</a>
                    </div>
                    <a class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom" onclick="javascript:my_info6_add()">어학 추가하기</a>
                </div>

                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">관련서류 등록하기</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        관련서류 등록하기
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mt-sm-3" style="margin-bottom:100px">
                    <?foreach ($file_list as $val) {?>
                        <div class="file_item border rounded py-2 px-2 mb-2 mt-sm-3">
                                <a onclick="file_trash(<?=$val['file_name']?>)"><i class="xi-trash pull-right" style="font-size:1.2em;"></i></a>
                                <a href="" download="<?=$val['file_name']?>" title="<?=$val['file_name']?>"><i class="xi-download pull-right" style="font-size:1.2em;"></i></a>
                                [<?=$val['file_type']?>] <?=$val['file_name']?>
                        </div>
                    <?}?>

                    <div class="text-center">
                        <button class="my-3 d-sm-inline-block d-none btn btn-warning" data-toggle="modal" data-target="#fileUpload">서류 추가하기</button>
                    </div>
                    <button class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom" data-toggle="modal" data-target="#fileUpload">서류 추가하기</button>
                </div>
            </div>

            <div class="row fixed-bottom">
                <div class="col-sm-2"></div>
                <div class="col-6 col-sm-4">
                    <input type="button" class="btn btn-block btn-light border-primary text-primary btn-round btn-lg my-3" onclick="history.back();" value="취소" />
                </div>
                <div class="col-6 col-sm-4">
                    <input type="button" class="btn btn-block btn-primary btn-round btn-lg my-3" onclick="resume_success()" value="저장" />
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="fileUpload" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px" id="file_modal">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#fileUpload').modal('hide');" ><i class="xi-close xi-2x"></i></a>

					<form id="theuploadform">

							<div class="mt-4 mb-3">
								<h5 class="weight_bold pb-3">관련 서류 등록</h5>
								구분
								<select class="red border-danger" style="background:white" name="fileUpload_select">
									<option value="이력서">이력서</option>
									<option value="자기소개서">자기소개서</option>
									<option value="학력증명서">학력증명서</option>
									<option value="경력증명서">경력증명서</option>
									<option value="자격증">자격증</option>
									<option value="어학">어학</option>
								</select>
							</div>
							<div class="mt-4 mb-3">
								<input type="file" id="userfile" name="userfile" value="">
							</div>

						<div class="row px-3 py-3">
								<div class="col-sm-2"></div>
								<div class="col-6 col-sm-4">
									<input type="submit" id="formsubmit" class="btn btn-block btn-danger btn-round mt-3" value="저장" />
								</div>
								<div class="col-6 col-sm-4">
									<input type="button" class="btn btn-block border-danger text-danger btn-round mt-3" onclick="jQuery('#fileUpload').modal('hide');" value="취소" />
								</div>
						</div>
					</form>
					<div id="textarea">
					</div>
        </div>
    </div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$("#job_salary").change();
		$("#occupation_select").change();
		loadDuty();
		certificateAutocomplete();
		if(member_career_arr.length > 0) {
			addViewMemberCareer ();
		}


		$("#formsubmit").click(function () {
		var iframe = $('<iframe name="postiframe" id="postiframe" width=0 height=0 style="display:none"></iframe>');

		$("#file_modal").append(iframe);

		var form = $('#theuploadform');
		form.attr("action", "/proc.php?act=technician.procFileUpload");
		form.attr("method", "post");

		form.attr("encoding", "multipart/form-data");
		form.attr("enctype", "multipart/form-data");

		form.attr("target", "postiframe");
		form.attr("file", $('#userfile').val());
		form.submit();

		$("#postiframe").on('load',function () {
				alert("파일이 업로드 되었습니다.");
		});

		return false;

		});

	});

  var local_arr = <?= json_encode($local_arr) ?>;
  var city_arr = <?= json_encode($city_arr) ?>;
  var district_arr = <?= json_encode($district_arr) ?>;

/*
* @brief 희망직무
*/
var duty_arr = <?= json_encode($duty_arr); ?>;

function occupation(obj){
	$("#select_duty").empty();

	$("#select_duty").append('<option disabled>직무를 선택해주세요 (최대 3개 추가가능)</option>');

	for(var i = 0; i < duty_arr.length; i++) {
		if(obj.value == duty_arr[i]["o_idx"]) {
			var option = $('<option value="' +duty_arr[i]["duty_name"]+ '">' +duty_arr[i]["duty_name"]+ '</option>');
			$("#select_duty").append(option);
		}
	}

	// var tr_duty_visible = $("#select_duty option").length();
	//
	// if(tr_duty_visible > 1) {
	// 	$("tr[name=tr_duty]").show();
	// 	$("#select_duty option:eq(0)").prop("selected", true);
	// } else {
	// 	$("tr[name=tr_duty]").hide();
	// }
}


  /*
  * @brief 직무 추가
  */
  var occupation_arr = <?=json_encode($occupation_arr)?>;
  var duty_field_arr = new Array();
  function dutyAddItem(o_idx_value, new_value) {
  	if(new_value == null){
  		return;
  	}

  	if(duty_field_arr.length >= 3){
  		alert("희망직무는 3개까지 선택 가능합니다.");
  		return;
  	}

  	if(inMultiArray(new_value, "duty_name", duty_field_arr) != -1) {
  		return;
  	} else {
  		var arr = new Array();
  		arr["o_idx"] = o_idx_value;
  		arr["duty_name"] = new_value;
  		duty_field_arr.push(arr);
  	}

  	var span = document.createElement('span');
  	span.id = new_value;
  	span.innerHTML = new_value + '<i class="xi-close-circle" onclick="remove_item(this)"></i>';
  	document.getElementById('duty_field').appendChild(span);

  }

  function remove_item(obj){
  	// obj.parentNode 를 이용하여 삭제
  	duty_field_arr.splice(inMultiArray(obj.parentNode.id, "duty_name", duty_field_arr), 1);

  	document.getElementById('duty_field').removeChild(obj.parentNode);
  }

  function inMultiArray(value, key, arr) {
  	var arr_lenght = arr.length;

  	for(var i=0; i < arr_lenght; i++){
  		if(arr[i][key] == value) {	return i; }
  	}

  	return -1;
  }

  function loadDuty() {
  	var arr = <?=json_encode($my_duty) ?>;
  	if(arr) {
  		for(var i=0; i < arr.length; i++){
  			dutyAddItem(arr[i]['o_idx'], arr[i]['duty_name']);
  		}
  	}
  }


  var my_info3_count = "<?if($my_info3){if(count($my_info3) == 0) { echo "1"; } else { echo count($my_info3); }} else { echo "1"; } ?>";
  var my_info5_count = "<?if($my_info5){if(count($my_info5) == 0) { echo "1"; } else { echo count($my_info5); }} else { echo "1"; } ?>";
  var my_info6_count = "<?if($my_info6){if(count($my_info6) == 0) { echo "1"; } else { echo count($my_info6); }} else { echo "1"; } ?>";


	//학력추가하기
  function my_info3_add() {
    var html = "";
    // if(my_info3_count != 0) {
      //var is_ged = $("#is_ged" + (my_info3_count - 1)).is(":checked");
      //var school_name = $("#school_name" + (my_info3_count - 1)).val();

      // if(!is_ged && !school_name) {
      //   alert("학교명 입력 해주세요.");
      //   $("#school_name").focus();
      //   return;
      // }

			html += '<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0" id="school_div'+ my_info3_count +'">';
			html += '<a class="position-absolute" style="right:10px; top:10px;" id="school_del'+ my_info3_count +'" onclick="javascript:my_info3_del1(' + my_info3_count + ')"><i class="xi-close"></i></a>';
			html += '<div class="row pb-2 px-2">';
			html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교구분</h6>';
			html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
			html += '<select class="form-control" id="s_idx'+ my_info3_count + '"name="s_idx'+ my_info3_count + '"onchange="school_changed(' +my_info3_count+ ')">';
			html += '<?= $school_select_tag ?>';
			html += '</select>';
			html += '<div class="input-group-append">';
			html += '<span class="input-group-text sm_content pr-2 pl-3">검정고시 <i class="xi-check-circle-o" id="ged'+ my_info3_count +'" onclick="ged_button('+my_info3_count+')"></i></span>';
			html += '<div class="input-group-append"><span class="input-group-text">&nbsp;</span></div>';
			html += '</div></div>';
      html += '<div class="col-6 pr-sm-2 mx-0 px-0">';
      html += '<div class="row px-3 px-sm-2">';
      html += '<h6 class="col-12 col-sm-6 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교명</h6>';
      html += '<div class="col-12 col-sm-6 px-0 mb-2 mr-1 mx-sm-0 mt-sm-3">';
      html += '<input type="text" class="form-control" id="school_name'+ my_info3_count +'"  placeholder="학교명"/>';
      html += '</div>';
      html += '</div>';
      html += '</div>';
      html += '<div class="col-6 pr-sm-2 mx-0 px-0">';
      html += '<div class="row px-3 px-sm-2">';
      html += '<h6 class="col-12 col-sm-6 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">졸업연도</h6>';
      html += '<div class="col-12 col-sm-6 px-0 mb-2 ml-1 mx-sm-0 mt-sm-3">';
      html += '<input type="text" class="form-control monthpicker" id="school_graduated'+ my_info3_count +'" placeholder="졸업연도"/>';
      html += '</div>';
      html += '</div>';
      html += '</div>';
			html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">전공</h6>';
			html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
			html += '<input type="text" id="school_major'+ my_info3_count + '"class="form-control" placeholder="전공"/>';
			html += '</div>';
			html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0" id="school_grade_title'+ my_info3_count +'"style="display:none">학점</h6>';
			html += '<div class="input-group col-6 col-sm-3 mx-0 px-0 mb-2 mt-sm-3" id="grade'+ my_info3_count +'" style="display:none">';
			html += '<input type="text" class="form-control text-center" id="school_grade'+ my_info3_count + '" placeholder="학점"/>';
			html += '<div class="input-group-prepend">';
			html += '<span class="input-group-text">/</span>';
			html += '</div>';
			html += '<input type="text" class="form-control text-center" id="max_grade'+ my_info3_count + '" placeholder="최대학점"/>';
			html += '</div></div></div>';

      $("#my_info3_2").append(html);
      my_info3_count++;
      $('#my_info3_count').val(my_info3_count);

      /*$('html,body').animate({scrollTop: $("#node1_" + (type1_count - 1)).offset().top}, 'slow');*/
    // }
  }

	function my_info3_del1(idx) {
		// $('#my_info3_2').css('display', 'block');
		// $('#my_info3_3').css('display', 'none');

		// if(my_info3_count - 1 != idx) {
		// 	idx *= 1;
		// 	var node1 = "school_hr" + (idx + 1);
		// 	document.getElementById("my_info3_2").removeChild(document.getElementById(node1));
		// } else if(my_info3_count - 1 == idx && idx > 0) {
		// 	idx *= 1;
		// 	var node1 = "school_hr" + idx;
		// 	document.getElementById("my_info3_2").removeChild(document.getElementById(node1));
		// }

		var node1 = "school_div" + idx;
		document.getElementById("my_info3_2").removeChild(document.getElementById(node1));

		idx *= 1;
		for(var i = idx; i < my_info3_count - 1; i++) {
			document.getElementById("school_div" + (i + 1)).id = "school_div" + i;
			document.getElementById("school_del" + (i + 1)).id = "school_del" + i;
			$("#school_del" + i).removeAttr("onclick");
			$("#school_del" + i).attr("onclick", "javascript:my_info3_del1(" + i + ");");

			document.getElementById("s_idx" + (i + 1)).id = "s_idx" + i;
			$("#s_idx" + i).removeAttr("onchange");
			$("#s_idx" + i).attr("onchange", "javascript:school_changed(" + i + ");");
			document.getElementById("ged" + (i + 1)).id = "ged" + i;
			document.getElementById("school_name" + (i + 1)).id = "school_name" + i;
			document.getElementById("school_graduated" + (i + 1)).id = "school_graduated" + i;
			$("#school_graduated" + i).removeAttr("onclick");
			$("#school_graduated" + i).addClass("monthpicker");

			document.getElementById("school_major" + (i + 1)).id = "school_major" + i;
			document.getElementById("school_grade" + (i + 1)).id = "school_grade" + i;
			document.getElementById("max_grade" + (i + 1)).id = "max_grade" + i;


			// if(i + 2 < my_info3_count) {
			// 	document.getElementById("school_hr" + (i + 2)).id = "school_hr" + (i+1);
			// }

		}
		if(my_info3_count - 1 == 0) {
			my_info3_count = 0
		} else {
			my_info3_count -= 1;
		}
		$('#my_info3_count').val(my_info3_count);
	}

	function addViewMemberCareer () {
		//$('#my_info4_2').css('display', 'block');
		// my_info4_3 : 숨김시 구분선
		//$('#my_info4_3').css('display', 'none');

		var start = $('div[name=div_career_field]').length;
		if(start == member_career_arr.length) {
			var arr = {"c_name":"", "c_position":"", "c_start_date":"", "c_end_date":"", "c_content":"", "o_idx":"", "duty_name":""};
			member_career_arr.push(arr);
		}

		for(var i = start; i < member_career_arr.length; i++) {
			var html = '';

			// if(i != 0) {
			// 	var c_name = $('input[name=c_name]').eq(i-1).val();
			//
			// 	if(!c_name) {
			// 		alert("기업명을 입력 해주세요.");
			// 		$('input[name=c_name]').focus();
			// 		return;
			// 	}
			//}

			html += '<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0">';
			html += '<a class="position-absolute" style="right:10px; top:10px;" name="delete_career" onclick="removeViewMemberCareer(this)"><i class="xi-close"></i></a>';
			html += '<div class="row pb-2 px-2">';
			html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">기업명</h6>';
			html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
			html += '<input type="text" id="c_name'+ i +'"name="c_name" class="form-control" value="' +member_career_arr[i]["c_name"]+ '" placeholder="회사명"/>';
			html += '<input type="text" id="c_position'+ i +'"name="c_position" class="form-control" value="' +member_career_arr[i]["c_position"]+ '" placeholder="직위(직급)"/>';
			html += '</div>';
			html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">직종</h6>';
			html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
			html += '<select class="form-control" name="c_o_idx" id="c_o_idx'+ i +'" onchange="addDutyToSelect(this)">';
			html += '</select>';
			html += '<select class="form-control" name="c_duty" id="c_duty'+ i +'">';
			html += '</select></div>';
			html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">근무기간</h6>';
			html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
			html += '<input type="text" class="form-control monthpicker_from" autocomplete="off" name="c_start_date"  value="' +member_career_arr[i]["c_start_date"].substring(0, 7)+ '"/>';
			html += '<div class="input-group-append">';
			html += '<span class="input-group-text">~</span>';
			html += '</div>';
			html += '<input type="text" name="c_end_date" class="form-control monthpicker_to" value="' +member_career_arr[i]["c_end_date"].substring(0, 7)+ '" />';
			html += '</div>';
			html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">직무내용</h6>';
			html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
			html += '<textarea rows="3" class="form-control" name="c_content" placeholder="기재시 적합한 일자리에 연결될 확률이 77% 증가합니다">'+member_career_arr[i]["c_content"]+'</textarea>';
			html += '</div></div></div>';


			var div = document.createElement('div');
			div.setAttribute("name", "div_career_field");
			div.innerHTML = html;
			document.querySelector('#my_info4_2').appendChild(div);
			addOccupationToSelect(i, member_career_arr[i]["o_idx"]);
		}

		//setDatepicker();
	}

	function removeViewMemberCareer(obj) {
		var num = $('a[name=delete_career]').index(obj);
		// num 값을 이용하여, 뷰삭제 -> 해당 값 배열에서 제거 -> hr 맞춤
		$('div[name=div_career_field]').eq(num).remove();

		member_career_arr.splice(num, 1);

		var first_child = document.querySelector('#my_info4_2').firstChild;

		for(var i = 0; i < first_child.childNodes.length; i++) {
			if(first_child.childNodes[i].nodeName == "div") {
				first_child.removeChild(first_child.childNodes[i]);
			}
		}
	}

	function addOccupationToSelect(num, o_idx) {
		var selecter = $('select[name=c_o_idx]').eq(num);
		$(selecter).append('<option selected disabled>직종을 선택해주세요</option>');

		for(var i = 0; i < occupation_arr.length; i++) {
			$(selecter).append('<option value="' +occupation_arr[i]["o_idx"]+ '">' +occupation_arr[i]["o_name"]+ '</option>');
			if(o_idx > 0) {
				$(selecter).val(o_idx);
				$(selecter).change();
			}
		}
	}

	function addDutyToSelect(obj) {
		var num = $('select[name=c_o_idx]').index(obj);
		var selecter = $('select[name=c_duty]').eq(num);

		$(selecter).empty();
		if(obj.value == 1 || obj.value == 9) {
			// $(selecter).append('<option selected disabled></option>');
		} else {
			$(selecter).append('<option selected disabled>직무를 선택해주세요</option>');
		}

	  for(var i = 0; i < duty_arr.length; i++) {
			if(obj.value == duty_arr[i]["o_idx"]) {
				var option = $('<option value="' +duty_arr[i]["duty_name"]+ '">' +duty_arr[i]["duty_name"]+ '</option>');
				$(selecter).append(option);
				if(member_career_arr[num]["duty_name"] == duty_arr[i]["duty_name"]){ $(selecter).val(duty_arr[i]["duty_name"]) }
			}
		}
	}



	function my_info5_add(){
		var html = "";

		// if(my_info5_count != 0) {
		// 	var certificate_name = $("#certificate_name" + (my_info5_count - 1)).val();
		// 	var certificate_date = $("#certificate_date" + (my_info5_count - 1)).val();
		//
		// 	if(!certificate_name || !certificate_date) {
		// 		alert("자격증명과 취득날짜를 입력해주세요.");
		// 		$("#certificate_name").focus();
		// 		return;
		// 	}
		// }
		html += '<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0" id="certificate_div'+ my_info5_count +'">';
		html += '<a class="position-absolute" style="right:10px; top:10px;" id="certificate_del'+ my_info5_count +'" onclick="my_info5_del1('+ my_info5_count +')"><i class="xi-close"></i></a>';
		html += '<div class="row pb-2 px-2">';
		html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">자격증명</h6>';
		html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
		html += '<input type="text" class="form-control" id="certificate_name'+ my_info5_count +'" name="h_certificate" placeholder="자격증명"/>';
		html += '<input type="text" class="form-control monthpicker" id="certificate_date'+ my_info5_count +'" placeholder="취득일자"/>';
		html += '</div></div></div>';

		$("#my_info5_2").append(html);
		my_info5_count++;
		$('#my_info5_count').val(my_info5_count);

		certificateAutocomplete();
	}

	function my_info5_del1(idx) {
	// $('#my_info5_2').css('display', 'block');
	// $('#my_info5_3').css('display', 'none');

	// if(my_info5_count - 1 != idx) {
	// 	idx *= 1;
	// 	var node1 = "certificate_hr" + (idx + 1);
	// 	document.getElementById("my_info5_2").removeChild(document.getElementById(node1));
	// } else if(my_info5_count - 1 == idx && idx > 0) {
	// 	idx *= 1;
	// 	var node1 = "certificate_hr" + idx;
	// 	document.getElementById("my_info5_2").removeChild(document.getElementById(node1));
	// }

	var node1 = "certificate_div" + idx;
	document.getElementById("my_info5_2").removeChild(document.getElementById(node1));

	idx *= 1;

	for(var i = idx; i < my_info5_count - 1; i++) {
		document.getElementById("certificate_div" + (i + 1)).id = "certificate_div" + i;
		document.getElementById("certificate_del" + (i + 1)).id = "certificate_del" + i;
		$("#certificate_del" + i).removeAttr("onclick");
		$("#certificate_del" + i).attr("onclick", "javascript:my_info5_del1(" + i + ");");

		document.getElementById("certificate_name" + (i + 1)).id = "certificate_name" + i;
		document.getElementById("certificate_date" + (i + 1)).id = "certificate_date" + i;
		$("#certificate_date" + i).removeAttr("onclick");
		$("#certificate_date" + i).attr("onclick", "javascript:click_datepicker('#certificate_date" + i + "');");
		// document.getElementById("is_certificate" + (i + 1)).id = "is_certificate" + i;

		// if(i + 2 < my_info5_count) {
		// 	document.getElementById("certificate_hr" + (i + 2)).id = "certificate_hr" + (i+1);
		// }

	}

	if(my_info5_count - 1 == 0) {
		my_info5_count = 0
	} else {
		my_info5_count -= 1;
	}

	$('#my_info5_count').val(my_info5_count);

}

function my_info6_add() {
	// $('#my_info6_2').css('display', 'block');
	// $('#my_info6_3').css('display', 'none');
	var html = "";

	// if(my_info6_count != 0) {
	// 	var lc_name_txt = $("#lc_name_txt" + (my_info6_count - 1)).val();
	// 	var lc_d_name_txt = $("#lc_d_name_txt" + (my_info6_count - 1)).val();
	// 	var score = $("#score" + (my_info6_count - 1)).val();
	// 	var language_date = $("#language_date" + (my_info6_count - 1)).val();
	//
	// 	if(!lc_name_txt ) {
	// 		alert("언어를 입력/선택해주세요.");
	// 		$("#lc_name_txt").focus();
	// 		return;
	// 	}
	//
	// 	if(!lc_d_name_txt) {
	// 		alert("시험명을 입력/선택해주세요.");
	// 		$("#lc_d_name_txt").focus();
	// 		return;
	// 	}
	//
	// 	if(!score) {
	// 		alert("점수를 입력해주세요.");
	// 		$("#score").focus();
	// 		return;
	// 	}
	//
	// 	if(!language_date) {
	// 		alert("취득날짜를 입력해주세요.");
	// 		$("#language_date").focus();
	// 		return;
	// 	}
	//}

	html += '<div class="added_card border rounded position-relative rounded-0 rounded-top container py-0 pb-1 py-md-3 pt-sm-3 pb-sm-0" id="language_div' + my_info6_count + '">';
	html += '<a class="position-absolute" style="right:10px; top:10px;" id="language_del'+ my_info6_count +'" onclick="javascript:my_info6_del1('+ my_info6_count +')"><i class="xi-close"></i></a>';
	html += '<div class="row pb-2 px-2">';
	html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">언어</h6>';
	html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
	html += '<input type="text" class="form-control" id="lc_name_txt'+ my_info6_count +'" name="lc_name_txt'+ my_info6_count +'" value="<?=$language_arr[0]["lc_name"]?>">';
	html += '<select class="form-control" id="lc_name'+ my_info6_count +'" name="lc_name'+ my_info6_count +'" onchange="javascript:languageChange(this.value,'+ my_info6_count +')">';
 	html += '<?= $language_select_tag ?>';
	html += '</select></div>';
	html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">시험명</h6>';
	html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
	html += '<input type="text" class="form-control" id="lc_d_name_txt'+ my_info6_count +'" name="lc_d_name_txt'+ my_info6_count +'" value="<?=$d_language_arr[0]["lc_d_name"]?>">';
	html += '<select class="form-control" id="lc_d_idx'+ my_info6_count +'" name="lc_d_idx'+ my_info6_count +'" onchange="javascript:d_languageChange(this.value,'+ my_info6_count +');">';
	html += '<?= $d_language_select_tag?>';
	html += '</select></div>';
	html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">점수</h6>';
	html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
	html += '<input type="text" class="form-control" id="score'+ my_info6_count +'"/>';
	html += '<div class="input-group-append">';
	html += '<span class="input-group-text">점(급)</span>';
	html += '</div></div>';
  html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">취득날짜</h6>';
	html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2 mt-sm-3">';
	html += '<input type="text" class="form-control" id="language_date'+ my_info6_count +'"/>';
	html += '</div></div></div>';

	$("#my_info6_2").append(html);
	my_info6_count++;
	$('#my_info6_count').val(my_info6_count);
}

function my_info6_del1(idx) {

	// if(my_info6_count - 1 != idx) {
	// 	idx *= 1;
	// 	var node1 = "language_hr" + (idx + 1);
	// 	document.getElementById("my_info6_2").removeChild(document.getElementById(node1));
	// } else if(my_info6_count - 1 == idx && idx > 0) {
	// 	idx *= 1;
	// 	var node1 = "language_hr" + idx;
	// 	document.getElementById("my_info6_2").removeChild(document.getElementById(node1));
	// }

	var node1 = "language_div" + idx;
	document.getElementById("my_info6_2").removeChild(document.getElementById(node1));

	idx *= 1;

	for(var i = idx; i < my_info6_count - 1; i++) {
		document.getElementById("language_div" + (i + 1)).id = "language_div" + i;
		document.getElementById("language_del" + (i + 1)).id = "language_del" + i;
		$("#language_del" + i).removeAttr("onclick");
		$("#language_del" + i).attr("onclick", "javascript:my_info6_del1(" + i + ");");

		document.getElementById("lc_name_txt" + (i + 1)).id = "lc_name_txt" + i;
		document.getElementById("lc_name_txt" + i).name = "lc_name_txt" + i;

		document.getElementById("lc_name" + (i + 1)).id = "lc_name" + i;
		document.getElementById("lc_name" + i).name = "lc_name" + i;
		$("#lc_name" + i).removeAttr("onchange");
		$("#lc_name" + i).attr("onclick", "javascript:languageChange(this.value, '" + i + "');");

		document.getElementById("lc_d_name_txt" + (i + 1)).id = "lc_d_name_txt" + i;
		document.getElementById("lc_d_name_txt" + i).name = "lc_d_name_txt" + i;

		document.getElementById("lc_d_idx" + (i + 1)).id = "lc_d_idx" + i;
		document.getElementById("lc_d_idx" + i).name = "lc_d_idx" + i;
		$("#lc_d_idx" + i).removeAttr("onchange");
		$("#lc_d_idx" + i).attr("onclick", "javascript:d_languageChange(this.value, '" + i + "');");

		document.getElementById("score" + (i + 1)).id = "score" + i;

		// document.getElementById("language_date" + (i + 1)).id = "language_date" + i;
		// $("#language_date" + i).removeAttr("onclick");
		// $("#language_date" + i).attr("onclick", "javascript:click_datepicker('#language_date" + i + "');");

		// if(i + 2 < my_info6_count) {
		// 	document.getElementById("language_hr" + (i + 2)).id = "language_hr" + (i+1);
		// }
	}

	if(my_info6_count - 1 == 0) {
		my_info6_count = 0
	} else {
		my_info6_count -= 1;
	}

	$('#my_info6_count').val(my_info6_count);

}

	function languageChange(value,idx) {
		$("#lc_name_txt" + idx).val(value);

		var params = {};
		params["value"] = value;

		exec_json("technician.language_detail_cate",params,function(ret_obj){
				$("#lc_d_name_txt" + idx).val("");
				$("#lc_d_idx" + idx).html(ret_obj.message);
				$("#lc_d_name_txt" + idx).val($("#lc_d_idx" + idx + " option:selected").text());
		});
	}

	function d_languageChange(value, idx) {
		$("#lc_d_name_txt" + idx).val(value);
	}

	function click_email(email) {
	  $("#m_email2").val(email);
	}

	function salary_select_change(obj){
		$("#job_salary").removeAttr("style");
		$("#salary").show();
		$("#salary_text").show();
		switch (obj.value) {
      case '0' :
	      $("#salary_text").find('span').html("회사 내규에 따름");
      break;
			case '1':
			case '2':
        $("#salary_text").find('span').html("만원 이상");
			break;
			case '3':
			case '4':
	      $("#salary_text").find('span').html("원 이상");
			break;
			default:
			$("#job_salary").attr("style", "width:100%");
			$("#salary_text").hide();
			$("#salary").css("display","none");
			$("#salary").val("");
		}
}

	// 자격증리스트 자동완성 기능
	var certificate_list = <?= json_encode($certificate_list) ?>;
	function certificateAutocomplete() {
		$("input[name=h_certificate]").autocomplete({
			source: certificate_list
		});
	}


	//고등학교 선택시 학점 숨김
	//고등학교 제외, 검정고시 숨김
	function school_changed(index){
		if($('#s_idx'+index).val() == 1){
			$('#grade'+index).css("display","none");
			$('#school_grade_title'+index).css("display","none");
			$('#ged'+index).css("display","flex");
		}
		else{
			$('#grade'+index).css("display","flex");
			$('#school_grade_title'+index).css("display","block");
			$('#ged'+index).css("display","none");
		}
	}


	function resume_success(){
		var a_line_self = $("#a_line_self").val();
		var place_holder = "<?=$rand_array[0]?>";
		var m_idx	=	<?=$m_idx?>;
		var m_name =	$("#m_name").val();
		var m_human	=	$("#m_human option:selected").val();
		var m_birthday	=	$("#m_birthday").val();
		var m_birth_ck1 = m_birthday.substring(0,4);
		var m_birth_ck2 = m_birthday.substring(0,1);
		var m_email	=	$("#m_email1").val() + "@" + $("#m_email2").val();
		var m_phone =	$("#m_phone1").val() + "-" + $("#m_phone2").val() + "-" + $("#m_phone3").val();
		var m_address	=	$("#address").val();
		var m_address2	=	$("#address2").val();
		var desired_salary_select = $("#job_salary option:selected").val();
		var desired_salary_input = $("#salary").val();
		var local_select = $("#local_select option:selected").val();
		var city_select = ($("#city_select option:selected").val()) ? $("#city_select option:selected").val():-1;
		var district_select = ($("#district_select option:selected").val()) ? $("#district_select option:selected").val():-1;
		var occupation_select = $("#occupation_select option:selected").val();
		var duty_o_arr = new Array(duty_field_arr.length);
		var duty_name_arr = new Array(duty_field_arr.length);
		for(var i = 0; i < duty_field_arr.length; i++){
			duty_o_arr[i] = duty_field_arr[i]["o_idx"];
			duty_name_arr[i] = duty_field_arr[i]["duty_name"];
		}
		var about_me	=	$("#about_me").val();

		if($("#m_phone1").val() == "전화번호 선택") {
			alert("전화번호를 선택하세요.");
			$('#m_phone1').focus();
			return;
		}

		if($("#m_phone2").val() == '0000'){
			alert("올바른 전화번호를 입력해주세요.");
			$('#m_phone2').focus();
			return;
		}

		if($("#m_phone3").val() == '0000'){
			alert("올바른 전화번호를 입력해주세요.");
			$('#m_phone3').focus();
			return;
		}

		if(m_birth_ck1 == '0000' || m_birth_ck2 == '-'){
			alert("올바른 생년월일을 입력해주세요.");
			$('#m_birthday').focus();
			return;
		}

		if(a_line_self == ""){
			a_line_self = place_holder;
		}

		var params = {
			"m_idx" : m_idx,
			"m_name" : m_name,
			"m_human" : m_human,
			"m_birthday" : m_birthday,
			"m_email" : m_email,
			"m_phone" : m_phone,
			"m_address" : m_address,
			"m_address2" : m_address2,
			"desired_salary_select" : desired_salary_select,
			"desired_salary_input" : desired_salary_input,
			"local_select" : local_select,
			"city_select" : city_select,
			"district_select" : district_select,
			"occupation_select" : occupation_select,
			"duty_o_arr" : duty_o_arr,
			"duty_name_arr" : duty_name_arr,
			"about_me" : about_me,
			"my_info3_count" : my_info3_count,
			"my_info5_count" : my_info5_count,
			"my_info6_count" : my_info6_count,
			"a_line_self" : a_line_self
		};

	var my_info3_json = {};
		for(var i = 0; i < my_info3_count; i++) {
			var s_idx				=	$("#s_idx" + i + " option:selected").val();
			var is_ged = 0;
			var school_name			=	$("#school_name" + i).val();
			var school_graduated	=	$("#school_graduated" + i).val() + "-01";
			var school_major		=	$("#school_major" + i).val();
			var school_grade		=	$("#school_grade" + i).val();
			var max_grade			=	$("#max_grade" + i).val();

			// 학점입력확인
			if($("#s_idx"+i).val() == 1){
				if($("#is_ged" + i).hasClass("xi-check-circle") == true) {
					is_ged = 1;
				}else{
					is_ged = 0;
				}
			}
			else if($("#school_grade"+i).val() == "" || $("#max_grade"+i).val() == ""){
				alert("학점을 입력하세요.");
				$("#school_grade"+i).focus();
				return;
			}

			var tmp = "var tmpA = {'s_idx" + i + "':'" + s_idx + "', 'is_ged" + i + "':'" + is_ged + "', 'school_name" + i + "':'" + school_name + "', 'school_graduated" + i + "':'" + school_graduated +
			          "', 'school_major" + i + "':'" + school_major + "', 'school_grade" + i + "':'" + school_grade + "', 'max_grade" + i + "':'" + max_grade + "'}";

			var json3 = {"s_idx":s_idx,"is_ged":is_ged,"school_name":school_name,"school_graduated":school_graduated,"school_major":school_major,"school_grade":school_grade,"max_grade":max_grade};
			my_info3_json[i] = json3;
			// eval(tmp);
			// $.extend(params, tmpA);
    }
		$.extend(params, {"my_info3_json":my_info3_json});

			var career_json = {};
				for(var i = 0; i < member_career_arr.length; i++) {
					var c_name				=	$("input[name=c_name]").eq(i).val();
					var c_position		=	$("input[name=c_position]").eq(i).val();
					var c_start_date	=	$("input[name=c_start_date]").eq(i).val() + "-01";
					var c_end_date		=	$("input[name=c_end_date]").eq(i).val() + "-01";
					var c_o_idx				= $("select[name=c_o_idx]").eq(i).val();
					var c_duty				= $("select[name=c_duty]").eq(i).val();
					var is_newcommer	=	0;
					var c_content			=	$("textarea[name=c_content]").eq(i).val();

					if($("#is_newcommer" + i).is(":checked") == true) {
						is_newcommer = 1;
					}

					var tmp = "var tmpA = {'c_name" + i + "':'" + c_name + "', 'c_position" + i + "':'" + c_position + "', 'c_start_date" + i + "':'" + c_start_date + "', 'c_end_date" + i + "':'" + c_end_date +
					                       "', 'c_o_idx" + i + "':'" + c_o_idx + "', 'c_duty" + i + "':'" + c_duty + "', 'is_newcommer" + i + "':'" + is_newcommer + "', 'c_content" + i + "':'" + c_content + "'}";

					var json = {"c_name":c_name, "c_position":c_position, "c_start_date":c_start_date, "c_end_date":c_end_date, "c_o_idx":c_o_idx, "c_duty":c_duty, "is_newcommer":is_newcommer, "c_content":c_content};
					career_json[i] = json;

				}
				$.extend(params, {"career_json":career_json});

			var my_info5_json = {};
				for(var i = 0; i < my_info5_count; i++) {
					var certificate_name	=	$("#certificate_name" + i).val();
					var certificate_date	=	$("#certificate_date" + i).val() + "-01";

					var tmp = "var tmpA = {'certificate_name" + i + "':'" + certificate_name + "', 'certificate_date" + i + "':'" + certificate_date +"'}";
					var json5 = {"certificate_name":certificate_name,"certificate_date":certificate_date};
					my_info5_json[i] = json5;
					//eval(tmp);
					//$.extend(params, tmpA);
				}
				$.extend(params, {"my_info5_json":my_info5_json});

				var my_info6_json = {};
				for(var i = 0; i < my_info6_count; i++) {
					var lc_name_txt			=	$("#lc_name_txt" + i).val();
					var lc_d_name_txt		=	$("#lc_d_name_txt" + i).val();
					var score				=	$("#score" + i).val();
					var language_date		=	$("#language_date" + i).val() + "-01";


					var tmp = "var tmpA = {'lc_name_txt" + i + "':'" + lc_name_txt + "', 'lc_d_name_txt" + i + "':'" + lc_d_name_txt + "', 'score" + i + "':'" + score + "', 'language_date" + i + "':'" + language_date + "'}";
					var json6 = {"lc_name_txt":lc_name_txt,"lc_d_name_txt":lc_d_name_txt,"score":score,"language_date":language_date};
					my_info6_json[i] = json6;
					// eval(tmp);
					// $.extend(params, tmpA);
				}
				$.extend(params, {"my_info6_json":my_info6_json});

			exec_json("technician.my_info_detail_edit",params,function(ret_obj){
				toastr.success(ret_obj.message);
				location.reload();
			});
		}

		$("#picture_upload").change(function(){
			readURL(this);

			var iframe = $('<iframe name="m_postiframe" id="m_postiframe" width=0 height=0 style="display:none"></iframe>');

			$('body').append(iframe);

			var form = $('#m_picture_form');
			form.attr("action", "/proc.php?act=technician.procFileUploadPicture");
			form.attr("method", "post");

			form.attr("encoding", "multipart/form-data");
			form.attr("enctype", "multipart/form-data");

			form.attr("target", "m_postiframe");
			form.attr("file", $('#picture_upload').val());
			form.submit();

			$("#m_postiframe").on('load',function () {
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

					// var formData = new FormData();
					// formData.append("uploadFile", $("#picture_upload")[0].files[0]);
					//
					// var params = {};
					// params["m_idx"] = 9245;
					// params["formData"] = formData;
					//
					// exec_json("member.my_picture_upload",params,function(ret_obj){
					//     toastr.success(ret_obj.message);
					//     document.location.reload();
					// });

				}
				reader.readAsDataURL(input.files[0]);
			}
		}


		$("#resume_upload").change(function(){
	    var iframe = $('<iframe name="postiframe_resume" id="postiframe_resume" width=0 height=0 style="display:none"></iframe>');

	    $('body').append(iframe);

	    var form = $('#theuploadform_resume');
	    form.attr("action", "/proc.php?act=technician.procFileUploadResume");
	    form.attr("method", "post");

	    form.attr("encoding", "multipart/form-data");
	    form.attr("enctype", "multipart/form-data");

	    form.attr("target", "postiframe_resume");
	    form.attr("file", $('#resume_upload').val());
	    form.submit();

	    $("#postiframe_resume").on('load',function () {
	        // alert("파일이 업로드 되었습니다.");
	        // location.reload();
	    });

	    return false;

	  });

		function ged_button(idx){
			jQuery('#ged'+idx).toggleClass('xi-check-circle-o');
			jQuery('#ged'+idx).toggleClass('xi-check-circle');
		}

		function m_picture_remove(m_idx){
			if(confirm("이미지가 삭제되며, 복구되지 않습니다.\n그래도 삭제하시겠습니까?") == true) {
				if(!m_idx) {
					return;
				}

				var params = {
					"m_idx" : m_idx
				}

				exec_json("technician.m_picture_remove",params,function(ret_obj){
					toastr.success(ret_obj.message);
					location.reload();
				});

			}
		}

</script>
<?php $footer_false = true; ?>
