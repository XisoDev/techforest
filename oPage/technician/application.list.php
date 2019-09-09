<?php

$application_letter = $output->get('application_letter');
$interest_rows = $output->get('interest_rows');

?>

<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">입사지원현황</h4>
    </div>
</section>
<div class="container pt-lg-5">

    <div class="row">
      <?php foreach($application_letter as $val) { ?>
        <input type="hidden" id="hidden_h_idx" value="<?=$val['h_idx']?>">
          <div class="col-12 col-md-4 px-md-2 pb-md-4">
              <div class="magazine tech_card mb-3 bg-white text-left shadow">
                  <div class="row">
                      <div class="col-5 col-md-12 px-0" style="background-color:#EEE;">
                          <div class="thumbnail mx-0 px-0" style="height:100%; background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                              <span class="overlay">
                                <?
                                  foreach ($interest_rows as $val2) {
                                    if($val2['h_idx'] == $val['h_idx']){
                                      $interest_html2 = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_remove('. $val['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart red" id="yes_interest"></i></a>';
                                      break;
                                    }else{
                                      $interest_html2 = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_add('. $val['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart" id="no_interest"></i></a>';
                                    }
                                  }
                                ?>
                                <?= $interest_html2 ?>
                              </span>
                          </div>
                      </div>
                      <? if ($val['city_name'] == "전체") { $val['city_name'] = "";} ?>
                      <? if ($val['district_name'] == "전체") { $val['district_name'] = ""; }?>
                      <? if ($val['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                      <div class="col-7 col-md-12 pl-0 pl-md-3">
                          <div class="content_padding">
                              <h6 class="weight_normal cut1"><?=$val['c_name']?></h6>
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
                              <p class="text-secondary xxs_content mx-0 px-0 pt-1">
                                  <img src="/oPage/images/imgicons/wrench_bg_red.png" height="14" /> <?=$val['job_is_career']?>
                              </p>
                          </div>

                          <div class="row m-0 p-0 pt-0 mt-0">
                              <div class="col-6 mx-0 px-0">
                                  <a href="<?=getUrl('technician','jobDetail',$val['h_idx'])?>" class="btn btn-light btn-block rounded-0">상세보기</a>
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
    </div>
</div>

<?php
$footer_false = true;
?>
