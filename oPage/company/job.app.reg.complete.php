<style>
    html,body{
        height:100%;
    }
    body{
        background-image:url("/oPage/company/images/complete_human.png");
        background-size:80%;
        background-repeat:no-repeat;
        background-position:20% 80%;
    }
    .animation_anchor{
        position:absolute;
        right:20px;
        top:30%;
        width:30%;
    }

</style>
<section class="content_padding pt-5 text-center">
    <h4 class="red py-3">공고등록 완료!</h4>
    <h6 class="weight_lighter">적합한 기술자에게 전달중 !</h6>
    <h6 class="weight_normal">지원자가 발생하면 카톡으로 알려드릴게요.</h6>
</section>

<!--애니메이션 기준점이 되어주는 뭉치-->
<div class="animation_anchor">
    <div class="position-relative">

        <img src="/oPage/company/images/complete_lefttalk.png" class="animated fadeInUp infinite delay-1s slower" width="40%" style="position:absolute; right:80%; bottom:100%;" />
        <img src="/oPage/company/images/complete_righttalk.png" class="animated fadeInUp infinite delay-3s slow" width="30%" style="position:absolute; right:-3px; bottom:100%;"  />

        <img src="/oPage/company/images/complete_app.png" class="animated pulse infinite" width="100%" />

        <img src="/oPage/company/images/complete_mag.png" class="saturn" width="50%" style="position:absolute; right:-3px; top:50%;"  />
    </div>
</div>

<section class="content_padding text-center bg-white fixed-bottom">
    <a href="#" class="btn btn-block border-danger red btn-lg btn-round">담당자 연락처 수정</a>
    <a href="<?=getUrl('company')?>" class="text-white btn btn-block btn-danger btn-lg btn-round">확인</a>
</section>