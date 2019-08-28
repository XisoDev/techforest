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

  function language_detail_cate($args){
    global $oDB;
    //$output = new Object();

    $lc_name = $args->value;

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
    $m_idx = $args->m_idx;

    //기본정보 저장
    $data1 = array(
      "m_name" => $args->m_name,
      "m_human" => $args->m_human,
      "m_birthday" => $args->m_birthday,
      "m_email" => $args->m_email,
      "m_phone" => $args->m_phone,
      "m_address" => $args->m_address,
      "m_address2" => $args->m_address2,
      "m_local_idx" => $args->local_idx,
      "m_city_idx" => $args->city_idx,
      "m_district_idx" => $args->district_idx,
      "edit_date" => $now_date,
    );

    $oDB->where("m_idx",$m_idx);
    $result1 = $oDB->update("TF_member_tb",$data1);

    if(!$result1){
      return new Object(1,"네트워크 오류가 발생했습니다.(-1)");
    }

    //희망급여 저장
    $data2 = array(
      "m_idx" => $args->m_idx,
      "salary_idx" => $args->desired_salary_select,
      "desired_salary" => $args->desired_salary_input,
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
      "self_introduction" => $args->about_me,
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
    if($my_info3_count != 0){
      $oDB->where("m_idx",$m_idx);
      $result5_1 = $oDB->delete("TF_member_education_tb");

      if(!$result5_1){
        return new Object(1,"네트워크 오류가 발생했습니다.(-5_1)");
      }
    }

    if(!$my_info3_count || $my_info3_count == 0){
    }else{
      for($i = 0; $i < $my_info3_count; $i++){
        $s_idx = $args->s_idx.$i;
        $school_name = $args->school_name.$i;
        $school_major = $args->school_major.$i;
        $school_grade = $args->school_grade.$i;
        $max_grade = $args->max_grade.$i;
        $school_graduated = $args->school_graduated.$i;
        $is_ged = $args->is_ged.$i;

        if($is_ged == 1){

        }else{
          if(!$school_name || !$school_major || !$school_graduated) {
          return new Object(1,"학교명, 전공, 졸업연도를 입력하세요.(" . $i . ")");
				  }
        }
        //2. 학력 저장
        $data5_2 = array(
          "m_idx" => $args->m_idx,
          "s_idx" => $args->s_idx,
          "school_name" => $args->school_name,
          "school_major" => $args->school_major,
          "school_grade" => $args->school_grade,
          "max_grade" => $args->max_grade,
          "school_graduated" => $args->school_graduated,
          "is_ged" => $args->is_ged,
          "school_idx" => $args->school_idx,
          "reg_date" => $now_date,
          "edit_date" => $now_date
        );
        $result5_2 = $oDB->insert("TF_member_self_tb",$data5_2);
        if(!$result5_2){
          return new Object(1,"네트워크 오류가 발생했습니다.(-5_2". $i .")");
        }
      }//학력 for문 끝
    }

    //1.경력 삭제
    $career_json = $args->career_json;
    if(count($career_json) != 0){
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

      if($is_newcommer == 1){

        }else{
          if(!($c_o_idx > 0)) {
            return new Object(1,"해당 경력의 직종을 설정해주세요.(" . $i+1 . ")");
          }

          if($c_o_idx == 1 || $c_o_idx == 9){
            $c_duty = "";
          }else if(empty($c_duty) || $c_duty == "null"){
            return new Object(1,"해당 경력의 직무를 설정해주세요.(" . $i+1 . ")");
          }

          if(!$c_name || !$c_position || !$c_start_date || !$c_end_date){
            return new Object(1,"기업명, 직위(직급), 근무기간을 입력하세요.(" . $i+1 . ")");
          }
        }

        //2. 경력 저장
        $data6_2 = array(
          "m_idx" => $args->m_idx,
          "c_name" => $c_name,
          "c_position" => $c_position,
          "c_content" => $c_content,
          "o_idx" => $c_o_idx,
          "duty_name" => $c_duty,
          "c_start_date" => $c_start_date,
          "c_end_date" => $c_end_date,
          "is_newcommer" => $is_newcommer,
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
      if($my_info5_count != 0){
        $oDB->where("m_idx",$m_idx);
        $result7_1 = $oDB->delete("TF_member_certificate_tb");

        if(!$result7_1){
          return new Object(1,"네트워크 오류가 발생했습니다.(-7_1)");
        }
      }

      if(!$my_info5_count || $my_info5_count == 0){

      }else{
        for($i = 0; $i < $my_info5_count; $i++){
          $certificate_name	=	$args->certificate_name.$i;
          $certificate_date	=	$args->certificate_date.$i;
          $is_certificate		=	$args->is_certificate.$i;

          if(!$certificate_name || !$certificate_date){
            return new Object(1,"자격증명, 취득날짜를 입력하세요.(" . $i . ")");
          }

          //2. 자격증 저장
          $data7_2 = array(
            "m_idx" => $args->m_idx,
            "certificate_name" => $certificate_name,
            "certificate_date" => $certificate_date,
            "is_certificate" => $is_certificate,
            "certificate_idx" => $i,
            "reg_date" => $now_date,
            "edit_date" => $now_date
          );

          $result7_2 = $oDB->insert("TF_member_certificate_tb",$data7_2);

          if(!$result7_2){
            return new Object(1,"네트워크 오류가 발생했습니다.(-7_2)");
          }
        }//자격증 for문 끝
      }

      //1.어학 삭제
      if($my_info6_count != 0){
        $oDB->where("m_idx",$m_idx);
        $result8_1 = $oDB->delete("TF_member_language_tb");

        if(!$result8_1){
          return new Object(1,"네트워크 오류가 발생했습니다.(-8_1)");
        }
      }

      if(!$my_info6_count || $my_info6_count == 0){

      }else{
        for($i = 0; $i < $my_info6_count; $i++){
          $lc_name			=	$args->lc_name_txt. $i;
          $lc_d_name			=	$args->lc_d_name_txt. $i;
          $score				=	$args->score. $i;
          $language_date		=	$args->language_date. $i;

          if(!$lc_name || !$lc_d_name || !$score || !$language_date) {
            return new Object(1,"어학을 빈칸없이 채워주세요.(" . $i . ")");
          }

          //2. 어학 저장
          $data8_2 = array(
            "m_idx" => $args->m_idx,
            "lc_idx" => $lc_name,
            "lc_d_idx" => $lc_d_name,
            "score" => $score,
            "language_date" => $language_date,
            "language_idx" => $i,
            "reg_date" => $now_date,
            "edit_date" => $now_date
          );
          $result8_2 = $oDB->insert("TF_member_certificate_tb",$data8_2);

          if(!$result8_2){
            return new Object(1,"네트워크 오류가 발생했습니다.(-8_2)");
          }
        }//어학 for문 끝
      }

      //1.직무 삭제
      $duty_name_arr = $args->duty_name_arr;
      $duty_o_arr = $args->duty_o_arr;

      if(count($duty_name_arr) != 0){
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
          "duty_name" => $duty_name_arr[$i],
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
        "a_line_self" => $args->a_line_self,
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
}
