<?
class companyController{
  function getMemberInfoByCompanySrl($m_idx = 0){

      global $oDB;

      $oDB->where("m.m_idx",$m_idx);
      $oDB->where("is_commerce","Y");
      $oDB->join("TF_member_commerce_tb mc","mc.m_idx = m.m_idx","LEFT");
      $row = $oDB->getOne("TF_member_tb m");

      return $row;
  }

  function procCompanyCheckHasID($args){

      $id = $args->m_id;

      if(!$id){
        return new Object(-1,"아이디를 입력해 주세요.");
      }

      if(mb_strlen($id, "UTF-8") < 2 || mb_strlen($id, "UTF-8") > 16){
        return new Object(-1, "아이디는 2 ~ 16자 내로 입력해주세요.");
      }

      global $oDB;
      $oDB->where("m_id","$id");
      $row = $oDB->getOne("TF_member_tb",null,"m_id");

      if($row){
        return new Object(-1,"중복된 아이디가 있습니다.");

      }else{
        $_SESSION['id_check'] = 1;
        return new Object(0,"사용가능한 아이디 입니다.");
      }
  }

  function procMemberSignupCompany($args){
      global $oDB;

      $_SESSION['signup'] = array();
      $_SESSION['signup']['m_id'] = $args->m_id;
      $_SESSION['signup']['m_pw1'] = $args->m_pw1;
      $_SESSION['signup']['m_pw2'] = $args->m_pw2;
      $_SESSION['signup']['c_name'] = $args->c_name;
      $_SESSION['signup']['c_position'] = $args->c_position;
      $_SESSION['signup']['phone2'] = $args->phone2;
      $_SESSION['signup']['phone3'] = $args->phone3;
      $_SESSION['signup']['m_email1'] = $args->m_email1;

      //비밀번호 일치하는지 확인
      if($args->m_pw1 && $args->m_pw1 != $args->m_pw2){
        return new Object(-1,"비밀번호를 확인해주세요.");
      }
      if($_SESSION['id_check'] != 1){
        return new Object(-1,"아이디 중복확인을 해주세요.");
      }
      if(!$args->m_id){
        return new Object(-1,"아이디를 입력해주세요.");
      }
      if(!$args->m_pw1){
        return new Object(-1,"비밀번호를 입력해주세요.");
      }
      if(!$args->m_pw2){
        return new Object(-1,"비밀번호를 확인해주세요.");
      }
      if(mb_strlen($args->m_pw1, "UTF-8") < 6){
        return new Object(-1,"비밀번호는 6자리 이상으로 지정해주세요.");
      }
      if(!$args->c_name){
        return new Object(-1,"회사명을 입력해주세요.");
      }
      if(!$args->agree1 || !$args->agree2){
        return new Object(-1,"약관에 동의해주세요.");
      }

      date_default_timezone_set('Asia/Seoul');
      $now_date = date(YmdHis);
      $m_email = $args->m_email1."@".$args->m_email2;
      $phone = $args->phone1."-".$args->phone2."-".$args->phone3;
      //insert
      $data = array(
        "m_id" => $args->m_id,
        "m_pw" => $args->m_pw1,
        "m_name" => $args->c_name,
        "m_human" => "F",
        "m_birthday" => "19900101",
        "m_phone" => $phone,
        "m_email" => $m_email,
        "is_commerce" => "Y",
        "is_device" => "W",
        "is_external" => "A",
        "reg_date" => $now_date,
        "edit_date" => $now_date
      );
      $row = $oDB->insert("TF_member_tb", $data);

      if($row){
          $m_id = $args->m_id;
          //회원가입 후 바로 로그인
          $oDB->where("m_id","$m_id");
          $m_row = $oDB->getOne("TF_member_tb",null,"m_idx");

          $_SESSION['LOGGED_INFO'] = $m_row['m_idx'];

          unset($_SESSION['signup']);

          $m_idx = $m_row['m_idx'];
          //TF_member_commerce_tb에 추가
          $mc_data = array(
            "m_idx" => $m_idx,
            "c_name" => $args->c_name,
            "reg_date" => $now_date
          );
          $row = $oDB->insert("TF_member_commerce_tb", $mc_data);

          return new Object(0,"가입에 성공하였습니다.");
      }else{
          return new Object(-1,"네트워크 오류가 발생했습니다.");
      }
  }
}
