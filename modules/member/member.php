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

        if(!$args->is_seo){
            setSEO("내 정보 관리", $logged_info['m_name']."님의 개인정보를 관리할 수 있습니다.");
        }

        $output = new Object();
        $output->add('notice_setting',$this->notice_setting());
        $output->add('page_title',"마이페이지");
        $output->add('act',$args->act);
        return $output;
    }

//    마이페이지 Alias
    function myprofile($args){
        global $logged_info;
        setSEO("내 정보 관리", $logged_info['m_name']."님의 정보를 업데이트 할 수 있습니다.");
        $args->is_seo = "Y";

        $args->act = "myprofile";
        return $this->index($args);
    }
    function updateIdpw($args){
        $args->act = "updateIdpw";
        return $this->index($args);
    }
    function settingAlert($args){
        $args->act = "settingAlert";
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

    function signUp($args){
        global $set_template_file;

        if(!isset($_SESSION["USER_TYPE"])){
            header("location:" . getUrl('page','selectType'));
            return;
        }
        if(isset($args->user_type)) $_SESSION["USER_TYPE"] = $args->user_type;

        if($_SESSION["USER_TYPE"] == "company"){
            $set_template_file = "member/signup.company.php";
        }else{
            // if(!$_SESSION['nice_auth']["CI"]){
            //     header("location:" . getUrl('member','niceAuth'));
            //     return true;
            // };


            $set_template_file = "member/signup.technician.php";
        }
    }

//     function niceAuth($args){
//         if($_SESSION['nice_auth']["CI"]){
//             header("location:" . getUrl('member','signUp'));
//             return true;
//         };
//
//         global $set_template_file;
//         $set_template_file = "member/nice_auth.php";
//     }

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

    function notice_setting(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      $oDB->where("m_idx",$m_idx);

      $oDB->orderby("n_idx","ASC");

      $row = $oDB->get("TF_notice_setting AS ns",null,"m_idx, n_idx, agree");

      return $row;
    }

    function withdrawMember(){
      
    }
}
