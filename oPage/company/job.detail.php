<?php

$hire_info = $output->get('hire_info');
$h_certificate = $output->get('h_certificate');
$member_count = $output->get('member_count');

?>

<style media="screen">
  .col-no-8 {
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
    width: 66.666667%;
  }
  .col-no-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
    width: 33.33333%;
  }

</style>

<link rel="stylesheet" href="/layout/company/assets/default.css">

<section class="bg-white">
  <section class="p-3 mt-4 pt-5 bg-white d-lg-none">
      <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
      <h4 class="weight_normal">공고 상세보기</h4>
  </section>

<div class="container" style="position:relative; z-index:1;">
  <section class="max_width margin_auto inline_block width_100 padding_top_50_xs_null">
  			<div class="col-md-8 padding_5_xs_null align_left float_left width_100">
  				<div class="padding_5 border1_xs_null">
  					<div class="padding_20">
  						<table>
  							<tr>
                  <?
                  if(!$hire_info[0]['image']) {
                      $img_url = "/layout/none/assets/images/no_company.png";
                  }else {
                      $img_url = "../../company_logo/" . $hire_info[0]['image'];
                  }
                  ?>
  								<td>
                    <img class="rectangle_70" src="<?=$img_url?>" alt="기업로고사진">
                  </td>
  								<td class="padding_left_10 line_height_15">
                    <strong style="font-size: 20px;"><?=$hire_info[0]['c_name']?></strong><br>
                    <?=$hire_info[0]['address']?> <?=$hire_info[0]['address2']?>
                  </td>
  							</tr>
  						</table>
  					</div>
  				</div>

          <div class="padding_5 border1_not_top_xs_null">
  					<div class="padding_20">
  						<table class="width_100" style="line-height: 1.7;">
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">공고제목</td>
  								<td class=" col-no-8 padding_0"><?=$hire_info[0]["h_title"]?></td>
  							</tr>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">직종</td>
  								<td class=" col-no-8 padding_0"><?=$hire_info[0]["hire_o_name"]?></td>
  							</tr>
  							<? if($hire_info[0]['duty_name']){ ?>
  								<tr class="height_45">
  									<td class=" col-no-4 padding_0" style="font-weight: bold;">직무</td>
  									<td class=" col-no-8 padding_0"><?=$hire_info[0]['duty_name']; ?></td>
  								</tr>
  							<? } ?>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">직무상세내용</td>
  								<td class=" col-no-8 padding_0"><?=$hire_info[0]["job_description"]?></td>
  							</tr>
  							<? if(count($h_certificate) > 0) {
  								for($i=0, $len = count($h_certificate); $i < $len; $i++){ ?>
  								<tr class="height_45">
  									<td class=" col-no-4 padding_0" style="font-weight: bold;">
  										<? echo ($i==0) ? "필요자격증":""; ?>
  									</td>
  									<td class=" col-no-8 padding_0"><?=$h_certificate[$i]['certificate_name']?></td>
  								</tr>
  								<? }
  							} ?>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">급여</td>
  								<td class=" col-no-8 padding_0">
  								<?
  								if (is_numeric($hire_info[0]['job_salary']) ){
  									if($hire_info[0]["salary_idx"] == 1 || $hire_info[0]["salary_idx"] == 2){
  										echo $hire_info[0]["salary_name"] . " " . number_format($hire_info[0]["job_salary"]) . "만원";
  									}
  									else if($hire_info[0]["salary_idx"] == 3 || $hire_info[0]["salary_idx"] == 4){
  										echo $hire_info[0]["salary_name"] . " " . number_format($hire_info[0]["job_salary"]) . "원";
  									}
  								}else{
  									echo $hire_info[0]['job_salary'];
  								}
  								?>
  								</td>
  							</tr>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">신입/경력</td>
  								<td class=" col-no-8 padding_0"><?=$hire_info[0]["job_is_career"]?></td>
  							</tr>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">학력</td>
  								<td class=" col-no-8 padding_0"><?=$hire_info[0]["job_achievement"]?></td>
  							</tr>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">근무형태</td>
  								<td class=" col-no-8 padding_0"><?=$hire_info[0]["w_name"]?></td>
  							</tr>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">근무지역</td>
  								<?
  								$hire_location = $hire_info[0]["local_name"];
  								if($hire_info[0]["city_name"] != "전체") {
  									$hire_location .= " " . $hire_info[0]["city_name"];
  								} else if($hire_info[0]["district_name"] != "전체") {
  									$hire_location .= " " . $hire_info[0]["district_name"];
  								}
  								?>
  								<td class=" col-no-8 padding_0"><?=$hire_location?></td>
  							</tr>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">공고시작</td>
  								<td class=" col-no-8 padding_0"><?=substr($hire_info[0]["job_start_date"],0, 10)?></td>
  							</tr>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">공고종료</td>
  								<td class=" col-no-8 padding_0"><?=substr($hire_info[0]["job_end_date"], 0, 10)?></td>
  							</tr>
  							<tr class="height_45">
  								<td class=" col-no-4 padding_0" style="font-weight: bold;">담당자 및 기타정보</td>
  								<td class=" col-no-8 padding_0"><? echo str_replace("\n", "<br />" , $hire_info[0]["job_manager"]);?></td>
  							</tr>
  						</table>
  					</div>
  				</div>
  				<div class="d-none padding_20"></div>
  				<div class="d-md-none padding_5 height_20" style="border-top: 1px solid #ddd;"></div>


  				<? if($logged_info['is_commerce'] == 'Y') {
  						if($hire_info[0]["m_idx"] == $m_idx) {?>
  							<div class="d-md-none padding_5 border1_not_top_xs_null font_size_20 align_center padding_top_30 padding_bottom_30">
                  <span>총<strong><?=$hire_info[0]["letter_count"]?>명</strong>의 지원자가 있습니다.</span>
                  <a href="<?=getUrl('company','job',$hire_info[0]['h_idx']);?>">
                    <button class="width_60 btn button1 margin_auto block" style="font-size: 19px;" >
                      <strong>지원자보기</strong>
                    </button>
                  </a>

                  <a href="<?=getUrl('company','job_appRegister',$hire_info[0]['h_idx']);?>">
                    <button class="width_60 btn button1" style="background: #777; font-size: 19px;">
                      <!-- <img class="rectangle_30 margin_right_5" src="./img/icon_025.png" alt="공고수정" style="margin-top: -5px;" /> -->
                      <strong>공고수정</strong>
                    </button>
                  </a>
  							</div>
  					<?	}

          }?>
  			</div>


  			<div class="d-none d-md-block col-md-4 padding_5 float_left">

  				<?
  					if($logged_info['is_commerce'] == 'Y') {
  						if($hire_info[0]["m_idx"] == $m_idx) {
  							$hire_info[0]["letter_count"] -= $member_count[0]['cnt'];?>
  							  <div class="padding_15 border1_xs_null font_size_20">
  								<span>총<strong><?=$hire_info[0]["letter_count"]?>명</strong>의 지원자가 있습니다.</span>
  								<a href="<?=getUrl('company','job',$hire_info[0]['h_idx']);?>">
  									<button class="btn button1" style="font-size: 19px;" >
  										<strong>지원자보기</strong>
  									</button>
  								</a>
  								<a href="<?=getUrl('company','job_appRegister',$hire_info[0]['h_idx']);?>">
  									<button class="btn button1" style="background: #777; font-size: 19px;">
  										<!-- <img class="rectangle_30 margin_right_5" src="./img/icon_025.png" alt="공고수정" style="margin-top: -5px;"> -->
  										<strong>공고수정</strong>
  									</button>
  								</a>
                </div>
  						<?}

  					}?>

  				<!-- <div class="padding_15 border1_xs_null font_size_20 margin_top_20 align_left">
              광고배너들어감
  				</div> -->
  			</div>
  		</section>
    </div>
  </section>




<script type="text/javascript">
  //알림 숫자 초기화
  $('#notice_count')[0].innerText = <?=count($output->get("member_notice"));?>

</script>
<?php
$footer_false = true;
?>
