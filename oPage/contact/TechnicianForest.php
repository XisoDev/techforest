<style>
    body {
        height:100%;
    }
    html{
      width:100%;
    }
    .p_center {
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .t_article {
        color: rgb(227, 187, 138);
        font: italic 700 22px 'Nanum Gothic';
        letter-spacing: 0.25em;
    }
    #TF1 img {
        width: 40%;
        max-width: 500px;
        min-width: 300px;
    }
    #TF2 span {
        position: absolute;
        top: 28%;
        left: 16%;
    }
    .TF4_txt {
        font: 18px/1.8em 'Nanum Gothic';
        color: #272624;
    }
    #TF5 {
        font:300 15px 'Nanum Square';
        color: #BBBBBB;
        line-height:2;
    }
    #TF5 .bigNum {
        font: 900 54px 'Nanum Myeongjo';
        color: #FFFFFF;
        line-height: 2;
    }
    #TF5 span {
        display: block;
    }
    #TF5 div {
        padding: 0;
    }
    #footer {
        display: block !important;
        position: inherit !important;
    }
    .bgimg-1 {
        position: relative;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 100%;
    }
    .bgimg-1 {
        background-image: url("https://wimirgsjsoop.cdn3.cafe24.com/introduce/background3.jpg");
        min-height: 566px;
    }
    /* Turn off parallax scrolling for tablets and phones */
    @media only screen and (max-device-width: 1024px) {
        .bgimg-1 {
            background-attachment: scroll;
        }
    }
    @media screen and (max-width:767px){
        #TF2 span {
            left: 50%;
            transform:translate(-50%,0);
        }
        #TF1 div {
            height: 474px !important;
        }
        #TF2 {
            height: 450px !important;
        }
        #TF2 div {
            top: 50% !important;
        }
        #TF3 {
            height:418px;
        }
        #TF4 {
            padding: 100px 10px !important;
        }
        #TF5 span{
            padding-left:15%;
        }
        #TF5 .bigNum, .m_center {
            text-align:center;
            padding:0 !important;
        }
    }
    .float_left{
      float:left;
    }
    .margin_auto {
      margin: auto;
    }
    .max_width {
      max-width: 1000px;
    }
    .align_center {
      text-align: center;
    }

</style>
<!-- <link rel="stylesheet" href="/layout/company/assets/default.css"> -->
<section class="p-3 mt-4 pt-5 pb-3 bg-white d-lg-none">
    <i class="xi-arrow-left xi-2x" onclick="history.back();"></i>
    <h5 class="weight_normal">기업소개</h5>
</section>

<section id="TF1">
    <div style="background:url('https://wimirgsjsoop.cdn3.cafe24.com/introduce/background1.jpg'); height:574px">
        <img class="p_center" src="https://wimirgsjsoop.cdn3.cafe24.com/introduce/b1_img1.png" />
    </div>
</section>

<section id="TF2" style="height:650px;">
    <div class="p_center" style="background-color:#ffffff00; border:solid 2px rgb(227, 187, 138); height:543px; width:90%; top:35%; max-width:940px">
        <span class="t_article">ABOUT US</span>
        <img class="p_center" src="https://wimirgsjsoop.cdn3.cafe24.com/introduce/b2_img1.png" style="position:absolute; top:60%; max-width:90%" />
    </div>
</section>

<section id="TF3">
    <div class="bgimg-1"></div>
</section>

<section id="TF4" class="max_width margin_auto" style="width:90%; padding:150px 10px; overflow:hidden; height:auto">
    <span class="t_article">OUR SERVICES</span>

    <div style="border-top: solid 1px #BDBDBD; padding:20px; margin-top:70px; display:inline-block; width:100%; letter-spacing:0.2em">
        <div class="col-xs-12 col-sm-3 float_left" style="padding-top:30px">
            <span class="TF4_txt visible-xs">기술인력 특화<br />구인-구직<br /><b>매칭서비스 플랫폼</b></span>
            <img class="hidden-xs" src="https://wimirgsjsoop.cdn3.cafe24.com/introduce/tf_img1.png" style="width:85%;margin-top:15px"/>
        </div>

        <div class="col-xs-12 col-sm-9 float_left" style="padding:30px 0">
            <span class="visible-xs" style="font:300 16px/1.8em 'NanumSquare'; word-break: keep-all">
                <b>기술자가 필요할 때, 기술자숲</b><br />
                -매칭시스템을 기반으로 기업과 기술자를 72시간 이내에 연결시켜주는 가장 빠르고 합리적인 방법<br />
                -기술자숲 웹서비스 www.gsjsoop.com / 앱서비스 - 안드로이드 ver, IOS ver
            </span>
            <img class="hidden-xs" src="https://wimirgsjsoop.cdn3.cafe24.com/introduce/tf_img2.png" style="max-width:100%" />
        </div>
    </div>
    <hr style="border-color:#BDBDBD;margin:0" />
    <div style="border-bottom: solid 1px #BDBDBD; padding:20px; display:inline-block; width:100%;">
        <div class="col-xs-12 col-sm-3 float_left" style="padding-top:30px; letter-spacing:0.2em;">
            <span class="TF4_txt visible-xs">행사<br /><b>기획 및 운영</b></span>
            <img class="hidden-xs" src="https://wimirgsjsoop.cdn3.cafe24.com/introduce/tf_img3.png" style="width:85%;margin-top:7px"/>
        </div>
        <div class="col-xs-12 col-sm-9 float_left" style="padding:30px 0">
            <span class="visible-xs" style="font:300 16px/1.8em 'NanumSquare'; word-break: keep-all;">
                <b>취업/채용 관련 행사 & 네트워킹을 위한 행사 기획 및 운영</b><br />
                - 스타트업 시너지 서밋(2017.04 / 2017.12)<br />
                - 경남 전문기술인력 채용박람회 (2018.01)
            </span>
            <img class="hidden-xs" src="https://wimirgsjsoop.cdn3.cafe24.com/introduce/tf_img4.png" style="max-width:100%" />
        </div>
    </div>

    <div style="border-bottom: solid 1px #BDBDBD; padding:20px; margin-bottom:70px; display:inline-block; width:100%;">
        <div class="col-xs-12 col-sm-3 float_left" style="padding-top:30px; letter-spacing:0.2em;">
            <span class="TF4_txt visible-xs"><b>전직 교육</b>서비스<br /></span>
            <img class="hidden-xs" src="https://wimirgsjsoop.cdn3.cafe24.com/introduce/tf_img5.png" style="width:85%;margin-top:7px"/>
        </div>
        <div class="col-xs-12 col-sm-9 float_left" style="padding:30px 0">
            <span class="visible-xs" style="font:300 16px/1.8em 'NanumSquare'; word-break: keep-all;">
                퇴직(예정) 숙련기술자 대상<br />
                <b>재취업·창직·창업을 위한 교육서비스 제공</b><br />
            </span>
            <img class="hidden-xs" src="https://wimirgsjsoop.cdn3.cafe24.com/introduce/tf_img6.png" style="max-width:49%" />
        </div>
    </div>
    <div class="row">
      <? for($i=1; $i < 7; $i++){ ?>
      <div class="col-xs-12 col-sm-4 " style="margin:25px 0"><img src="https://wimirgsjsoop.cdn3.cafe24.com/introduce/b4_img<?=$i?>.png" width="100%" /></div>
      <? } ?>
    </div>

</section>

<section id="TF5" style="background-color:rgb(39, 38, 36); padding:100px 10px; display:inline-block; width:100%">
    <div class="margin_auto max_width">
        <span class="t_article m_center" style="display:block; margin-bottom:50px">HISTORY</span>
        <div class="col-xs-12 col-sm-2 float_left">
            <span class="bigNum">2016</span>
            <span><b>10월</b>: 기술자숲(주) 설립</span>
        </div>
        <div class="col-xs-12 col-sm-3 float_left" style="margin: 0 13px;">
            <span class="bigNum">2017</span>
            <span><b>12월</b>: 제2회 스타트업시너지서밋 운영</span>
            <span><b>10월</b>: 부산시 공공.빅데이터 활용</span>
            <span>　　　창업경진대회 앱서비스 부문 수상</span>
            <span><b>09월</b>: (예비)사회적기업 지정 - 경상남도</span>
            <span><b>09월</b>: 제1회 스타트업시너지서밋 운영</span>
            <span><b>09월</b>: 기술자숲 웹 서비스, IOS어플 출시</span>
            <span><b>09월</b>: 벤처기업 인증 획득</span>
            <span><b>06월</b>: I-gen챌린지공모전 창업부문 수상</span>
            <span><b>06월</b>: ISO9001:2008 인증 획득</span>
            <span><b>06월</b>: 경남창조경제혁신센터 MOU 체결</span>
            <span><b>04월</b>: 경남벤처기업협회 MOU 체결</span>
            <span><b>02월</b>: 기술자숲 안드로이드 어플 출시</span>
        </div>
        <div class="col-xs-12 col-sm-3 float_left" style="margin: 0 13px">
            <span class="bigNum">2018</span>
            <span><b>12월</b>: 경남지방중소벤처기업청장 표창 </span>
            <span><b>10월</b>: 2018 Do dream day</span>
            <span>　　　취업박람회 협력 운영 </span>
            <span><b>09월</b>: 경남지방중소벤처기업청 </span>
            <span>　　　경남조선해양기자재협동조합</span>
            <span>　　　MOU 체결</span>
            <span><b>06월</b>: 2018 H-온드림 7기 선정</span>
            <span><b>05월</b>: 경남지방중소벤처기업청</span>
            <span>　　　MOU 체결</span>
            <span><b>02월</b>: 기술자숲 서비스 2.0 출시</span>
            <span><b>02월</b>: (예비)사회적기업 지정</span>
            <span>　　　- 고용노동부</span>
            <span><b>01월</b>: 경남 전문기술인력</span>
            <span>　　　채용박람회 협력 운영</span>
        </div>
        <div class="col-xs-12 col-sm-3 float_left" style="margin: 0 13px">
            <span class="bigNum">2019</span>
            <span><b>02월</b>: 2019숙련기술자 Cheer Up!</span>
            <span>　　　취업캠프(부산) 운영</span>
            <span><b>02월</b>: 2019 메이커인스트럭터</span>
            <span>　　　양성교육 공동 운영</span>
            <span><b>01월</b>: 2019숙련기술자 Cheer Up!</span>
            <span>　　　취업캠프(목포) 운영</span>
        </div>
    </div>
</section>

<section style="background:url('https://wimirgsjsoop.cdn3.cafe24.com/introduce/background6.jpg') center no-repeat; background-size:cover; height:739px">
    <div class="align_center" style="position:relative; top:25%">
        <span style="font:22px 'Nanum Gothic'; color:#33281C;">기술자숲은<br /><b>함께 가치를 만들어 갈 여러분을</b><br />늘 기다리고 있습니다.</span>
        <div style="height:40px"></div>
        <span style="color:#363432; font:15px 'Nanum Myeongjo'; line-height:1.9em">
            Email: Kong@gsjsoop.com<br />
            Tel: 1800-9665 / Fax: 055-259-5315<br />
            경남 창원시 마산회원구 봉암북 7길 21, ICT진흥센터 5동 607호
        </span>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('.bxslider').bxSlider({
            auto: true,
            adaptiveHeight: true,
            minSlides: 1,
            maxSlides: 2,
            slideWidth: 480,
            slideMargin: 40
        });
    });
</script>

<?php
$footer_false = true;
?>
