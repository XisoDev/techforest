<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">일자리 더 보기</h4>
    </div>
</section>
<div class="container pt-lg-5">
    <div class="px-0 pb-1 pt-3 pt-lg-0">
        <!-- 모바일버전 버튼 -->
        <a href="<?=getUrl('technician','findJobListAll')?>" class="d-lg-none pull-right btn btn-xxs border-primary btn-round  py-2 px-3">전체공고</a>
        <a href="<?=getUrl('technician','findJobList')?>" class="d-lg-none pull-right btn btn-primary btn-xxs btn-round py-2 px-3 mr-1">맞춤공고</a>
        <h6>일자리 정보</h6>
    </div>

    <div class="px-0 pb-1 pt-0 mt-0 mb-2">
        <div class="row">
<!--            <div class="col-6 pr-1 col-lg-4">-->
<!--                <select class="form-control"><option>지역설정</option></select>-->
<!--            </div>-->
<!--            <div class="col-6 pl-1 col-lg-4">-->
<!--                <select class="form-control"><option>직종</option></select>-->
<!--            </div>-->
            <div class="col-lg-2 pr-1">
                <a href="<?=getUrl('technician','findJobList')?>" class="d-lg-block btn-block d-none btn btn-round btn-primary py-2 px-3">맞춤공고</a>
            </div>
            <div class="col-lg-2 pl-1">
                <a href="<?=getUrl('technician','findJobListAll')?>" class="d-lg-block btn-block d-none btn border-primary btn-round py-2 px-3 mr-1">전체공고</a>
            </div>
        </div>
    </div>
    <div class="row">
        <?php for($i=1; $i<=9; $i++) { ?>
            <div class="col-12 col-md-4 px-md-2 pb-md-4">
                <div class="magazine tech_card mb-3 bg-white text-left shadow">
                    <div class="row">
                        <div class="col-5 col-md-12 px-0" style="background-color:#EEE;">
                            <div class="thumbnail mx-0 px-0" style="height:100%; background-image:url('http://www.planttech.co.kr/wp-content/uploads/2018/07/%EC%82%BC%EC%84%B1%EC%97%94%EC%A7%80%EB%8B%88%EC%96%B4%EB%A7%811-820x457.png')">
                                <span class="overlay">
                                <a href="#" class="btn-xxs btn btn-round border-white text-white py-1 px-2 position-absolute mr-md-3" style="right:10px; top:10px;">
                                    관심공고
                                    <i class="xi-heart red"></i>
                                </a>
                                </span>
                            </div>
                        </div>
                        <div class="col-7 col-md-12 pl-0 pl-md-3">
                            <div class="p-2">
                                <h6 class="weight_normal pb-0 mb-0">그림자숲</h6>
                                <h6 class="red pt-0 mt-0">가공팀(조/반장)</h6>
                                <hr class="p-0 m-0" />
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
                                    <a href="#" class="btn btn-light text-secondary btn-xs py-3 px-0 btn-block rounded-0">상세보기</a>
                                </div>
                                <div class="col-6 mx-0 px-0">
                                    <button class="btn btn-danger btn-xs py-3 px-0 btn-block rounded-0">지원하기</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
  // function all_show(num){
  //   $(".choose1").toggleClass("btn-primary");
  //   $(".choose2").toggleClass("border-primary");
  // }
</script>

<?php
$footer_false = true;
?>
