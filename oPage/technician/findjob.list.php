<section class="bg-white">
    <div class="content_padding mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">일자리 더 보기</h5>
    </div>
</section>
<div class="content_padding">
    <div class="content_padding px-0 pb-1 mb-0">
        <a href="#" class="pull-right btn btn-xxs btn-round border-primary py-2 px-3">전체공고</a>
        <a href="#" class="pull-right btn btn-primary btn-xxs btn-round py-2 px-3 mr-1">맞춤공고</a>
        <h6>일자리 정보</h6>
    </div>

    <div class="content_padding px-0 pb-1 pt-0 mt-0 mb-4">
        <div class="row">
            <div class="col-6 pr-1">
                <select class="form-control"><option>지역설정</option></select>
            </div>
            <div class="col-6 pl-1">
                <select class="form-control"><option>직종</option></select>
            </div>
        </div>
    </div>
    <?php for($i=1; $i<=3; $i++) { ?>
        <div class="magazine tech_card mb-3 bg-white text-left">
            <div class="row">
                <div class="col-5 pr-0" style="background-color:#EEE;">
                    <div class="thumbnail" style="height:100%;">
                        <span class="overlay">
                        <a href="#" class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute" style="left:10px; top:10px;">
                            관심공고
                            <i class="xi-heart red"></i>
                        </a>
                        </span>
                    </div>
                </div>
                <div class="col-7 pl-0">
                    <div class="content_padding">
                        <h6 class="weight_normal">그림자숲</h6>
                        <h6 class="red">가공팀(조/반장)</h6>
                        <hr />
                        <p class="weight_lighter xxs_content mx-0 px-0">
                            <span class="badge badge-danger weight_lighter">위치</span>
                            경남 김해시
                        </p>
                        <p class="text-secondary xxs_content mx-0 px-0 pt-1">
                            <span class="badge badge-danger weight_lighter">시</span>
                            <b>7,350 원</b>
                            <span class="bg-red icon_wrap"><i class="xi-wrench"></i></span>경력 최소 10년
                        </p>
                    </div>

                    <div class="row m-0 p-0 pt-0 mt-0">
                        <div class="col-6 mx-0 px-0">
                            <a href="#" class="btn btn-light btn-block rounded-0">상세보기</a>
                        </div>
                        <div class="col-6 mx-0 px-0">
                            <button class="btn btn-danger btn-block rounded-0">지원하기</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

<?php
$footer_false = true;
?>