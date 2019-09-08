<div class="container-fluid welcome_seciton" style="background-image:url('/oPage/images/home_welcome.png');">
    <img src="/oPage/images/gear.png" class="rotating d-sm-none" style="position:absolute; width:30%; right:-5%; top:-5%;"  />
    <img src="/oPage/images/gear.png" class="rotating_slow d-sm-none" style="position:absolute; left:-35%; width:60%; top:3%;" />
    <div class="container">
    <div class="row">
        <div class="col">
          <?php if(!$logged_info) { ?>
            <h4 class="weight_lighter">안녕하세요</h4>
            <h4 class="weight_bold mb-3">채용담당자님:)</h4>
          <?php } ?>
          <?php if($logged_info) { ?>
            <h5 class="weight_normal d-none d-md-block">안녕하세요</h5>
              <h5 class="weight_normal"><span class="weight_bold"><?=$logged_info['c_name']?> 채용담당자님</span> :)</h5>
            <h5 class="weight_normal mb-3">어떤 기술자를 찾고 계신가요?</h5>
          <?php } ?>
          <ul class="nav">
              <?php if(!$logged_info) { ?>
              <li class="nav-item">
                  <a class="nav-link btn btn-warning btn-round btn-xs" href="<?=getUrl('member','login',false,array('cur' => $current_url))?>">로그인</a>
              </li>
              <?php } ?>
              <li class="nav-item">
                  <!--            blank--> &nbsp;
              </li>
              <?php if(!$logged_info) { ?>
              <li class="nav-item">
                  <a class="nav-link btn btn-danger btn-round btn-xs"  href="<?=getUrl('member','signUp')?>">회원가입</a>
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
        <h5 class="weight_lighter mt-4">진행중인 <span class="red">채용공고가 0건</span> 이네요!</h5>
        </div>
        <div class="col-12 mt-2">
            <div class="flex-card-slick">
                <?php for($i=1; $i<=3; $i++){ ?>
                    <div class="tech_card text-center">
                        <div class="thumbnail">
                            <div class="icon_wrap">
                                <i class="xi-plus-circle xi-2x color_primary"></i>
                            </div>
                        </div>
                        <p class="weight_lighter mt-2">공고등록하고<br />맞춤기술자 보기</p>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <?php if($logged_info) { ?>
        <div class="col-12 mr-0 pr-0">
            <a href="<?=getUrl('company','job_register')?>" class="pull-right mr-3 d-none d-md-inline-block mt-3 btn btn-primary btn-round">추가등록<i class="xi-plus"></i></a>
            <a href="<?=getUrl('company','job_register')?>" class="pull-right mr-3 d-md-none mt-4 btn btn-primary py-1 btn-xxs btn-round">추가등록<i class="xi-plus"></i></a>
          <? date_default_timezone_set('Asia/Seoul');
             $now_date = date(YmdHis);
             $m_idx = $_SESSION['LOGGED_INFO'];
             $oDB->where("co.m_idx",$m_idx);
             $oDB->where("h.job_end_date",$now_date,">");
             $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
             $row = $oDB->getOne("TF_hire_tb h","count(h.h_idx) as count_hire");
            ?>
            <h6 class="d-md-none weight_lighter mt-4"><span class="red">총<?=$row['count_hire']?>건</span>의 진행중인 공고가 있어요.</h6>
            <h5 class="d-none d-md-block weight_lighter mt-4">최근 등록하신 <span class="red"><?=$row['count_hire']?>건</span>의 채용공고가 있어요.</h5>
        </div>


        <?php if($row['count_hire'] == 0){?>
          <div class="col-12 mt-2">
              <div class="flex-card-slick">
                  <?php for($i=1; $i<=3; $i++){ ?>
                      <div class="tech_card text-center">
                          <div class="thumbnail">
                              <div class="icon_wrap">
                                  <i class="xi-plus-circle xi-2x color_primary"></i>
                              </div>
                          </div>
                          <p class="weight_lighter mt-2">공고등록하고<br />맞춤기술자 보기</p>
                      </div>
                  <?php } ?>
              </div>
          </div>
        <?php }else{ ?>
        <div class="col-12 mt-2">
            <div class="flex-card-slick">
                <?php foreach($output->get("hire_ing") as $val){ ?>
                    <div class="tech_card bg-white shadow">
                        <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                        </div>
                        <div class="py-2 px-2 text-left pb-1">
                            <p class="pb-0 mb-0"><?=$val['c_name']?></p>
                            <h6 class="red hire_tit"><?=$val['h_title']?></h6>
                            <p class="weight_lighter xxs_content mx-0 px-0">
                              <? if ($val['city_name'] == "전체") { $val['city_name'] = "";} ?>
                              <? if ($val['district_name'] == "전체") { $val['district_name'] = ""; }?>
                              <? if($val['salary_idx'] < 3) { $hire_salary_text = "만원"; } else { $hire_salary_text = "원"; } ?>
                                <span class="badge badge-danger weight_lighter"><i class="xi-map-marker"></i></span>
                                <?php echo $val['local_name'] . " " . $val['city_name'].$val['district_name'];?>
                                <span class="salary_span badge badge-danger weight_lighter">
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
                                <b><?php echo number_format($val['job_salary']) . $hire_salary_text?></b>
                            </p>
                            <p class="text-secondary xxs_content mx-0 px-0"><i class="xi-clock-o"></i> 마감 <?=$val['job_end_day']?>일 전</p>
                        </div>
                        <div class="row mt-1 mx-0 px-0">
                            <div class="col-6 mx-0 px-0">
                                <a href="<?=getUrl('company','job_appRegister',$val['h_idx']);?>" class="btn btn-light btn-block rounded-0 xs_content">수정</a>
                            </div>
                            <div class="col-6 mx-0 px-0">
                                <a href="<?=getUrl('company','job',$val['h_idx']);?>" class="btn btn-light btn-block rounded-0 red xs_content">지원자 (<?=$val['applicant']?>)</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
<!--    endrow-->
</div>
<!-- end section -->


<!--    배너슬라이드 섹션-->
<br>
<div id="demo" class="carousel slide standard" data-ride="carousel">

  <!-- The slideshow -->
  <div class="carousel-inner slick_wrap affix_middle">
      <?php for($i=1; $i<=5; $i++){ ?>
          <div class="carousel-item bg-primary<?php print ($i==1) ? " active" : ""?> text-center">
              <img src="/layout/none/assets/images/no_banner.png" alt="banner1" width="100%" style="width:auto; max-height:120px;">
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


<div class="container">
    <div class="row">
        <div class="col-12">

            <?php if($logged_info) { ?>
                <div class="d-block d-lg-none">
                    <h5 class="weight_lighter mt-4">
                        <span class="red">기술자숲</span>에 딱 맞는 추천기술자를 찾아왔어요!
                    </h5>
                </div>
            <?php } else { ?>
                <div class="d-block d-lg-none">
                    <h5 class="weight_lighter mt-4">
                        <span class="btn btn-round btn-xxs btn-primary">NEW</span>
                        새로운 기술자가 등록됐어요!
                    </h5>
                </div>
            <?php } ?>
            <div class="d-none d-lg-block text-center pt-5 pb-3">
                <h3 class="weight_bold mt-3">AI 추천 기술자</h3>
                <h6 class="weight_lighter mt-1 mb-2">ABC기업과 맞는 기술자를 추천 해 드립니다! 지금 확인해보세요!</h6>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="flex-card-slick">
                <?php foreach($output->get("new_member2") as $val){ ?>
                    <?php $desired_work_place = $val['local_name'] . " ";
                    if($val['m_city_idx'] != -1){ $desired_work_place .= $val['city_name']; }
                    if($val['m_district_idx'] != -1){ $desired_work_place .= $val['district_name']; }?>
                    <div class="tech_card bg-white overflow-hidden mx-md-3 mb-md-3 shadow">
                        <div class="avatar square w-50 mx-auto my-2 my-sm-3 my-md-4" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                        </div>
                        <h6 class="weight_normal mb-3 px-2 text-center"><?=$val['m_name']?> (<?=$val['m_birthday']?>세)</h6>
                        <p class="text-left xs_content px-3 py-0 m-0 mb-1">  <img class="d-inline imgicon" src="/oPage/images/imgicons/location_bg_red.png" height="10" /> 희망지역 : <?=$desired_work_place?></p>
                        <p class="text-left xs_content px-3 py-0 m-0" class="cut1" style="height:42px;"> <img class="d-inline imgicon" src="/oPage/images/imgicons/wrench_bg_red.png" height="10" /> 주요경력 : <?=$val['duty_name']?></p>
                        <div class="row mt-0 mx-0 px-0">
                            <div class="col-12 mx-0 px-0">
                              <a href="<?=getUrl('technician','resume',$val['m_idx'],array("from"=>"index"))?>" target="_blank" class="btn btn-block btn-warning mt-3 rounded-0">이력서보기</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="#" class="d-none d-md-inline-block mt-3 btn btn-primary btn-round">더 많은 기술자보기</a>
    </div>
</div>

<div class="container-fluid bg-light pb-5 pt-5 pt-lg-2 mt-5">
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-12">
                <div class="d-block d-lg-none">
                    <h5 class="weight_lighter">
                        실시간 지원현황
                    </h5>
                </div>
                <div class="d-none d-lg-block text-center pt-5 pb-3">
                    <h3 class="weight_bold mt-3">실시간 지원현황</h3>
                </div>
            </div>
                <div class="weight_lighter">
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
                      <div class="tech_card bg-white text-left p-2 mb-2 shadow">
                      <p class="cut1 pb-0 mb-0">
                        <span class="btn btn-round btn-xxs btn-danger"><?=$application_time?></span>
                        <?=$val['c_name']?> 에 지원자가 발생했습니다.
                      </p>
                    </div>
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
<div class="d-none d-lg-block container-fluid text-white sub_visual" style="background-image:url('/oPage/company/visual/company.noauto.png'); background-color:#1F3951; background-size:contain; background-repeat:no-repeat; background-position:80% bottom;">
    <div class="container py-5 text-left">
        <h5>국내1위 기술인력 전문 구인구직 매칭서비스</h5>
        <h4>지금까지 <span class="text-warning">기술자숲</span>을 통해</h4>
        <h3>전달된 일자리 <span class="weight_bold" style="font-size:40px;">총 <b class="russo_one text-warning">27,567</b>개</span></h3>
    </div>
</div>

<div class="d-none d-lg-block container">
    <div class="text-center pt-5 pb-3">
        <h3 class="weight_bold mt-3">언론보도</h3>
        <h6 class="weight_lighter mt-1 mb-2">기술자숲의 언론보도 및 소식을 확인해보세요.</h6>
    </div>
    <div class="row">
        <?php for($i=1; $i<=3; $i++){ ?>
            <div class="col-4 mt-2">
                <div class="shadow">
                    <div style="background-color:#EEE; min-height:150px;">

                    </div>
                    <div class="px-md-2">
                        <div class="p-2">
                            <h6 class="weight_normal">휴대폰으로 딱 10초!, 기술자 일자리 매칭 서비...</h6>
                            <p class="xs_content px-0">
                                30대 소셜 벤처 기업가가 조선산업 불황 여파로 일자리를 잃은 숙련 기...
                            </p>
                            <hr />
                            <a class="btn btn-primary btn-xs py-2 px-3 pull-right" href="#">자세히 보기</a>
                            <p class="text-secondary my-0 py-0 px-0">2019.05.30</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<div class="d-none py-5 d-lg-block container-fluid mt-5 bg-light">
    <div class="d-flex justify-content-between container">
        <a href="#" target="_blank"><img src="/oPage/company/supports/01_logo.png" /></a>
        <a href="#" target="_blank"><img src="/oPage/company/supports/02_logo.png" /></a>
        <a href="#" target="_blank"><img src="/oPage/company/supports/03_logo.png" /></a>
        <a href="#" target="_blank"><img src="/oPage/company/supports/04_logo.png" /></a>
    </div>
</div>
<!-- 메인에 뜨는 공고등록 유도 팝업 -->
<div class="modal fade" id="tech_modal_example" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#tech_modal_example').modal('hide');" ><i class="xi-close xi-2x"></i></a>
            <div class="popoup_header rounded-top" style="background-image:url('/oPage/company/images/popup_header_company.png');"></div>
            <div class="px-3 pb-2 pt-4">
                <h6 class="weight_lighter">지금 공고를 등록하시면 <span class="red">적합한 구직자와 빠르게</span> 연결될 수 있습니다.</h6>
                <h6 class="weight_normal mb-2 mt-4 mb-3">공고를 등록하시겠습니까?</h6>
                <a class="btn btn-block btn-danger btn-round btn-lg mb-3" href="<?=getUrl('company','job_register')?>">공고 등록 하러가기</a>
            </div>
            <button class="py-3 btn btn-block btn-light" onclick="jQuery('#tech_modal_example').modal('hide');" style="border-radius:10px;">메인페이지로 이동</button>
        </div>
    </div>
</div>


<?php $footer_false = true; ?>

<script type="text/javascript">
    // jQuery(document).ready(function($){
    //     $('#tech_modal_example').modal('show');
    // });
    <?if($row['count_hire']){?>
      var count_hire = <?=$row['count_hire']?>;
    <? }else{?>
      var count_hire = 0;
    <? } ?>;
    var loginfo = <?=$_SESSION['LOGGED_INFO']?>;
  if( (loginfo > 0 && count_hire < 1) && ("<?=$logged_info['registration']?>" == "" || "<?=$logged_info['address']?>" == "")){
    jQuery(document).ready(function($){
        $('#tech_modal_example').modal('show');
    });
  }else if(<?=$_SESSION['LOGGED_INFO']?> > 0){
    jQuery(document).ready(function($){

    var hire_end = <?=count($output->get('hire_end'))?>;
    if(hire_end > 0){
      var params = {};
      var hire_array = [];
      var reg_array = [];
      var i=0;
      <?php foreach($output->get("hire_end") as $val){ ?>
        hire_array[i] = <?=$val['h_idx']?>;
        reg_array[i] = '<?=$val['job_end_date']?>';
        i++;
      <? } ?>
      params['m_idx'] = <?=$_SESSION['LOGGED_INFO']?>;
      params['hire_array'] = hire_array;
      params['reg_date'] = reg_array;
      exec_json("company.hire_end",params,function(ret_obj){

      });

      }
    });
  }


</script>
