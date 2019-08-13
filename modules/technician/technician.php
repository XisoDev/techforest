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
            $set_template_file = "technician/magazine.view.php";
        }else {
            $set_template_file = "technician/magazine.list.php";
        }

        $output = new Object();
        return $output;

    }


    function service($args){
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        if($args->document_srl){
            $set_template_file = "technician/service.view.php";
        }else {
            $set_template_file = "technician/service.list.php";
        }

        $output = new Object();
        return $output;

    }


    function serviceHistory($args){
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/service.history.php";

        $output = new Object();
        return $output;

    }

    function servicePayment($args){
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/service.payment.php";

        $output = new Object();
        return $output;

    }

    function  now_application(){
      global $oDB;

      $oDB->orderby("al.reg_date","DESC");
      $oDB->join("TF_hire_tb h","al.h_idx = h.h_idx", "LEFT");
      $oDB->join("TF_member_commerce_tb mc","h.c_idx = mc.c_idx", "LEFT");
      $row = $oDB->get("TF_application_letter al",3,"al.h_idx, al.reg_date, mc.c_name");

      return $row;
    }

    function naver_login_check(){
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
