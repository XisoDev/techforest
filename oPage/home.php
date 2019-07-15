<div class="container-fluid welcome_seciton" style="background-image:url('/oPage/images/home_welcome.png');">
    <div class="container">
    <div class="row">
        <div class="col">
        <h4 class="weight_lighter">안녕하세요</h4>
        <h4 class="weight_bold mb-3">기술자숲 채용담당자님:)</h4>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link btn btn-warning btn-round btn-xs" href="#">로그인</a>
            </li>
            <li class="nav-item">
                <!--            blank--> &nbsp;
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-danger btn-round btn-xs" href="#"">회원가입</a>
            </li>
        </ul>
        </div>
    </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h5 class="weight_lighter mt-4">진행중인 <span class="red">채용공고가 0건</span> 이네요!</h5>
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

        <div class="col-12">
            <h5 class="weight_lighter mt-4">
                <span class="btn btn-round btn-xxs btn-primary">NEW</span>
                새로운 기술자가 등록됐어요!
            </h5>
            <div class="flex-card-slick">
                <?php for($i=1; $i<=4; $i++){ ?>
                    <div class="tech_card bg-white overflow-hidden">
                        <div class="thumbnail square" style="background-image:url('<?=$tpath?>/assets/images/no_avatar.png');">
                        </div>
                        <h6 class="weight_normal mb-3">공*영 (56세)</h6>
                        <p class="text-left xxs_content"><span class="bg-red icon_wrap"><i class="xi-wrench"></i></span> co2용접 | 배관</p>
                        <p class="text-left xxs_content"><span class="bg-red icon_wrap"><i class="xi-map-marker"></i></span> 경남 | 부산</p>
                        <a href="#" class="btn btn-block btn-warning mt-3 rounded-0">이력서 보기</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<!--    배너슬라이드 섹션-->
<div class="standard">
    <div class="slick_wrap affix_middle">
        <div class="banners_slick mt-5">
            <?php for($i=1; $i<=4; $i++){ ?>
                <div class="banner bg-primary">
                    <img src="<?=$tpath?>/assets/images/no_banner.png" />
                </div>
            <?php } ?>
        </div>
    </div>
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