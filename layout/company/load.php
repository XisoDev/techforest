<?php

    //웹폰트 로드
    $add_html_header[] = "<link href='//fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>";

    $add_body_class[] = '';

    //하단 스크립트 로드.
    if($api_key["google_map"])
        $add_html_footer[] = '<script src="//maps.googleapis.com/maps/api/js?v=3&key='.$api_key["google_map"].'"></script>';
