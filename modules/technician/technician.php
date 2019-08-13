<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class technicianView{

    function index($args){
        global $set_template_file;
        global $site_info;
        $site_info->layout = "technician";

        $output = new Object();
        $output->add('now_application',$this->now_application());

        $set_template_file = "technician/index.php";

        return $output;
    }

    function resume($args){
        setSEO("이력서 등록","기술자숲 회원이라면 누구나 작성할 수 있습니다.");
        global $site_info;

        global $add_body_class;

        global $set_template_file;
        if($args->document_srl) {
            $site_info->layout = "none";
            $add_body_class[] = "";
            $set_template_file = "technician/resume.view.php";
        }else{
            $site_info->layout = "technician";
            $add_body_class[] = "shrink";
            $set_template_file = "technician/resume.list.php";
        }

        $output = new Object();
        return $output;
    }

    function resumeWrite($args){
        setSEO("온라인 이력서 작성이 어렵다면?","종이이력서를 사진으로 찍거나 이력서파일을 올려주세요.");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/resume.write.php";

        $output = new Object();
        return $output;
    }

    function findJob($args){
        setSEO("일자리 찾기","기술자님께 딱!맞는 일자리와 관심공고를 살펴보세요");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/findjob.php";

        $output = new Object();
        return $output;
    }

    function findJobList($args){
        setSEO("일자리 찾기","기술자님께 딱!맞는 일자리와 관심공고를 살펴보세요");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/findjob.list.php";

        $output = new Object();
        return $output;
    }

    function magazine($args){
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        if($args->document_srl){
            setSEO("글제목 넣으셔요","작성자, 날짜같은거 넣으면 좋음");
            //또는
            setSEO("취업정보","글제목 넣으셔요");
            $set_template_file = "technician/magazine.view.php";
        }else {
            setSEO("취업정보","취업박람회 및 정보를 한 눈에 살펴보세요.");
            $set_template_file = "technician/magazine.list.php";
        }

        $output = new Object();
        return $output;

    }


    function service($args){
        setSEO("유료 서비스 안내","기업을 쉽게 찾을 수 있는 유료서비스를 이용해보세요.");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;

        $output = new Object();
        if($args->document_srl){
            $set_template_file = "technician/service.view.php";
            $output->add('false_sub_visual',true);
        }else {
            $set_template_file = "technician/service.list.php";
        }
        return $output;

    }


    function serviceHistory($args){
        setSEO("서비스 이용현황","사용가능한 쿠폰과 결제내역을 살펴보세요.");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/service.history.php";

        $output = new Object();
        return $output;

    }
//
//    function servicePayment($args){
//        global $site_info;
//        $site_info->layout = "technician";
//
//        global $add_body_class;
//        $add_body_class[] = "shrink";
//
//        global $set_template_file;
//        $set_template_file = "technician/service.payment.php";
//
//        $output = new Object();
//        return $output;
//
//    }

    function  now_application(){
      global $oDB;

      $oDB->orderby("al.reg_date","DESC");
      $oDB->join("TF_hire_tb h","al.h_idx = h.h_idx", "LEFT");
      $oDB->join("TF_member_commerce_tb mc","h.c_idx = mc.c_idx", "LEFT");
      $row = $oDB->get("TF_application_letter al",3,"al.h_idx, al.reg_date, mc.c_name");

      return $row;
    }

    function naver_login_check(){
        global $logged_info;
        global $oDB;
      $m_id = $logged_info['m_id'];
      $m_idx = $_SESSION['LOGGED_INFO'];
      $m_id_str = substr($m_id,0,3);
      if($m_id_str == 'nN_'){
          $naver_login = 1;
          $oDB->where("m_idx",$m_idx);
          $row = $oDB->get("TF_member_tb",null,"m_phone, m_birthday, m_address, m_address2");

          if(!$row['m_phone'] || !$row[0]['m_birthday'] || !$row[0]['m_address'] || !$row[0]['m_address2']){
              //이력서정보등록 페이지로 이동
          }
       }
    }
}
