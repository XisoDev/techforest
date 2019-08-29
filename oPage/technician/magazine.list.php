<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">취업정보</h4>
    </div>
</section>
<div class="container pt-lg-5">
    <div class="d-block d-lg-none">
        <span class="xxs_content pull-right">전체 137</span>
        <h6>취업정보 살펴보기</h6>
    </div>
    <div class="d-none d-lg-block">
        <span class="xs_content btn btn-xs btn-round border-secondary pull-right">전체 137</span>
        <h4 class="mb-2">취업정보 살펴보기</h4>
    </div>

    <div class="row">
    <?php for($i=1; $i<=9; $i++) { ?>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="magazine tech_card mb-3 bg-white text-left">
        <div class="row">
            <div class="col-5 pr-0 col-md-12" style="background-color:#EEE; min-height:150px;">

            </div>
            <div class="col-7 pl-0 col-md-12 px-md-2">
                <div class="content_padding">
                    <h6 class="red">[취업정보]</h6>
                    <h6 class="weight_normal">2019년 7월 전국...</h6>
                    <p class="xs_content px-0">
                        발빠르게 찾아온 7월 전국 취업 박람회! 놓치지 않도록 미리미리 ...
                    </p>
                    <p class="xxs_content text-secondary my-0 py-0 px-0">2019.05.30</p>
                </div>
                <a class="btn btn-block btn-danger rounded-0" href="<?=getUrl('technician','magazine',10)?>">자세히 보기</a>
            </div>
        </div>
    </div>
        </div>
    <?php } ?>
    </div>
<!--    페이지네비게이션을 어떤방식으로 처리하실지 몰라 비워둡니다.-->

</div>


<?php
$footer_false = true;
?>