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
  function hire_end($args){
    global $oDB;
    $hire_array = $args->hire_array;
    $reg_array = $args->reg_date;
    $m_idx = $args->m_idx;

    for($i=0; $i < count($hire_array);$i++){

      $oDB->where("m_idx",$m_idx);
      $oDB->where("n_idx",4);
      $oDB->where("num",$hire_array[$i]);
      $EXISTS = $oDB->get("TF_member_notice as mn",null,'m_idx');

      if(count($EXISTS) < 1){
        $data = Array ("m_idx" => $m_idx,
                "n_idx" => 4,
                "num" => $hire_array[$i],
                "reg_date" => $reg_array[$i],
              );
        $row = $oDB->insert ('TF_member_notice', $data);
      }

    }
    if($row){
      return new Object(0,'공고마감 알림');
    }else{
      return new Object(0,'');
    }
  }


  function procMemberSignupCompany($args){
      global $oDB;

      $now_date = date(YmdHis);

      //insert
      $data = array(
        "m_id" => $args->m_id,
        "m_pw" => $args->m_pw1,
        "m_name" => $args->m_name,
        "m_human" => "M",
        "m_birthday" => "19900101",
        "m_phone" => $args->m_phone,
        "m_email" => $args->m_email,
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

          $m_idx = $m_row['m_idx'];
          //TF_member_commerce_tb에 추가
          $mc_data = array(
            "m_idx" => $m_idx,
            "c_name" => $args->m_name,
            "phonenumber" => $args->m_phone,
            "select6" => $args->m_email,
            "select7" => $args->select7,
            "edit_date" => $now_date,
            "reg_date" => $now_date
          );
          $oDB->insert("TF_member_commerce_tb", $mc_data);

          //직급저장
          $cm_data = array(
            "m_idx" => $m_idx,
            "c_name" => $args->m_name,
            "c_m_name" => $args->select7,
            "c_m_duty" => $args->c_position,
            "c_m_phone" => $args->m_phone,
            "c_m_email" => $args->m_email,
            "reg_date" => $now_date
          );
          $oDB->insert("TF_commerce_manager_tb", $cm_data);

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
    $m_idx = $_SESSION['LOGGED_INFO'];

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
          "m_idx" => $m_idx,
          "num_option" => "소득공제용",
          "num" => $args->receipt_phone,
          "reg_date" => $now_date
        );
        $row2 = $oDB->insert("TF_cash_receipt",$cash_data);

      }else if($args->receipt_registration){
        $cash_data = array(
          "p_idx" => $search_p_idx[0]['p_idx'],
          "m_idx" => $m_idx,
          "num_option" => "지출증빙용",
          "num" => $args->receipt_registration,
          "reg_date" => $now_date
        );
        $row2 = $oDB->insert("TF_cash_receipt",$cash_data);
      }
    }else{
      return new Object(1,"네트워크 오류가 발생했습니다.");
    }
  }


   function add_voucher($args){
     global $oDB;
     $now_date = date(YmdHis);
     $timestamp = strtotime("+1 months");
     $expire_date = date("Y-m-d H:i:s", $timestamp);
     $data = array(
       "m_idx" => $args->m_idx,
       "h_idx" => $args->h_idx,
       "ps_idx" => $args->ps_idx,
       "all_count" => $args->all_count,
       "remain_count" => $args->remain_count,
       "reg_date" => $now_date,
       "expire_date" => $expire_date
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

   function procFileUpload(){
     global $oDB;
     $c_idx = $_SESSION['c_idx'];
     $date	= date(YmdHis);
     $image_name = $c_idx . "_" . $date . ".jpg";

     $file_real_name = $_FILES["userfile"]["name"];

     $target_path = "./company_logo/";

     if($_FILES["userfile"]["tmp_name"]){
       $oDB->where("c_idx",$c_idx);
       $row = $oDB->get("TF_member_commerce_tb",null,"image");

       $db_img = $row['image'];
       if($db_img) {
         unlink("./company_logo/" . $db_img);
       }

       if(!$row){
         return new Object(-1,"네트워크 오류입니다.(-1)");
       }
       // 파일저장
     if(move_uploaded_file($_FILES['userfile']['tmp_name'], "./company_logo/" . $image_name)){

       $data = array(
         "image" => $image_name,
         "edit_date" => $date
       );
       $oDB->where("c_idx",$c_idx);
       $insert_row = $oDB->update("TF_member_commerce_tb",$data);

       if(!$insert_row) {
         return new Object(-1,"네트워크 오류입니다.(-2)");
       } else {
         return new Object(0,"기업로고가 등록/수정되었습니다.");
       }

     } else {
       return new Object(-1,"네트워크 오류입니다.(-3)");
     }
   }

   }
}
