<div class="container-fluid welcome_seciton" style="background-image:url('/oPage/images/home_welcome.png');">
    <img src="/oPage/images/gear.png" class="rotating" style="position:absolute; width:30%; right:-5%; top:-5%;"  />
    <img src="/oPage/images/gear.png" class="rotating_slow" style="position:absolute; left:-35%; width:60%; top:3%;" />
    <div class="container">
    <div class="row">
        <div class="col">
        <?php if(!$logged_info) { ?>
        <h4 class="weight_lighter">안녕하세요</h4>
        <h4 class="weight_bold mb-3">채용담당자님:)</h4>
        <?php } ?>
        <?php if($logged_info) { ?>
        <h5 class="weight_lighter"><?=$logged_info['c_name']?> 채용담당자님:)</h5>
        <h5 class="weight_lighter mb-3">어떤 기술자를 찾고 계신가요?</h5>
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
                <a class="nav-link btn btn-danger btn-round btn-xs" href="#"">회원가입</a>
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
                    <div class="tech_card">
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
        <div class="col-9 mr-0 pr-0">
            <h6 class="weight_lighter mt-4">총 <span class="red">2건</span>의 진행중인 공고가 있어요.</h6>
        </div>
        <div class="col-3 ml-0 pl-0">
            <a href="#" class="mt-3 btn btn-block btn-primary btn-xxs btn-round">추가등록<i class="xi-plus"></i></a>
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
                            <p class="text-secondary xxs_content mx-0 px-0"><i class="xi-clock-o"></i> 마감 13일 전</p>
                        </div>
                        <div class="row mt-1 mx-0 px-0">
                            <div class="col-6 mx-0 px-0">
                                <a href="#" class="btn btn-light btn-block rounded-0">수정</a>
                            </div>
                            <div class="col-6 mx-0 px-0">
                                <a href="#" class="btn btn-light btn-block rounded-0 red">지원자 (4)</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <?php if(!$logged_info) { ?>
        <div class="col-12">
        <h5 class="weight_lighter mt-4">
            <span class="btn btn-round btn-xxs btn-primary">NEW</span>
            새로운 기술자가 등록됐어요!
        </h5>
        </div>
        <?php } ?>
        <?php if($logged_info) { ?>
            <div class="col-12">
                <h6 class="weight_lighter mt-4"><span class="red"><?=$logged_info['c_name']?></span>에 딱 맞는 공고를 찾아왔어요!</h6>
            </div>
        <?php } ?>
        <div class="col-12 mt-2">
            <div class="flex-card-slick">
                <?php foreach($output->get("new_member2") as $val){ ?>
                  <?php $desired_work_place = $val['local_name'] . " ";
                        if($val['m_city_idx'] != -1){ $desired_work_place .= $val['city_name']; }
                        if($val['m_district_idx'] != -1){ $desired_work_place .= $val['district_name']; }?>
                    <div class="tech_card bg-white overflow-hidden">
                        <div class="avatar square" style="margin: 10px 25px; background-image:url('/layout/none/assets/images/no_avatar.png');">
                        </div>
                        <h6 class="weight_normal mb-3"><?=$val['m_name']?> (<?=$val['m_birthday']?>세)</h6>
                        <p class="text-left xxs_content"><span class="bg-red icon_wrap"><i class="xi-wrench"></i></span>주요경력 : <?=$val['duty_name']?></p>
                        <p class="text-left xxs_content"><span class="bg-red icon_wrap"><i class="xi-map-marker"></i></span>희망지역 : <?=$desired_work_place?></p>
                        <a href="#" class="btn btn-block btn-warning mt-3 rounded-0">이력서 보기</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<!--    배너슬라이드 섹션-->
<br>
<div id="demo" class="carousel slide standard" data-ride="carousel">

  <!-- The slideshow -->
  <div class="carousel-inner slick_wrap affix_middle">
    <div class="carousel-item bg-primary active">
      <img src="/layout/none/assets/images/no_banner.png" alt="banner1" width="100%">
    </div>
    <div class="carousel-item bg-primary">
      <img src="/layout/none/assets/images/no_banner.png" alt="banner2" width="100%">
    </div>
    <div class="carousel-item bg-primary">
      <img src="/layout/none/assets/images/no_banner.png" alt="banner3" width="100%">
    </div>
    <div class="carousel-item bg-primary">
      <img src="/layout/none/assets/images/no_banner.png" alt="banner4" width="100%">
    </div>
    <div class="carousel-item bg-primary">
      <img src="/layout/none/assets/images/no_banner.png" alt="banner5" width="100%">
    </div>
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
            <h5 class="weight_lighter mt-4">
                실시간 지원현황
            </h5>

            <div class="tech_card bg-white text-left">
                <div class="content_padding weight_lighter">
                <p><span class="btn btn-round btn-xxs btn-danger">07분 전</span> 학남건설에 지원자가 발생했습니다.</p>
                <p><span class="btn btn-round btn-xxs btn-danger">21분 전</span> 학남건설에 지원자가 발생했습니다.</p>
                </div>
                <a href="#" class="btn btn-block btn-lg btn-light weight_normal mt-3 rounded-0">실시간 지원현황 더 보기</a>
            </div>
        </div>
    </div>
</div>
