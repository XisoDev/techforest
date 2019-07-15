<?php

    //웹폰트 로드
    $add_html_header[] = "<link href=\"//fonts.googleapis.com/css?family=Noto+Sans+KR:300,400,500,900&display=swap\" rel=\"stylesheet\">";
    $add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/company/assets/vendor/bootstrap/css/bootstrap.css\">";
    $add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/company/assets/techforest.css?nocache=".time()."\">";
    $add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/company/assets/vendor/slick/slick.css\">";
    $add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/company/assets/vendor/slick/slick-theme.css\">";
    $add_html_header[] = "<link rel=\"stylesheet\" href=\"/layout/company/assets/vendor/xeicon/xeicon.min.css\">";

    $add_body_class[] = 'for_company';

    //boostrap script & jquery
    $add_html_footer[] = '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
    $add_html_footer[] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
    $add_html_footer[] = '<script src="/layout/company/assets/vendor/bootstrap/js/bootstrap.min.js"></script>';
    $add_html_footer[] = '<script src="/layout/company/assets/vendor/slick/slick.min.js"></script>';
    $add_html_footer[] = '<script src="/layout/company/assets/global_company.js?nocache='.time().'"></script>';

    //하단 스크립트 로드.
    if($api_key["google_map"])
        $add_html_footer[] = '<script src="//maps.googleapis.com/maps/api/js?v=3&key='.$api_key["google_map"].'"></script>';