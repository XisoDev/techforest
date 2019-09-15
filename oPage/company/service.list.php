<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">유료서비스 안내</h4>
    </div>
</section>
<div class="container pt-lg-5 pb-5 bg-white">
    <div class="mx-lg-auto col-lg-10 py-lg-5 pt-lg-3">
        <h4 class="d-none d-lg-block mb-4"><img src="/oPage/images/imgicons/bulb_yellow.png" height="30" class="imgicon" /> 유료서비스 소개</h4>
    <a class="service_card mb-5 bg-white shadow text-dark" href="<?=getUrl('company','service',4)?>">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="thumbnail" style="height:100%; background-image:url('/oPage/technician/images/tech_service.jpg"></div>
            </div>
            <span class="btn btn-danger btn-xs d-lg-none">기업</span>
            <div class="col-12 col-lg-4 py-lg-4 text-center text-lg-left">
                <div class="px-3 pb-4 pt-4 pl-lg-0">
                    <span class="btn btn-danger btn-lg d-lg-inline-block d-none position-static btn-xs py-2 px-4 mb-3">기업</span>
                    <h5 class="weight_bold">후불 통합 패키지</h5>
                    <h6 class="weight_lighter">문자발송 및 연락처 열람</h6>
                </div>
                <div class="d-none d-lg-block red pb-4">
                    서비스 자세히보기
                </div>
            </div>
        </div>
    </a>

    <a class="service_card mb-5 bg-white shadow text-dark" onclick="call_gsjsoop();">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="thumbnail" style="height:100%; background-image:url('/oPage/company/images/company_service2.jpg"></div>
            </div>
            <span class="btn btn-danger btn-xs d-lg-none">기업</span>
            <div class="col-12 col-lg-4 py-lg-4 text-center text-lg-left">
                <div class="px-3 pb-4 pt-4 pl-lg-0">
                    <span class="btn btn-danger btn-lg d-lg-inline-block d-none position-static btn-xs py-2 px-4 mb-3">기업</span>
                    <h5 class="weight_bold">광고 배너</h5>
                    <h6 class="weight_lighter">웹/앱 광고배너 게시</h6>
                </div>
                <div class="d-none d-lg-block red pb-4">
                    서비스 자세히보기
                </div>
            </div>
        </div>
    </a>
    </div>
</div>

<script type="text/javascript">
  function call_gsjsoop(){
    alert("1800-9665로 연락주시면 광고배너상품 소개자료를 보내드립니다.");
  }
</script>

<?php
$footer_false = true;
?>
