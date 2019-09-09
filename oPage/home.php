<style>
    html,body{
        height:100%;
    }
    body{
        background-image:url('/oPage/images/home_bg.jpg');
        background-size:cover;
        background-position:center;
    }
    .welcome_seciton{
        position:relative;
        height:50%;
        background-size: 76%;
        background-position: 105% 100%;
        background-repeat: no-repeat;
        padding: 40px 15px 20px;
    }
    .welcome_seciton.technician{
        background-position: 110% 120%;
    }
    .row{
        min-height:300px;
    }
    @media screen and (max-width:575px) {
        .row {
            height: 100%;
        }
    }
</style>
<div class="container d-none d-sm-block text-white text-center pt-5 pb-4 position-relative">
    <div class="position-absolute" style="right:10px; top:30px;">
        <a href="#"><img src="/oPage/images/home_appstore.png" height="29"  /></a>
        <a href="#"><img src="/oPage/images/home_playstore.png" height="29" /></a>
    </div>
    <h3 class="pt-5 mt-3">국내 1위 기술인력 전문 구인구직 매칭서비스</h3>
    <h1 class="pb-4">기술자숲</h1>
</div>
<div class="row mx-auto" style="max-width:900px">
<div class="container-fluid welcome_seciton bg-primary col-sm-6" style="background-image:url('/oPage/images/home_welcome.png');">
    <img src="/oPage/images/gear.png" class="rotating d-sm-none" style="z-index:0; position:absolute; width:30%; right:-5%; top:-5%;"  />
    <img src="/oPage/images/gear.png" class="rotating_slow d-sm-none" style="z-index:0; position:absolute; left:-35%; width:60%; top:3%;" />
    <div class="container">
        <div class="row">
            <div class="col text-sm-center pt-md-5">
                <h2 class="weight_lighter mb-3 text-sm-center"><span class="weight_bold">기술자</span>를<br class="d-sm-none" /> 찾으시나요?</h2>

                <a href="<?=getUrl('company')?>" class="btn border-white btn-round text-white btn-lg">기업회원</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid welcome_seciton technician bg-warning col-sm-6" style="background-image:url('/oPage/images/technician_welcome.png');">
    <img src="/oPage/images/gear.png" class="rotating d-sm-none" style="z-index:0; position:absolute; width:30%; right:-5%; top:-5%;"  />
    <img src="/oPage/images/gear.png" class="rotating_slow d-sm-none" style="z-index:0; position:absolute; left:-35%; width:60%; top:3%;" />
    <div class="container">
        <div class="row">
            <div class="col text-sm-center pt-md-5">
                <h2 class="weight_lighter mb-3 text-sm-center"><span class="weight_bold">일자리</span>를<br class="d-sm-none" /> 찾으시나요?</h2>

                <a href="<?=getUrl('technician')?>" class="btn btn-round border-dark btn-lg">개인회원</a>
            </div>
        </div>
    </div>
</div>
</div>
<?php

/* ajax 예제
<script type="text/javascript">
    jQuery(document).ready(function($){
        var params = {};
        params["is_view"] = "Y";

        exec_json("company.index",params,function(ret_obj){
            //성공했을 때 처리할 명령
        });

    });
</script>
*/
