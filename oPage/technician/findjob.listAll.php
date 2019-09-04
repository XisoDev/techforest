<?php
  $hire_rows = $output->get('hire_rows');
  $interest_rows = $output->get('interest_rows');
  $local_list = $output->get('local_list');
  $occupation_list = $output->get('occupation_list');
  $duty_list = $output->get('duty_list');

  if($_GET['local_idx']){
    $search_local_idx = $_GET['local_idx'];
  }

  if($_GET['o_idx']){
    $search_o_idx = $_GET['o_idx'];
  }else{
    $search_o_idx = -1;
  }

  if($_GET['short']){
    $search_short = $_GET['short'];
  }
  if($_GET['duty']){
    $search_duty_name = $_GET['duty'];
  }

?>
<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">일자리 더 보기</h4>
    </div>
</section>
<div class="container pt-lg-5">
    <div class="px-0 pb-1 pt-3 pt-lg-0">
        <!-- 모바일버전 버튼 -->
        <a href="<?=getUrl('technician','findJobListAll')?>" class="d-lg-none pull-right btn btn-xxs btn-round btn-primary py-2 px-3">전체공고</a>
        <a href="<?=getUrl('technician','findJobList')?>" class="d-lg-none pull-right btn border-primary btn-xxs btn-round py-2 px-3 mr-1">맞춤공고</a>
        <h6>일자리 정보</h6>
    </div>

    <div class="content_padding px-0 pb-1 pt-0 mt-0 mb-4">
        <div class="row">
            <div class="col-6 pr-1 col-lg-4">
                <select class="form-control" id="local_select" onchange="location.href=(this.value)">
                  <? foreach ($local_list as $val) { ?>
                      <? if($val["local_idx"] == $search_local_idx){?>
                        <option value="<?=getUrl('technician','findJobListAll',false,array('local_idx' => $val['local_idx'],'o_idx' => $search_o_idx, 'duty' => $search_duty_name))?>" selected><?=$val['local_name']?></option>
                      <? }else{ ?>
                        <option value="<?=getUrl('technician','findJobListAll',false,array('local_idx' => $val['local_idx'],'o_idx' => $search_o_idx, 'duty' => $search_duty_name))?>"><?=$val['local_name']?></option>
                      <? }
                    } ?>
                </select>
            </div>
            <div class="col-6 pl-1 col-lg-4">
                <select class="form-control" id="occupation_select" onchange="location.href=(this.value)">
                  <? foreach ($occupation_list as $val) { ?>
                    <? if($val["o_idx"] == $search_o_idx){?>
                      <option value="<?=getUrl('technician','findJobListAll',false,array('local_idx' => $search_local_idx,'o_idx' => $val['o_idx'], 'duty' => $search_duty_name))?>" selected><?=$val['o_name']?></option>
                    <? }else{ ?>
                        <option value="<?=getUrl('technician','findJobListAll',false,array('local_idx' => $search_local_idx,'o_idx' => $val['o_idx'], 'duty' => $search_duty_name))?>"><?=$val['o_name']?></option>
                    <? }
                  } ?>
                </select>
            </div>
            <div class="col-lg-2 pr-1">
                <a href="<?=getUrl('technician','findJobList')?>" class="d-lg-block btn-block d-none btn btn-round border-primary py-2 px-3">맞춤공고</a>
            </div>
            <div class="col-lg-2 pl-1">
                <a href="<?=getUrl('technician','findJobListAll')?>" class="d-lg-block btn-block d-none btn btn-primary btn-round py-2 px-3 mr-1">전체공고</a>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-6 pr-1 col-lg-4">
                <select class="form-control" id="duty_select" onchange="location.href=(this.value)">
                    <option value="<?=getUrl('technician','findJobListAll',false,array('local_idx' => $search_local_idx,'o_idx' => $search_o_idx, 'duty' => '전체'))?>">전체</option>
                  <?foreach ($duty_list as $val) {?>
                    <?if($search_o_idx == $val["o_idx"]){?>
                      <?if($search_duty_name == $val["duty_name"]){?>
                        <option value="<?=getUrl('technician','findJobListAll',false,array('local_idx' => $search_local_idx,'o_idx' => $search_o_idx, 'duty' => $val['duty_name']))?>" selected><?=$val['duty_name']?></option>
                      <?}else{?>
                        <option value="<?=getUrl('technician','findJobListAll',false,array('local_idx' => $search_local_idx,'o_idx' => $search_o_idx, 'duty' => $val['duty_name']))?>"><?=$val['duty_name']?></option>
                      <?}?>
                  <?}?>
                <?}?>
                </select>
            </div>
            <div class="col-6 pl-1 col-lg-4">
              단기공고
              <?if($search_short > 0){?>
                <input type="checkbox" id="short_term" checked>
              <?}else{?>
                <input type="checkbox" id="short_term">
              <?}?>
            </div>
        </div>
    </div>
    <div class="row">
      <input type="hidden" id="hidden_m_idx" value="<?=$m_idx?>">
        <?php foreach($hire_rows as $val) { ?>
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
                                    <a href="<?=getUrl('company','jobDetail',$val['h_idx'])?>" class="btn btn-light btn-block rounded-0">상세보기</a>
                                </div>
                                <div class="col-6 mx-0 px-0">
                                    <button class="btn btn-danger btn-block rounded-0" onclick="application_ok(<?=$val['h_idx']?>)">지원하기</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
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
                <a class="btn btn-block border-danger btn-round btn-lg mb-3 red" href="#">연락처 수정하기</a>
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
      location.href="<?=getUrl('technician','findJobListAll',false,array('local_idx' => $search_local_idx,'o_idx' => $search_o_idx, 'duty'=>$search_duty_name, 'short'=>1))?>";
    }else{
      location.href="<?=getUrl('technician','findJobListAll',false,array('local_idx' => $search_local_idx,'o_idx' => $search_o_idx, 'duty'=>$search_duty_name, 'short'=>-1))?>";
    }
});
</script>

<?php
$footer_false = true;
?>
