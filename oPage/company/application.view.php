<?php
  $info_row = $output->get('app_info_row');
  $check_voucher = $output->get('check_voucher');
  $check_applicant = $output->get('check_applicant');
  $occupation_row = $output->get('occupation_row');
  $introduction_row = $output->get('introduction_row');
  $education_row = $output->get('education_row');
  $career_row = $output->get('career_row');
  $certificate_row = $output->get('certificate_row');
  $language_row = $output->get('language_row');
  $file_row = $output->get('file_row');
  $application_m_idx = $output->get('application_m_idx');

  $self_introduction = str_replace("\n", "<br />", $introduction_row[0]["self_introduction"]);
  $h_idx = $_REQUEST['h_idx'];
?>
<section class="p-3 mt-4 pt-5 bg-white d-lg-none">
    <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
    <h4 class="weight_normal">지원자정보 상세보기</h4>
</section>

<div class="container" style="position:relative; z-index:1;">

    <div class="col-lg-8 mx-md-auto px-0 px-md-3">
    <h4 class="d-none d-lg-block py-4 mt-md-5">기본정보</h4>
    <div class="p-2 pb-1 d-md-none pt-4">
        <h6>기본정보</h6>
        <div class="row">
            <div class="col-6 pb-0 my-0 pl-4 mx-auto">
              <?if(!$info_row[0]['m_picture']){?>
                <div class="avatar square" style="background-image:url('/layout/none/assets/images/no_avatar.png');"></div>
              <?}else{?>
<!--                  배경으로 수정해놓음 / by xiso-->
                  <div class="avatar square" id="my_picture" alt="picture" style="background-image:url('../../../img/<?=$info_row[0]['m_picture']?>');"></div>
              <?}?>
            </div>
        </div>
    </div>
    <div class="tech_card bg-white overflow-hidden pt-0 my-3 shadow">
        <span class="btn btn-block btn-warning mt-0 rounded-0 mb-3">
          <?=$info_row[0]['a_line_self']?>
        </span>
        <div class="row">
            <div class="d-none d-md-block col-md-1">
            </div>
            <div class="d-none d-md-block col-md-3 pt-3">
                <?if(!$info_row[0]['m_picture']){?>
                    <div class="avatar square" style="background-image:url('/layout/none/assets/images/no_avatar.png');"></div>
                <?}else{?>
                    <!--                  배경으로 수정해놓음 / by xiso-->
                    <div class="avatar square" id="my_picture" alt="picture" style="background-image:url('../../../img/<?=$info_row[0]['m_picture']?>');"></div>
                <?}?>
            </div>
            <div class="col-12 col-md-7 col-lg-8">
                <div class="px-3">
                <table class="table table-borderless table-vertical-middle table-sm" cellspacing="0" cellpadding="0">
                    <colgroup>
                        <col width="10">
                        <col width="70">
                        <col width="10">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">이름</th>
                        <td>:</td>
                        <td><?=$info_row[0]['m_name']?>
                            <?php
                            if($info_row[0]["m_human"] == "M") {
                                echo "[남자]";
                            } else if($info_row[0]["m_human"] == "F") {
                                echo "[여자]";
                            } else {
                                echo "";
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">생년월일</th>
                        <td>:</td>
                        <td><?= date("Y-m-d", strtotime($info_row[0]["m_birthday"])); ?></td>
                    </tr>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">주소</th>
                        <td>:</td>
                        <td><?=$info_row[0]['m_address']?> <?=$info_row[0]['m_address2']?></td>
                    </tr>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">희망급여</th>
                        <td>:</td>
                        <td><?
                            if(!empty($info_row[0]["desired_salary"]) || $info_row[0]["salary_idx"] == 0){
                                if($info_row[0]["salary_name"] == "연봉" || $info_row[0]["salary_name"] == "월급"){
                                    echo $info_row[0]['salary_name']." ".number_format($info_row[0]['desired_salary']). " 만원 이상";
                                }
                                else if($info_row[0]["salary_name"] == "일급" || $info_row[0]["salary_name"] == "시급"){
                                    echo $info_row[0]['salary_name']." ".number_format($info_row[0]['desired_salary']). " 원 이상";
                                }
                                else if($info_row[0]["salary_idx"] == 0){
                                    echo "회사내규에 따름";
                                }
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td><i class="xi-cog xxx_content"></i></td>
                        <th class="weight_bold">희망직종</th>
                        <td>:</td>
                        <td><?=$occupation_row[0]["o_name"]?></td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3 pt-md-4">
        <h5 class="p-2 d-none d-md-block bg-light">경력간단요약</h5>
        <span class=" d-md-none btn btn-block btn-light mt-0 rounded-0 mb-3">경력간단요약</span>
        <p class="px-3"><?=$self_introduction?></p>
    </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3 pt-md-4">
        <h5 class="p-2 d-none d-md-block bg-light">학력</h5>
        <span class=" d-md-none btn btn-block btn-light mt-0 rounded-0 mb-3">학력</span>
          <div class="px-3">
            <?php foreach ($education_row as $key => $val) {?>
              <?if($key != 0){?>
                <hr class="mx-4" />
              <?}?>
              <?php if($val['is_ged'] == 1){?>
                <table class="table table-borderless table-vertical-middle table-sm" cellspacing="0" cellpadding="0">
                  <colgroup>
                    <col width="10">
                    <col width="70">
                    <col width="10">
                    <col width="*">
                  </colgroup>
                  <tr>
                      <td><i class="xi-cog xxx_content"></i></td>
                      <th class="weight_bold">학교</th>
                      <td>:</td>
                      <td>검정고시</td>
                  </tr>
                </table>
              <?php }else{ ?>
                <table class="table table-borderless table-vertical-middle table-sm" cellspacing="0" cellpadding="0">
                    <colgroup>
                        <col width="10">
                        <col width="70">
                        <col width="10">
                        <col width="*">
                    </colgroup>
                <tr>
                    <td><i class="xi-cog xxx_content"></i></td>
                    <th class="weight_bold">학교</th>
                    <td>:</td>
                    <td><?=$val['school_name']?></td>
                </tr>
                <tr>
                    <td><i class="xi-cog xxx_content"></i></td>
                    <th class="weight_bold">졸업연도</th>
                    <td>:</td>
                    <td><?=substr($val["school_graduated"], 0, 7)?></td>
                </tr>
                <tr>
                    <td><i class="xi-cog xxx_content"></i></td>
                    <th class="weight_bold">전공</th>
                    <td>:</td>
                    <td><?=$val['school_major']?></td>
                </tr>
                <?php if($val['s_idx'] == 1){?>

                <?php }else{?>
                  <tr>
                      <td><i class="xi-cog xxx_content"></i></td>
                      <th class="weight_bold">학점</th>
                      <td>:</td>
                      <td><?=$val['school_grade']?> / <?=$val['max_grade']?></td>
                  </tr>
                <?php }?>
                </table>
              <?php }?>
            <?php } ?>
          </div>
      </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3 pt-md-4">
        <h5 class="p-2 d-none d-md-block bg-light">경력</h5>
        <span class=" d-md-none btn btn-block btn-light mt-0 rounded-0 mb-3">경력</span>
        <div class="px-3">
        <?php if(!$career_row){?>
          <table class="table table-borderless table-vertical-middle table-sm" cellspacing="0" cellpadding="0">
              <colgroup>
                  <col width="10">
                  <col width="70">
                  <col width="10">
                  <col width="*">
              </colgroup>
              <tr>
                  <td><i class="xi-cog xxx_content"></i></td>
                  <th class="weight_bold">경력</th>
                  <td>:</td>
                  <td>신입</td>
              </tr>
          </table>
        <?php }else{ ?>
        <?php foreach ($career_row as $key => $val) {?>
          <?if($key != 0){?>
            <hr class="mx-4" />
          <?}?>
          <table class="table table-borderless table-vertical-middle table-sm" cellspacing="0" cellpadding="0">
              <colgroup>
                  <col width="10">
                  <col width="70">
                  <col width="10">
                  <col width="*">
              </colgroup>
              <tr>
                  <td><i class="xi-cog xxx_content"></i></td>
                  <th class="weight_bold">기업명</th>
                  <td>:</td>
                  <td><?=$val['c_name']?> | <?=$val['c_position']?></td>
              </tr>
              <tr>
                  <td><i class="xi-cog xxx_content"></i></td>
                  <th class="weight_bold">기간</th>
                  <td>:</td>
                  <td><?=substr($val['c_start_date'],0,7)?> ~ <?=substr($val['c_end_date'],0,7)?></td>
              </tr>
              <tr>
                  <td><i class="xi-cog xxx_content"></i></td>
                  <th class="weight_bold">직무내용</th>
                  <td>:</td>
                  <td style="word-break:break-all"><?=str_replace("\n", "<br />", $val["c_content"])?></td>
              </tr>
          </table>
          <?php } ?>
        <?php } ?>
        </div>
    </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3 pt-md-4">
        <h5 class="p-2 d-none d-md-block bg-light">자격증</h5>
        <span class=" d-md-none btn btn-block btn-light mt-0 rounded-0 mb-3">자격증</span>
          <div class="px-3">
            <?php foreach ($certificate_row as $key => $val) {?>
              <?if($key != 0){?>
                <hr class="mx-4" />
              <?}?>
              <table class="table table-borderless table-vertical-middle table-sm" cellspacing="0" cellpadding="0">
                  <colgroup>
                      <col width="10">
                      <col width="70">
                      <col width="10">
                      <col width="*">
                  </colgroup>
                  <tr>
                      <td><i class="xi-cog xxx_content"></i></td>
                      <th class="weight_bold">자격증명</th>
                      <td>:</td>
                      <td><?=$val['certificate_name']?></td>
                  </tr>
                  <tr>
                      <td><i class="xi-cog xxx_content"></i></td>
                      <th class="weight_bold">취득날짜</th>
                      <td>:</td>
                      <td><?=substr($val['certificate_date'],0,7)?></td>
                  </tr>
              </table>
            <?php } ?>
          </div>
        </div>



    <div class="tech_card bg-white overflow-hidden pt-0 my-3 pt-md-4">
      <h5 class="p-2 d-none d-md-block bg-light">어학</h5>
      <span class=" d-md-none btn btn-block btn-light mt-0 rounded-0 mb-3">어학</span>
        <div class="px-3">
          <?php foreach ($language_row as $key => $val) {?>
            <?if($key != 0){?>
              <hr class="mx-4" />
            <?}?>
            <table class="table table-borderless table-vertical-middle table-sm" cellspacing="0" cellpadding="0">
                <colgroup>
                    <col width="10">
                    <col width="70">
                    <col width="10">
                    <col width="*">
                </colgroup>
                <tr>
                    <td><i class="xi-cog xxx_content"></i></td>
                    <th class="weight_bold">시험명</th>
                    <td>:</td>
                    <td><?=$val['lc_d_idx']?> | <?=$val['score']?></td>
                </tr>
                <tr>
                    <td><i class="xi-cog xxx_content"></i></td>
                    <th class="weight_bold">취득날짜</th>
                    <td>:</td>
                    <td><?=substr($val['language_date'],0,7)?></td>
                </tr>
            </table>
          <?php }?>
       </div>
    </div>

    <div class="tech_card bg-white overflow-hidden pt-0 my-3 pt-md-4">
        <h5 class="p-2 d-none d-md-block bg-light">관련서류보기</h5>
        <span class=" d-md-none btn btn-block btn-light mt-0 rounded-0 mb-3">관련서류보기</span>

        <div class="px-3">
            <table class="table table-borderless table-vertical-middle table-sm" cellspacing="0" cellpadding="0">
                <colgroup>
                    <col width="10">
                    <col width="*">
                    <col width="30">
                </colgroup>
                <?php foreach ($file_row as $val) {?>
                  <tr>
                      <td><i class="xi-cog xxx_content"></i></td>
                      <td>[<?=$val['file_type']?>] <?=$val['file_name']?></td>
                      <td>
                        <?  $file_name_sever = $val["file_name"];?>
                        <a href="../../../portfolio/<?=$file_name_sever?>" download="<?=$val['file_name']?>" title="<?=$val['file_name']?>">
                          <img src="/oPage/images/imgicons/download.png" height="16"/>
                        </a>
                      </td>
                  </tr>
                <?php }?>
            </table>
        </div>


    </div>

        <a href="<?=getUrl('technician','resume',$application_m_idx)?>" class="btn btn-block tech_card bg-primary btn-primary px-5 mb-3 d-md-none" target="_blank">이력서 전체보기</a>

        <div class="d-none d-md-block text-center">
            <a href="<?=getUrl('technician','resume',$application_m_idx)?>" class="btn btn-primary px-5 rounded-0" target="_blank">이력서 전체보기</a>
            <?php if(!$check_voucher){?>
                <button data-toggle="modal" data-target="#buy_voucher" class="btn btn-warning px-5 rounded-0">면접 제안하기</button>
            <?php }else if($check_applicant){?>
                <button class="btn btn-warning disabled px-5 rounded-0">면접제안 완료</button>
            <?php }else{?>
                <button data-toggle="modal" data-target="#suggestion_way" class="btn btn-warning px-5 rounded-0">면접 제안하기</button>
            <?php } ?>
        </div>
    </div>
</div>

<div class="d-md-none">
<?php if(!$check_voucher){?>
  <button data-toggle="modal" data-target="#buy_voucher" class="btn btn-block btn-warning btn-lg rounded-0 fixed-bottom">면접 제안하기</button>
<?php }else if($check_applicant){?>
  <button class="btn btn-block btn-warning btn-lg rounded-0 fixed-bottom disabled">면접제안 완료</button>
<?php }else{?>
  <button data-toggle="modal" data-target="#suggestion_way" class="btn btn-block btn-warning btn-lg rounded-0 fixed-bottom">면접 제안하기</button>
<?php } ?>
</div>

<div class="modal fade" id="suggestion_way" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#suggestion_way').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding">
                <h5 class="weight_lighter"><span class="red">면접 요청방법</span>을<br />선택 해 주세요.</h5>
                <div class="px-3">
                  <button onclick="prepare()" class="btn btn-block btn-danger btn-round mt-3">문자메세지 발송</button>

                  <!-- <button onclick="jQuery('#suggestion_way').modal('hide');jQuery('#interview_sms').modal('show');" class="btn btn-block btn-danger btn-round mt-3">문자메세지 발송</button> -->
<!--                    이렇게 쓰시면 미리 내용을 채워서 공고등록자 휴대전화로 바로 문자전송가능-->
<!--                <a class="btn btn-block btn-danger btn-round mt-3" href="sms:+821057595999&amp;body=%EA%B8%B0%EC%88%A0%EC%9E%90%EC%88%B2%20%EC%A7%80%EC%9B%90%EC%9E%90%EB%8B%98%EA%BB%98%20%EB%A9%B4%EC%A0%91%EC%9A%94%EC%B2%AD%20%EB%93%9C%EB%A6%BD%EB%8B%88%EB%8B%A4.">문자메세지 발송</a>-->
                <?if($isMobile == true){?>
                  <a class="btn btn-block border-danger text-danger btn-round mt-3" onclick="suggestion_call()" href="tel:+821057595999">지원자에게 직접 전화</a>
                <?}else{?>
                  <button onclick="suggestion_call()" class="btn btn-block border-danger text-danger btn-round mt-3">지원자에게 직접 전화</button>
                <?}?>
                </div>
            </div>
            <button class="mt-2 btn btn-block btn-light" onclick="jQuery('#suggestion_way').modal('hide');" style="border-radius:10px;">닫기</button>
        </div>
    </div>
</div>

<div class="modal fade" id="application_phone" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#application_phone').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding">
                <p>
                  <span class="red">
                    지원자 : <?=$info_row[0]['m_name']?><br>
                    ☎ <?=$info_row[0]['m_phone']?><br>
                  </span>
                  <span>
                    *면접정보 외 다른 목적으로<br>
                    개인정보를 이용할 수 없습니다.
                  </span>
                </p>
                <div class="px-3">
                <button class="btn btn-block border-danger text-danger btn-round mt-3" onclick="jQuery('#application_phone').modal('hide');">닫기</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="buy_voucher" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#buy_voucher').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding">
                <p>
                  공고등록권을 구매 후 해당 지원자에게<br>
                  <b>면접 요청</b>을 하실 수 있습니다.<br>
                </p>
                <h5 class="weight_lighter"><span class="red">공고등록권을 구매</span>하시겠습니까?</h5>
                <div class="px-3">
                <button onclick="jQuery('#buy_voucher').modal('hide');document.location.href='<?=getUrl('company','service',4,array(num=>$document_srl,h_idx=>$h_idx))?>'" class="btn btn-block btn-danger btn-round mt-3">구매하기</button>
                <button class="btn btn-block border-danger text-danger btn-round mt-3" onclick="jQuery('#buy_voucher').modal('hide');">아니오</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="interview_suggestion" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#interview_suggestion').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding">
                <p>
                  잔여 면접제안권 <span class="red"><?=$check_voucher[0]['max_remain_count']?>회</span><br>
                  <b>해당 지원자에게 면접제안을 하시겠어요?</b>
                </p>
                <div class="px-3">
                <button onclick="suggestion_yes()" class="btn btn-block btn-danger btn-round mt-3">네</button>
                <button class="btn btn-block border-danger text-danger btn-round mt-3" onclick="jQuery('#interview_suggestion').modal('hide');">아니오</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <div class="modal fade" id="interview_sms" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center" style="border-radius:10px;">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#interview_sms').modal('hide');jQuery('#suggestion_way').modal('show');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding" style="overflow-y: scroll; max-height:450px;">
                <h4 class="weight_lighter red">면접 제안하기</h4>
                <form method="post" action="/proc.php?act=" class="text-left">

                    <label class="mt-3">공고명</label>
                    <input type="text" class="form-control" value="PCL 및 로봇제어 기술자분 모집" />

                    <label class="mt-3">면접일시</label>
                    <input type="text" class="form-control xiso_date mb-1" />
                    <div class="row">
                        <div class="col-6 pr-1">
                            <select class="form-control"><option value="">오전 08시</option></select>
                        </div>
                        <div class="col-6 pl-1">
                            <select class="form-control"><option value="">30분</option></select>
                        </div>
                    </div>

                    <label class="mt-3">면접장소</label>
                    <div class="input-group mb-1">
                        <input type="text" class="form-control" />
                        <button class="btn btn-danger rounded-0">검색</button>
                    </div>
                    <input type="text" class="form-control" value="상세주소 입력" />

                    <label class="mt-3">면접시 지참 서류</label>
                    <div class="input-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="none">
                            <label class="custom-control-label" for="none">없음</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="none">
                            <label class="custom-control-label" for="none">신분증</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="none">
                            <label class="custom-control-label" for="none">이력서</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="none">
                            <label class="custom-control-label" for="none">기타</label>
                        </div>
                    </div>
                    <input type="text" class="form-control" placeholder="기타서류를 입력 해 주세요"/>

                    <label class="mt-3">발신번호</label>
                    <input type="text" class="form-control" placeholder="- 없이 숫자만 입력" />

                    <label class="mt-3">발신번호 인증</label>
                    <div class="input-group mb-1">
                        <input type="text" class="form-control" />
                        <button class="btn btn-danger rounded-0">인증</button>
                    </div>

                    <button class="btn btn-block btn-danger btn-round mt-3">문자메세지 발송</button>
                </form>
            </div>
            <button class="mt-2 btn btn-block btn-light" onclick="jQuery('#interview_sms').modal('hide');jQuery('#suggestion_way').modal('show');" style="border-radius:10px;">취소</button>
        </div>
    </div>
</div> -->

<script type="text/javascript">
  //알림 숫자 초기화
  $('#notice_count')[0].innerText = <?=count($output->get("member_notice"));?>

  function prepare(){
    alert("죄송합니다. 서비스 준비중입니다.");
  }

  function suggestion_yes(){
    $('#interview_suggestion').modal('hide');
    $('#suggestion_way').modal('show');

    var params = {};
    exec_json("company.use_voucher",params,function(ret_obj){

    });
  }

  function suggestion_call(){

    //모바일버전이 아닐때, 전화번호 표시 모달창 열기
    if(<?=$isMobile?> == 0){
      $('#suggestion_way').modal('hide');
      $('#application_phone').modal('show');
    }

    var params = {};
    params["applicant_idx"] = <?=$info_row[0]["m_idx"]?>;
    params["c_idx"] = <?=$logged_info['c_idx']?>;
    params['h_idx'] = <?=$h_idx?>;

    exec_json("company.insert_interview_info",params,function(ret_obj){

    });
  }

</script>
<?php
//$footer_false = true;
?>
