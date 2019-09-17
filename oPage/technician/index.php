<?php
//이력서완성도(경력 개수)
$count_career_row = $output->get('count_career_row');
//이력서완성도(경력 직무상세내용 개수)
$count_c_content_row = $output->get('count_c_content_row');
//이력서완성도(기본정보+희망4종 입력 여부)
$count_myinfo_row = $output->get('count_myinfo_row');
//이력서 정보
$myinfo_row = $output->get('myinfo_row');
//추천기술자 허용여부 팝업
$rt_row = $output->get('rt_row');
//언론보도리스트
$news_list = $output->get('news_list');
//총공고개수
$all_hire_row = $output->get('all_hire_row');

if(!$count_career_row[0]['count_career']){
  $count_career = 0;
}else{
  $count_career = $count_career_row[0]['count_career'];
}

if(!$count_c_content_row[0]['count_c_content']){
  $count_c_content = 0;
}else{
  $count_c_content = $count_c_content_row[0]['count_c_content'];
}

if(!$count_myinfo_row[0]['count_myinfo']){
  $count_myinfo = 0;
}else{
  $count_myinfo = $count_myinfo_row[0]['count_myinfo'];
}


if($logged_info['is_commerce']=='Y'){
  echo ("<script>
    alert('잘못된 접속입니다.');
    location.href='".getUrl('company')."';
  </script>");
}
?>
<script type="text/javascript">
// $(document).ready(function(){
//   var is_commerce = "<?=$logged_info['is_commerce']?>";
//   if( is_commerce == 'Y'){
//     location.href="<?=getUrl('company')?>";
//   }else{
//
//   }
// });


</script>

<div class="container-fluid welcome_seciton" style="background-image:url('/oPage/images/technician_welcome.png');">
    <img src="/oPage/images/gear.png" class="rotating d-sm-none" style="position:absolute; width:30%; right:-5%; top:-5%;"  />
    <img src="/oPage/images/gear.png" class="rotating_slow d-sm-none" style="position:absolute; left:-35%; width:60%; top:3%;" />
    <div class="container">
    <div class="row">
        <div class="col">
        <?php if(!$logged_info) { ?>
        <h5 class="weight_lighter"><b>기술자님 :)</b> 로그인하고</h5>
        <h5 class="weight_lighter mb-3">맞춤 일자리를 확인하세요!</h5>
        <?php } ?>
        <?php if($logged_info) { ?>
            <div class="d-block d-md-none">
                <h5 class="weight_bold"><?=$logged_info['m_name']?>님 :)</h5>
                <h5 class="weight_lighter mb-3">어떤 일자리를 찾고 계신가요?</h5>
            </div>
            <div class="d-none d-md-block">
                <h4 class="weight_bold mb-0">안녕하세요<br /><?=$logged_info['m_name']?>님 :)<br /><span class="weight_lighter">어떤 일자리를 찾고 계신가요?</span></h4>
            </div>
        <?php } ?>
        <ul class="nav">
            <?php if(!$logged_info) { ?>
            <li class="nav-item">
                <a class="nav-link btn btn-primary btn-round btn-xs" href="<?=getUrl('member','login',false,array('cur' => $current_url))?>">로그인</a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <!--            blank--> &nbsp;
            </li>
            <?php if(!$logged_info) { ?>
            <li class="nav-item">
                <a class="nav-link btn btn-danger btn-round btn-xs" href="<?=getUrl('member','signUp')?>">회원가입</a>
            </li>
            <?php } ?>
        </ul>
        </div>
    </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php if(!$logged_info) { ?>
        <div class="col-12">
            <h6 class="weight_bold mt-4">아직 이력서를 등록하지 않으셨네요!</h6>
            <button class="btn btn-lg btn-block btn-warning xs_content py-3" onclick="location.href='<?=getUrl('member','login',false,array('cur' => $current_url))?>'">이력서 등록하고 맞춤 일자리 확인하기
                <span class="color_primary"><i class="xi-plus-circle"></i></span>
            </button>
        </div>

        <div class="col-12">
            <div class="bg-white rounded pt-3 mt-3">
            <a href="<?=getUrl('technician','findJobListAll')?>" class="pull-right mr-2 btn btn-primary btn-xxs btn-round py-1 px-2">공고더보기 <i class="xi-plus"></i></a>
            <h6 class="weight_bold ml-2">오늘의 주요 채용 공고!</h6>

                <div class="clearfix"></div>
        <!-- <div class="col-4 mr-0 pr-1">
            <select class="form-control"><option>기계/제조</option></select>
        </div>
        <div class="col-4 mx-0 px-0">
            <select class="form-control"><option>배관</option></select>
        </div>
        <div class="col-4 ml-0 pl-1">
            <select class="form-control"><option>부산</option></select>
        </div> -->
            <div class="flex-card-slick" onclick="location.href='<?=getUrl('member','login',false,array('cur' => $current_url))?>'">
                <?php foreach($output->get("new_hire3") as $val){ ?>
                  <?php $desired_work_place = $val['local_name'] . " ";if($val['city_name'] != '전체'){ $desired_work_place .= $val['city_name']; }if($val['district_name'] != '전체'){ $desired_work_place .= $val['district_name']; }?>
                    <div class="tech_card bg-white">
                        <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                        </div>
                        <div class="p-2 text-left pb-1">
                            <h6 class="pb-0 mb-0"><?=$val['c_name']?></h6>
                            <h6 class="red cut1 m-0"><?=$val['h_title']?></h6>
                            <p class="weight_lighter xxs_content mx-0 px-0">
                                <span class="badge badge-danger weight_lighter">위치</span>
                                <?=$desired_work_place?>
                                <? if($val['salary_idx']==4){?>
                                  <span class="badge badge-danger weight_lighter">시</span>
                                  <b><?=$val['job_salary']?>원</b>
                                <? }else{ ?>
                                  <? if($val['salary_idx']==1){ ?>
                                    <span class="badge badge-danger weight_lighter">연</span>
                                  <? }else if($val['salary_idx']==2){ ?>
                                    <span class="badge badge-danger weight_lighter">월</span>
                                  <? }else if($val['salary_idx']==3){ ?>
                                    <span class="badge badge-danger weight_lighter">일</span>
                                  <? } ?>
                                    <b><?=$val['job_salary']?>만원</b>
                                <? } ?>
                            </p>
                            <p class="text-secondary xxs_content mx-0 px-0">
                                <i class="xi-clock-o"></i> 마감 <?=$val['hire_end_date']?>일 전
                                <!-- <i class="xi-eye-o"></i> 142 -->
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php }else{ ?>
            <!--                mobile card-->
            <div class="d-block d-md-none">
                <div class="col-12">
                    <h6 class="weight_bold xs_content mt-4 mb-1">
                        <span class="red"><?=$logged_info['m_name']?></span>님의 이력서 완성도는
                        <span class="red">
                          <?php if(($count_career == $count_c_content) && $count_career != 0 && $count_myinfo > 0){
                              echo '높음';
                          }else if(($count_career > $count_c_content) && $count_myinfo > 0){
                              echo '중간';
                          }else{
                              echo '낮음';
                          }
                          ?>
                        </span>입니다.
                    </h6>
                    <h6 class="weight_bold xs_content mt-0 mb-2">
                        상세 경력을 기입하고 취업 성공률을 높여보세요!
                    </h6>
                    <div class="tech_card overflow-hidden mt-md-n5 shadow">
                        <div class="row">
                            <div class="col-4 mr-0 pr-0 d-md-none">
                                <div class="py-3 px-2">
                                    <div class="avatar square bg-white" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 ml-0 pl-0 col-md-12 px-md-5">
                                <div class="text-left">
                                    <h5 class="weight_bold mb-1 mt-2"><?=$logged_info['m_name']?>
                                        <span class="xs_content weight_lighter">(<?=$myinfo_row[0]['m_birthday']?>세)</span>
                                    </h5>
                                    <?php $desired_work_place = $myinfo_row[0]['local_name'] . " ";
                                    if($myinfo_row[0]['m_city_idx'] != -1){ $desired_work_place .= $myinfo_row[0]['city_name']; }
                                    if($myinfo_row[0]['m_district_idx'] != -1){ $desired_work_place .= $myinfo_row[0]['district_name']; }?>
                                    <div class="row px-3 pb-2">
                                        <p class="col-12 col-md-12 xs_content weight_lighter px-0 cut1 mb-1"><img src="/oPage/images/imgicons/helmet_bg_red.png" height="20" /> <b>희망직무</b> : <?=$myinfo_row[0]['hope_duty']?></p>
                                        <p class="col-12 col-md-6 xs_content weight_lighter px-0 mb-1"><img src="/oPage/images/imgicons/location_bg_red.png" height="20" /> <b>희망지역</b> : <?=$desired_work_place?></p>
                                        <p class="col-12 col-md-6 xs_content weight_lighter px-0 mb-0"><img src="/oPage/images/imgicons/wrench_bg_red.png" height="20" /> <b>주요경력</b> : <?=$myinfo_row[0]['duty_name']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="<?=getUrl('technician','resumeWrite',$m_idx)?>" class="btn btn-block btn-primary mt-0 rounded-0">이력서 수정하기</a>
                    </div>
                </div>
            </div>
            <!--                end mobile card-->
            <!--PC card-->
            <div class="col-12 d-none d-md-block" style="
                    background-image:url('/oPage/technician/images/main_1section_bg.png');
                    background-size:contain;
                    background-repeat:no-repeat;
                    background-position:center top;
            ">
                <div class="col-md-10 col-lg-8 mx-auto mt-md-5">
                    <div class="mx-auto avatar position-relative square bg-white" style="
                                max-width:150px;
                                margin-top:-75px;
                                z-index:50;
                                background-image:url('/layout/none/assets/images/no_avatar.png');
                            ">
                    </div>
                    <div class="tech_card overflow-hidden mt-md-n5 bg-white shadow">
                        <div class="row">
                            <div class="d-none d-md-block px-5 text-center col-12 pt-5">
                                <h5 class="mt-4 mb-1">
                                    <span class="red"><?=$logged_info['m_name']?></span>님의 이력서 완성도는
                                    <span class="red">
                                      <?php if($count_career_row[0]['count_career'] == $count_c_content_row[0]['count_c_content'] && $count_myinfo_row[0]['count_myinfo']){
                                          echo '높음';
                                      }else if($count_career_row[0]['count_career'] > $count_c_content_row[0]['count_c_content'] && $count_myinfo_row[0]['count_myinfo']){
                                          echo '중간';
                                      }else{
                                          echo '낮음';
                                      }
                                      ?>
                                    </span>입니다.
                                </h5>
                                <h5 class="mt-0 mb-2">
                                    상세 경력을 기입하고 취업 성공률을 높여보세요!
                                </h5>
                                <hr />
                            </div>
                            <div class="col-4 mr-0 pr-0 d-md-none">
                                <div class="content_padding">
                                    <div class="avatar square bg-white" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 ml-0 pl-0 col-md-12 px-md-5">
                                <div class="text-left">
                                    <?php $desired_work_place = $myinfo_row[0]['local_name'] . " ";
                                    if($myinfo_row[0]['m_city_idx'] != -1){ $desired_work_place .= $myinfo_row[0]['city_name']; }
                                    if($myinfo_row[0]['m_district_idx'] != -1){ $desired_work_place .= $myinfo_row[0]['district_name']; }?>
                                    <div class="row px-5 pb-sm-2 pb-md-3">
                                        <h5 class="weight_bold mb-2"><?=$logged_info['m_name']?>
                                            <span class="xs_content weight_lighter">(<?=$myinfo_row[0]['m_birthday']?>세)</span>
                                        </h5>
                                        <p class="col-12 col-md-12 sm_content weight_lighter px-0 cut1 mb-1"><img src="/oPage/images/imgicons/helmet_bg_red.png" height="20" /> <b>희망직무</b> : <?=$myinfo_row[0]['hope_duty']?></p>
                                        <p class="col-12 col-md-6 sm_content weight_lighter px-0"><img src="/oPage/images/imgicons/wrench_bg_red.png" height="20" /> <b>주요경력</b> : <?=$myinfo_row[0]['duty_name']?></p>
                                        <p class="col-12 col-md-6 sm_content weight_lighter px-0"><img src="/oPage/images/imgicons/location_bg_red.png" height="20" /> <b>희망지역</b> : <?=$desired_work_place?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="<?=getUrl('technician','resumeWrite',$m_idx)?>" class="btn btn-block btn-danger py-2 mt-0 rounded-0">이력서 수정하기</a>
                    </div>
                </div>
            </div>
            <!--                end pc card-->
<?php } ?>
        </div>
<!--        end whitebox-->
    </div>
<!--    end col-->
</div>
<!--end row-->
    <!--    배너슬라이드 섹션-->
    <br>
    <div id="demo" class="carousel slide standard" data-ride="carousel">
        <!-- The slideshow -->
        <div class="carousel-inner slick_wrap affix_middle">
            <?php for($i=1; $i<=5; $i++){ ?>
                <div class="carousel-item bg-primary<?php print ($i==1) ? " active" : ""?> text-center">
                    <img src="/layout/none/assets/images/banner_test1.png" alt="banner1" width="100%" style="width:auto; max-height:120px;">
                </div>
            <?php } ?>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>

<?php if($logged_info) { ?>
<div class="container">
    <div class="row">
            <div class="col-12 mt-2">
                <div class="d-block d-lg-none">
                <h6 class="weight_normal mt-3 mb-2"><span class="red"><?=$logged_info['m_name']?>님</span>이,<br />
                    지원하실 확률이 높은 공고를 찾아왔어요!</h6>
                </div>
                <div class="d-none d-lg-block text-center pt-5 pb-3">
                    <div class="text-center xs_content">
                        <i class="text-warning">●</i>
                        <i class="text-primary">●</i>
                        <i class="text-warning">●</i>
                    </div>
                    <h3 class="weight_bold mt-3">AI 추천 공고</h3>
                    <h6 class="weight_lighter mt-1 mb-2">지원하실 확률이 높은 공고를 찾아왔어요!</h6>
                </div>

                <div class="flex-card-slick">
                  <?php foreach($output->get("new_hire2") as $val){ ?>
                    <?php $desired_work_place = $val['local_name'] . " ";if($val['city_name'] != '전체'){ $desired_work_place .= $val['city_name']; }if($val['district_name'] != '전체'){ $desired_work_place .= $val['district_name']; }?>
                      <div class="tech_card bg-white">
                          <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                          </div>
                          <div class="p-2 text-left pb-1">
                              <h6 class="mb-0 pb-0"><?=$val['c_name']?></h6>
                              <h6 class="red cut1 pt-1"><?=$val['h_title']?></h6>
                              <p class="weight_lighter xxs_content mx-0 px-0">
                                  <span class="badge badge-danger weight_lighter">위치</span>
                                  <?=$desired_work_place?>
                                  <? if($val['salary_idx']==4){?>
                                    <span class="badge badge-danger weight_lighter">시</span>
                                    <b><?=$val['job_salary']?>원</b>
                                  <? }else{ ?>
                                    <? if($val['salary_idx']==1){ ?>
                                      <span class="badge badge-danger weight_lighter">연</span>
                                    <? }else if($val['salary_idx']==2){ ?>
                                      <span class="badge badge-danger weight_lighter">월</span>
                                    <? }else if($val['salary_idx']==3){ ?>
                                      <span class="badge badge-danger weight_lighter">일</span>
                                    <? } ?>
                                      <b><?=$val['job_salary']?>만원</b>
                                  <? } ?>
                              </p>
                              <p class="text-secondary xxs_content mx-0 px-0">
                                  <i class="xi-clock-o"></i> 마감 <?=$val['hire_end_date']?>일 전
                                  <!-- <i class="xi-eye-o"></i> 142 -->
                              </p>
                          </div>
                          <a href="<?=getUrl('technician','jobDetail',$val['h_idx'])?>" class="btn btn-block btn-warning mt-3 rounded-0">자세히 보기</a>
                      </div>
                  <?php } ?>
                </div>
            </div>
    </div>
</div>
<?php } ?>

<div class="container d-lg-none">
    <div class="row">
        <div class="col-12 pb-4">
            <h5 class="weight_normal mt-4">
                실시간 지원현황
            </h5>
            <div class="tech_card bg-white text-left">
                <div class="p-3 weight_lighter mb-0">
                  <?php foreach($output->get("now_application") as $val){
                      $diff = time() - strtotime($val['reg_date']);
                        if ( $diff>86400 ) {
                          $application_time= ceil($diff/86400).'일 전';
                        } else if ( $diff>3600 ) {
                          $application_time= ceil($diff/3600).'시간 전';
                        } else if ( $diff>60 ) {
                          $application_time= ceil($diff/60).'분 전';
                        } else {
                          $application_time= $diff.'초 전';
                        }
                    ?>
                      <p class="cut1">
                        <span class="btn btn-round btn-xxs btn-danger"><?=$application_time?></span>
                        <?=$val['c_name']?>에 지원자가 발생했습니다.
                      </p>
                <?}?>
                </div>
            </div>
        </div>
    </div>
</div>



<link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet" />
<style>
    .russo_one{
        font-family: 'Russo One', sans-serif;
    }
</style>
<div class="d-none d-lg-block container-fluid text-white sub_visual mt-5" style="background-image:url('/oPage/company/visual/company.noauto.png'); background-color:#141d35; background-size:contain; background-repeat:no-repeat; background-position:80% bottom;">
    <div class="container py-5 text-left">
        <h5>국내1위 기술인력 전문 구인구직 매칭서비스</h5>
        <h4>지금까지 <span class="text-warning">기술자숲</span>을 통해</h4>
        <h3>전달된 일자리 <span class="weight_bold" style="font-size:40px;">총 <b class="russo_one text-warning"><?=number_format($all_hire_row[0]['count_hire'])?></b>개</span></h3>
    </div>
</div>

<div class="d-none d-lg-block container">
    <div class="text-center pt-5 pb-3">
        <div class="text-center xs_content">
            <i class="text-warning">●</i>
            <i class="text-primary">●</i>
            <i class="text-warning">●</i>
        </div>
        <h3 class="weight_bold mt-3">언론보도</h3>
        <h6 class="weight_lighter mt-1 mb-2">기술자숲의 언론보도 및 소식을 확인해보세요.</h6>
    </div>
    <div class="flex-card-slick">
        <?php foreach($news_list as $val){ ?>
            <div class="col-4 mt-2">
                <div class="shadow">
                    <div style="background-image:url('<?=$val['n_img']?>'); min-height:150px;">

                    </div>
                    <div class="px-md-2">
                        <div class="px-2 py-3">
                            <h6 class="weight_normal cut1"><?=$val['n_title']?></h6>
                            <p class="xs_content px-0 cut1">
                                <?=$val['n_content']?>
                            </p>
                            <hr />
                            <a class="btn btn-primary btn-xs py-2 px-3 pull-right" href="<?=$val['n_link']?>">자세히 보기</a>
                            <p class="text-secondary my-0 py-0 px-0"><?=$val['n_date']?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<div class="d-none py-5 d-lg-block container-fluid mt-5 bg-light">
    <div class="d-flex container">
        <a href="#" target="_blank"><img src="/oPage/company/supports/01_logo.png" /></a>
        <a href="#" target="_blank"><img src="/oPage/company/supports/04_logo.png" /></a>
        <a href="#" target="_blank"><img src="/oPage/company/supports/02_logo.png" /></a>
        <a href="#" target="_blank"><img src="/oPage/company/supports/03_logo.png" /></a>
    </div>
</div>

<!-- 이름,생년,전화번호,주소,경력이 있는 개인회원에게 추천기술자 알림 팝업 -->
<div class="modal fade" id="recommend_technician_modal" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:330px;">
        <div class="modal-content text-center" style="border-radius:10px">
            <a class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#recommend_technician_modal').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="popoup_header rounded-top" style="background-image:url('/oPage/technician/images/popup_header_technician.png');"></div>
            <div class="px-3 pb-2 pt-4">
                <h6 class="weight_normal mb-1">기업이 먼저 입사제안을</h6>
                <h6 class="weight_normal mb-1">할 수 있도록 <span class="red">회원님의 이력서를 </span></h6>
                <h6 class="weight_normal mb-3"><span class="red">추천해도 될까요?</span></h6>
                <a class="btn btn-block btn-danger btn-round btn-lg mb-3" style="color:#fff;font-size:16px;" onclick="rt_click_yes()">네 추천해주세요</a>
                <a class="btn btn-block border-danger text-danger btn-round btn-lg mt-3 mb-2" style="font-size:16px;" onclick="rt_click_no()">아니오</a>
            </div>
            <button class="btn btn-block btn-light" onclick="jQuery('#recommend_technician_modal').modal('hide');" style="border-radius:10px;">닫기</button>
        </div>
    </div>
</div>

<script type="text/javascript">

  function rt_click_yes(){
    var m_idx = <?=$m_idx?>;
    var params = {
      "m_idx" : m_idx
    };
    exec_json("technician.recommend_technician_yes",params,function(ret_obj){
      ///toastr.success(ret_obj.message);
      $('#recommend_technician_modal').modal('hide');
    });
  }

  function rt_click_no(){
    var m_idx = <?=$m_idx?>;
    var params = {
      "m_idx" : m_idx
    };
    exec_json("technician.recommend_technician_no",params,function(ret_obj){
      //toastr.success(ret_obj.message);
      document.location.href = "<?=getUrl('member','settingAlert')?>"
    });
  }
  //이름,생년,전화번호,주소,경력이 있는 개인회원에게 추천기술자 알림 팝업
  //yes or no 클릭 시, TF_recommend_technician에 입력 (닫기는 해당안됨)
  //no 클릭 시, 알림페이지로 이동
  //테이블에 입력된 회원은 안뜸.
  if(<?=$_SESSION['LOGGED_INFO']?> > 0 && <?=count($count_career_row)?> > 0 && "<?=$logged_info['m_name']?>" != "" && "<?=$logged_info['m_birthday']?>" != ""
    && "<?=$logged_info['m_phone']?>" != "" && "<?=$logged_info['m_address']?>" != "" && <?=count($rt_row)?> == 0){
    jQuery(window).on('load',function(){
        $('#recommend_technician_modal').modal('show');
    });
  }

</script>

<?php $footer_false = true; ?>
