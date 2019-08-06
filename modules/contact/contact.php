<?php

class contactView{

    function index($args)
    {
        if(!$_SESSION['LOGGED_INFO']){
            return goLogin();
        }

        global $site_info;
        $site_info->layout = $_SESSION["USER_TYPE"];
        global $add_body_class;
        $add_body_class[] = "shrink";

        setSEO("문의하기","기술자숲에 궁금한것이 있다면 무엇이든 문의 해 보세요, 문의 글을 작성하기 힘들다면 언제든지 전화로 문의하셔도 좋습니다.");

        global $set_template_file;
        $set_template_file = "contact/write.php";

        $output = new Object();
        return $output;
    }
}