<?php
class technicianController{

  function edit_phone($args){

    date_default_timezone_set('Asia/Seoul');
    $now_date = date(YmdHis);

    $m_phone = $args->m_phone;
    $m_idx = $args->m_idx;

    $data = array(
      "m_phone" => $m_phone,
      "edit_date" => $now_date
    );
    global $oDB;
    $oDB->where("m_idx","$m_idx");
    $row = $oDB->update("TF_member_tb",$data);

    if($row){
      return new Object(0,"휴대폰번호가 변경되었습니다.");
    }else{
      return new Object(-1,"네트워크 오류가 발생했습니다.");
    }

  }

  function edit_email($args){
    date_default_timezone_set('Asia/Seoul');
    $now_date = date(YmdHis);

    $m_email = $args->m_email;
    $m_idx = $args->m_idx;

    $data = array(
      "m_email" => $m_email,
      "edit_date" => $now_date
    );
    global $oDB;
    $oDB->where("m_idx","$m_idx");
    $row = $oDB->update("TF_member_tb",$data);

    if($row){
      return new Object(0,"이메일 주소가 변경되었습니다.");
    }else{
      return new Object(-1,"네트워크 오류가 발생했습니다.");
    }

  }

}
