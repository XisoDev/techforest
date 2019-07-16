<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class memberView{

    function index($args)
    {
        global $set_template_file;
        global $add_html_footer;
        global $logged_info;
        global $oDB;

        if(!$_SESSION['LOGGED_INFO']){
            return goLogin();
        }

        if(!$args->act) $args->act = "index";
        $set_template_file = "member/mypage.php";
        createToken();

        $output = new Object();
        $output->add('page_title',"마이페이지");
        $output->add('act',$args->act);
        return $output;
    }

//    마이페이지 Alias
    function myprofile($args){
        $args->act = "myprofile";
        return $this->index($args);
    }

    function login($args){
        moduleLoadDefault('oPage/member');
        $output = new Object();
        global $set_template_file;

        if($_SESSION['LOGGED_INFO']){
            if(!$args->cur) $args->cur = getUrl();
            header('Location: ' . $args->cur);
        }else{
            $set_template_file = "member/login.php";
            $output->add('page_title',"로그인이 필요합니다.");
        }

        return $output;
    }

    function findPassword($args){
        $output = new Object();
        global $set_template_file;

        if($_SESSION['LOGGED_INFO']){
            if(!$args->cur) $args->cur = getUrl();
            header('Location: ' . $args->cur);
        }else{
            $set_template_file = "member/find_new_password.php";
            $output->add('page_title',"아이디 / 비밀번호 찾기");
        }
        return $output;
    }

    function findPasswordSuccess($args){
        $output = new Object();
        global $set_template_file;

        if(!$_SESSION['LOGGED_INFO'] || !isset($_SESSION['findPasswordSuccess'])){
            header('Location: ' . getUrl('member','myprofile'));
        }else{
            $set_template_file = "member/find_update_password.php";
            $output->add('page_title',"본인인증에 성공하였습니다.");
        }
        return $output;
    }
}