<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class companyView{

    function index($args){
        global $set_template_file;
        global $site_info;
        $site_info->layout = "company";


        $output = new Object();
        $output->add('application_list',$this->getApplicationCompany());
        $output->add('new_member',$this->new_member());


        $set_template_file = "company/index.php";

        return $output;
    }


      function getApplicationCompany(){
        global $oDB;

        $oDB->orderBy("al.reg_date","DESC");
        $oDB->join("TF_hire_tb h", "al.h_idx = h.h_idx", "LEFT");
        $oDB->join("TF_member_commerce_tb mc", "h.c_idx = mc.c_idx", "LEFT");
        $row = $oDB->get("TF_application_letter al",3,"al.h_idx,al.reg_date,mc.c_name");

        return $row;
      }

      function new_member(){
        global $oDB;

        $oDB->where("m_birthday",NULL, 'IS NOT');
        $oDB->where("m_address", NULL, 'IS NOT');
        $oDB->where("m_name", NULL, 'IS NOT');
        $oDB->where("mc.m_idx", NULL, 'IS NOT');
        $oDB->where("m_address != ''");
        $oDB->where("m_birthday != ''");
        $oDB->where("duty_name != ''");
        $oDB->where("substr(m_birthday,1,4) != 0000");
        $oDB->where("substr(m_phone,1,3) != 000");
        $oDB->where("substr(m_phone,5,4) != 0000");
        $oDB->orderBy("rand()");
        $oDB->join("TF_member_career_tb mc", "m.m_idx = mc.m_idx", "LEFT");
        $row = $oDB->get("TF_member_tb m",4,"m.m_idx");

        return $row;
      }

      function new_member2(){

      }

}
