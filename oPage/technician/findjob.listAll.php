<?php
  $hire_rows = $output->get('hire_rows');
  $interest_rows = $output->get('interest_rows');
  $local_list = $output->get('local_list');
  $occupation_list = $output->get('occupation_list');
  $duty_list = $output->get('duty_list');


  $page =  $_REQUEST['page'];

  if(!$page) {
    $page = 1;
  }


  if($_GET['local_idx']){
    $local_idx = $_GET['local_idx'];
  }

  if($_GET['o_idx']){
    $o_idx = $_GET['o_idx'];
  }else{
    $o_idx = -1;
  }

  if($_GET['short']){
    $short = $_GET['short'];
  }
  if($_GET['duty_name']){
    $duty_name = $_GET['duty_name'];
  }


  $total_record = count($hire_rows);
      $scale = 12;
  	$start = ($page - 1) * $scale;

  	/* 페이징 시작 */
  	$allPage = ceil($total_record / $scale);

  	if($page > $allPage){
  		$page = 1;
  		$total_record = count($hire_rows);
  		$scale = 12;
  	$start = ($page - 1) * $scale;

  	/* 페이징 시작 */
  	$allPage = ceil($total_record / $scale);
  	}

  	$oneSection = 5;
  	$currentSection = ceil($page / $oneSection);
  	$allSection = ceil($allPage / $oneSection);
  	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1);
  	if($currentSection == $allSection) {
  		$lastPage = $allPage;
  	} else {
  		$lastPage = $currentSection * $oneSection;
  	}
  	$prevPage = (($currentSection - 1) * $oneSection);
  	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1);
  	if(!$m_idx){
  		if($page != 1) {
  			$paging .= "<li><a href=\"./?page=&local_idx=" . $local_idx . "&o_idx=" . $o_idx . "&duty_name=" . $duty_name ."\" aria-label=\"Previous\">처음</a></li>";
  		}
  		//첫 섹션이 아니라면 이전 버튼을 생성
  		if($currentSection != 1) {
  			$paging .= "<li><a href=\"./?page=&local_idx=" . $local_idx . "&o_idx=" . $o_idx . "&duty_name=" . $duty_name ."\" aria-label=\"Previous\">이전</a></li>";
  		}

  		for($i = $firstPage; $i <= $lastPage; $i++) {
  			if($i == $page) {
  				$paging .= "<li class=\"active\"><a>" . $i . "</a></li>";
  			}else if($i > 2){
  				$paging .= "<li><a onclick=\"javascript:login_please();\">" . $i . "</a></li>";
  			} else {
  				$paging .= "<li><a href=\"./?page=" . $i .  "&local_idx=". $local_idx . "&o_idx=" . $o_idx . "&duty_name=" . $duty_name . "\" aria-label=\"Previous\">" . $i . "</a></li>";
  			}
  		}

  		if($currentSection != $allSection) {
  			$paging .= "<li><a onclick=\"javascript:login_pleasee();\">다음</a></li>";
  		}

  		if($page != $allPage) {
  			$paging .= "<li><a onclick=\"javascript:login_please();\">끝</a></li>";
  		}

  	}else{
  		if($page != 1) {
  			$paging .= "<li><a href=\"./?page=1\" aria-label=\"Previous\">처음</a></li>";
  		}
  		//첫 섹션이 아니라면 이전 버튼을 생성
  		if($currentSection != 1) {
  			$paging .= "<li><a href=\"./?page=" . $prevPage . "\" aria-label=\"Previous\">이전</a></li>";
  		}

  		for($i = $firstPage; $i <= $lastPage; $i++) {
  			if($i == $page) {
  				$paging .= "<li class=\"active\"><a>" . $i . "</a></li>";
  			} else {
  				$paging .= "<li><a href=\"./?page=" . $i .  "&local_idx=". $local_idx . "&o_idx=" . $o_idx . "&duty_name=" . $duty_name . "\" aria-label=\"Previous\">" . $i . "</a></li>";
  			}
  		}

  		if($currentSection != $allSection) {
  		$paging .= "<li><a href=\"./?page=" . $nextPage . "\">다음</a></li>";
  		}
  		if($page != $allPage) {
  			$paging .= "<li><a href=\"./?page=" . $allPage . "\" aria-label=\"Next\">끝</a></li>";
  		}
  	}


?>
<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">일자리 더 보기</h4>
    </div>
</section>
<div class="container pt-lg-5">
    <div class="d-block d-lg-none pt-4 pb-2">
        <a href="<?=getUrl('technician','findJobListAll')?>" class="d-lg-none pull-right btn btn-primary btn-xs btn-round py-2 px-3 mr-1">전체공고</a>
        <?if($m_idx > 0){?>
        <a href="<?=getUrl('technician','findJobList')?>" class="d-lg-none pull-right btn btn-xs border-primary btn-round  py-2 px-3">맞춤공고</a>
        <?}?>
        <h6>일자리 정보</h6>
    </div>
    <div class="d-none d-lg-block pt-4 pb-4">
        <?if($m_idx > 0){?>
        <a href="<?=getUrl('technician','findJobList')?>" class="pull-right btn btn-sm border-primary btn-round py-1 px-3 mr-1">맞춤공고</a>
        <?}?>
        <a href="<?=getUrl('technician','findJobListAll')?>" class="pull-right btn btn-sm btn-round btn-primary py-1 px-3">전체공고</a>
        <h4 class="mb-2">일자리 정보</h4>
        <!-- <div class="row">
            <div class="col-3">
                <select class="form-control"><option>지역설정</option></select>
            </div>
            <div class="col-3">
            <select class="form-control"><option>직종</option></select>
            </div>
            <div class="col-3">
                <select class="form-control"><option>직종</option></select>
            </div>
            <div class="col-3">
                <select class="form-control"><option>직종</option></select>
            </div>
        </div> -->
        <div class="clearfix"></div>
    </div>

    <div class="content_padding px-0 pb-1 pt-0 mt-0 mb-4">
        <div class="row">
            <div class="col-6 pr-1 col-lg-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-light">지역</span>
                    </div>
                    <select class="form-control" id="local_select" onchange="location.href=(this.value)">
                        <? foreach ($local_list as $val) { ?>
                            <? if($val["local_idx"] == $local_idx){?>
                                <option value="<?=getUrl('technician','findJobListAll',false,array('page'=>$page, 'local_idx' => $val['local_idx'],'o_idx' => $o_idx, 'duty_name' => $duty_name))?>" selected><?=$val['local_name']?></option>
                            <? }else{ ?>
                                <option value="<?=getUrl('technician','findJobListAll',false,array('page'=>$page, 'local_idx' => $val['local_idx'],'o_idx' => $o_idx, 'duty_name' => $duty_name))?>"><?=$val['local_name']?></option>
                            <? }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="col-6 pl-1 col-lg-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-light">직종</span>
                    </div>
                    <select class="form-control" id="occupation_select" onchange="location.href=(this.value)">
                      <? foreach ($occupation_list as $val) { ?>
                        <? if($val["o_idx"] == $o_idx){?>
                          <option value="<?=getUrl('technician','findJobListAll',false,array('page'=>$page, 'local_idx' => $local_idx,'o_idx' => $val['o_idx'], 'duty_name' => $duty_name))?>" selected><?=$val['o_name']?></option>
                        <? }else{ ?>
                            <option value="<?=getUrl('technician','findJobListAll',false,array('page'=>$page, 'local_idx' => $local_idx,'o_idx' => $val['o_idx'], 'duty_name' => $duty_name))?>"><?=$val['o_name']?></option>
                        <? }
                      } ?>
                    </select>
                </div>
            </div>
            <div class="col-6 pr-1 col-lg-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-light">직무</span>
                    </div>
                    <select class="form-control" id="duty_select" onchange="location.href=(this.value)">
                        <option value="<?=getUrl('technician','findJobListAll',false,array('page'=>$page, 'local_idx' => $local_idx,'o_idx' => $o_idx, 'duty_name' => '전체'))?>">전체</option>
                      <?foreach ($duty_list as $val) {?>
                        <?if($o_idx == $val["o_idx"]){?>
                          <?if($duty_name == $val["duty_name"]){?>
                            <option value="<?=getUrl('technician','findJobListAll',false,array('page'=>$page, 'local_idx' => $local_idx,'o_idx' => $o_idx, 'duty_name' => $val['duty_name']))?>" selected><?=$val['duty_name']?></option>
                          <?}else{?>
                            <option value="<?=getUrl('technician','findJobListAll',false,array('page'=>$page, 'local_idx' => $local_idx,'o_idx' => $o_idx, 'duty_name' => $val['duty_name']))?>"><?=$val['duty_name']?></option>
                          <?}?>
                      <?}?>
                    <?}?>
                    </select>
                </div>
            </div>
            <div class="col-6 pl-1 col-lg-12 p-3">
                <span class="pull-right">
              단기공고
              <?if($short > 0){?>
                <input type="checkbox" id="short_term" checked>
              <?}else{?>
                <input type="checkbox" id="short_term">
              <?}?>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
      <input type="hidden" id="hidden_m_idx" value="<?=$m_idx?>">
      <?php
          //기준 숫자
          $file_count = FileHandler::getFileCount('oPage/technician/company_thumbnails','png');
      ?>
      <?if($total_record > 0){?>
        <?php for($i = $start; $i < $start + $scale && $i < $total_record; $i++) { ?>
          <input type="hidden" id="hidden_h_idx" value="<?=$hire_rows[$i]['h_idx']?>">
            <div class="col-12 col-md-4 px-md-2 pb-md-4">
                <div class="magazine tech_card mb-3 bg-white text-left shadow">
                    <div class="row">
                        <div class="col-5 col-md-12 px-0" style="background-color:#EEE;">
                          <?php
                          //랜덤 이미지를 h_idx 에의해 고정적으로 출력하기 위한 계산식
                          $img_num = $hire_rows[$i]['h_idx'] % $file_count;
                          $img_num = $img_num + 1;
                          ?>
                            <div class="thumbnail mx-0 px-0" style="height:100%; background-image:url('/oPage/technician/company_thumbnails/<?=$img_num?>.png')">
                                <span class="overlay">
                                 <?if($m_idx > 0){
                                    foreach ($interest_rows as $val2) {
                                      if($val2['h_idx'] == $hire_rows[$i]['h_idx']){
                                        $interest_html2 = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_remove('. $hire_rows[$i]['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart red" id="yes_interest"></i></a>';
                                        break;
                                      }else{
                                        $interest_html2 = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="interest_add('. $hire_rows[$i]['h_idx'] .')" style="right:10px; top:10px;">관심공고<i class="xi-heart" id="no_interest"></i></a>';
                                      }
                                    }
                                  }else{
                                    $interest_html2 = '<a class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-lg-3" onclick="login_please();" style="right:10px; top:10px;">관심공고<i class="xi-heart"></i></a>';
                                  }?>
                                <?= $interest_html2 ?>
                                </span>
                            </div>
                        </div>
                        <? if ($hire_rows[$i]['city_name'] == "전체") { $hire_rows[$i]['city_name'] = "";} ?>
                        <? if ($hire_rows[$i]['district_name'] == "전체") { $hire_rows[$i]['district_name'] = ""; }?>
                        <? if ($hire_rows[$i]['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                        <div class="col-7 col-md-12 pl-0 pl-md-3">
                            <div class="p-2">
                                <h6 class="weight_normal cut1"><?=$hire_rows[$i]['c_name']?></h6>
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
                                <p class="text-secondary xxs_content mx-0 px-0 pt-1">
                                    <img src="/oPage/images/imgicons/wrench_bg_red.png" height="14" /> <?=$hire_rows[$i]['job_is_career']?>
                                </p>
                            </div>

                            <div class="row m-0 p-0 pt-0 mt-0">
                                <div class="col-6 mx-0 px-0">
                                  <?if($m_idx > 0){?>
                                    <a href="<?=getUrl('technician','jobDetail',$hire_rows[$i]['h_idx'])?>" class="btn btn-light btn-block rounded-0">상세보기</a>
                                  <?}else{?>
                                    <button onclick="login_please()" class="btn btn-light btn-block rounded-0">상세보기</button>
                                  <?}?>
                                </div>
                                <div class="col-6 mx-0 px-0">
                                  <?if($m_idx > 0){?>
                                    <?if($career_n == 1){?>
                                      <button class="btn btn-danger btn-block rounded-0" onclick="application_ok(<?=$hire_rows[$i]['h_idx']?>)">지원하기</button>
                                    <?}else if($career_n == 0 && ($hire_rows[$i]['job_is_career'] == '무관' || $hire_rows[$i]['job_is_career'] == '신입')){?>
                                      <button class="btn btn-danger btn-block rounded-0" onclick="application_ok(<?=$hire_rows[$i]['h_idx']?>)">지원하기</button>
                                    <?}else if($career_n == 0 && ($hire_rows[$i]['job_is_career'] != '무관' || $hire_rows[$i]['job_is_career'] != '신입')){?>
                                      <button class="btn btn-danger btn-block rounded-0" onclick="write_career();">지원하기</button>
                                    <?}?>
                                  <?}else{?>
                                    <button class="btn btn-danger btn-block rounded-0" onclick="login_please();">지원하기</button>
                                  <?}?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
      <?}else{?>
        <div class="text-center mx-auto">
          <img src="/oPage/technician/images/info.png" alt="인포아이콘" width="40">
          <h6 class="pt-3">원하시는 조건의 일자리가 아직 없어요.</h6>
          <h6>기술자숲이 열심히 찾아볼게요!</h6>
        </div>
      <?}?>
    </div>
    <div class="" style="text-align:center;">
      <ul class="pagination">
        <?
          if($total_record > 0){
            echo $paging;
          }
        ?>
      </ul>
    </div>
</div>

<div class="modal fade" id="check_phonenumber" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true" style="">
    <div class="modal-dialog modal-dialog-centered mx-auto" role="document" style="max-width:330px;">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#check_phonenumber').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="square avatar bg-red mx-auto" style="width:120px; margin-top:-60px; background-image:url('/oPage/ncenter/images/header_icon.png');"></div>
            <div class="p-3 text-center">
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
  $(document).ready(function(){
    //occupation();
  });

  // function occupation(){
  //  $("#duty_select").empty();
  // }

 function search_hire(){
   var local_idx = $("#local_select option:selected").val();
   var o_idx = $("#occupation_select option:selected").val();

   var params = {};
   params["local_idx"] = local_idx;
   params["o_idx"] = o_idx;

   exec_json("technician.search",params,function(ret_obj){
       toastr.success(ret_obj.message);
       //location.reload();
   });

 }

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


$("#short_term").change(function(){
    if($("#short_term").is(":checked")){
      location.href="<?=getUrl('technician','findJobListAll',false,array('page'=>$page, 'local_idx' => $local_idx,'o_idx' => $o_idx, 'duty_name'=>$duty_name, 'short'=>1))?>";
    }else{
      location.href="<?=getUrl('technician','findJobListAll',false,array('page'=>$page, 'local_idx' => $local_idx,'o_idx' => $o_idx, 'duty_name'=>$duty_name, 'short'=>-1))?>";
    }
});

function login_please(){
  var result = confirm("로그인 후 이용해주세요. 로그인 하시겠습니까?");
  if(result){
    location.href="<?=getUrl('member','login',false,array('cur' => $current_url))?>";
  }
}

function write_career(){
  var result = confirm("지원을 위해 이력정보등록이 필요합니다. 등록하시겠습니까?");
  if(result){
    location.href="<?=getUrl('technician','resumeWrite',$m_idx)?>";
  }
}

</script>

<?php
$footer_false = true;
?>
