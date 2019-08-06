<section class="bg-white">
    <div class="content_padding mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">취업정보</h5>
    </div>
</section>
<div class="content_padding">
    <span class="xxs_content pull-right">전체 137</span>
    <h6>취업정보 살펴보기</h6>
    <?php for($i=1; $i<=3; $i++) { ?>
    <div class="magazine tech_card mb-3 bg-white text-left">
        <div class="row">
            <div class="col-4 pr-0" style="background-color:#EEE;">

            </div>
            <div class="col-8 pl-0">
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
    <?php } ?>

<!--    페이지네비게이션을 어떤방식으로 처리하실지 몰라 비워둡니다.-->

</div>


<?php
$footer_false = true;
?>