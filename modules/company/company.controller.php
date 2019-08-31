<?
class companyController{
  // function getMemberInfoByCompanySrl($m_idx = 0){
  //
  //     global $oDB;
  //
  //     $oDB->where("m.m_idx",$m_idx);
  //     $oDB->where("is_commerce","Y");
  //     $oDB->join("TF_member_commerce_tb mc","mc.m_idx = m.m_idx","LEFT");
  //     $row = $oDB->getOne("TF_member_tb m");
  //
  //     return $row;
  // }
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

  function company_info($args){
    global $oDB;

    $c_name = $args->c_name;
    $registration = $args->registration;
    $address = $args->address;
    $address2 = $args->address2;
    $phonenumber = $args->phonenumber;
    $select6= $args->select6;
    $c_introduction = $args->c_introduction;

    $m_idx=$_SESSION['LOGGED_INFO'];

    date_default_timezone_set('Asia/Seoul');
    $now_date = date(YmdHis);

    $data = array(
      "c_name" => $c_name,
      "registration" => $registration,
      "address" => $address,
      "address2" => $address2,
      "phonenumber" => $phonenumber,
      "select6" => $select6,
      "c_introduction" => $c_introduction,
      "reg_date" => $now_date
    );
    $oDB->where("m_idx",$m_idx);
    $row = $oDB->update("TF_member_commerce_tb", $data);

    if($row){
        return new Object(0,"기업정보가 등록되었습니다.");
    }else{
      return new Object(-1,"네트워크 오류가 발생했습니다.");
    }
  }

  function job_register_success($args){
    global $oDB;

    $h_idx = $args->h_idx;
    $c_idx = $args->c_idx;
    $m_idx = $args->m_idx;
    $h_title = $args->h_title;
    $job_description = $args->job_description;
    $o_idx = $args->o_idx;
    $duty_name= $args->duty_name;
    $salary_idx = $args->salary_idx;
    $job_salary = $args->job_salary;
    $job_is_career = $args->job_is_career;
    $job_achievement = $args->job_achievement;
    $w_idx = $args->w_idx;
    $local_idx = $args->local_idx;
    $city_idx = $args->city_idx;
    $district_idx = $args->district_idx;
    $job_start_date = $args->job_start_date;
    $job_end_date = $args->job_end_date;
    $job_manager = $args->job_manager;
    $phonenumber = $args->phonenumber;
    $select6 = $args->select6;
    $h_certificate_array = $args->h_certificate_array;
    $h_certificate_count = $args->h_certificate_count;
    $short_term_check = $args->short_term_check;

    date_default_timezone_set('Asia/Seoul');
    $now_date = date(YmdHis);

    if($short_term_check == 1){
      $h_title = "[단기]". $args->h_title;
    }

    if($h_idx > 0){
      $data = array(
        "o_idx" => $o_idx,
        "duty_name" => $duty_name,
        "w_idx" => $w_idx,
        "salary_idx" => $salary_idx,
        "h_title" => $h_title,
        "job_description" => $job_description,
        "job_salary" => $job_salary,
        "job_achievement" => $job_achievement,
        "job_is_career" => $job_is_career,
        "job_manager" => $job_manager,
        "job_start_date" => $job_start_date,
        "job_end_date" => $job_end_date,
        "local_idx" => $local_idx,
        "city_idx" => $city_idx,
        "district_idx" => $district_idx,
        "edit_date" => $now_date,
        "hire_is_show" => 'N'
      );
      $oDB->where("h_idx",$h_idx);
      $a_row = $oDB->update("TF_hire_tb", $data);

      $data_info = array(
        "select6" => $select6,
        "select7" => $select7,
        "phonenumber" => $phonenumber,
        "edit_date" => $now_date
      );

      $oDB->where("c_idx",$c_idx);
      $row_info = $oDB->update("TF_member_commerce_tb",$data_info);

      //global $_db_config;
      //$oDBDelete = new MysqliDb($_db_config['host'], $_db_config['user_name'],$_db_config['password'],$_db_config['db'],$_db_config['port']);
      $oDB->where("h_idx",$h_idx);
      $del = $oDB->delete("TF_hire_certificate");
      if(!$del){
        return new Object(-1,"네트워크 오류가 발생했습니다.(-3)");
      }

      for($i = 0; $i < $h_certificate_count; $i++) {
        $certificate_data[$i] = array(
          "h_idx" => $h_idx,
          "certificate_name" => $h_certificate_array[$i]
        );
        $certificate_row = $oDB->insert("TF_hire_certificate", $certificate_data[$i]);
        if(!$certificate_row){
          return new Object(-1,"네트워크 오류가 발생했습니다.(-1)");
        }
      }

      if($a_row){
        $update_check = 1;
        return new Object(0,"공고가 수정되었습니다.");
      }else{
        return new Object(-1,"네트워크 오류가 발생했습니다.(-2)");
      }
    } else {
      $oDB->orderBy("job_idx","DESC");
      $oDB->where("c_idx",$c_idx);
      $job_idx_row = $oDB->get("TF_hire_tb",null,"MAX(job_idx)+1 as job_idx");
      $job_idx = (int)$job_idx_row[0]['job_idx'];

      $data = array(
        "c_idx" => $c_idx,
        "o_idx" => $o_idx,
        "duty_name" => $duty_name,
        "w_idx" => $w_idx,
        "salary_idx" => $salary_idx,
        "h_title" => $h_title,
        "job_description" => $job_description,
        "job_salary" => $job_salary,
        "job_achievement" => $job_achievement,
        "job_is_career" => $job_is_career,
        "job_manager" => $job_manager,
        "job_start_date" => $job_start_date,
        "job_end_date" => $job_end_date,
        "local_idx" => $local_idx,
        "city_idx" => $city_idx,
        "district_idx" => $district_idx,
        "job_idx" => $job_idx,
        "reg_date" => $now_date,
        "edit_date" => $now_date
      );
      $row = $oDB->insert("TF_hire_tb", $data);

      $data_info = array(
        "select6" => $select6,
        "select7" => $select7,
        "phonenumber" => $phonenumber,
        "edit_date" => $now_date
      );

      $oDB->where("c_idx",$c_idx);
      $row_info = $oDB->update("TF_member_commerce_tb",$data_info);

      if($row){
        $oDB->orderBy("h_idx","DESC");
        $oDB->where("reg_date",$now_date);
        $oDB->where("c_idx",$c_idx);
        $h_row = $oDB->get("TF_hire_tb",null,"h_idx");
        $h_idx = $h_row[0]["h_idx"];

        $short_term_data = array(
          "h_idx" => $h_idx
        );
        $short_term = $oDB->insert("TF_hire_short_term",$short_term_data);

        // 위에서 정리된 oDB안의 내용을 reset없이 달고오면 안됩니다.
        //$oDB = new MysqliDb($_db_config['host'], $_db_config['user_name'],$_db_config['password'],$_db_config['db'],$_db_config['port']);

        for($i = 0; $i < $h_certificate_count; $i++) {
          $certificate_data[$i] = array(
            "h_idx" => $h_idx,
            "certificate_name" => $h_certificate_array[$i]
          );
          $certificate_row = $oDB->insert("TF_hire_certificate", $certificate_data[$i]);
          if(!$certificate_row){
            return new Object(-1,"네트워크 오류가 발생했습니다.(-1)");
          }
        }
        return new Object(0,"공고가 등록되었습니다.");
      }else{
        return new Object(-1,"네트워크 오류가 발생했습니다.");
      }
    }
  }

  function close_hire($args){
    global $oDB;

    $h_idx = $args->h_idx;

    date_default_timezone_set('Asia/Seoul');
    $now_date = date(YmdHis);

    $data = array(
      "job_end_date" => $now_date
    );
    $oDB->where("h_idx",$h_idx);
    $row = $oDB->update("TF_hire_tb",$data);
    if($row){
      return new Object(0,"공고마감처리가 완료되었습니다.");

    }
  }

  function service_order_success($args){
    global $oDB;
    $now_date = date(YmdHis);

    $data = array(
      "m_idx" => $args->m_idx,
      "ps_idx" => $args->ps_idx,
      "discount" => $args->discount,
      "amount" => $args->amount,
      "merchant_uid" => $args->merchant_uid,
      "reg_date" => $now_date,
      "payment_method" => "CARD",
      "account_holder" => $args->account_holder,
      "state" => "Y",
      "edit_date" => $now_date
    );

    $row = $oDB->insert("TF_payment",$data);

    if($row){
      return new Object(0,"결제가 완료되었습니다.");
    }else{
      return new Object(-1,"네트워크 오류가 발생했습니다.");
    }
  }

  function service_order_success2($args){
    global $oDB;
    $now_date = date(YmdHis);

    $data = array(
      "m_idx" => $args->m_idx,
      "ps_idx" => $args->ps_idx,
      "discount" => $args->discount,
      "amount" => $args->amount,
      "merchant_uid" => $args->merchant_uid,
      "reg_date" => $now_date,
      "payment_method" => "CASH",
      "account_holder" => $args->account_holder,
      "state" => "N",
      "edit_date" => $now_date
    );

    $row = $oDB->insert("TF_payment",$data);

    if($row){

      $oDB->where("reg_date",$now_date);
      $search_p_idx = $oDB->get("TF_payment",null,"p_idx");

      if($args->receipt_phone){
        $cash_data = array(
          "p_idx" => $search_p_idx[0]['p_idx'],
          "num_option" => "소득공제용",
          "num" => $args->receipt_phone,
          "reg_date" => $now_date
        );
        $row2 = $oDB->insert("TF_cash_receipt",$cash_data);

      }else if($args->receipt_registration){
        $cash_data = array(
          "p_idx" => $search_p_idx[0]['p_idx'],
          "num_option" => "지출증빙용",
          "num" => $args->receipt_registration,
          "reg_date" => $now_date
        );
        $row2 = $oDB->insert("TF_cash_receipt",$cash_data);
      }
    }else{
      return new Object(-1,"네트워크 오류가 발생했습니다.");
    }
  }


   function add_voucher($args){
     global $oDB;
     $now_date = date(YmdHis);

     $data = array(
       "m_idx" => $args->m_idx,
       "h_idx" => $args->h_idx,
       "ps_idx" => $args->ps_idx,
       "all_count" => $args->all_count,
       "remain_count" => $args->remain_count,
       "reg_date" => $now_date
     );

     $row = $oDB->insert("TF_member_voucher",$data);

     if($row){
       return new Object(0,"결제가 완료되었습니다.");
     }else{
       return new Object(-1,"네트워크 오류가 발생했습니다.");
     }
   }

   function use_voucher($args){
     global $oDB;
     $now_date = date(YmdHis);
     $m_idx = $_SESSION['LOGGED_INFO'];

     $oDB->where("m_idx",$m_idx);
     $sel_row = $oDB->get("TF_member_voucher");

      $use_data = array(
        "remain_count" => $sel_row[0]['remain_count']-1
      );
      $oDB->where("v_idx",$sel_row[0][v_idx]);
      $use_row = $oDB->update("TF_member_voucher",$use_data);
   }

   function insert_interview_info($args){
     global $oDB;
     $now_date = date(YmdHis);
     $m_idx = $_SESSION['LOGGED_INFO'];

     $data = array(
       "m_idx" => $m_idx,
       "c_idx" => $args->c_idx,
       "h_idx" => $args->h_idx,
       "applicant_idx" => $args->applicant_idx,
       "way" => "직접 전화",
       "reg_date" => $now_date
     );
     $insert_row = $oDB->insert("TF_suggest_interview",$data);

     if(!$insert_row){
       return new Object(-1,"네트워크 오류가 발생했습니다.");
     }
   }
}
