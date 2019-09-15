<?php
$m_idx = $_SESSION['LOGGED_INFO'];
$hire_info = $output->get('hire_info');
$h_certificate = $output->get('h_certificate');
$member_count = $output->get('member_count');
$interest = $output->get('interest');

$h_idx = $output->get('h_idx');
$N_hire = $output->get('N_hire');
$B_hire = $output->get('B_hire');


?>
<link rel="stylesheet" href="/layout/company/assets/default.css">
<!-- <link rel="stylesheet" href="/layout/none/vendor/bootstrap/css/bootstrap.min.css"> -->

<section class="bg-white">
  <section class="p-3 mt-4 pt-5 bg-white d-lg-none">
      <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
      <h4 class="weight_normal">공고 상세보기</h4>
  </section>

<input type="hidden" id="hidden_m_idx" value="<?=$m_idx?>">
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
          <?if($logged_info['is_commerce'] == 'Y'){?>
          <?}else{?>
            <div class="d-md-none padding_5 border1_not_top_xs_null">
    					<div class="padding_20">
    						<?
    							if($m_idx > 0) {
    								if(!$interest) {?>
    									<img style="cursor:pointer;" class="rectangle_60" src="/oPage/images/imgicons/icon_001.png" alt="빈하트" onclick="interest_add(<?=$hire_info[0]['h_idx']?>)">
    								<?} else {?>
    									<img style="cursor:pointer;" class="rectangle_60" src="/oPage/images/imgicons/icon_002.png" alt="찬하트" onclick="interest_remove(<?=$hire_info[0]['h_idx']?>)">
    								<?}?>
    							<?} else {?>

    							<?}?>

    						<img style="cursor:pointer; margin-right:5px;" onclick="javascript:click_share();" class="rectangle_60" src="/oPage/images/imgicons/icon_005.png" alt="공유" />
    						<!-- 상세공고 다음/이전 작업 -->
    						<img style="cursor:pointer; margin-right:5px;" onclick="javascript:back_careers_detail();" class="rectangle_60" src="/oPage/images/imgicons/icon_003.png" alt="이전">
    						<img style="cursor:pointer" onclick="javascript:next_careers_detail();" class="rectangle_60" src="/oPage/images/imgicons/icon_004.png" alt="다음">
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

          <!-- 모바일 -->
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

                  <a href="#" onclick="javascript:move_hire_insert( <?=$hire_info[0]["h_idx"]?> );" >
                    <button class="width_60 btn button1" style="background: #777; font-size: 19px;">
                      <!-- <img class="rectangle_30 margin_right_5" src="./img/icon_025.png" alt="공고수정" style="margin-top: -5px;" /> -->
                      <strong>공고수정</strong>
                    </button>
                  </a>
  							</div>
  					<?	}

            } else {?>
  						<div class="d-md-none padding_5 border1_not_top_xs_null font_size_20 align_center padding_top_30 padding_bottom_30">
  						   <span><strong><?=$hire_info[0]["c_name"]?></strong>에 <br /><strong>지원</strong>하시겠습니까?</span><br/>

  							<?$date_now = date("Y-m-d H:i:s");
  							if($date_now > strtotime($hire_info[0]["job_end_date"]) ){?>
  								<button class="btn btn-block btn-primary d-md-none" style="font-size: 19px;" onclick="application_ok(<?=$val['h_idx']?>)"><strong>지원하기1</strong></button>
  						<?}
  							else if($m_idx > 0) {?>
  							  <button class="btn btn-block btn-primary d-md-none" style="font-size: 19px;" onclick="application_ok(<?=$val['h_idx']?>)"><strong>지원하기2</strong></button>
  						<?} else {?>
  								<a href="#" type="button" role="button" data-toggle="modal" data-target="#modal_login" rel="nofollow"><button class="btn btn-block btn-primary d-md-none" style="font-size: 19px;"><strong>지원하기3</strong></button></a>
  						<?}?>
  						</div>
  					<?}?>
  			</div>

        <!-- web -->
  			<div class="d-none d-md-block col-md-4 padding_5 float_left">
  				<?
  					if($logged_info['is_commerce'] == 'Y') {
  						if($hire_info[0]["m_idx"] == $m_idx) {
  							$hire_info[0]["letter_count"] -= $member_count[0]['cnt'];?>
  							  <div class="padding_15 border1_xs_null font_size_20">
  								<span>총<strong>(<?=$hire_info[0]["letter_count"]?>)명</strong>의 지원자가 있습니다.</span>
  								<a href="<?=getUrl('company','job',$hire_info[0]['h_idx']);?>">
  									<button class="btn button1" style="font-size: 19px;">
  										<strong>지원자보기</strong>
  									</button>
  								</a>
  								<a href="#" onclick="javascript:move_hire_insert(<?=$hire_info[0]["h_idx"]?>)">
  									<button class="btn button1" style="background: #777; font-size: 19px;">
  										<!-- <img class="rectangle_30 margin_right_5" src="./img/icon_025.png" alt="공고수정" style="margin-top: -5px;"> -->
  										<strong>공고수정</strong>
  									</button>
  								</a>
                </div>
  						<?}

  					} else {?>
  						<div class="padding_15 border1_xs_null font_size_20 align_center">
  						<span><strong><?=$hire_info[0]["c_name"]?></strong>에 <br /><strong>지원</strong>하시겠습니까?</span><br>
  							<?if($m_idx > 0) {
  								if($career_n==1){?>
  									<button class="btn btn-block btn-primary" style="font-size: 19px;" onclick="application_ok(<?=$hire_info[0]['h_idx']?>)"><strong>지원하기4</strong></button>
  								<?}
  								if($career_n==0){?>
  									<button class="btn btn-block btn-primary" style="font-size: 19px;" onclick="application_ok(<?=$hire_info[0]['h_idx']?>)"><strong>지원하기5</strong></button>
  								<?}
  							} else {?>
                  <!-- 로그인어떻게 할것인가? 페이지이동? 아니면 비로그인시 지원하기 버튼 안보이기-->
  								<button class="btn btn-block btn-primary" style="font-size: 19px;" ><strong>지원하기6</strong></button>
  							<?}?>
  						</div>
  					<?}?>


  				<div class="padding_15 border1_xs_null font_size_20 margin_top_20 align_left">
            <?if($logged_info['is_commerce'] == 'Y') {?>
              <!-- 광고배너들어감 -->
  					<?} else {
    						if($m_idx > 0) {
    							if(!$interest) {?>
    								<img style="cursor:pointer;" class="rectangle_60" src="/oPage/images/imgicons/icon_001.png" alt="빈하트" onclick="interest_add(<?=$hire_info[0]['h_idx']?>)">
    							<?} else {?>
    								<img style="cursor:pointer;" class="rectangle_60" src="/oPage/images/imgicons/icon_002.png" alt="찬하트" onclick="interest_remove(<?=$hire_info[0]['h_idx']?>)">
    						<?}
    						} else {

              }
    					?>

    					<img style="cursor:pointer;" onclick="javascript:click_share();" class="rectangle_60" src="/oPage/images/imgicons/icon_005.png" alt="공유" />
    					<!-- 상세공고 다음/이전 작업 -->
    					<?if($logged_info['is_commerce'] == 'Y') {

    					}else if(!$m_idx){?>
    						<a href="./careers.html"><button class="btn button1" style="font-size: 19px;width:65%;margin:0px;height:60px;background: white;color:  #003E6F;border: 1px solid #003E6F;border-radius: 0;"><strong>일자리 더보기</strong></button></a>
    					<?}else{?>
    						<img style="cursor:pointer;" onclick="javascript:back_careers_detail();" class="rectangle_60" src="/oPage/images/imgicons/icon_003.png" alt="이전">
    						<img style="cursor:pointer" onclick="javascript:next_careers_detail();" class="rectangle_60" src="/oPage/images/imgicons/icon_004.png" alt="다음">
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
                <a class="btn btn-block border-danger btn-round btn-lg mb-3 red" href="#">연락처 수정하기</a>
            </div>
            <button class="mt-2 btn btn-block btn-light" onclick="jQuery('#check_phonenumber').modal('hide');" style="border-radius:10px;">닫기</button>
        </div>
    </div>
</div>




<script type="text/javascript">
  //알림 숫자 초기화
  $('#notice_count')[0].innerText = <?=count($output->get("member_notice"));?>

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

	// 공유하기
function click_share() {
	//$("#modal_share").modal("toggle");
	var url = location.href;
	var IE = (document.all) ? true : false;
	if (IE) {
		window.clipboardData.setData('Text', url);
		alert('주소가 복사되었습니다.');
	} else {
		temp = prompt("Ctrl+C를 눌러 클립보드로 복사하세요", url );
	}

}

//이전공고 이동
function back_careers_detail(){
	var move = '<?=$B_hire[0]['h_idx']?>';
	if(move==''){
		alert('이전공고가 없습니다.');
	}else{
		location.href = "<?=getUrl('technician','jobDetail',$B_hire[0]['h_idx'])?>";
	}

}
//다음공고 이동
function next_careers_detail(){
	var move = '<?=$N_hire[0]['h_idx']?>';
	if(move==''){
		alert('이전공고가 없습니다.');
	}else{
		location.href = "<?=getUrl('technician','jobDetail',$N_hire[0]['h_idx'])?>";
	}
}

</script>
<?php
$footer_false = true;
?>
