<section class="content_padding mt-4 pt-5 bg-white">
    <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
    <h5 class="weight_normal">공고 ・ 지원자관리</h5>
</section>
<div class="container">
    <div class="content_padding px-0">
    <h6><span class="red">진행중</span>인 공고를 확인해보세요.</h6>
    </div>
    <?php for($i=1; $i<=4; $i++){ ?>
        <div class="tech_card bg-white mb-4">
            <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                <div class="overlay"><span class="overlay-content">(주)에이에스티</span></div>
            </div>
            <div class="row m-0 p-0">
                <div class="col-6 mx-0 px-0">
                    <a href="#" class="btn btn-danger btn-block rounded-0">상세보기</a>
                </div>
                <div class="col-6 mx-0 px-0">
                    <a href="#" class="btn btn-light btn-block rounded-0">공고마감하기</a>
                </div>
            </div>
            <div class="content_padding text-left py-1">
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
                    <a href="<?=getUrl('company','job_appList',100);?>" class="btn btn-light btn-block rounded-0 red">지원자 (4)</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <a href="#" class="btn btn-block btn-primary">공고 더보기</a>

    <div class="content_padding px-0 mt-4 py-0">
        <h6 class="weight_normal">마감된공고를 확인하세요.</h6>
    </div>
    <?php for($i=1; $i<=4; $i++){ ?>
        <div class="tech_card bg-white mb-4">
            <div class="thumbnail mx-0 px-0" style="background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                <div class="overlay"><span class="overlay-content">(주)에이에스티</span></div>
            </div>
            <div class="content_padding text-left py-1">
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
                <div class="col-12 mx-0 px-0">
                    <a href="<?=getUrl('company','job_appList',12345);?>" class="btn btn-secondary btn-block rounded-0">지원자 보기(1)</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <a href="#" class="btn btn-block btn-primary">마감된 공고 더보기</a>
</div>