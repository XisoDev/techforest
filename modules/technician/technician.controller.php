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
      return new Object(1,"관심공고가 해지되었습니다.");
    }else{
      return new Object(-1,"네트워크 오류가 발생했습니다.");
    }
  }



}
