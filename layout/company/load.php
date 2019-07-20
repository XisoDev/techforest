<?php

//웹폰트 로드
$add_html_header[] = "<link href=\"//fonts.googleapis.com/css?family=Noto+Sans+KR:300,400,500,900&display=swap\" rel=\"stylesheet\">";
//    시트
$add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/none/vendor/bootstrap/css/bootstrap.css\">";

//    기타벤더 호출
$add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/none/vendor/slick/slick.css\">";
$add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/none/vendor/slick/slick-theme.css\">";
$add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/none/vendor/toastr/toastr.min.css\">";
$add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/none/vendor/xeicon/xeicon.min.css\">";
$add_html_header[] = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';

//    글로벌 공용
$add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/none/assets/global_common.css?nocache=".time()."\">";
//    레이아웃 전용 커스텀
$add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/company/assets/company_layout.css?nocache=".time()."\">";
//    폼 커스텀
$add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/none/assets/global_forms.css?nocache=".time()."\">";

$add_body_class[] = 'for_company';

//boostrap script & jquery
$add_html_footer[] = '<script src="/layout/none/vendor/toastr/toastr.min.js"></script>';
$add_html_footer[] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
$add_html_footer[] = '<script src="/layout/none/vendor/bootstrap/js/bootstrap.min.js"></script>';
$add_html_footer[] = '<script src="/layout/none/vendor/slick/slick.min.js"></script>';
$add_html_footer[] = '<script src="/common_assets/js/xiso_common.js"></script>';
$add_html_footer[] = '<script src="/layout/company/assets/company_global.js?nocache='.time().'"></script>';
//하단 스크립트 로드.
if($api_key["google_map"])
    $add_html_footer[] = '<script src="//maps.googleapis.com/maps/api/js?v=3&key='.$api_key["google_map"].'"></script>';