<link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
<div class="content_padding">
    <h4 class="weight_normal mb-0 pb-0">현재</h4>
    <h1 class="weight_super mt-0 pt-0 mb-0 pb-0">
        <span id="intro_counter" class="auto_counter russo_one" data-counter="15327" data-duration="3000">0</span>
        <span class="lg_content weight_normal">명의</span></h1>
    <h4 class="weight_normal mb-0 pb-0">기술자가</h4>
    <h4 class="weight_normal">일자리를 찾고 있어요!</h4>

    <img src="/oPage/images/1x/porkrane.png" id="porkrane" />

    <img src="/oPage/images/1x/splash_human.png" id="splash_human" />

    <img src="/oPage/images/logo_primary.png" id="logo_primary" />
</div>

<script type="text/javascript">
    jQuery(function($){
        setTimeout(function(){
            jQuery("#porkrane").addClass('run_animate');
            jQuery("#splash_human").addClass('run_animate');
        },500);

        setTimeout(function(){
            document.location.href="<?=getUrl('page','selectType')?>";
        },5000);
    });
</script>