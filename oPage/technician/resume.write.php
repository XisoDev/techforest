<?php

$m_idx = $_SESSION['LOGGED_INFO'];

//한줄자기소개
$a_line_self = $output->get('a_line_row');

//이력서 정보
$resume_row = $output->get('resume_row');

//급여리스트
$salary_list = $output->get('salary_list');

//지역리스트
$local_arr = $output->get('local_arr');
$city_arr = $output->get('city_arr');
$district_arr = $output->get('district_arr');

//직종리스트
$occupation_arr = $output->get('occupation_arr');

//직무리스트
$duty_arr = $output->get('duty_arr');

//학력리스트
$school_arr = $output->get('school_arr');

// 학교리스트 기본HTML
for($i = 0; $i < count($school_arr); $i++) {
	$s_idx	= $school_arr[$i]["s_idx"];
	$s_name	= $school_arr[$i]["s_name"];
	$school_select_tag .= "<option value=\\\"" . $s_idx . "\\\">" . $s_name . "</option>";
}

//나의 이력서 정보 조회 - 학력
$my_info3 = $output->get('my_info3');

//나의 이력서 정보 조회 - 희망직무
$my_duty = $output->get('my_duty');

//자격증리스트
$certificate_row = $output->get('certificate_row');
$certificate_list = array();
foreach($certificate_row as $val){
  array_push($certificate_list, $val['certificate_name']);
}

//한줄자기소개 랜덤 힌트
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

<section class="sub_visual d-none d-lg-block pb-2" style="background-image:url('<?=$no_auto_bg_url?>');">
    <h4 class="red"><?=$site_info->title?></h4>
    <p class="weight_normal text-secondary pb-0 my-0"><?=$site_info->desc?></h4></p>
    <p class="weight_lighter text-secondary pt-0 pb-2 my-0">기술자숲이 대신 작성해 드립니다.</h4></p>
    <a href="#" class="btn btn-danger">이력서파일 등록하기</a>
    <p class="red xs_content weight_lighter">*영업일 기준 1일 소요됩니다.</p>
</section>
<section class="bg-white">
    <div class="d-block d-lg-none">
        <div class="content_padding mt-4 pt-5 mb-0 pb-2">
            <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
            <h5 class="weight_normal">이력서 등록</h5>
        </div>
        <hr />
    </div>
    <div class="mt-0 pt-0">
        <div class="container">
            <div class="row col-md-10 col-lg-9 mx-md-auto mb-md-4 px-0 mx-0">
                <div class="col-12 mt-3 mt-lg-5 mx-0 px-0">
                    <h6 class="d-block d-lg-none">기본정보</h6>
                    <h4 class="d-none d-lg-block">기본정보</h4>
                </div>
                <div class="col-5 col-sm-4 col-lg-3 mx-auto px-auto">
                    <div class="position-relative">
                        <a class="position-absolute text-primary" style="right:0;top:0; font-size:28px;z-index:10;"><i class="xi-close-circle"></i></a>
                        <div class="avatar square mb-2" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                        </div>
                        <i class="xi-camera position-absolute text-white" style="right:0;bottom:0; font-size:28px;"></i>
                        <i class="xi-camera position-absolute text-secondary" style="right:1px;bottom:1px; font-size:26px;"></i>
                    </div>
                </div>
            </div>

            <div class="row col-md-10 col-lg-9 mx-md-auto mb-md-4 px-0 mx-0">
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>한줄자기소개</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <input type="text" class="form-control" value="<?=$a_line_self[0]['a_line_self']?>" placeholder="<?=$rand_array[0]?>" />
                </div>
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>이름</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <input type="text" class="form-control" id="m_name" value="<?=$resume_row[0]['m_name']?>"/>
                </div>
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>성별</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <select class="form-control" id="m_human">
                      <option value="M" <?if($resume_row[0]["m_human"] == "M") { echo "selected=\"selected\"";}?>>남자</option>
                      <option value="F" <?if($resume_row[0]["m_human"] == "F") { echo "selected=\"selected\"";}?>>여자</option>
                    </select>
                </div>
                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>생년월일</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <input type="text" class="form-control xiso_date" id="m_birthday" value="<?=date("Y-m-d", strtotime($resume_row[0]["m_birthday"]));?>" placeholder="" />
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>전화번호</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
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
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
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
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <div class="input-group mb-2 overflow-hidden rounded">
                        <input type="text" class="form-control" id="address"  value="<?=$resume_row[0]['m_address']?>" placeholder="주소검색" readonly>
                        <button type="button" class="btn btn-primary rounded-0" onclick="search_address()">검색</button>
                    </div>
                    <input type="text" class="form-control" id="address2" value="<?=$resume_row[0]['m_address2']?>" placeholder="상세주소">
                </div>

								<div id="wrap" style="display:none;border:1px solid;width:100%;height:50%;margin:5px 0;position:relative">
									<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
								</div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>희망급여</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <div class="input-group">
                        <select class="form-control" id="job_salary" onchange="salary_select_change(this)">
													<option value="0">회사내규에 따름</option>
                          <?php
                            foreach($salary_list as $val) {
                              if($val["salary_idx"] == $resume_row[0]["salary_idx"]) {
                                echo "<option value=\"" . $val["salary_idx"] . "\" selected=\"selected\">" . $val["salary_name"] . "</option>";
                              } else {
                                echo "<option value=\"" . $val["salary_idx"] . "\">" . $val["salary_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                        <input type="text" class="form-control" id="salary" style="width:50px;" maxlength="10" value="<?=$edit_row[0]["job_salary"]?>" onkeyup="onlyNumber(this)" />
                        <div class="input-group-append">
                            <span class="input-group-text" id="salary_text" style="font-size:12px;">만원 이상</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6>희망근무지</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
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
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
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
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                  <div id="duty_field" class="height_35" style="display:table-cell; vertical-align:middle"></div>

                    <!-- <span class="selected_item text-secondary xs_content" onclick="jQuery(this).remove();"><i class="xi-close-circle"></i> 기계/제조 관리직</span>
                    <span class="selected_item text-secondary xs_content" onclick="jQuery(this).remove();"><i class="xi-close-circle"></i> 주물사</span> -->
                    <div class="input-group mb-2 overflow-hidden rounded mt-2">
                        <select class="form-control" id="select_duty"></select>
                        <button type="button" class="btn btn-primary rounded-0" onclick="dutyAddItem($('#occupation_select').val(), $('#select_duty').val())">추가</button>
                    </div>
                </div>

                <div class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">
                    <h6 class="d-none d-sm-block">자기소개 및<br />경력 간단 요약</h6>
                    <h6 class="d-block d-sm-none bg-primary text-white text-center py-2">경력간단요약 및 자기소개</h6>
                </div>
                <div class="col-12 col-sm-9 mx-0 px-0 mb-2">
                    <textarea rows="3" class="form-control"></textarea>
                </div>

            </div>

            <div class="row col-md-10 col-lg-9 mx-md-auto mb-md-4 px-0 mx-0">
                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">학력</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <!-- <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a> -->
                        학력
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
									<div id="my_info3_2">
										<?php
											if(count($my_info3) == 0){?>
												<!-- <a class="" style="right:10px; top:10px;" ><i class="xi-close"></i></a> -->
												<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교구분</h6>
												<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
														<select class="form-control" id="s_idx0" name="s_idx0" onchange="school_changed(0)">
															<?
															for($j = 0; $j < count($school_arr); $j++) {
																if($my_info3[$i]["s_idx"] == $school_arr[$j]["s_idx"]) {
																	echo "<option value=\"" . $school_arr[$j]["s_idx"] . "\" selected=\"selected\">" . $school_arr[$j]["s_name"] . "</option>";
																} else {
																	echo "<option value=\"" . $school_arr[$j]["s_idx"] . "\">" . $school_arr[$j]["s_name"] . "</option>";
																}
															}
															?>
														</select>
														<div class="input-group-append" id="ged0">
																<span class="input-group-text">검정고시 <i class="xi-check-circle-o" onclick="jQuery(this).toggleClass('xi-check-circle-o'); jQuery(this).toggleClass('xi-check-circle')"></i></span>
														</div>
												</div>
												<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교명</h6>
												<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
													<input type="text" id="school_name"<?=$i?> class="form-control" placeholder="기술 고등학교"/>
													<input type="text" class="form-control" onclick="month_picker()" placeholder="졸업일자"/>
												</div>
												<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">전공</h6>
												<input type="text" class="form-control col-12 col-sm-9 mx-0 mb-2 mb-sm-0" placeholder="기계전공"/>
												<div class="input-group col-6 col-sm-9 mx-0 px-0 mb-2" id="grade0" style="visibility:hidden;">
													<input type="text" class="form-control text-center" id="school_grade<?=$idx?>" value="<?=$val['school_grade']?>" placeholder="학점"/>
													<div class="input-group-prepend">
														<span class="input-group-text">/</span>
													</div>
													<input type="text" class="form-control text-center" id="max_grade<?=$idx?>" value="<?=$val['max_grade']?>" placeholder="최대학점"/>
												</div>

											<? }else{
												foreach($my_info3 as $idx => $val){?>
												<div class="added_card border rounded position-relative rounded-0 rounded-top container py-3 pt-sm-3 pb-sm-0" id="my_info3_2">
												<div class="row content_padding">
													<a class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
													<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교구분</h6>
													<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
															<select class="form-control" id="s_idx<?=$idx?>" name="s_idx<?=$idx?>" onchange="school_changed(<?=$idx?>)">
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
																$is_ged_visible = "hidden";
																if($val["s_idx"] == 1){
																	$is_ged_visible = "visible";
																}
															?>
															<div class="input-group-append" id="ged<?=$idx?>" style="visibility:<?=$is_ged_visible?>">
																<? //검정고시면
																	if($val["s_idx"] == 1 || $val['is_ged'] == 1){?>
																		<span class="input-group-text">검정고시 <i class="xi-check-circle" onclick="jQuery(this).toggleClass('xi-check-circle-o');jQuery(this).toggleClass('xi-check-circle')"></i></span>
																<? }else if($val["s_idx"] == 1 || $val['is_ged'] == 0){ ?>
																		<span class="input-group-text">검정고시 <i class="xi-check-circle-o" onclick="jQuery(this).toggleClass('xi-check-circle-o');jQuery(this).toggleClass('xi-check-circle')"></i></span>
																<? } ?>
															</div>
													</div>
													<h6 class="col-6 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교명</h6>
													<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
														<input type="text" class="form-control" id="school_name<?=$idx?>"  value="<?=$val['school_name']?>" placeholder="학교명"/>
													</div>
													<h6 class="col-6 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">졸업연도</h6>
													<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
														<input type="text" class="form-control" id="school_name<?=$idx?>" value="<?=$val['school_graduated']?>" placeholder="졸업연도"/>
													</div>

														<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">전공</h6>
														<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
															<input type="text" class="form-control" id="school_major<?=$idx?>" value="<?=$val['school_major']?>" placeholder="전공"/>
														</div>
														<?
															$is_grade_visible = "hidden";
															if($val["s_idx"] != 1){
																$is_grade_visible = "visible";
															}
														?>
													<h6 class="col-6 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0" id="school_grade_title" style="visibility:<?=$is_grade_visible?>;">학점</h6>

													<div class="input-group col-6 col-sm-9 mx-0 px-0 mb-2" id="grade<?=$idx?>" style="visibility:<?=$is_grade_visible?>;">
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
                        <button class="my-3 d-sm-inline-block d-none btn btn-warning" onclick="javascript:my_info3_add();">학력 추가하기</button>
                    </div>
                    <button class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom" onclick="javascript:my_info3_add();">학력 추가하기</button>


                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">경력</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        경력
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3 pb-sm-0">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <div class="row content_padding">
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">기업명</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder="기술 주식회사"/>
                                <input type="text" class="form-control" placeholder="직위(직급) 입력"/>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">직종</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <select class="form-control">
                                    <option>기계/제조</option>
                                </select>
                                <select class="form-control">
                                    <option>직위(직급) 선택</option>
                                    <option>NCT</option>
                                </select>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">근무기간</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
    <!--                            date picker 쓰실거죠?-->
                                <input type="text" class="form-control" placeholder=""/>
                                <div class="input-group-append">
                                    <span class="input-group-text">~</span>
                                </div>
                                <input type="text" class="form-control" placeholder=""/>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">직무내용</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="my-3 d-sm-inline-block d-none btn btn-warning">경력 추가하기</a>
                    </div>
                    <a href="#" class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom">경력 추가하기</a>

                </div>

                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">자격증</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        자격증
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2" >
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3 pb-sm-0" id="my_info5_2">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <div class="row content_padding">
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">자격증명</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                              <input type="text" class="form-control" name="h_certificate" placeholder="자격증명"/>
                              <input type="text" class="form-control" placeholder="취득일자"/>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                      <button class="my-3 d-sm-inline-block d-none btn btn-warning" onclick="my_info5_add()">자격증 추가하기</button>
                    </div>
                    <button class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom" onclick="my_info5_add()">자격증 추가하기</button>

                </div>


                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">어학</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        어학
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="added_card border rounded position-relative rounded-0 rounded-top container py-3 pb-sm-0">
                        <a href="#" class="position-absolute" style="right:10px; top:10px;"><i class="xi-close"></i></a>
                        <div class="row content_padding">
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">언어</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <select class="form-control">
                                    <option>영어</option>
                                </select>

                                <select class="form-control">
                                    <option>영어</option>
                                </select>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">언어</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <select class="form-control">
                                    <option>TOEIC</option>
                                </select>

                                <select class="form-control">
                                    <option>TOEIC</option>
                                </select>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">점수</h6>
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder="990"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">점 (급)</span>
                                </div>
                            </div>
                            <h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">취득날짜</h6>
<!--                        datepicker -->
                            <div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">
                                <input type="text" class="form-control" placeholder=""/>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="my-3 d-sm-inline-block d-none btn btn-warning">어학 추가하기</a>
                    </div>
                    <a href="#" class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom">어학 추가하기</a>

                </div>


                <div class="col-12 px-sm-0">
                    <h6 class="d-block d-sm-none mt-3">관련서류 등록하기</h6>
                    <h5 class="d-none d-sm-block bg-light py-2 px-3 mt-2 mt-sm-4">
                        <a href="#" class="text-secondary pull-right"><i class="xi-angle-down"></i></a>
                        관련서류 등록하기
                    </h5>
                </div>
                <div class="col-12 mx-0 px-0 mb-2">
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-trash pull-right xi-2x"></i>
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-trash pull-right xi-2x"></i>
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-trash pull-right xi-2x"></i>
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="file_item border rounded py-2 px-2 mb-2">
                        <i class="xi-trash pull-right xi-2x"></i>
                        <i class="xi-download pull-right xi-2x"></i>
                        [이력서] ic_launcher_1024.png
                    </div>
                    <div class="text-center">
                        <a href="#" class="my-3 d-sm-inline-block d-none btn btn-warning">서류 추가하기</a>
                    </div>
                    <a href="#" class="d-sm-none d-inline-block btn btn-warning btn-block rounded-0 rounded-bottom">서류 추가하기</a>

                </div>

            </div>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-6 col-sm-4">
                    <input type="submit" class="btn btn-block btn-light border-primary text-primary btn-round btn-lg my-3" value="취소" />
                </div>
                <div class="col-6 col-sm-4">
                    <input type="submit" class="btn btn-block btn-primary btn-round btn-lg my-3" value="저장" />
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

	$(document).ready(function(){
		$("#job_salary").trigger('onchange');
		$("#occupation_select").change();
		loadDuty();
	});

  var local_arr = <?= json_encode($local_arr) ?>;
  var city_arr = <?= json_encode($city_arr) ?>;
  var district_arr = <?= json_encode($district_arr) ?>;

  function resume_success(){
    var a_line_self = $("#a_line_self").val();
    var place_holder = "<?=$rand_array[0]?>";
    var m_idx	=	<?=$m_idx?>;
    var m_name =	$("#m_name").val();
    var m_human	=	$("#m_human option:selected").val();
    var m_birthday	=	$("#m_birthday").val();
    var m_birth_ck1 = m_birthday.substring(0,4);
    var m_birth_ck2 = m_birthday.substring(0,1);
    var m_email	=	$("#m_email1").val() + "@" + $("#my_info_email1").val();
    var m_phone =	$("#m_phone1").val() + "-" + $("#m_phone2").val() + "-" + $("#m_phone3").val();
    var m_address	=	$("#m_address1").val();
    var m_address2	=	$("#m_address2").val();

    var desired_salary_select = $("#desired_salary_select option:selected").val();
    var desired_salary_input = $("#desired_salary_input").val();
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
  }

/*
* @brief 희망직무
*/
var duty_arr = <? echo json_encode($duty_arr); ?>;

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
  	span.innerHTML = new_value + '<img class="duty-btn-delete" src="../../img/close.png" alt="삭제" style="width:12px;margin:5px;" onclick="remove_item(this)" />';
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


  var my_info3_count = "<?if($my_info3){if(count($my_info3) == 0) { echo "0"; } else { echo count($my_info3); }} else { echo "0"; } ?>";
  var my_info5_count = "<?if($my_info5){if(count($my_info5) == 0) { echo "0"; } else { echo count($my_info5); }} else { echo "0"; } ?>";
  var my_info6_count = "<?if($my_info6){if(count($my_info6) == 0) { echo "0"; } else { echo count($my_info6); }} else { echo "0"; } ?>";


	//학력추가하기
  function my_info3_add() {
    var html = "";
    if(my_info3_count != 0) {
      var is_ged = $("#is_ged" + (my_info3_count - 1)).is(":checked");
      var school_name = $("#school_name" + (my_info3_count - 1)).val();

      // if(!is_ged && !school_name) {
      //   alert("학교명 입력 해주세요.");
      //   $("#school_name").focus();
      //   return;
      // }

      // html += "<hr id=\"school_hr" + my_info3_count + "\" />";
			html += '<div class="added_card border rounded position-relative rounded-0 rounded-top container py-3 pt-sm-3 pb-sm-0">';

				html += '<div class="row content_padding">';
			html += '<a class="position-absolute" style="right:10px; top:10px;" onclick="javascript:my_info3_del1(' + my_info3_count + ')"><i class="xi-close"></i></a>';
			html += '<div class="row content_padding" id="my_info3_2">';
			html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교구분</h6>';
			html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">';
			html += '<select class="form-control" id="s_idx'+ my_info3_count + '"name="s_idx'+ my_info3_count + '"onchange="school_changed(' +my_info3_count+ ')">';
			html += '<?= $school_select_tag ?>';
			html += '</select>';
			html += '<div class="input-group-append" id="ged'+ my_info3_count + '">';
			html += '<span class="input-group-text">검정고시 <i class="xi-check-circle-o"></i></span>';
			html += '</div>';
			html += '</div>';
			html += '<h6 class="col-6 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">학교명</h6>';
			html += '<h6 class="col-6 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">졸업연도</h6>';
			html += '<div class="input-group col-6 col-sm-9 mx-0 px-0 mb-2">';
			html += '<input type="text" id="school_name'+ my_info3_count + '"class="form-control" placeholder="학교명"/>';
			html += '</div>';
			html += '<div class="input-group col-6 col-sm-9 mx-0 px-0 mb-2">';
			html += '<input type="text" id="school_graduated'+ my_info3_count + '"class="form-control" onclick="javascript:click_datepicker("#school_graduated' + my_info3_count + ')" placeholder="졸업연도"/>';
			html += '</div>';
			html += '<h6 class="col-6 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">전공</h6>';
			html += '<h6 class="col-6 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0" id="school_grade_title" style="visibility:hidden;">학점</h6>';
			html += '<div class="input-group col-6 col-sm-9 mx-0 px-0 mb-2">';
			html += '<input type="text" id="school_major'+ my_info3_count + '"class="form-control" placeholder="전공"/>';
			html += '</div>';
			html += '<div class="input-group col-6 col-sm-9 mx-0 px-0 mb-2" id="grade'+ my_info3_count +'" style="visibility:hidden;">';
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
    }
  }

	function my_info5_add(){
		var html = "";

		html += '<a href="#" class="" id="certificate_del' + my_info5_count + '"style="right:10px; top:10px;"><i class="xi-close"></i></a>';
		html += '<div class="row content_padding">';
		html += '<h6 class="col-12 col-sm-3 text-sm-right pr-md-3 pr-sm-2 mt-3 mx-0 px-0">자격증명</h6>';
		html += '<div class="input-group col-12 col-sm-9 mx-0 px-0 mb-2">';
		html += '<input type="text" name="h_certificate" class="form-control" placeholder="자격증명"/>';
		html += '<input type="text" class="form-control" placeholder="취득일자"/>';
		html += '</div>';
		html += '</div>';

		$("#my_info5_2").append(html);
		my_info5_count++;
		$('#my_info5_count').val(my_info5_count);

		certificateAutocomplete();

	}


	function click_email(email) {
	  $("#m_email2").val(email);
	}

	function salary_select_change(obj){
		$("#job_salary").removeAttr("style");
		$("#salary").show();
		$("#salary_text").show();
		switch (obj.value) {
			case '1':
			case '2':
			document.getElementById('salary_text').innerHTML = "만원 이상";
			break;
			case '3':
			case '4':
			document.getElementById('salary_text').innerHTML = "원 이상";
			break;
			default:
			$("#job_salary").attr("style", "width:100%");
			$("#salary_text").hide();
			$("#salary").attr("display", "none");
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
			$('#grade'+index).css("visibility","hidden");
			$('#school_grade_title').css("visibility","hidden");
			$('#ged'+index).css("visibility","visible");
		}
		else{
			$('#grade'+index).css("visibility","visible");
			$('#school_grade_title').css("visibility","visible");
			$('#ged'+index).css("visibility","hidden");
		}
	}

</script>
<?php $footer_false = true; ?>
