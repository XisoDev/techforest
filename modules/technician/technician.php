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

        $output->add('myinfo_row',$this->resume_info());
        $output->add('now_application',$this->now_application());
        $output->add('count_career_row',$this->resume_completeness1());
        $output->add('count_c_content_row',$this->resume_completeness2());
        $output->add('count_myinfo_row',$this->resume_completeness3());

        $set_template_file = "technician/index.php";

        return $output;
    }

    function resume($args){
        setSEO("이력서 등록","기술자숲 회원이라면 누구나 작성할 수 있습니다.");
        global $site_info;
        global $add_body_class;
        global $set_template_file;
        global $oDB;
        $output = new Object();

        if($args->document_srl) {
            $site_info->layout = "none";
            $add_body_class[] = "";

        }else{
            $site_info->layout = "technician";
            $add_body_class[] = "shrink";
            $set_template_file = "technician/resume.list.php";
        }

        return $output;
    }

    function resumeWrite($args){
        setSEO("온라인 이력서 작성이 어렵다면?","종이이력서를 사진으로 찍거나 이력서파일을 올려주세요.");
        global $site_info;
        global $add_body_class;
        global $set_template_file;
        global $oDB;

        $output = new Object();
        $site_info->layout = "technician";
        $add_body_class[] = "shrink";
        $set_template_file = "technician/resume.write.php";

        $m_idx = $_SESSION['LOGGED_INFO'];

        //한줄자기소개
        $oDB->where("m_idx",$m_idx);
        $a_line_row = $oDB->get("TF_a_line_self",null,"a_line_self");

        //나의 이력서 정보 조회
        $oDB->orderBy("m.m_idx","ASC");
        $oDB->where("m.m_idx",$m_idx);
        $oDB->join("TF_member_occupation mo","mo.m_idx = m.m_idx","LEFT");
        $oDB->join("TF_district_tb d","m.m_district_idx = d.district_idx","LEFT");
        $oDB->join("TF_city_tb c","m.m_city_idx = c.city_idx","LEFT");
        $oDB->join("TF_local_tb l","m.m_local_idx = l.local_idx","LEFT");
        $resume_row = $oDB->get("TF_member_tb m",null,"m_id, m_name, m_human, m_birthday, m_phone, m_email,
         m_address, m_address2, m_picture, local_name, city_name, district_name, m_local_idx, m_city_idx, m_district_idx, mo.o_idx");

        //나의 이력서 정보 조회 - 학력
        $oDB->orderBy("e.seq","ASC");
        $oDB->where("m_idx",$m_idx);
        $oDB->join("TF_school s","e.s_idx = s.s_idx","LEFT");
        $my_info3 = $oDB->get("TF_member_education_tb e",null,"e.seq, e.s_idx, s_name, school_name, school_major, school_grade, max_grade, school_graduated, is_ged, school_idx");

        //나의 이력서 정보 조회 - 희망직무
        $oDB->where("m_idx",$m_idx);
        $my_duty = $oDB->get("TF_member_duty",null,"o_idx, duty_name");

        //급여 리스트
        $oDB->orderBy("salary_idx","ASC");
        $oDB->where("salary_is_show","Y");
        $salary_list = $oDB->get("TF_salary",null,"salary_idx, salary_name");

        //지역리스트
        //근무지역 local
        $oDB->orderBy("visible_idx","ASC");
        $oDB->where("local_visible","Y");
        $local_arr = $oDB->get("TF_local_tb",null,"local_idx, local_name");

        //근무지역 city
        $oDB->orderBy("city_idx","ASC");
        $oDB->orderBy("local_idx","ASC");
        $oDB->where("city_visible","Y");
        $city_arr = $oDB->get("TF_city_tb",null,"city_idx, city_name, local_idx");

        //근무지역 distinct
        $oDB->orderBy("district_idx","ASC");
        $oDB->orderBy("local_idx","ASC");
        $oDB->where("district_visible","Y");
        $district_arr = $oDB->get("TF_district_tb",null,"district_idx, district_name, local_idx");

        // 직종 리스트
        $oDB->where("o_is_show","Y");
        $occupation_arr = $oDB->get("TF_occupation",null,"o_idx, o_name");

        // 직무 리스트
        $oDB->orderBy("duty_name","ASC");
        $oDB->orderBy("visible_idx","ASC");
        $oDB->orderBy("o_idx","ASC");
        $duty_arr = $oDB->get("TF_duty");

        //학력리스트
        $oDB->orderBy("s_idx","ASC");
        $school_arr = $oDB->get("TF_school",null,"s_idx, s_name");

        // 자격증리스트
        $oDB->orderBy("seq","ASC");
        $certificate_row = $oDB->get("TF_certificate",null,"certificate_name");


        $output->add('a_line_row',$a_line_row);
        $output->add('resume_row',$resume_row);
        $output->add('salary_list',$salary_list);
        $output->add('local_arr',$local_arr);
        $output->add('city_arr',$city_arr);
        $output->add('district_arr',$district_arr);
        $output->add('occupation_arr',$occupation_arr);
        $output->add('duty_arr',$duty_arr);
        $output->add('school_arr',$school_arr);
        $output->add('my_info3',$my_info3);
        $output->add('my_duty',$my_duty);
        $output->add('certificate_row',$certificate_row);

        return $output;
    }

    function findJob($args){
        setSEO("일자리 찾기","기술자님께 딱!맞는 일자리와 관심공고를 살펴보세요");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/findjob.php";

        $output = new Object();
        return $output;
    }

    function findJobList($args){
        setSEO("일자리 찾기","기술자님께 딱!맞는 일자리와 관심공고를 살펴보세요");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/findjob.list.php";

        $output = new Object();
        return $output;
    }

    function magazine($args){
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        if($args->document_srl){
            setSEO("글제목 넣으셔요","작성자, 날짜같은거 넣으면 좋음");
            //또는
            setSEO("취업정보","글제목 넣으셔요");
            $set_template_file = "technician/magazine.view.php";
        }else {
            setSEO("취업정보","취업박람회 및 정보를 한 눈에 살펴보세요.");
            $set_template_file = "technician/magazine.list.php";
        }

        $output = new Object();
        return $output;

    }


    function service($args){
        setSEO("유료 서비스 안내","기업을 쉽게 찾을 수 있는 유료서비스를 이용해보세요.");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;

        $output = new Object();
        if($args->document_srl){
            $set_template_file = "technician/service.view.php";
            $output->add('false_sub_visual',true);
        }else {
            $set_template_file = "technician/service.list.php";
        }
        return $output;

    }


    function serviceHistory($args){
        setSEO("서비스 이용현황","사용가능한 쿠폰과 결제내역을 살펴보세요.");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/service.history.php";

        $output = new Object();
        return $output;

    }
//
//    function servicePayment($args){
//        global $site_info;
//        $site_info->layout = "technician";
//
//        global $add_body_class;
//        $add_body_class[] = "shrink";
//
//        global $set_template_file;
//        $set_template_file = "technician/service.payment.php";
//
//        $output = new Object();
//        return $output;
//
//    }

    function  now_application(){
      global $oDB;

      $oDB->orderby("al.reg_date","DESC");
      $oDB->join("TF_hire_tb h","al.h_idx = h.h_idx", "LEFT");
      $oDB->join("TF_member_commerce_tb mc","h.c_idx = mc.c_idx", "LEFT");
      $row = $oDB->get("TF_application_letter al",3,"al.h_idx, al.reg_date, mc.c_name");

      return $row;
    }

    function naver_login_check(){
      global $logged_info;
      global $oDB;
      $m_id = $logged_info['m_id'];
      $m_idx = $_SESSION['LOGGED_INFO'];
      $m_id_str = substr($m_id,0,3);
      if($m_id_str == 'nN_'){
        $naver_login = 1;
        $oDB->where("m_idx",$m_idx);
        $row = $oDB->get("TF_member_tb",null,"m_phone, m_birthday, m_address, m_address2");

        if(!$row['m_phone'] || !$row[0]['m_birthday'] || !$row[0]['m_address'] || !$row[0]['m_address2']){
              //이력서정보등록 페이지로 이동
        }
      }
    }

    function resume_completeness1(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      //이력서완성도(경력 개수)
      $oDB->where("m_idx",$m_idx);
      $count_career_row = $oDB->getOne("TF_member_career_tb","count(m_idx) as count_career");

      return $count_career_row;
    }

    function resume_completeness2(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      //이력서완성도(경력 직무상세내용 개수)
      $oDB->where("m_idx",$m_idx);
      $oDB->where("c_content","","!=");
      $oDB->where("c_content",NULL, 'IS NOT');
      $count_c_content_row = $oDB->getOne("TF_member_career_tb","count(c_content) as count_c_content");

      return $count_c_content_row;
    }

    function resume_completeness3(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      //이력서완성도(기본정보+희망4종 입력 여부)
      $oDB->where("m.m_idx",$m_idx);
      $oDB->where("d.m_idx",NULL,"IS NOT");
      $oDB->where("m.m_address2",NULL,"IS NOT");
      $oDB->where("m.m_address2","","!=");
      $oDB->where("m.m_address","","!=");
      $oDB->where("m.m_phone","","!=");
      $oDB->where("m.m_birthday","","!=");
      $oDB->where("m.m_email","","!=");
      $oDB->join("TF_member_duty d","m.m_idx = d.m_idx", "LEFT");
      $oDB->join("TF_member_occupation o","m.m_idx = o.m_idx", "LEFT");
      $oDB->join("TF_member_order mo","m.m_idx = mo.m_idx", "LEFT");
      $count_myinfo_row = $oDB->getOne("TF_member_tb m","count(m.m_idx) as count_myinfo");

      return $count_myinfo_row;
    }

    function resume_info(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      //이력서 정보
      $columns = "distinct m.m_idx, group_concat(distinct(mc.duty_name)) as duty_name, group_concat(md.duty_name) as hope_duty,";
      $columns .= "YEAR(CURRENT_TIMESTAMP) - YEAR(m_birthday) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(m_birthday, 5))+1 as m_birthday,";
      $columns .= "local_name, city_name, district_name, m_city_idx, m_district_idx";

      $oDB->where("m.m_idx",$m_idx);
      $oDB->where("mc.duty_name","",'!=');
      $oDB->groupBy("m.m_idx");
      $oDB->join("TF_member_career_tb AS mc", "m.m_idx = mc.m_idx", "LEFT");
      $oDB->join("TF_member_duty AS md", "m.m_idx = md.m_idx", "LEFT");
      $oDB->join("TF_local_tb AS l", "m.m_local_idx = l.local_idx", "LEFT");
      $oDB->join("TF_city_tb AS c", "m.m_city_idx = c.city_idx", "LEFT");
      $oDB->join("TF_district_tb AS d", "m.m_district_idx = d.district_idx", "LEFT");
      $myinfo_row = $oDB->getOne("TF_member_tb AS m",$columns);

      return $myinfo_row;
    }
