<?php

//api키 모음
$api_key = array();

    //구글 추적코드
    $api_key["google_gtag"] = false;
    $api_key["google_map"] = false;

//get Site Info
$site_info = new stdClass();
$site_info->domain = $_SERVER['HTTP_HOST'];
$site_info->storage = $site_info->domain;
if(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']))
    $site_info->protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'] . "://";
else
    $site_info->protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$site_info->url = $site_info->protocol . $site_info->domain;

// set Site SEO
$site_info->title = "기술자숲";
$site_info->keyword = "중장년, 숙련공, 기술직, 취업, 채용, 이직, 강소기업, 중소기업, 현장직, 생산직";
$site_info->desc = "기술인력 구인구직 매칭서비스 / 중장년 숙련공 기술직 취업 채용 교육행사 정보";
$site_info->layout = 'none';

//set Category
$category = array();
