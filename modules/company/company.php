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
        $output->add('new_member2',$this->new_member2());


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
        $oDB->where("m_address",'','!=');
        $oDB->where("m_birthday",'','!=');
        $oDB->where("duty_name",'','!=');
        $oDB->where("substr(m_birthday,1,4) != 0000");
        $oDB->where("substr(m_phone,1,3) != 000");
        $oDB->where("substr(m_phone,5,4) != 0000");
        $oDB->orderBy("rand()");
        $oDB->join("TF_member_career_tb mc", "m.m_idx = mc.m_idx", "LEFT");
        $row = $oDB->get("TF_member_tb m",4,"m.m_idx");

        return $row;
      }

      function new_member2(){
        global $oDB;

        $columns = "distinct m.m_idx, group_concat(distinct(mc.duty_name)) as duty_name,";
        $columns .= "concat(concat(substr(m.m_name,1,1),'*'),substr(m.m_name,3,10)) as m_name,";
        $columns .= "YEAR(CURRENT_TIMESTAMP) - YEAR(m_birthday) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(m_birthday, 5) + 1) as m_birthday,";
        $columns .= "m_phone, m_address, local_name, city_name, district_name, m_city_idx, m_district_idx";

        // $rand_new_member = $this->new_member();
        // $oDB->where(sprintf("(m.m_idx = %s or m.m_idx = %s or m.m_idx = %s or m.m_idx = %s)",$rand_new_member[0]['m_idx'],$rand_new_member[1]['m_idx'],$rand_new_member[2]['m_idx'],$rand_new_member[3]['m_idx']));
        $rand_new_member = $this->new_member();
        $m_idxs = array();
        foreach($rand_new_member as $val) $m_idxs[] = $val['m_idx'];

        $oDB->where('m.m_idx',$m_idxs,"IN");
        $oDB->where("duty_name","",'!=');
        $oDB->groupBy("m.m_idx");
        $oDB->join("TF_member_career_tb AS mc", "m.m_idx = mc.m_idx", "LEFT");
        $oDB->join("TF_local_tb AS l", "m.m_local_idx = l.local_idx", "LEFT");
        $oDB->join("TF_city_tb AS c", "m.m_city_idx = c.city_idx", "LEFT");
        $oDB->join("TF_district_tb AS d", "m.m_district_idx = d.district_idx", "LEFT");
        $row = $oDB->get("TF_member_tb AS m",null,$columns);

  // $sql = "SELECT distinct m.m_idx, group_concat(distinct(mc.duty_name)) as duty_name,
  //         concat(concat(substr(m.m_name,1,1),'*'),substr(m.m_name,3,10)) as m_name,
  //         YEAR(CURRENT_TIMESTAMP) - YEAR(m_birthday) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(m_birthday, 5)) as m_birthday,
  //         m_phone, m_address, local_name, city_name, district_name, m_city_idx, m_district_idx
  //         FROM TF_member_tb m
  //         LEFT JOIN TF_member_career_tb mc ON m.m_idx = mc.m_idx
  //         LEFT JOIN TF_local_tb l ON m.m_local_idx = l.local_idx
  //         LEFT JOIN TF_city_tb c ON m.m_city_idx = c.city_idx
  //         LEFT JOIN TF_district_tb d ON m.m_district_idx = d.district_idx
  //         WHERE (m.m_idx = $num1 or m.m_idx = $num2 or m.m_idx = $num3 or m.m_idx = $num4) and
  //               duty_name != ''
  //         GROUP BY m.m_idx";

          return $row;
        }
}
