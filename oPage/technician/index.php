<?php
$m_idx = $_SESSION['LOGGED_INFO'];

//이력서완성도(경력 개수)
$oDB->where("m_idx",$m_idx);
$count_career_row = $oDB->getOne("TF_member_career_tb","count(m_idx) as count_career");

//이력서완성도(경력 직무상세내용 개수)
$oDB->where("m_idx",$m_idx);
$oDB->where("c_content","","!=");
$oDB->where("c_content",NULL, 'IS NOT');
$count_c_content_row = $oDB->getOne("TF_member_career_tb","count(c_content) as count_c_content");

//이력서완성도(기본정보+희망4종 입력 여부)
$oDB->where("m.m_idx",$m_idx);
$oDB->where("d.m_idx",NULL,"IS NOT");
$oDB->where("m.m_address2",NULL,"IS NOT");
$oDB->where("m.m_address2","","!=");
$oDB->where("m.m_address","","!=");
$oDB->where("m.m_phone","","!=");
$oDB->where("m.m_birthday","","!=");
$oDB->where("m.m_email","","!=");
$oDB->join("TF_member_duty d","m.m_idx = d.m_idx", "LEFT");
$oDB->join("TF_member_occupation o","m.m_idx = o.m_idx", "LEFT");
$oDB->join("TF_member_order mo","m.m_idx = mo.m_idx", "LEFT");
$count_myinfo_row = $oDB->getOne("TF_member_tb m","count(m.m_idx) as count_myinfo");

//이력서 정보
$columns = "distinct m.m_idx, group_concat(distinct(mc.duty_name)) as duty_name, group_concat(md.duty_name) as hope_duty,";
$columns .= "YEAR(CURRENT_TIMESTAMP) - YEAR(m_birthday) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(m_birthday, 5))+1 as m_birthday,";
$columns .= "local_name, city_name, district_name, m_city_idx, m_district_idx";

$oDB->where("m.m_idx",$m_idx);
$oDB->where("mc.duty_name","",'!=');
$oDB->groupBy("m.m_idx");
$oDB->join("TF_member_career_tb AS mc", "m.m_idx = mc.m_idx", "LEFT");
$oDB->join("TF_member_duty AS md", "m.m_idx = md.m_idx", "LEFT");
$oDB->join("TF_local_tb AS l", "m.m_local_idx = l.local_idx", "LEFT");
$oDB->join("TF_city_tb AS c", "m.m_city_idx = c.city_idx", "LEFT");
$oDB->join("TF_district_tb AS d", "m.m_district_idx = d.district_idx", "LEFT");
$myinfo_row = $oDB->getOne("TF_member_tb AS m",$columns);

?>


<div class="container-fluid welcome_seciton" style="background-image:url('/oPage/images/technician_welcome.png');">
    <img src="/oPage/images/gear.png" class="rotating d-sm-none" style="position:absolute; width:30%; right:-5%; top:-5%;"  />
    <img src="/oPage/images/gear.png" class="rotating_slow d-sm-none" style="position:absolute; left:-35%; width:60%; top:3%;" />
    <div class="container">
    <div class="row">
        <div class="col">
        <?php if(!$logged_info) { ?>
        <h4 class="weight_lighter"><b>기술자님 :)</b> 로그인하고</h4>
        <h4 class="weight_lighter mb-3">맞춤 일자리를 확인하세요!</h4>
        <?php } ?>
        <?php if($logged_info) { ?>
        <h5 class="weight_bold"><?=$logged_info['m_name']?>님 :)</h5>
        <h5 class="weight_lighter mb-3">어떤 일자리를 찾고 계신가요?</h5>
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
            <h6 class="weight_lighter mt-4">아직 이력서를 등록하지 않으셨네요!</h6>
            <button class="btn btn-lg btn-block btn-warning sm_content">이력서 등록하고 맞춤 일자리 확인하기
                <span class="color_primary"><i class="xi-plus-circle"></i></span>
            </button>
        </div>

        <div class="col-9 mr-0 pr-0">
            <h6 class="weight_lighter mt-4">오늘의 주요 채용 공고!</h6>
        </div>
        <div class="col-3 ml-0 pl-0">
            <a href="#" class="mt-3 btn btn-block btn-primary btn-xxs btn-round">더보기<i class="xi-plus"></i></a>
        </div>

        <div class="col-4 mr-0 pr-1">
            <select class="form-control"><option>기계/제조</option></select>
        </div>
        <div class="col-4 mx-0 px-0">
            <select class="form-control"><option>배관</option></select>
        </div>
        <div class="col-4 ml-0 pl-1">
            <select class="form-control"><option>부산</option></select>
        </div>

        <div class="col-12 mt-2">
            <div class="flex-card-slick">
                <?php for($i=1; $i<=3; $i++){ ?>
                    <div class="tech_card bg-white">
                        <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                        </div>
                        <div class="content_padding text-left pb-1">
                            <h6><?=$logged_info->company?></h6>
                            <h6 class="red">CATIA 프로그램 경력자 모집</h6>
                            <p class="weight_lighter xxs_content mx-0 px-0">
                                <span class="badge badge-danger weight_lighter">위치</span>
                                경남 김해시
                                <span class="badge badge-danger weight_lighter">연</span>
                                <b>4,500 만원</b>
                            </p>
                            <p class="text-secondary xxs_content mx-0 px-0">
                                <i class="xi-clock-o"></i> 마감 13일 전
                                <i class="xi-eye-o"></i> 114
                            </p>
                        </div>
                        <a href="#" class="btn btn-block btn-warning mt-3 rounded-0">자세히 보기</a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php }else{ ?>
            <div class="col-12" style="
                    background-image:url('/oPage/technician/images/main_1section_bg.png');
                    background-size:contain;
                    background-repeat:no-repeat;
                    background-position:center top;
            ">
                <div class="d-block d-md-none">
                <h6 class="weight_lighter mt-4 mb-1">
                    <span class="red"><?=$logged_info['m_name']?></span>님의 이력서 완성도는
                    <span class="red">
                      <?php if($count_career_row['count_career'] == $count_c_content_row['count_c_content'] && $count_myinfo_row['count_myinfo']){
                        echo '높음';
                      }else if($count_career_row['count_career'] > $count_c_content_row['count_c_content'] && $count_myinfo_row['count_myinfo']){
                        echo '중간';
                      }else{
                        echo '낮음';
                      }
                      ?>
                    </span>입니다.
                </h6>
                <h6 class="weight_lighter mt-0 mb-2">
                    상세 경력을 기입하고 취업 성공률을 높여보세요!
                </h6>
                </div>

                <div class=" col-md-10 col-lg-8 mx-auto mt-md-5">
                    <div class="d-none d-md-block mx-auto avatar position-relative square bg-white" style="
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
                                  <?php if($count_career_row['count_career'] == $count_c_content_row['count_c_content'] && $count_myinfo_row['count_myinfo']){
                                      echo '높음';
                                  }else if($count_career_row['count_career'] > $count_c_content_row['count_c_content'] && $count_myinfo_row['count_myinfo']){
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
                                <div class="mx-auto avatar square bg-white" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                                </div>
                            </div>
                        </div>
                        <div class="col-8 ml-0 pl-0 col-md-12 px-md-5">
                            <div class="text-left">
                                <h5 class="weight_bold mb-2 pt-3"><?=$logged_info['m_name']?>
                                    <span class="xs_content weight_lighter">(<?=$myinfo_row['m_birthday']?>세)</span>
                                </h5>
                                <?php $desired_work_place = $myinfo_row['local_name'] . " ";
                                      if($myinfo_row['m_city_idx'] != -1){ $desired_work_place .= $myinfo_row['city_name']; }
                                      if($myinfo_row['m_district_idx'] != -1){ $desired_work_place .= $myinfo_row['district_name']; }?>
                                <div class="row px-3 py-sm-2 py-md-3">
                                <p class="col-12 col-md-6 xxs_content weight_lighter px-0"><span class="bg-red icon_wrap"><i class="xi-dashboard"></i></span> <b>희망직무</b> : <?=$myinfo_row['hope_duty']?></p>
                                <p class="col-12 col-md-6 xxs_content weight_lighter px-0"><span class="bg-red icon_wrap"><i class="xi-wrench"></i></span> <b>주요경력</b> : <?=$myinfo_row['duty_name']?></p>
                                <p class="col-12 col-md-6 xxs_content weight_lighter px-0"><span class="bg-red icon_wrap"><i class="xi-map-marker"></i></span> <b>희망지역</b> : <?=$desired_work_place?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn btn-block btn-danger mt-0 rounded-0">이력서 수정하기</a>
                </div>
                </div>
            </div>
<?php } ?>
    </div>
</div>
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

<?php if($logged_info) { ?>
<div class="container">
    <div class="row">
            <div class="col-12 mt-2">
                <div class="d-block d-lg-none">
                <h5 class="weight_bold mt-3"><span class="red"><?=$logged_info['m_name']?></span>님 께서,</h5>
                <h6 class="weight_lighter mt-1 mb-2">지원하실 확률이 높은 공고를 찾아왔어요!</h6>
                </div>
                <div class="d-none d-lg-block text-center pt-5 pb-3">
                    <h3 class="weight_bold mt-3">AI 추천 공고</h3>
                    <h6 class="weight_lighter mt-1 mb-2">지원하실 확률이 높은 공고를 찾아왔어요!</h6>
                </div>

                <div class="flex-card-slick">
                    <?php for($i=1; $i<=3; $i++){ ?>
                        <div class="tech_card bg-white">
                            <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                            </div>
                            <div class="content_padding text-left pb-1">
                                <h6><?=$logged_info->company?></h6>
                                <h6 class="red">CATIA 프로그램 경력자 모집</h6>
                                <p class="weight_lighter xxs_content mx-0 px-0">
                                    <span class="badge badge-danger weight_lighter">위치</span>
                                    경남 김해시
                                    <span class="badge badge-danger weight_lighter">연</span>
                                    <b>4,500 만원</b>
                                </p>
                                <p class="text-secondary xxs_content mx-0 px-0">
                                    <i class="xi-clock-o"></i> 마감 13일 전
                                    <i class="xi-eye-o"></i> 114
                                </p>
                            </div>
                            <a href="#" class="btn btn-block btn-warning mt-3 rounded-0">자세히 보기</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
    </div>
</div>
<?php } ?>

<div class="container d-lg-none">
    <div class="row">
        <div class="col-12">
            <h5 class="weight_lighter mt-4">
                실시간 지원현황
            </h5>
            <div class="tech_card bg-white text-left">
                <div class="content_padding weight_lighter">
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
                      <p>
                        <span class="btn btn-round btn-xxs btn-danger"><?=$application_time?></span>
                        <?=$val['c_name']?>에 지원자가 발생했습니다.
                      </p>
                <?}?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="d-none d-lg-block container-fluid mt-5 text-white sub_visual" style="background-image:url('<?=$no_auto_bg_url?>')">
    <div class="container py-5 text-left">
    <h5>국내1위 기술인력 전문 구인구직 매칭서비스</h5>
    <h4>지금까지 <span class="text-warning">기술자숲</span>을 통해</h4>
    <h3>전달된 일자리 <span class="weight_bold" style="font-size:40px;">총 <b class="weight_super">27,567</b>개</span></h3>
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
                <div class="content_padding">
                    <h6 class="weight_normal">휴대폰으로 딱 10초!, 기술자 일자리 매칭 서비...</h6>
                    <p class="xs_content px-0">
                        30대 소셜 벤처 기업가가 조선산업 불황 여파로 일자리를 잃은 숙련 기...
                    </p>
                    <hr />
                    <a class="btn btn-primary pull-right" href="#">자세히 보기</a>
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
    <a href="#" target="_blank"><img src="/oPage/technician/images/supports_01.jpg" height="59" /></a>
    <a href="#" target="_blank"><img src="/oPage/technician/images/supports_03.jpg" height="59" /></a>
    <a href="#" target="_blank"><img src="/oPage/technician/images/supports_05.jpg" height="59" /></a>
    <a href="#" target="_blank"><img src="/oPage/technician/images/supports_07.png" height="59" /></a>
    </div>
</div>
<?php $footer_false = true; ?>