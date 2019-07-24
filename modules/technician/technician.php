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


    function  now_application(){
      global $oDB;

      $oDB->orderby("al.reg_date","DESC");
      $oDB->join("TF_hire_tb h","al.h_idx = h.h_idx", "LEFT");
      $oDB->join("TF_member_commerce_tb mc","h.c_idx = mc.c_idx", "LEFT");
      $row = $oDB->get("TF_application_letter al",3,"al.h_idx, al.reg_date, mc.c_name");

      return $row;
    }


// 이력서 완성도(기본정보+희망4종)
// $sql = "SELECT *
//         FROM TF_member_tb m
//         LEFT JOIN TF_member_order mo ON m.m_idx = mo.m_idx
//         LEFT JOIN TF_member_occupation o ON m.m_idx = o.m_idx
//         LEFT JOIN TF_member_duty d ON m.m_idx = d.m_idx
//         WHERE m.m_email != '' and
//               m.m_birthday != '' and
//               m.m_phone != '' and
//               m.m_address != '' and
//               m.m_address2 IS NOT NULL and
//               m.m_address2 != '' and
//               d.m_idx IS NOT NULL and
//               m.m_idx = $get_m_idx";
//   $my_info4_2 = record_set($sql);

}
