<?php
class technicianController{

  function interest_remove($args){
    global $oDB;

    $h_idx = htmlspecialchars($args->h_idx);
    $m_idx = htmlspecialchars($args->m_idx);

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
    $h_idx = htmlspecialchars($args->h_idx);
    $m_idx = htmlspecialchars($args->m_idx);

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

  function language_detail_cate($args){
    global $oDB;
    //$output = new Object();

    $lc_name = htmlspecialchars($args->value);

    $oDB->where("lc_d_is_show","Y");
    $oDB->where("lc_name","$lc_name");
    $oDB->join("TF_language_cate lc","lc.lc_idx = lcd.lc_idx","LEFT");
    $language_cate_detail_rows = $oDB->get("TF_language_cate_detail lcd",null,"lcd.lc_d_idx, lcd.lc_d_name");

    $html = "";

    for($i = 0; $i < count($language_cate_detail_rows); $i++) {
      $lc_d_idx	= $language_cate_detail_rows[$i]["lc_d_idx"];
      $lc_d_name	= $language_cate_detail_rows[$i]["lc_d_name"];
      $html .= "<option value=\"" . $lc_d_name . "\">" . $lc_d_name . "</option>";
    }

    if($html == "" || !$html) {
      $html .= "<option value=\"\">직접입력</option>";
    }

    return new Object(0,$html);

  }

  function my_info_detail_edit($args){
    global $oDB;
    $now_date = date(YmdHis);
    $m_idx = htmlspecialchars($args->m_idx);

    //기본정보 저장
    $data1 = array(
      "m_name" => htmlspecialchars($args->m_name),
      "m_human" => htmlspecialchars($args->m_human),
      "m_birthday" => htmlspecialchars($args->m_birthday),
      "m_email" => htmlspecialchars($args->m_email),
      "m_phone" => htmlspecialchars($args->m_phone),
      "m_address" => htmlspecialchars($args->m_address),
      "m_address2" => htmlspecialchars($args->m_address2),
      "m_local_idx" => $args->local_select,
      "m_city_idx" => $args->city_select,
      "m_district_idx" => $args->district_select,
      "edit_date" => $now_date,
    );

    $oDB->where("m_idx",$m_idx);
    $result1 = $oDB->update("TF_member_tb",$data1);

    if(!$result1){
      return new Object(1,"네트워크 오류가 발생했습니다.(-1)");
    }

    //희망급여 저장
    $data2 = array(
      "m_idx" => $m_idx,
      "salary_idx" => $args->desired_salary_select,
      "desired_salary" => htmlspecialchars($args->desired_salary_input),
      "reg_date" => $now_date,
      "edit_date" => $now_date
    );
    $updateColumns = array("salary_idx","desired_salary","edit_date");
    $lastInsertId = "m_idx";
    $oDB->onDuplicate($updateColumns,$lastInsertId);
    $result2 = $oDB->insert("TF_member_order",$data2);

    if(!$result2){
      return new Object(1,"네트워크 오류가 발생했습니다.(-2)");
    }

    //희망직종 저장
    if(!$args->occupation_select){
      $args->occupation_select = 1;
    }
    $data3 = array(
      "m_idx" => $args->m_idx,
      "o_idx" => $args->occupation_select,
      "reg_date" => $now_date,
      "edit_date" => $now_date
    );
    $updateColumns2 = array("o_idx","edit_date");
    $lastInsertId2 = "m_idx";
    $oDB->onDuplicate($updateColumns2,$lastInsertId2);
    $result3 = $oDB->insert("TF_member_occupation",$data3);

    if(!$result3){
      return new Object(1,"네트워크 오류가 발생했습니다.(-3)");
    }

    //자기소개 저장
    $data4 = array(
      "m_idx" => $args->m_idx,
      "self_introduction" => htmlspecialchars($args->about_me),
      "reg_date" => $now_date,
      "edit_date" => $now_date
    );
    $updateColumns3 = array("m_idx","self_introduction","edit_date");
    $lastInsertId3 = "m_idx";
    $oDB->onDuplicate($updateColumns3,$lastInsertId3);
    $result4 = $oDB->insert("TF_member_self_tb",$data4);

    if(!$result4){
      return new Object(1,"네트워크 오류가 발생했습니다.(-4)");
    }

    //1.학력 삭제
    // global $_db_config;
    // $oDBDelete = new MysqliDb($_db_config['host'], $_db_config['user_name'],$_db_config['password'],$_db_config['db'],$_db_config['port']);
    $oDB->where("m_idx",$m_idx);
    $result5_0 = $oDB->get("TF_member_education_tb");

    $my_info3_json = $args->my_info3_json;
    if(count($result5_0) > 0){
      $oDB->where("m_idx",$m_idx);
      $result5_1 = $oDB->delete("TF_member_education_tb");

      if(!$result5_1){
        return new Object(1,"네트워크 오류가 발생했습니다.(-5_1)");
      }
    }


    for($i = 0, $len = count($my_info3_json); $i < $len; $i++){
        $s_idx = $my_info3_json[$i]['s_idx'];
        $school_name = $my_info3_json[$i]['school_name'];
        $school_major = $my_info3_json[$i]['school_major'];
        $school_grade = $my_info3_json[$i]['school_grade'];
        $max_grade = $my_info3_json[$i]['max_grade'];
        $school_graduated = $my_info3_json[$i]['school_graduated'];
        $is_ged = $my_info3_json[$i]['is_ged'];
        $school_idx = $i;

          //2. 학력 저장
        $data5_2 = array(
          "m_idx" => $args->m_idx,
          "s_idx" => $s_idx,
          "school_name" => htmlspecialchars($school_name),
          "school_major" => htmlspecialchars($school_major),
          "school_grade" => htmlspecialchars($school_grade),
          "max_grade" => htmlspecialchars($max_grade),
          "school_graduated" => htmlspecialchars($school_graduated),
          "is_ged" => $is_ged,
          "school_idx" => $school_idx,
          "reg_date" => $now_date,
          "edit_date" => $now_date
        );
        $result5_2 = $oDB->insert("TF_member_education_tb",$data5_2);
        if(!$result5_2){
          return new Object(-1,"네트워크 오류가 발생했습니다.(-5_2". $i .")");
        }
      }//학력 for문 끝


    //1.경력 삭제
    $oDB->where("m_idx",$m_idx);
    $result6_0 = $oDB->get("TF_member_career_tb");

    $career_json = $args->career_json;
    if(count($result6_0) > 0){
      $oDB->where("m_idx",$m_idx);
      $result6_1 = $oDB->delete("TF_member_career_tb");

      if(!$result6_1){
        return new Object(1,"네트워크 오류가 발생했습니다.(-6_1)");
      }
    }

    for($i = 0, $len = count($career_json); $i < $len; $i++){
      $c_name = $career_json[$i]['c_name'];
      $c_position = $career_json[$i]['c_position'];
      $c_content = $career_json[$i]['c_content'];
      $c_start_date = $career_json[$i]['c_start_date'];
      $c_end_date = $career_json[$i]['c_end_date'];
      $c_o_idx = $career_json[$i]['c_o_idx'];
      $c_duty = $career_json[$i]['c_duty'];
      $is_newcommer = $career_json[$i]['is_newcommer'];
      $c_content = $career_json[$i]['c_content'];

        //2. 경력 저장
        $data6_2 = array(
          "m_idx" => $args->m_idx,
          "c_name" => htmlspecialchars($c_name),
          "c_position" => htmlspecialchars($c_position),
          "c_content" => htmlspecialchars($c_content),
          "o_idx" => $c_o_idx,
          "duty_name" => htmlspecialchars($c_duty),
          "c_start_date" => htmlspecialchars($c_start_date),
          "c_end_date" => htmlspecialchars($c_end_date),
          "is_newcommer" => htmlspecialchars($is_newcommer),
          "career_idx" => $i,
          "reg_date" => $now_date,
          "edit_date" => $now_date
        );
        $result6_2 = $oDB->insert("TF_member_career_tb",$data6_2);

        if(!$result6_2){
          return new Object(1,"네트워크 오류가 발생했습니다.(-6_2 경력". $i+1 .")");
        }
      }//경력 for문 끝


      //1.자격증 삭제
      $oDB->where("m_idx",$m_idx);
      $result7_0 = $oDB->get("TF_member_certificate_tb");

      $my_info5_json = $args->my_info5_json;

      if(count($result7_0) > 0){
        $oDB->where("m_idx",$m_idx);
        $result7_1 = $oDB->delete("TF_member_certificate_tb");

        if(!$result7_1){
          return new Object(1,"네트워크 오류가 발생했습니다.(-7_1)");
        }
      }

        for($i = 0, $len = count($my_info5_json); $i < $len; $i++){
          $certificate_name = $my_info5_json[$i]['certificate_name'];
          $certificate_date = $my_info5_json[$i]['certificate_date'];

          //2. 자격증 저장
          $data7_2 = array(
            "m_idx" => $args->m_idx,
            "certificate_name" => htmlspecialchars($certificate_name),
            "certificate_date" => $certificate_date,
            "is_certificate" => "N",
            "certificate_idx" => $i,
            "reg_date" => $now_date,
            "edit_date" => $now_date
          );

          $result7_2 = $oDB->insert("TF_member_certificate_tb",$data7_2);

          if(!$result7_2){
            return new Object(1,"네트워크 오류가 발생했습니다.(-7_2)");
          }
        }//자격증 for문 끝


      //1.어학 삭제
      $oDB->where("m_idx",$m_idx);
      $result8_0 = $oDB->get("TF_member_language_tb");

      $my_info6_json = $args->my_info6_json;

      if(count($result8_0) > 0){
        $oDB->where("m_idx",$m_idx);
        $result8_1 = $oDB->delete("TF_member_language_tb");

        if(!$result8_1){
          return new Object(1,"네트워크 오류가 발생했습니다.(-8_1)");
        }
      }

      for($i = 0, $len = count($my_info6_json); $i < $len; $i++){
        $lc_name = $my_info6_json[$i]['lc_name_txt'];
        $lc_d_name = $my_info6_json[$i]['lc_d_name_txt'];
        $score = $my_info6_json[$i]['score'];
        $language_date = $my_info6_json[$i]['language_date'];

          //2. 어학 저장
          $data8_2 = array(
            "m_idx" => $args->m_idx,
            "lc_idx" => htmlspecialchars($lc_name),
            "lc_d_idx" => htmlspecialchars($lc_d_name),
            "score" => htmlspecialchars($score),
            "language_date" => htmlspecialchars($language_date),
            "language_idx" => $i,
            "reg_date" => $now_date,
            "edit_date" => $now_date
          );
          $result8_2 = $oDB->insert("TF_member_language_tb",$data8_2);

          if(!$result8_2){
            return new Object(1,"네트워크 오류가 발생했습니다.(-8_2)");
          }
        }//어학 for문 끝

      //1.직무 삭제
      $duty_name_arr = htmlspecialchars($args->duty_name_arr)htmlspecialchars();
      $duty_o_arr = htmlspecialchars($args->duty_o_arr)htmlspecialchars();

      $oDB->where("m_idx",$m_idx);
      $result9_0 = $oDB->get("TF_member_duty");

      if(count($result9_0) > 1){
        $oDB->where("m_idx",$m_idx);
        $result9_1 = $oDB->delete("TF_member_duty");

        if(!$result9_1){
          return new Object(1,"네트워크 오류가 발생했습니다.(-9_1)");
        }
      }

      for($i=0; $i < count($duty_name_arr); $i++) {
        //2. 직무 저장
        $data9_2 = array(
          "m_idx" => $args->m_idx,
          "o_idx" => $duty_o_arr[$i],
          "duty_name" => htmlspecialchars($duty_name_arr[$i]),
          "reg_date" => $now_date
        );
        $result9_2 = $oDB->insert("TF_member_duty",$data9_2);

        if(!$result9_2){
          return new Object(1,"네트워크 오류가 발생했습니다.(-9_2)");
        }
      }//직무 for문 끝

      //한줄PR 저장

      $data10 = array(
        "m_idx" => $args->m_idx,
        "a_line_self" => htmlspecialchars($args->a_line_self),
        "reg_date" => $now_date,
        "edit_date" => $now_date
      );
      $updateColumns4 = array("m_idx","a_line_self","edit_date");
      $lastInsertId4 = "m_idx";
      $oDB->onDuplicate($updateColumns4,$lastInsertId4);
      $result10 = $oDB->insert("TF_a_line_self",$data10);

      if(!$result10){
        return new Object(1,"네트워크 오류가 발생했습니다.(-10)");
      }
      return new Object(0,"등록 및 수정이 완료되었습니다.");
  }

  function recommend_technician_yes($args){
    global $oDB;
    $now_date = date(YmdHis);

    $yes_data = array(
      "m_idx" => $args->m_idx,
      "YN" => "Y",
      "reg_date" => $now_date
    );
    $yes_row = $oDB->insert("TF_recommend_technician",$yes_data);

    if($yes_row){
      return new Object(0);
    }else{
      return new Object(1,"네트워크 오류가 발생했습니다.");
    }
  }

  function recommend_technician_no($args){
    global $oDB;
    $now_date = date(YmdHis);

    $no_data = array(
      "m_idx" => $args->m_idx,
      "YN" => "N",
      "reg_date" => $now_date
    );
    $no_row = $oDB->insert("TF_recommend_technician",$no_data);

    if($no_row){
      return new Object(0);
    }else{
      return new Object(1,"네트워크 오류가 발생했습니다.");
    }
  }

  function suggestion_join($args){
    global $oDB;
    $now_date = date(YmdHis);

    $oDB->where("m_idx",$args->m_idx);
    $oDB->where("h_idx",$args->h_idx);
    $sj_check = $oDB->get("TF_suggest_join");

    if($sj_check){
      return new Object(1,"이미 해당 지원자에게 입사제안한 공고입니다.");
    }else{
      $sj_data = array(
        "c_idx" => $args->c_idx,
        "h_idx" => $args->h_idx,
        "m_idx" => $args->m_idx,
        "reg_date" => $now_date
      );
      $sj_row = $oDB->insert("TF_suggest_join",$sj_data);

      if($sj_row){
        return new Object(0,"입사제안이 완료되었습니다.");
      }else{
        return new Object(1,"네트워크 오류가 발생했습니다.");
      }
    }
  }

  function application_letter_register($args){
    global $oDB;
    $now_date = date(YmdHis);

    $h_idx = $args->h_idx;
    $m_idx = $args->m_idx;

    if(!$h_idx) {
      return new Object(1,"잘못된 접속입니다.(0)");
    }
    if(!$m_idx) {
      return new Object(1,"잘못된 접속입니다.(-1)");
    }

    $oDB->where("m_idx",$m_idx);
    $address_row = $oDB->get("TF_member_tb",null,"m_address");

    if(!$address_row){
      return new Object(1,"정보를 추가 입력 후 이용해주세요.");
    }

    $oDB->where("m_idx",$m_idx);
    $oDB->where("h_idx",$h_idx);
    $applicant_check = $oDB->get("TF_application_letter");

    if(count($applicant_check) > 0){
      return new Object(1,"이미 지원한 공고입니다.");
    }else{
      //지원
      $data = array(
        "h_idx" => $h_idx,
        "m_idx" => $m_idx,
        "reg_date" => $now_date,
        "isVisible" => "N"
      );
      $applicant_insert= $oDB->insert("TF_application_letter",$data);

      //알림 설정을 위한 업체 m_idx select
      $oDB->where("h.h_idx",$h_idx);
      $oDB->join("TF_member_commerce_tb c","c.c_idx = h.c_idx","LEFT");
      $row = $oDB->get("TF_hire_tb as h",null,"c.m_idx");

      //알림 설정
      $data = Array ("m_idx" => $row[0]['m_idx'],
              "n_idx" => 1,
              "num" => $h_idx,
              "reg_date" => $now_date,
            );
      $row = $oDB->insert ('TF_member_notice', $data);

      if($row){
        return new Object(0,"지원이 완료되었습니다.");
      }else{
        return new Object(1,"네트워크 오류가 발생했습니다.(-2)");
      }
    }
  }

  function procFileUpload($args){
    global $oDB;
    $m_idx = $_SESSION['LOGGED_INFO'];

    $oDB->where("m_idx",$m_idx);
    $row = $oDB->get("TF_member_file");

    if(count($row) >= 10){
      return new Object(1,"파일은 최대 10개까지 업로드 가능합니다.(-1)");
    }

    if(!$_FILES["userfile"]["name"]){
     return new Object(-1,"파일이 없습니다.(-2)");
   }

   if($_FILES["userfile"]["error"] > 0){
     return new Object(-1,"파일이 잘못되었습니다.(-3)");
    }

    $access_extension = array('jpg','jpeg','gif','png','bmp', 'doc', 'docx', 'dot', 'dotx', 'ppt', 'pptx', 'xls', 'xlsx', 'hwp', 'zip', 'pdf');
    $path = pathinfo($_FILES['userfile']['name']);
    $ext = strtolower($path['extension']);

     if(!in_array($ext, $access_extension)) {
       return new Object(-1,"허용 되지 않는 확장자 입니다.(-4)");
     }

     if($_FILES["userfile"]["size"] > 52428800){
      return new Object(-1,"파일 크기는 최대 50mb까지입니다.(-5)");
    }

    $file_select = $args->fileUpload_select;

    $date	= date(YmdHis);
    $file_real_name = $_FILES["userfile"]["name"];
    $file_name = $m_idx . "_" . $date . "_" . $file_real_name;
    $target_path = "../TF/portfolio/";

    if(move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_path . $file_name)){
      $data = array(
        "m_idx" => $m_idx,
        "file_type" => htmlspecialchars($file_select),
        "file_name" => htmlspecialchars($file_real_name),
        "reg_date" => $date
      );
      $upload_row = $oDB->insert("TF_member_file",$data);
      if(!$upload_row){
      return new Object(-1,"파일 업로드 중 오류가 발생하였습니다.(-6)");
      }
    }else{
      return new Object(-1,"파일 업로드 중 오류가 발생하였습니다.(-7)");
    }

    return new Object(0,"파일 업로드가 완료되었습니다.");
  }

  function procFileUploadResume(){
    global $oDB;
    $m_idx = $_SESSION['LOGGED_INFO'];

    if(!$_FILES["resume_upload"]["name"]){
     return new Object(-1,"파일이 없습니다.(-2)");
   }

   if($_FILES["resume_upload"]["error"] > 0){
     return new Object(-1,"파일이 잘못되었습니다.(-3)");
    }

    $access_extension = array('jpg','jpeg','gif','png','bmp', 'doc', 'docx', 'dot', 'dotx', 'ppt', 'pptx', 'xls', 'xlsx', 'hwp', 'zip', 'pdf');
    $path = pathinfo($_FILES['resume_upload']['name']);
    $ext = strtolower($path['extension']);

     if(!in_array($ext, $access_extension)) {
       return new Object(-1,"허용 되지 않는 확장자 입니다.(-4)");
     }


    $date	= date(YmdHis);
    $file_real_name = $_FILES["resume_upload"]["name"];
    $file_name = $m_idx . "_" . $date . "_" . $file_real_name;
    $target_path = "../TF/curriculum/";

    if(move_uploaded_file($_FILES["resume_upload"]["tmp_name"], $target_path . $file_name)){
      $data = array(
        "m_idx" => $m_idx,
        "image" => htmlspecialchars($file_name),
        "is_ok" => 'N',
        "reg_date" => $date
      );
      $upload_row = $oDB->insert("TF_curriculum_tb",$data);

      if(!$upload_row){
      return new Object(-1,"파일 업로드 중 오류가 발생하였습니다.(-6)");
      }
    }else{
      return new Object(-1,"파일 업로드 중 오류가 발생하였습니다.(-7)");
    }

    return new Object(0,"파일 업로드가 완료되었습니다.");
  }

  function FileDelete($args){
    global $oDB;
    $m_idx = $_SESSION['LOGGED_INFO'];

    $date = date("YmdHis", strtotime($args->reg_date));
    $file_real_name = htmlspecialchars($args->file_name);
    $file_name = $m_idx . "_" . $date . "_" . $file_real_name;
    $target_path = "../TF/portfolio/";

    if(unlink($target_path . $file_name)){
      $oDB->where("reg_date",$date);
      $oDB->where("file_name",$file_real_name);
      $file_delete_row = $oDB->delete("TF_member_file");

      if(!$file_delete_row){
      return new Object(-1,"파일 삭제 중 오류가 발생하였습니다.(-6)");
      }
    }else{
      return new Object(-1,"파일 삭제 중 오류가 발생하였습니다.(-7)");
    }

    return new Object(0,"파일 삭제가 완료되었습니다.");
  }

  function m_picture_remove($args){
    global $oDB;
    $m_idx = $_SESSION['LOGGED_INFO'];
    $now_date = date(YmdHis);
    $target_path = "../TF/selfImg/";
    $image_name = $m_idx . "_" . $date . ".jpg";

    $oDB->where("m_idx",$m_idx);
    $row = $oDB->get("TF_member_tb",null,"m_picture");

    if($row['m_picture']){
      unlink($target_path . $image_name);
    }

    $data = array(
      "m_picture" => '',
      "edit_date" => $now_date,
    );
    $oDB->where("m_idx",$m_idx);
    $file_delete_row = $oDB->update("TF_member_tb",$data);

    if(!$file_delete_row){
    return new Object(-1,"이미지 삭제 중 오류가 발생하였습니다.");
    }
    return new Object(0,"이미지 삭제가 완료되었습니다.");
  }

  function procFileUploadPicture(){
    global $oDB;
    $m_idx = $_SESSION['LOGGED_INFO'];
    $date	= date(YmdHis);
    $image_name = $m_idx . "_" . $date . ".jpg";

    $file_real_name = $_FILES["picture_upload"]["name"];

    $target_path = "../TF/selfImg/";

    if($_FILES["picture_upload"]["tmp_name"]){
      $oDB->where("m_idx",$m_idx);
      $row = $oDB->get("TF_member_tb",null,"m_picture");

      $db_img = $row['m_picture'];
      if($db_img) {
        unlink("../TF/selfImg/" . $db_img);
      }

      if(!$row){
        return new Object(-1,"네트워크 오류입니다.(-1)");
      }
      // 파일저장
    if(move_uploaded_file($_FILES['picture_upload']['tmp_name'], "../TF/selfImg/" . $image_name)){

      $data = array(
        "m_picture" => $image_name,
        "edit_date" => $date
      );
      $oDB->where("m_idx",$m_idx);
      $insert_row = $oDB->update("TF_member_tb",$data);

      if(!$insert_row) {
        return new Object(-1,"네트워크 오류입니다.(-2)");
      } else {
        return new Object(0,"증명사진이 등록/수정되었습니다.");
      }

    } else {
      return new Object(-1,"네트워크 오류입니다.(-3)");
    }
  }

  }

  function withdrawTechnician($args){
    global $oDB;

    $m_idx = $args->m_idx;

    $oDB->where("m_idx",$m_idx);
    $row1 = $oDB->delete("TF_member_career_tb");

    $oDB->where("m_idx",$m_idx);
    $row2 = $oDB->delete("TF_member_certificate_tb");

    $oDB->where("m_idx",$m_idx);
    $row3 = $oDB->delete("TF_member_education_tb");

    $oDB->where("m_idx",$m_idx);
    $sel = $oDB->get("TF_member_file",null,"file_name, reg_date");
    if($sel){
      $filePath = $m_idx . "_" . date_format($sel['reg_date'], "YmdHis") . "_" . $sel['file_name'];
      unlink("../TF/curriculum/" . $filePath);
    }

    $oDB->where("m_idx",$m_idx);
    $row4 = $oDB->delete("TF_member_file");

    $oDB->where("m_idx",$m_idx);
    $row5 = $oDB->delete("TF_member_language_tb");

    $oDB->where("m_idx",$m_idx);
    $row6 = $oDB->delete("TF_member_order");

    $oDB->where("m_idx",$m_idx);
    $row7 = $oDB->delete("TF_member_self_tb");

    $oDB->where("m_idx",$m_idx);
    $row8 = $oDB->delete("TF_curriculum_tb");

    $oDB->where("m_idx",$m_idx);
    $row9 = $oDB->delete("TF_gcm_tb");

    $oDB->where("m_idx",$m_idx);
    $row10 = $oDB->delete("TF_interest_career_tb");

    $oDB->where("m_idx",$m_idx);
    $oDB->join("TF_qna_reply_tb reply","qna.q_idx = reply.q_idx","LEFT");
    $row11 = $oDB->delete("TF_qna_tb qna");

    $oDB->where("m_idx",$m_idx);
    $row10 = $oDB->delete("TF_member_setting");

    $oDB->where("m_idx",$m_idx);
    $row11 = $oDB->delete("TF_EducationEvent_Member_tb");

    $oDB->where("m_idx",$m_idx);
    $row12 = $oDB->delete("TF_member_tb");
    if(!$row12){
      return new Object(-1,"회원탈퇴 중 오류가 발생하였습니다.");
    }

  }

}
