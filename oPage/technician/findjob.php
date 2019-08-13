<section class="bg-white">
    <div class="content_padding mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">일자리 찾기</h5>
    </div>
</section>
<div class="content_padding">
    <div class="content_padding px-0 pb-1">
        <a href="<?=getUrl('technician','findJobList')?>" class="pull-right btn btn-primary btn-xxs btn-round">더보기 +</a>
        <h6>일자리 정보</h6>
    </div>

    <div class="flex-card-slick">
        <?php for($i=1; $i<=3; $i++){ ?>
            <div class="tech_card bg-white">
                <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                    <span class="overlay">
                    <a href="#" class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute" style="right:10px; top:10px;">
                        관심공고
                        <?php if($i % 2 == 0) { ?>
                        <i class="xi-heart"></i>
                        <?php }else{ ?>
                        <i class="xi-heart red"></i>
                        <?php } ?>
                    </a>
                    </span>
                </div>
                <div class="content_padding text-left pb-1">
                    <h6>(주)일진</h6>
                    <h6 class="red">CATIA 프로그램 경력자 모집</h6>
                    <p class="weight_lighter xxs_content mx-0 px-0">
                        <span class="badge badge-danger weight_lighter">위치</span>
                        경남 김해시
                        <span class="badge badge-danger weight_lighter">시</span>
                        <b>7,350 원</b>
                    </p>
                    <p class="text-secondary xxs_content mx-0 px-0 pb-2">
                    <span class="bg-red icon_wrap"><i class="xi-wrench"></i></span>경력 최소 10년
                    </p>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-6 mx-0 px-0">
                        <a href="#" class="btn btn-light btn-block rounded-0">상세보기</a>
                    </div>
                    <div class="col-6 mx-0 px-0">
                        <button class="btn btn-light btn-block rounded-0 red">지원하기</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


    <div class="content_padding px-0 pb-1 pt-4">
        <a href="#" class="pull-right btn btn-primary btn-xxs btn-round">더보기 +</a>
        <h6>입사지원현황</h6>
    </div>
    <?php for($i=1; $i<=3; $i++) { ?>
        <div class="magazine tech_card mb-3 bg-white text-left">
            <div class="row">
                <div class="col-5 pr-0" style="background-color:#EEE;">
                    <div class="thumbnail d-block" style="height:100%;" onmouseover="jQuery(this).find('div.overlay').removeClass('d-none');" onmouseout="jQuery(this).find('div.overlay').addClass('d-none');">
                    <div class="overlay d-none">
                        <div class="overlay-content" style="width:100%; text-align:center;">
                            <a href="#" class="btn-round btn border-white text-white btn-xs">이력서 열람</a>
                            <p class="xxs_content">2019.07.01<br />16:18:59</p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-7 pl-0">
                    <div class="content_padding">
                        <h6 class="weight_normal">그림자숲</h6>
                        <h6 class="red">가공팀(조/반장)</h6>
                        <p class="weight_lighter xxs_content mx-0 px-0">
                            <span class="badge badge-danger weight_lighter">위치</span>
                            경남 김해시
                            <span class="badge badge-danger weight_lighter">시</span>
                            <b>7,350 원</b>
                        </p>
                        <p class="text-secondary xxs_content mx-0 px-0 pt-1">
                            <span class="bg-red icon_wrap"><i class="xi-wrench"></i></span>경력 최소 10년
                        </p>
                    </div>

                    <div class="row m-0 p-0 pt-0 mt-0">
                        <div class="col-6 mx-0 px-0">
                            <a href="#" class="btn btn-light btn-block rounded-0">상세보기</a>
                        </div>
                        <div class="col-6 mx-0 px-0">
                            <button class="btn btn-light btn-block rounded-0 red">지원완료</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="content_padding px-0 pb-1">
        <a href="<?=getUrl('technician','findJobList')?>" class="pull-right btn btn-primary btn-xxs btn-round">더보기 +</a>
        <h6>관심공고</h6>
    </div>

    <div class="flex-card-slick">
        <?php for($i=1; $i<=3; $i++){ ?>
            <div class="tech_card bg-white">
                <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                    <span class="overlay">
                    <a href="#" class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute" style="right:10px; top:10px;">
                        관심공고
                        <i class="xi-heart red"></i>
                    </a>
                    </span>
                </div>
                <div class="content_padding text-left pb-1">
                    <h6>(주)일진</h6>
                    <h6 class="red">CATIA 프로그램 경력자 모집</h6>
                    <p class="weight_lighter xxs_content mx-0 px-0">
                        <span class="badge badge-danger weight_lighter">위치</span>
                        경남 김해시
                        <span class="badge badge-danger weight_lighter">시</span>
                        <b>7,350 원</b>
                    </p>
                    <p class="text-secondary xxs_content mx-0 px-0 pb-2">
                        <span class="bg-red icon_wrap"><i class="xi-wrench"></i></span>경력 최소 10년
                    </p>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-6 mx-0 px-0">
                        <a href="#" class="btn btn-light btn-block rounded-0">상세보기</a>
                    </div>
                    <div class="col-6 mx-0 px-0">
                        <button class="btn btn-light btn-block rounded-0 red">지원하기</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
$footer_false = true;
?>