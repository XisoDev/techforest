<?php
class technicianController{

  function interest_remove($args){
    global $oDB;

    $h_idx = $args->h_idx;
    $m_idx = $args->m_idx;

    $oDB->where("h_idx",$h_idx);
    $oDB->where("m_idx",$m_idx);
    $remove = $oDB->delete("TF_interest_career_tb");

    if($remove){
      return new Object(0,"관심공고가 해지되었습니다.");
    }else{
      return new Object(1,"네트워크 오류가 발생했습니다.");
    }
  }

  function interest_add($args){
    global $oDB;
    $now_date = date(YmdHis);
    $h_idx = $args->h_idx;
    $m_idx = $args->m_idx;

    $data = array(
      "m_idx" => $m_idx,
      "h_idx" => $h_idx,
      "reg_date" => $now_date
    );
    $i_add = $oDB->insert("TF_interest_career_tb",$data);

    if($i_add){
      return new Object(0,"관심공고가 등록되었습니다.");
    }else{
      return new Object(1,"네트워크 오류가 발생했습니다.");
    }
  }

  function search($args){
    global $oDB;

    $now_date = date(YmdHis);

    $local_idx = $args->local_idx;
    $o_idx = $args->o_idx;

    if(!$local_idx) {
      $local_idx = -1;
    }

    if($o_idx == 'undefined' || !$o_idx || $o_idx == 1){
      $o_idx = -1;
    }

    // print_r($local_idx);
    // exit();
    //전체 일자리 조회
    $oDB->orderBy("vip","DESC");
    $oDB->orderBy("h.h_idx","DESC");
    $oDB->where("hire_is_show","Y");
    $oDB->where("job_end_date",$now_date,">=");
    if($local_idx > 0){
      $oDB->where("l.local_idx",$local_idx);
    }
    if($o_idx > 0){
      $oDB->where("h.o_idx",$o_idx);
    }
    $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
    $oDB->join("TF_local_tb l","h.local_idx = l.local_idx","LEFT");
    $oDB->join("TF_city_tb c","h.city_idx = c.city_idx","LEFT");
    $oDB->join("TF_district_tb d","h.district_idx = d.district_idx","LEFT");
    $oDB->join("TF_hire_certificate hce","hce.h_idx = h.h_idx","LEFT");
    $hire_rows = $oDB->get("TF_hire_tb h",12,"c_name, h_title, local_name, city_name, district_name,
                                              h.local_idx, h.city_idx, h.district_idx, job_achievement,
                                              salary_idx, job_salary, job_is_career, h.h_idx, h.o_idx");
    $output = new Object();
    $output->add('hire_rows',$hire_rows);
    return $output;
  }


}
