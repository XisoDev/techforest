<?php
$m_idx = $_SESSION['LOGGED_INFO'];
$hire_info = $output->get('hire_info');
$h_certificate = $output->get('h_certificate');
$member_count = $output->get('member_count');
?>
<link rel="stylesheet" href="/layout/company/assets/default.css">
<link rel="stylesheet" href="/layout/none/vendor/bootstrap/bootstrap.min.css">

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
          <!-- <img class="rectangle_60" src="/oPage/images/imgicons/arrow_left.png" alt="관심" /> -->
          <?if($logged_info['is_commerce'] == 'Y'){?>
          <?}else{?>
            <div class="d-md-none padding_5 border1_not_top_xs_null">
    					<div class="padding_20">
    						<?
    							if($m_idx > 0) {
    								if($hire_info[0]["interest_count"] > 0) {?>

    									<a class="inline_block" id="click_interest2"><img class="rectangle_60" src="./company/images/icon_001.png" alt="관심" /><input type="hidden" value="<?=$hire_info[0]["h_idx"]?>" /></a>
    								<?} else {?>
    									<a class="inline_block" id="click_interest1"><img class="rectangle_60" src="./company/images/icon_002.png" alt="관심공고" /><input type="hidden" value="<?=$hire_info[0]["h_idx"]?>" /></a>
    								<?}?>
    							<?} else {?>
    								<?if($hire_info[0]["interest_count"] > 0) {?>
    									<a class="color_point2" href="#" type=\"button" role="button" data-toggle="modal" data-target="#modal_login" rel="nofollow"><img  class="rectangle_60" src="./images/icon_002.png" alt="관심" /></a>
    								<?} else {?>
    									<a class="color_point2" href="#" type=\"button" role="button" data-toggle="modal" data-target="#modal_login" rel="nofollow"><img  class="rectangle_60" src="./images/icon_001.png" alt="관심" /></a>
    								<?}?>
    							<?}?>

    						?>
    						<img style="cursor:pointer; margin-right:5px;" onclick="javascript:click_share();" class="rectangle_60" src="./images/icon_005.png" alt="공유" />
    						<!-- 상세공고 다음/이전 작업 -->
    						<img style="cursor:pointer; margin-right:5px;" onclick="javascript:back_careers_detail('<?=$b_h_idx?>');" class="rectangle_60" src="./images/icon_003.png" alt="이전">
    						<img style="cursor:pointer" onclick="javascript:next_careers_detail('<?=$n_h_idx?>');" class="rectangle_60" src="./images/icon_004.png" alt="다음">
    					</div>
    				</div>
          <?}?>

  				<div class="padding_5 border1_not_top_xs_null">
  					<div class="padding_20">
  						<table class="width_100" style="line-height: 1.7;">
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-4 padding_0" style="font-weight: bold;">공고제목</td>
  								<td class="col-xs-8 col-sm-8 padding_0"><?=$hire_info[0]["h_title"]?></td>
  							</tr>
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">직종</td>
  								<td class="col-xs-8 col-sm-9 padding_0"><?=$hire_info[0]["hire_o_name"]?></td>
  							</tr>
  							<? if($hire_info[0]['duty_name']){ ?>
  								<tr class="height_45">
  									<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">직무</td>
  									<td class="col-xs-8 col-sm-9 padding_0"><?=$hire_info[0]['duty_name']; ?></td>
  								</tr>
  							<? } ?>
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">직무상세내용</td>
  								<td class="col-xs-8 col-sm-9 padding_0"><?=$hire_info[0]["job_description"]?></td>
  							</tr>
  							<? if(count($h_certificate) > 0) {
  								for($i=0, $len = count($h_certificate); $i < $len; $i++){ ?>
  								<tr class="height_45">
  									<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">
  										<? echo ($i==0) ? "필요자격증":""; ?>
  									</td>
  									<td class="col-xs-8 col-sm-9 padding_0"><?=$h_certificate[$i]['certificate_name']?></td>
  								</tr>
  								<? }
  							} ?>
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">급여</td>
  								<td class="col-xs-8 col-sm-9 padding_0">
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
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">신입/경력</td>
  								<td class="col-xs-8 col-sm-9 padding_0"><?=$hire_info[0]["job_is_career"]?></td>
  							</tr>
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">학력</td>
  								<td class="col-xs-8 col-sm-9 padding_0"><?=$hire_info[0]["job_achievement"]?></td>
  							</tr>
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">근무형태</td>
  								<td class="col-xs-8 col-sm-9 padding_0"><?=$hire_info[0]["w_name"]?></td>
  							</tr>
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">근무지역</td>
  								<?
  								$hire_location = $hire_info[0]["local_name"];
  								if($hire_info[0]["city_name"] != "전체") {
  									$hire_location .= " " . $hire_info[0]["city_name"];
  								} else if($hire_info[0]["district_name"] != "전체") {
  									$hire_location .= " " . $hire_info[0]["district_name"];
  								}
  								?>
  								<td class="col-xs-8 col-sm-9 padding_0"><?=$hire_location?></td>
  							</tr>
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">공고시작</td>
  								<td class="col-xs-8 col-sm-9 padding_0"><?=substr($hire_info[0]["job_start_date"],0, 10)?></td>
  							</tr>
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">공고종료</td>
  								<td class="col-xs-8 col-sm-9 padding_0"><?=substr($hire_info[0]["job_end_date"], 0, 10)?></td>
  							</tr>
  							<tr class="height_45">
  								<td class="col-xs-4 col-sm-3 padding_0" style="font-weight: bold;">담당자 및 기타정보</td>
  								<td class="col-xs-8 col-sm-9 padding_0"><? echo str_replace("\n", "<br />" , $hire_info[0]["job_manager"]);?></td>
  							</tr>
  						</table>
  					</div>
  				</div>
  				<div class="d-none padding_20"></div>
  				<div class="d-md-none padding_5 height_20" style="border-top: 1px solid #ddd;"></div>


  				<? if($logged_info['is_commerce'] == 'Y') {
  						if($hire_info[0]["m_idx"] == $m_idx) {?>
  							<div class="d-md-none padding_5 border1_not_top_xs_null font_size_20 align_center padding_top_30 padding_bottom_30">
                  <span>총<strong>(<?=$hire_info[0]["letter_count"]?>)명</strong>의 지원자가 있습니다.</span>
                  <a href="<?=getUrl('company','job',$hire_info[0]['h_idx']);?>">
                    <button class="width_60 btn button1 margin_auto block" style="font-size: 19px;" >
                      <strong>지원자보기</strong>
                    </button>
                  </a>

                  <a href="<?=getUrl('company','job_appRegister',$hire_info[0]);?>">
                    <button class="width_60 btn button1" style="background: #777; font-size: 19px;">
                      <!-- <img class="rectangle_30 margin_right_5" src="./img/icon_025.png" alt="공고수정" style="margin-top: -5px;" /> -->
                      <strong>공고수정</strong>
                    </button>
                  </a>
  							</div>
  					<?	}

  					} else {
  						echo "<div class=\"d-md-none padding_5 border1_not_top_xs_null font_size_20 align_center padding_top_30 padding_bottom_30\">";
  							echo "<span><strong>\"" . $hire_info[0]["c_name"] . "\"</strong>에 <br /><strong>지원</strong>하시겠습니까?</span><br/>";

  							$date_now = date("Y-m-d H:i:s");
  							if($date_now > strtotime($hire_info[0]["job_end_date"]) ){
  								echo "<a href=\"#\" type=\"button\" role=\"button\" data-toggle=\"modal\" data-target=\"#modal_application\" rel=\"nofollow\"><button class=\"btn btn-block btn-primary d-md-none\" style=\"font-size: 19px;\" ><strong>지원하기1</strong></button></a>";
  							}
  							else if($m_idx > 0) {
  								echo "<a href=\"#\" type=\"button\" role=\"button\" data-toggle=\"modal\" data-target=\"#modal_application\" rel=\"nofollow\"><button class=\"btn btn-block btn-primary d-md-none\" style=\"font-size: 19px;\" ><strong>지원하기2</strong></button></a>";
  							} else {
  								echo "<a href=\"#\" type=\"button\" role=\"button\" data-toggle=\"modal\" data-target=\"#modal_login\" rel=\"nofollow\"><button class=\"btn btn-block btn-primary d-md-none\" style=\"font-size: 19px;\" ><strong>지원하기3</strong></button></a>";
  							}
  						echo "</div>";
  					}
  				?>
  			</div>


  			<div class="d-none d-md-block col-md-4 padding_5 float_left">

  				<?
  					if($logged_info['is_commerce'] == 'Y') {
  						if($hire_info[0]["m_idx"] == $m_idx) {
  							$hire_info[0]["letter_count"] -= $member_count[0]['cnt'];?>
  							  <div class="padding_15 border1_xs_null font_size_20">
  								<span>총<strong>(<?=$hire_info[0]["letter_count"]?>)명</strong>의 지원자가 있습니다.</span>
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

  					} else {
  						echo "<div class=\"padding_15 border1_xs_null font_size_20\">";
  							echo "<span><strong>\"" . $hire_info[0]["c_name"] . "\"</strong>에 <br /><strong>지원</strong>하시겠습니까?</span>";
  							if($m_idx > 0) {
  								if($career_n==1){
  									echo "<a href=\"#\" type=\"button\" role=\"button\" data-toggle=\"modal\" data-target=\"#modal_application\" rel=\"nofollow\"><button class=\"btn btn-block btn-primary d-md-none\" style=\"font-size: 19px;\" ><strong>지원하기4</strong></button></a>";
  								}
  								if($career_n==0){
  									echo "<a href=\"#\" type=\"button\" role=\"button\" data-toggle=\"modal\" data-target=\"#modal_career_n\" rel=\"nofollow\"><button class=\"d-none btn btn-block btn-primary \" style=\"font-size: 19px;\" ><strong>지원하기5</strong></button></a>";
  								}
  							} else {
  								echo "<a href=\"#\" type=\"button\" role=\"button\" data-toggle=\"modal\" data-target=\"#modal_login\" rel=\"nofollow\"><button class=\"btn btn-block btn-primary d-md-none\" style=\"font-size: 19px;\" ><strong>지원하기6</strong></button></a>";
  							}
  						echo "</div>";
  					}
  				?>


  				<div class="padding_15 border1_xs_null font_size_20 margin_top_20 align_left">
            <?if($logged_info['is_commerce'] == 'Y') {?>
              광고배너들어감
  					<?} else {?>
              <?
    						if($hire_info[0]["homepage"]) {
    							echo "<a href=\"" . $hire_info[0]["homepage"] . "\" target=\"_blank\" style=\"margin-right:5px\" ><img class=\"rectangle_60\" src=\"./img/icon_007.png\" alt=\"홈페이지\" /></a>";
    						}

    						if($m_idx > 0) {
    							if($hire_info[0]["interest_count"] > 0) {
    								//echo "<a class=\"inline_block\" id=\"click_interest2\"><img class=\"rectangle_60\" src=\"./img/icon_027.png\" alt=\"관심\" /><input type=\"hidden\" value=\"" . $h_idx . "\" /></a>";
    							} else {
    								//echo "<a class=\"inline_block\" id=\"click_interest1\"><img class=\"rectangle_60\" src=\"./img/icon_005.png\" alt=\"관심공고\" /><input type=\"hidden\" value=\"" . $h_idx . "\" /></a>";
    							}
    						} else {
    							if($hire_info[0]["interest_count"] > 0) {
    								//echo "<a class=\"color_point2\" href=\"#\" type=\"button\" role=\"button\" data-toggle=\"modal\" data-target=\"#modal_login\" rel=\"nofollow\"><img class=\"rectangle_60\"src=\"./img/icon_027.png\" alt=\"관심\" /></a>";
    							} else {
    								//echo "<a class=\"color_point2\" href=\"#\" type=\"button\" role=\"button\" data-toggle=\"modal\" data-target=\"#modal_login\" rel=\"nofollow\"><img class=\"rectangle_60\"src=\"./img/icon_005.png\" alt=\"관심\" /></a>";
    							}
    						}

    					?>

    					<img style="cursor:pointer; margin-right:5px;" onclick="javascript:click_share();" class="rectangle_60" src="./img/icon_006.png" alt="공유" />
    					<!-- 상세공고 다음/이전 작업 -->
    					<?if($logged_info['is_commerce'] == 'Y') {

    					}else if(!$m_idx){
    							if($hire_info[0]["homepage"]){
    								echo "<a href=\"./careers.html\"><button class=\"btn button1\" style=\"font-size: 19px;width:50%;margin:0px;height:60;background: white;color:  #003E6F;border: 1px solid #003E6F;border-radius: 0;\" ><strong>일자리 더보기</strong></button></a>";
    							}else{
    								echo "<a href=\"./careers.html\"><button class=\"btn button1\" style=\"font-size: 19px;width:70%;margin:0px;height:60;background: white;color:  #003E6F;border: 1px solid #003E6F;border-radius: 0;\" ><strong>일자리 더보기</strong></button></a>";
    							}

    					}else{?>
    						<img style="cursor:pointer; margin-right:5px;" onclick="javascript:back_careers_detail('<?=$b_h_idx?>');" class="rectangle_60" src="./img/icon_029.png" alt="이전">
    						<img style="cursor:pointer" onclick="javascript:next_careers_detail('<?=$n_h_idx?>');" class="rectangle_60" src="./img/icon_028.png" alt="다음">
    					<?}?>
            <?}?>

  				</div>

  				<?
  					for($i = 0; $i < count($banner_list); $i++) {
  						$url = $banner_list[$i]["url"];
  						$image = $banner_list[$i]["image"];

  						echo "<a href=\"" . $url . "\" ><img src=\"" . $image . "\" class=\"width_100 margin_top_20\" /></a>";
  					}
  				?>
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
