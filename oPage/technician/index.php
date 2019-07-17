<div class="container-fluid welcome_seciton" style="background-image:url('/oPage/images/technician_welcome.png');">
    <img src="/oPage/images/gear.png" class="rotating" style="position:absolute; width:30%; right:-5%; top:-5%;"  />
    <img src="/oPage/images/gear.png" class="rotating_slow" style="position:absolute; left:-35%; width:60%; top:3%;" />
    <div class="container">
    <div class="row">
        <div class="col">
        <?php if(!$logged_info) { ?>
        <h4 class="weight_lighter"><b>기술자님 :)</b> 로그인하고</h4>
        <h4 class="weight_lighter mb-3">맞춤 일자리를 확인하세요!</h4>
        <?php } ?>
        <?php if($logged_info) { ?>
        <h5 class="weight_bold"><?=$logged_info->user_name?>님:)</h5>
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
            <div class="col-12">
                <h6 class="weight_lighter mt-4 mb-1">
                    <span class="red"><?=$logged_info->user_name?></span>님의 이력서 완성도는
                    <span class="red">'낮음'</span>입니다.
                </h6>
                <h6 class="weight_lighter mt-0 mb-2">
                    상세 경력을 기입하고 취업 성공률을 높여보세요!
                </h6>

                <div class="tech_card overflow-hidden">
                    <div class="row">
                        <div class="col-4 mr-0 pr-0">
                            <div class="content_padding">
                                <div class="mx-auto avatar square bg-white" style="background-image:url('/layout/none/assets/images/no_avatar.png');">
                                </div>
                            </div>
                        </div>
                        <div class="col-8 ml-0 pl-0">
                            <div class="text-left">
                                <h5 class="weight_bold mb-2 pt-3"><?=$logged_info->user_name?>
                                    <span class="xs_content weight_lighter"><?=zdate($logged_info->birthday,"Y.m.d")?> (56세)</span>
                                </h5>
                                <p class="xxs_content weight_lighter px-0"><span class="bg-red icon_wrap"><i class="xi-dashboard"></i></span> <b>희망직무</b> : 용접</p>
                                <p class="xxs_content weight_lighter px-0"><span class="bg-red icon_wrap"><i class="xi-wrench"></i></span> <b>주요경력</b> : 없음</p>
                                <p class="xxs_content weight_lighter px-0"><span class="bg-red icon_wrap"><i class="xi-map-marker"></i></span> <b>희망지역</b> : 부산</p>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn btn-block btn-primary mt-0 rounded-0">이력서 수정하기</a>
                </div>
            </div>

            <div class="col-12 mt-2">
                <h5 class="weight_bold mt-3"><span class="red"><?=$logged_info->user_name?></span>님 께서,</h5>
                <h6 class="weight_lighter mt-1 mb-2">지원하실 확률이 높은 공고를 찾아왔어요!</h6>

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
        <?php } ?>
    </div>
</div>

<!--    배너슬라이드 섹션 // 기술자쪽은 affix 하지않음-->
<div class="standard">
    <div class="slick_wrap">
        <div class="banners_slick mt-5">
            <?php for($i=1; $i<=4; $i++){ ?>
                <div class="banner bg-primary">
                    <img src="/layout/none/assets/images/no_banner.png" />
                </div>
            <?php } ?>
        </div>
    </div>
</div>