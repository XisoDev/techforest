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
        $output->add('new_hire2',$this->new_hire2());
        $output->add('new_hire3',$this->new_hire3());

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
            $set_template_file = "technician/resume.view.php";

            $m_idx = $args->document_srl;

            //나의 이력서 정보 조회 - 기본정보
            $oDB->orderBy("m.m_idx","ASC");
            $oDB->where("m.m_idx",$m_idx);
            $oDB->join("TF_member_occupation mo","mo.m_idx = m.m_idx","LEFT");
            $oDB->join("TF_district_tb d","m.m_district_idx = d.district_idx","LEFT");
            $oDB->join("TF_city_tb c","m.m_city_idx = c.city_idx","LEFT");
            $oDB->join("TF_local_tb l","m.m_local_idx = l.local_idx","LEFT");
            $my_info1 = $oDB->get("TF_member_tb m",null,"m_name, m_human, m_birthday, m_phone, m_email, m_address, m_address2, m_picture, local_name, city_name, district_name");

            //나의 이력서 정보 조회 - 자기소개
            $oDB->where("m_idx",$m_idx);
            $my_info2 = $oDB->get("TF_member_self_tb",null,"self_introduction");

            //나의 이력서 정보 조회 - 학력
            $oDB->orderBy("e.seq","ASC");
            $oDB->where("m_idx",$m_idx);
            $oDB->join("TF_school s","e.s_idx = s.s_idx","LEFT");
            $my_info3 = $oDB->get("TF_member_education_tb e",null,"school_name, school_major, school_grade, max_grade, school_graduated, is_ged, e.s_idx");

            //나의 이력서 정보 조회 - 경력
            $oDB->orderBy("career_idx","DESC");
            $oDB->orderBy("is_newcommer","ASC");
            $oDB->where("m_idx",$m_idx);
            $my_info4 = $oDB->get("TF_member_career_tb",null,"c_name, c_position, c_content, c_start_date, c_end_date, is_newcommer, career_idx");

            //나의 이력서 정보 조회 - 자격증
            $oDB->orderBy("certificate_idx","DESC");
            $oDB->orderBy("is_certificate","DESC");
            $oDB->where("m_idx",$m_idx);
            $my_info5 = $oDB->get("TF_member_certificate_tb",null,"certificate_name, certificate_date, is_certificate");

            //나의 이력서 정보 조회 - 어학
            $oDB->orderBy("language_idx","DESC");
            $oDB->where("m_idx",$m_idx);
            $my_info6 = $oDB->get("TF_member_language_tb",null,"lc_d_idx, score, language_date");

            //나의 이력서 정보 조회 - 희망급여
            $oDB->where("m_idx",$m_idx);
            $oDB->join("TF_salary s","o.salary_idx = s.salary_idx","LEFT");
            $my_info7 = $oDB->get("TF_member_order o",null,"o.salary_idx, salary_name, desired_salary");

            //나의 이력서 정보 조회 - 희망직종
            $oDB->where("m_idx",$m_idx);
            $oDB->join("TF_occupation oc","mo.o_idx = oc.o_idx","LEFT");
            $my_info8 = $oDB->get("TF_member_occupation mo",null,"o_name");

            //나의 이력서 정보 조회 - 희망직무
            $oDB->where("m_idx",$m_idx);
            $my_info9 = $oDB->get("TF_member_duty",null,"duty_name");

            //한줄자기소개
            $oDB->where("m_idx",$m_idx);
            $my_info10 = $oDB->get("TF_a_line_self",null,"a_line_self");

            $output->add('my_info1',$my_info1);
            $output->add('my_info2',$my_info2);
            $output->add('my_info3',$my_info3);
            $output->add('my_info4',$my_info4);
            $output->add('my_info5',$my_info5);
            $output->add('my_info6',$my_info6);
            $output->add('my_info7',$my_info7);
            $output->add('my_info8',$my_info8);
            $output->add('my_info9',$my_info9);
            $output->add('my_info10',$my_info10);


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

         //나의 이력서 정보 조회 - 자기소개
         $oDB->where("m_idx",$m_idx);
         $self_row = $oDB->get("TF_member_self_tb",null,"self_introduction");

        //나의 이력서 정보 조회 - 학력
        $oDB->orderBy("e.seq","ASC");
        $oDB->where("m_idx",$m_idx);
        $oDB->join("TF_school s","e.s_idx = s.s_idx","LEFT");
        $my_info3 = $oDB->get("TF_member_education_tb e",null,"e.seq, e.s_idx, s_name, school_name, school_major, school_grade, max_grade, school_graduated, is_ged, school_idx");

        //나의 이력서 정보 조회 - 경력
        $oDB->orderBy("seq","ASC");
        $oDB->where("m_idx",$m_idx);
        $my_info4 = $oDB->get("TF_member_career_tb",null,"seq, c_name, c_position, c_content, o_idx, duty_name, c_start_date, c_end_date, is_newcommer, career_idx");

        //나의 이력서 정보 조회 - 자격증
        $oDB->orderBy("seq","ASC");
        $oDB->where("m_idx",$m_idx);
        $my_info5 = $oDB->get("TF_member_certificate_tb",null,"seq, certificate_name, certificate_date, is_certificate, certificate_idx");

        //나의 이력서 정보 조회 - 어학
        $oDB->orderBy("seq","ASC");
        $oDB->where("m_idx",$m_idx);
        $my_info6 = $oDB->get("TF_member_language_tb",null,"seq, lc_idx, lc_d_idx, score, language_date");

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

        //언어리스트
        $oDB->orderBy("lc_idx","ASC");
        $language_arr = $oDB->get("TF_language_cate",null,"lc_idx, lc_name");

        //시험명 리스트
        $oDB->orderBy("lcd.lc_d_idx","ASC");
        $oDB->orderBy("lcd.lc_idx","ASC");
        $oDB->join("TF_language_cate lc","lcd.lc_idx = lc.lc_idx","LEFT");
        $d_language_arr = $oDB->get("TF_language_cate_detail lcd",null,"lcd.lc_d_idx, lcd.lc_idx, lcd.lc_d_name, lc.lc_name");

        $output->add('a_line_row',$a_line_row);
        $output->add('self_row',$self_row);
        $output->add('resume_row',$resume_row);
        $output->add('salary_list',$salary_list);
        $output->add('local_arr',$local_arr);
        $output->add('city_arr',$city_arr);
        $output->add('district_arr',$district_arr);
        $output->add('occupation_arr',$occupation_arr);
        $output->add('duty_arr',$duty_arr);
        $output->add('school_arr',$school_arr);
        $output->add('my_info3',$my_info3);
        $output->add('my_info4',$my_info4);
        $output->add('my_info5',$my_info5);
        $output->add('my_info6',$my_info6);
        $output->add('my_duty',$my_duty);
        $output->add('certificate_row',$certificate_row);
        $output->add('language_arr',$language_arr);
        $output->add('d_language_arr',$d_language_arr);


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

        global $oDB;


        $output = new Object();

        $output->add('interest_rows',$this->interest_hire());

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

    function findJobListAll($args){
        setSEO("일자리 찾기","기술자님께 딱!맞는 일자리와 관심공고를 살펴보세요");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "technician/findjob.listAll.php";

        global $oDB;

        $m_idx = $_SESSION['LOGGED_INFO'];
        $now_date = date(YmdHis);

        $local_idx = $args->local_idx;
        $o_idx = $args->o_idx;

        if(!$local_idx) {
        	$local_idx = -1;
        }

        if($o_idx == 'undefined' || !$o_idx || $o_idx == 1){
        	$o_idx = -1;
        }

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
        //지역 리스트
        $oDB->orderBy("visible_idx","ASC");
        $oDB->where("local_visible","Y");
        $local_list = $oDB->get("TF_local_tb");

        //직종 리스트
        $oDB->where("o_is_show","Y");
        $occupation_list = $oDB->get("TF_occupation",null,"o_idx, o_name");

        $output = new Object();
        $output->add('hire_rows',$hire_rows);
        $output->add('local_list',$local_list);
        $output->add('occupation_list',$occupation_list);
        $output->add('interest_rows',$this->interest_hire());
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

    function m_duty_name(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      $columns = "m.m_idx, mc.duty_name as mc, md.duty_name as md";

      $oDB->where("(mc.duty_name != ? or md.duty_name != ? )",ARRAY('',''));
      $oDB->where("m.m_idx",$m_idx);
      // $oDB->where("h.h_idx",6917,'<=');
      $oDB->join("TF_member_career_tb AS mc","mc.m_idx = m.m_idx","LEFT");
      $oDB->join("TF_member_duty AS md","md.m_idx = m.m_idx","LEFT");

      $row = $oDB->get("TF_member_tb AS m",null,$columns);

      return $row;
    }

    function new_hire(){
        global $oDB;

        $m_idx = $_SESSION['LOGGED_INFO'];
        $member_duty = $this->m_duty_name();
        $m_duty_name = array();

        foreach($member_duty as $val){
          if($val['md'] != '' && $val['mc'] != ''){
            $m_duty_name[] = $val['md'];
            $m_duty_name[] = $val['mc'];
          }else if($val['md'] != ''){
            $m_duty_name[] = $val['md'];
          }else if($val['mc'] != ''){
            $m_duty_name[] = $val['mc'];
          }
        }

        if(count($m_duty_name) == 0){
          $oDB->where("duty_name",'','!=');
        }else{
          $oDB->where("duty_name",$m_duty_name,"IN");
        }
        $oDB->orderBy("rand()");
        $row = $oDB->get("TF_hire_tb h",null,"h.h_idx");

        return $row;
    }

    function new_hire2(){
        global $oDB;

        $columns = "h_idx, c_name, h_title, TO_DAYS( job_end_date ) - TO_DAYS( NOW( ) ) AS hire_end_date, local_name, city_name, district_name, salary_idx, job_salary";

        $now_date = date(YmdHis);
        // $rand_new_member = $this->new_member();
        // $oDB->where(sprintf("(m.m_idx = %s or m.m_idx = %s or m.m_idx = %s or m.m_idx = %s)",$rand_new_member[0]['m_idx'],$rand_new_member[1]['m_idx'],$rand_new_member[2]['m_idx'],$rand_new_member[3]['m_idx']));
        $rand_new_hire = $this->new_hire();
        $h_idxs = array();
        foreach($rand_new_hire as $val) $h_idxs[] = $val['h_idx'];
        $oDB->where("h.h_idx",$h_idxs,"IN");
        $oDB->where("duty_name","",'!=');
        $oDB->where("job_end_date",$now_date,'>');

        $oDB->join("TF_member_commerce_tb AS co", "co.c_idx = h.c_idx", "LEFT");
        $oDB->join("TF_member_tb AS m", "m.m_idx = co.m_idx", "LEFT");
        $oDB->join("TF_local_tb AS l", "h.local_idx = l.local_idx", "LEFT");
        $oDB->join("TF_city_tb AS c", "h.city_idx = c.city_idx", "LEFT");
        $oDB->join("TF_district_tb AS d", "h.district_idx = d.district_idx", "LEFT");
        $row = $oDB->get("TF_hire_tb AS h",null,$columns);

        return $row;
    }

    function new_hire3(){
        global $oDB;

        $columns = "h_idx, c_name, h_title, TO_DAYS( job_end_date ) - TO_DAYS( NOW( ) ) AS hire_end_date, local_name, city_name, district_name, salary_idx, job_salary";

        $now_date = date(YmdHis);

        $oDB->where("job_end_date",$now_date,'>');
        $oDB->orderby("h.h_idx","DESC");
        $oDB->join("TF_member_commerce_tb AS co", "co.c_idx = h.c_idx", "LEFT");
        $oDB->join("TF_member_tb AS m", "m.m_idx = co.m_idx", "LEFT");
        $oDB->join("TF_local_tb AS l", "h.local_idx = l.local_idx", "LEFT");
        $oDB->join("TF_city_tb AS c", "h.city_idx = c.city_idx", "LEFT");
        $oDB->join("TF_district_tb AS d", "h.district_idx = d.district_idx", "LEFT");
        $row = $oDB->get("TF_hire_tb AS h",3,$columns);

        return $row;
    }

    function interest_hire(){
      global $oDB;
      $m_idx = $_SESSION['LOGGED_INFO'];

      //관심공고
      $oDB->orderBy("ic.reg_date","DESC");
      $oDB->where("ic.m_idx",$m_idx);
      $oDB->join("TF_hire_tb h","h.h_idx = ic.h_idx","LEFT");
      $oDB->join("TF_district_tb d","h.district_idx = d.district_idx","LEFT");
      $oDB->join("TF_city_tb c","h.city_idx = c.city_idx","LEFT");
      $oDB->join("TF_local_tb l","h.local_idx = l.local_idx","LEFT");
      $oDB->join("TF_member_commerce_tb mc","mc.c_idx = h.c_idx","LEFT");
      $interest_rows = $oDB->get("TF_interest_career_tb ic");

      return $interest_rows;
    }

  }
