<?php
  $m_idx = $_SESSION['LOGGED_INFO'];

  //관심공고
  $interest_rows = $output->get('interest_rows');
  //맞춤공고리스트
  $hire_rows = $output->get('hire_rows');
  //지역리스트
  $local_list = $output->get('local_list');
  //직종리스트
  $occupation_list = $output->get('occupation_list');
  //직무리스트
  $duty_list = $output->get('duty_list');
  //입사지원 현황
  $application_letter = $output->get('application_letter');
?>

<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">일자리 찾기</h4>
    </div>
</section>
<div class="container pt-lg-5">
    <div class="d-block d-lg-none pt-4 pb-2">
        <a href="<?=getUrl('technician','findJobList')?>" class="pull-right btn py-2 px-3 btn-primary btn-xxs btn-round">더보기 +</a>
        <h6>일자리 정보</h6>
    </div>
    <div class="d-none d-lg-block pt-4 pb-2">
        <a href="<?=getUrl('technician','findJobList')?>" class="pull-right btn mt-2 py-2 px-3 btn-primary btn-xs btn-round">더보기 +</a>
        <h4 class="mb-2">일자리 정보</h4>
    </div>

  <input type="hidden" id="hidden_m_idx" value="<?=$m_idx?>">
    <div class="flex-card-slick">
      <? $count_hire = (count($hire_rows) > 6) ? 6 : count($hire_rows); ?>
        <?php for($i=0; $i < $count_hire; $i++){ ?>
          <input type="hidden" id="hidden_h_idx" value="<?=$hire_rows[$i]['h_idx']?>">
            <div class="tech_card bg-white shadow">
                <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                  <span class="overlay">
                    <?
                      foreach ($interest_rows as $val2) {
                        if($val2['h_idx'] == $hire_rows[$i]['h_idx']){
                          $interest_html2 = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_remove('. $hire_rows[$i]['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart red" id="yes_interest"></i></a>';
                          break;
                        }else{
                          $interest_html2 = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_add('. $hire_rows[$i]['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart" id="no_interest"></i></a>';
                        }
                      }
                    ?>
                    <?= $interest_html2 ?>
                  </span>
                </div>
                <? if ($hire_rows[$i]['city_name'] == "전체") { $hire_rows[$i]['city_name'] = "";} ?>
                <? if ($hire_rows[$i]['district_name'] == "전체") { $hire_rows[$i]['district_name'] = ""; }?>
                <? if ($hire_rows[$i]['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                <div class="p-2 text-left pb-1">
                    <h6 class="cut1"><?=$hire_rows[$i]['c_name']?></h6>
                    <h6 class="red cut1"><?=$hire_rows[$i]['h_title']?></h6>
                    <p class="weight_lighter xxs_content mx-0 px-0">
                        <span class="badge badge-danger weight_lighter">위치</span>
                        <?= $hire_rows[$i]['local_name'] . " " . $hire_rows[$i]['city_name'].$hire_rows[$i]['district_name']?>
                        <span class="badge badge-danger weight_lighter">
                          <?if($hire_rows[$i]['salary_idx'] == "1"){
                              echo "연봉";
                            }else if($hire_rows[$i]['salary_idx'] == "2"){
                              echo "월급";
                            }else if($hire_rows[$i]['salary_idx'] == "3"){
                              echo "일급";
                            }else{
                              echo "시급";
                            }?>
                        </span>
                        <b><?= number_format($hire_rows[$i]['job_salary']) . $hire_salary_text?></b>
                    </p>
                    <p class="text-secondary xxs_content mx-0 px-0 pb-2">
                        <img src="/oPage/images/imgicons/wrench_bg_red.png" height="14" style="float:left" /> <?=$hire_rows[$i]['job_is_career']?>
                    </p>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-6 mx-0 px-0 border-right">
                        <a href="<?=getUrl('technician','jobDetail',$hire_rows[$i]['h_idx'])?>" class="btn btn-light btn-block rounded-0">상세보기</a>
                    </div>
                    <div class="col-6 mx-0 px-0">
                        <button class="btn btn-light btn-block rounded-0 red" onclick="application_ok(<?=$hire_rows[$i]['h_idx']?>)">지원하기</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="py-md-5 my-md-5">
    <div class="container">
        <div class="d-block d-lg-none pt-4 pb-2">
            <a href="<?=getUrl('technician','applicationList')?>" class="pull-right btn py-2 px-3 btn-primary btn-xxs btn-round">더보기 +</a>
            <h6>입사지원현황</h6>
        </div>
        <div class="d-none d-lg-block pt-4 pb-2">
            <a href="<?=getUrl('technician','applicationList')?>" class="pull-right btn mt-2 py-2 px-3 btn-primary btn-xs btn-round">더보기 +</a>
            <h4 class="mb-2">입사지원현황</h4>
        </div>
    <div class="row px-2">
    <?if(count($application_letter) > 0){?>
      <? $count_application_letter = (count($application_letter) > 2) ? 2 : count($application_letter); ?>
        <?php for($i=0; $i<$count_application_letter; $i++) { ?>
        <div class="col-12 col-md-6 px-md-4">
        <div class="magazine tech_card mb-3 bg-white text-left shadow">
            <div class="row px-0 mx-0">
                <div class="col-5 col-md-12 px-0 mx-0" style="background-color:#EEE;">
                    <div class="thumbnail d-block" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png');height:100%; min-height:170px;"
                         onmouseover="jQuery(this).find('div.overlay').removeClass('d-none');" onmouseout="jQuery(this).find('div.overlay').addClass('d-none');">
                    <div class="overlay">
                        <div class="overlay-content" style="width:100%; text-align:center;">
                            <?if($application_letter[$i]['isChecked'] == "Y"){?>
                            <a href="#" class="btn-round btn border-white text-white btn-xs">이력서 열람</a>
                            <p class="xxs_content"><?=substr($application_letter[$i]['check_date'],0,10);?><br /><?=substr($application_letter[$i]['check_date'],10);?></p>
                            <? }?>
                        </div>
                    </div>
                    </div>
                </div>
                <? if ($application_letter[$i]['city_name'] == "전체") { $application_letter[$i]['city_name'] = "";} ?>
                <? if ($application_letter[$i]['district_name'] == "전체") { $application_letter[$i]['district_name'] = ""; }?>
                <? if ($application_letter[$i]['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                <div class="col-7 col-md-12 pl-0 px-0">
                    <div class="py-2 px-3">
                        <h6 class="weight_normal pb-0 mb-0"><?=$application_letter[$i]['c_name']?></h6>
                        <h6 class="red pt-0 mt-0 cut1"><?=$application_letter[$i]['h_title']?></h6>
                        <hr class="py-1 px-0 m-0" />
                        <p class="weight_lighter xxs_content mx-0 px-0">
                            <span class="badge badge-danger weight_lighter">위치</span>
                            <?= $application_letter[$i]['local_name'] . " " . $application_letter[$i]['city_name'].$application_letter[$i]['district_name']?>
                            <span class="badge badge-danger weight_lighter">
                              <?if($application_letter[$i]['salary_idx'] == "1"){
                                  echo "연봉";
                                }else if($application_letter[$i]['salary_idx'] == "2"){
                                  echo "월급";
                                }else if($application_letter[$i]['salary_idx'] == "3"){
                                  echo "일급";
                                }else{
                                  echo "시급";
                                }?>
                            </span>
                            <b><?= number_format($application_letter[$i]['job_salary']) . $hire_salary_text?></b>
                            <br class="d-md-none" />
                            <img src="/oPage/images/imgicons/wrench_bg_red.png" height="14" /> <?=$application_letter[$i]['job_is_career']?>
                        </p>
                    </div>

                    <div class="row m-0 p-0 pt-0 mt-1">
                        <div class="col-6 mx-0 px-0">
                            <a href="<?=getUrl('technician','jobDetail',$application_letter[$i]['h_idx'])?>" class="btn btn-light btn-block btn-xs px-0 py-3 rounded-0">상세보기</a>
                        </div>
                        <div class="col-6 mx-0 px-0">
                              <button class="btn btn-danger btn-block btn-xs px-0 py-3 rounded-0" disabled>지원완료</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>
    <?php }else{ ?>
      <p>입사지원현황이 없습니다.</p>
    <?php } ?>
    </div>
    </div>
</div>
<div class="container pb-md-5">
    <div class="d-block d-lg-none pt-4 pb-2">
        <a href="<?=getUrl('technician','interest_list')?>" class="pull-right btn py-2 px-3 btn-primary btn-xxs btn-round">더보기 +</a>
        <h6>관심공고</h6>
    </div>
    <div class="d-none d-lg-block pt-4 pb-2">
        <a href="<?=getUrl('technician','interest_list')?>" class="pull-right btn mt-2 py-2 px-3 btn-primary btn-xs btn-round">더보기 +</a>
        <h4 class="mb-2">관심공고</h4>
    </div>

    <div class="flex-card-slick">
      <input type="hidden" id="hidden_m_idx" value="<?=$m_idx?>">
        <?php if(count($interest_rows) != 0){ ?>
          <?php foreach($interest_rows as $val){ ?>
            <div class="tech_card bg-white shadow">
                <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                    <span class="overlay">
                      <?
                        if($m_idx > 0) {
                          if(count($interest_rows) == 0) {
                            $interest_html = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_add('. $val['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart" id="no_interest"></i></a>';
                          } else {
                            if(count($interest_rows) > 0) {
                              $interest_html = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_remove('. $val['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart red" id="yes_interest"></i></a>';
                            } else {
                              $interest_html = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_add('. $val['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart" id="no_interest"></i></a>';
                            }
                          }
                        }else {

                      }
                    ?>
                    <?= $interest_html ?>
                    </span>
                </div>
                <? if ($val['city_name'] == "전체") { $val['city_name'] = "";} ?>
                <? if ($val['district_name'] == "전체") { $val['district_name'] = ""; }?>
                <? if ($val['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                <div class="text-left pb-1 p-2">
                    <h6 class="cut1"><?=$val['c_name']?></h6>
                    <h6 class="red cut1"><?=$val['h_title']?></h6>
                    <p class="weight_lighter xxs_content mx-0 px-0">
                    <span class="badge badge-danger weight_lighter">위치</span>
                      <?= $val['local_name'] . " " . $val['city_name'].$val['district_name']?>
                    <span class="badge badge-danger weight_lighter">
                      <?if($val['salary_idx'] == "1"){
                          echo "연봉";
                        }else if($val['salary_idx'] == "2"){
                          echo "월급";
                        }else if($val['salary_idx'] == "3"){
                          echo "일급";
                        }else{
                          echo "시급";
                        }?>
                    </span>
                      <b><?= number_format($val['job_salary']) . $hire_salary_text?></b>
                    </p>
                    <p class="text-secondary xxs_content mx-0 px-0 pb-2">
                        <img src="/oPage/images/imgicons/wrench_bg_red.png" height="14" style="float:left" /> <?=$val['job_is_career']?>
                    </p>
                </div>

                <div class="row m-0 p-0 mt-1">
                    <div class="col-6 mx-0 px-0">
                        <a href="<?=getUrl('technician','jobDetail',$val['h_idx'])?>" class="btn btn-light btn-block rounded-0">상세보기</a>
                    </div>
                    <div class="col-6 mx-0 px-0">
                        <button class="btn btn-light btn-block rounded-0 red" onclick="application_ok(<?=$val['h_idx']?>)">지원하기</button>
                    </div>
                </div>
            </div>
        <?php
            }
          }else{ ?>
            <div class="text-center py-5 bg-white rounded shadow-sm mx-auto">
                등록된 관심공고가 없습니다.
                <p class="xxs_content text-secondary">관심있는 공고를 등록 해 보세요 :)</p>
            </div>
       <? } ?>
    </div>
</div>

<div class="modal fade" id="check_phonenumber" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true" style="">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#check_phonenumber').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="content_padding">
                <h5 class="weight_lighter">기업측의 면접요청을 위해 <br> <span class="red">본인의 연락처가 맞는지</span><br>다시 한번 확인해주세요.</h5>
                <span class="red">─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─</span>
                <h5 class="weight_normal mb-2 mt-4 mb-3 red">☎ <?=$logged_info['m_phone']?></h5>
                <a class="btn btn-block btn-danger btn-round btn-lg mb-3" id="applicant_ok">네 맞습니다</a>
                <a class="btn btn-block border-danger btn-round btn-lg mb-3 red" href="<?=getUrl('member','myprofile')?>">연락처 수정하기</a>
            </div>
            <button class="mt-2 btn btn-block btn-light" onclick="jQuery('#check_phonenumber').modal('hide');" style="border-radius:10px;">닫기</button>
        </div>
    </div>
</div>



<script type="text/javascript">
function application_ok(h_idx){
  $('#check_phonenumber').modal('show');

  $('#applicant_ok').click(function(e) {
    var m_idx = <?=$m_idx?>;

    var params = {};
    params["h_idx"] = h_idx;
    params["m_idx"] = m_idx;

    exec_json("technician.application_letter_register",params,function(ret_obj){
        toastr.success(ret_obj.message);
        $('#check_phonenumber').modal('hide');
    });
 });
}
</script>
<?php
$footer_false = true;
?>
