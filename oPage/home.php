<style>
    html,body{height:100%;}
    .welcome_seciton{
        position:relative;
        height:50%;
        background-size: 110%;
        background-position: -100% 100%;
        background-repeat: no-repeat;
        padding: 40px 15px 20px;
    }
</style>
<div class="container-fluid welcome_seciton bg-primary" style="background-image:url('/oPage/images/home_welcome.png');">
    <img src="/oPage/images/gear.png" class="rotating" style="z-index:0; position:absolute; width:30%; right:-5%; top:-5%;"  />
    <img src="/oPage/images/gear.png" class="rotating_slow" style="z-index:0; position:absolute; left:-35%; width:60%; top:3%;" />
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="weight_lighter"><span class="weight_bold">기술자</span>를</h2>
                <h2 class="weight_lighter mb-3">찾으시나요?</h2>

                <a href="<?=getUrl('company')?>" class="btn border-white btn-round text-white btn-lg">기업회원</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid welcome_seciton bg-warning" style="background-image:url('/oPage/images/technician_welcome.png');">
    <img src="/oPage/images/gear.png" class="rotating" style="z-index:0; position:absolute; width:30%; right:-5%; top:-5%;"  />
    <img src="/oPage/images/gear.png" class="rotating_slow" style="z-index:0; position:absolute; left:-35%; width:60%; top:3%;" />
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="weight_lighter"><span class="weight_bold">일자리</span>를</h2>
                <h2 class="weight_lighter mb-3">찾으시나요?</h2>

                <a href="<?=getUrl('technician')?>" class="btn btn-round border-dark btn-lg">개인회원</a>
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
