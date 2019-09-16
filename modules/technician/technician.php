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
        global $logged_info;

        $site_info->layout = "technician";

        $output = new Object();



        $output->add('new_hire2',$this->new_hire2());
        $output->add('new_hire3',$this->new_hire3());

        $output->add('myinfo_row',$this->resume_info());
        $output->add('now_application',$this->now_application());
        $output->add('count_career_row',$this->resume_completeness1());
        $output->add('count_c_content_row',$this->resume_completeness2());
        $output->add('count_myinfo_row',$this->resume_completeness3());
        $output->add('rt_row',$this->recommend_technician_check());
        $output->add('member_notice',$this->member_notice());
        $output->add('news_list',$this->news_list());
        $output->add('all_hire_row',$this->all_hire_count());
        $set_template_file = "technician/index.php";

        return $output;
    }

    function resume($args){
        setSEO("이력서 등록","상세한 이력서로 면접기회를 높여보세요.");
        global $site_info;
        global $add_body_class;
        global $set_template_file;
        global $oDB;

        $output = new Object();
        $output->add('member_notice',$this->member_notice());
        if($args->document_srl) {
            $site_info->layout = "none";
            $add_body_class[] = "no_mobile_header";
            $add_body_class[] = "no_pc_header";
            $add_body_class[] = "no_pc_footer";
            $set_template_file = "technician/resume.view.php";

            $m_idx = $args->document_srl;

            $resume_columns = "concat(concat(substr(m.m_name,1,1),'*'),substr(m.m_name,3,10)) as hidden_m_name,";
            $resume_columns .= "YEAR(CURRENT_TIMESTAMP) - YEAR(m_birthday) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(m_birthday, 5))+1 as m_age,";
            $resume_columns .= "m.m_idx,m_name, m_human, m_birthday, m_phone, m_email, m_address, m_address2, m_picture, local_name, city_name, district_name";


            //나의 이력서 정보 조회 - 기본정보
            $oDB->orderBy("m.m_idx","ASC");
            $oDB->where("m.m_idx",$m_idx);
            $oDB->join("TF_member_occupation mo","mo.m_idx = m.m_idx","LEFT");
            $oDB->join("TF_district_tb d","m.m_district_idx = d.district_idx","LEFT");
            $oDB->join("TF_city_tb c","m.m_city_idx = c.city_idx","LEFT");
            $oDB->join("TF_local_tb l","m.m_local_idx = l.local_idx","LEFT");
            $my_info1 = $oDB->get("TF_member_tb m",null,$resume_columns);

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
            $output->add('suggestion_join_hire',$this->suggestion_join_hire());

        }else{
            $site_info->layout = "technician";
            $add_body_class[] = "shrink";
            $add_body_class[] = "no_mobile_header";
            $set_template_file = "technician/resume.list.php";

            $output->add('myinfo_row',$this->resume_info());
            $output->add('file_list',$this->file_list());
            $output->add('count_career_row',$this->resume_completeness1());
            $output->add('count_c_content_row',$this->resume_completeness2());
            $output->add('count_myinfo_row',$this->resume_completeness3());
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
        $add_body_class[] = "no_mobile_header";
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

        //나의 이력서 정보 조회 - 희망급여
        $oDB->where("m_idx",$m_idx);
        $member_order_row = $oDB->get("TF_member_order",null,"m_idx,salary_idx,desired_salary");

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
        $output->add('member_order_row',$member_order_row);
        $output->add('file_list',$this->file_list());
        $output->add('member_notice',$this->member_notice());
        $output->add('duty_list',$this->duty_list());
        $output->add('occupation_list',$this->occupation_list());

        return $output;
    }

    function findJob($args){
        setSEO("일자리 찾기","맞춤일자리뿐 아니라 전체일자리를 확인해보세요.");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";
        $add_body_class[] = "no_mobile_header";

        global $set_template_file;
        $set_template_file = "technician/findjob.php";

        global $oDB;


        $output = new Object();

        $output->add('application_letter',$this->application_letter());
        $output->add('member_notice',$this->member_notice());
        $output->add('interest_rows',$this->interest_hire());
        $output->add('duty_list',$this->duty_list());
        $output->add('occupation_list',$this->occupation_list());
        $output->add('local_list',$this->local_list());
        $output->add('hire_rows',$this->customized_hire());

        return $output;
    }


    function findJobList($args){
        setSEO("일자리 찾기","맞춤일자리뿐 아니라 전체일자리를 확인해보세요.");
        global $site_info;

        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";
        $add_body_class[] = "no_mobile_header";

        global $set_template_file;
        $set_template_file = "technician/findjob.list.php";



      //   //이력서 미입력 확인
      //   if($member_resume[0]['count'] > 0){
      //     if($member_info[0]['s_idx'] > 0) {$career_n =1; }
      //     else if(!empty($member_info[0]['self_introduction'])) {$career_n =1; }
      //     else if($member_info[0]['language'] > 0) {$career_n =1; }
      //   }else {
      //     $career_n =0;
      //   }

      $output = new Object();


      $output->add('interest_rows',$this->interest_hire());
      $output->add('member_notice',$this->member_notice());
      $output->add('duty_list',$this->duty_list());
      $output->add('occupation_list',$this->occupation_list());
      $output->add('local_list',$this->local_list());
      $output->add('hire_rows',$this->customized_hire());

      return $output;
    }

    function findJobListAll($args){
        setSEO("일자리 찾기","맞춤일자리뿐 아니라 전체일자리를 확인해보세요.");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";
        $add_body_class[] = "no_mobile_header";

        global $set_template_file;
        $set_template_file = "technician/findjob.listAll.php";

        global $oDB;

        $m_idx = $_SESSION['LOGGED_INFO'];
        $now_date = date(YmdHis);

        $local_idx = $args->local_idx;
        $o_idx = $args->o_idx;
        $short_term = $args->short;
        $duty = $args->duty_name;

        if(!$local_idx) {
        	$local_idx = -1;
        }

        if($o_idx == 'undefined' || !$o_idx || $o_idx == 1){
        	$o_idx = -1;
        }

        if(!$short_term) {
          $short_term = -1;
        }

        if(!$duty || $duty == '전체'){
          $duty = -1;
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
        if($duty != -1){
          $oDB->where("h.duty_name","$duty");
        }
        if($short_term > 0){
          $oDB->where("h_title","[단기]%","like");
        }
        $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
        $oDB->join("TF_local_tb l","h.local_idx = l.local_idx","LEFT");
        $oDB->join("TF_city_tb c","h.city_idx = c.city_idx","LEFT");
        $oDB->join("TF_district_tb d","h.district_idx = d.district_idx","LEFT");
        $oDB->join("TF_hire_certificate hce","hce.h_idx = h.h_idx","LEFT");
        $hire_rows = $oDB->get("TF_hire_tb h",null,"c_name, h_title, local_name, city_name, district_name,
                                                  h.local_idx, h.city_idx, h.district_idx, job_achievement,
                                                  salary_idx, job_salary, job_is_career, h.h_idx, h.o_idx, h.duty_name");

        $output = new Object();
        $output->add('hire_rows',$hire_rows);
        $output->add('interest_rows',$this->interest_hire());
        $output->add('member_notice',$this->member_notice());
        $output->add('duty_list',$this->duty_list());
        $output->add('occupation_list',$this->occupation_list());
        $output->add('local_list',$this->local_list());

        return $output;
    }


    function magazine($args){
        global $oDB;
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";
        $add_body_class[] = "no_mobile_header";

        $output = new Object();

        global $set_template_file;
        if($args->document_srl){
            // setSEO("글제목 넣으셔요","작성자, 날짜같은거 넣으면 좋음");
            // //또는
            // setSEO("취업정보","글제목 넣으셔요");
            // $set_template_file = "technician/magazine.view.php";
        }else {
            setSEO("취업정보","다양한 취업정보를 한눈에 확인하세요.");
            $set_template_file = "technician/magazine.list.php";

            $oDB->orderby("reg_date","DESC");
            $oDB->where("is_show","Y");
            $magazine_list = $oDB->get("TF_magazine_tb",null,"category,title,link,image,reg_date");

        }
        $output->add('magazine_list',$magazine_list);
        $output->add('member_notice',$this->member_notice());
        return $output;

    }


    function service($args){
        setSEO("유료 서비스 안내","기술자숲의 상품을 만나보세요.");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";
        $add_body_class[] = "no_mobile_header";

        global $set_template_file;

        $output = new Object();
        $output->add('member_notice',$this->member_notice());
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
        $add_body_class[] = "no_mobile_header";

        global $set_template_file;
        $set_template_file = "technician/service.history.php";

        $output = new Object();
        $output->add('member_notice',$this->member_notice());
        return $output;

    }

    function interest_list($args){
        setSEO("관심공고","");
        global $site_info;
        $site_info->layout = "technician";

        global $add_body_class;
        $add_body_class[] = "shrink";
        $add_body_class[] = "no_mobile_header";

        global $set_template_file;
        $set_template_file = "technician/interest.list.php";

        $output = new Object();
        $output->add('interest_rows',$this->interest_hire());
        $output->add('member_notice',$this->member_notice());
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
      $count_myinfo_row = $oDB->get("TF_member_tb m",null,"count(m.m_idx) as count_myinfo");

      return $count_myinfo_row;
    }

    function resume_info(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      //이력서 정보
      $columns_info = "group_concat(distinct(mc.duty_name)) as duty_name, group_concat(distinct(md.duty_name)) as hope_duty,";
      $columns_info .= "YEAR(CURRENT_TIMESTAMP) - YEAR(m_birthday) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(m_birthday, 5))+1 as m_birthday,";
      $columns_info .= "local_name, city_name, district_name,m_local_idx, m_city_idx, m_district_idx,m.edit_date";

      $oDB->groupBy("m.m_idx");
      $oDB->where("m.m_idx",$m_idx);
      $oDB->Where("mc.duty_name","","!=");
      $oDB->join("TF_member_career_tb mc", "m.m_idx = mc.m_idx", "LEFT");
      $oDB->join("TF_member_duty md", "m.m_idx = md.m_idx", "LEFT");
      $oDB->join("TF_local_tb l", "m.m_local_idx = l.local_idx", "LEFT");
      $oDB->join("TF_city_tb c", "m.m_city_idx = c.city_idx", "LEFT");
      $oDB->join("TF_district_tb d", "m.m_district_idx = d.district_idx", "LEFT");
      $myinfo_row = $oDB->get("TF_member_tb m",null,$columns_info);

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

    function recommend_technician_check(){
      global $oDB;
      $m_idx = $_SESSION['LOGGED_INFO'];

      $oDB->where("m_idx",$m_idx);
      $rt_row = $oDB->get("TF_recommend_technician");

      return $rt_row;

    }

    function suggestion_join_hire(){
      global $oDB;
      global $logged_info;

      $c_idx = $logged_info['c_idx'];
      $now_date = date(YmdHis);
      //
      //진행중인 공고 불러오기
      $oDB->where("c_idx",$c_idx);
      $oDB->where("job_end_date",$now_date,">");
      $suggestion_join_hire = $oDB->get("TF_hire_tb");

      return $suggestion_join_hire;
    }


    function member_notice(){
      global $oDB;

      $date = date("Y-m-d H:i:s", strtotime("-7 day")); // 어제

      $m_idx = $_SESSION['LOGGED_INFO'];

      $columns = "DISTINCT h_title, mn_idx, mn.m_idx, mn.n_idx, mn.num, n.notice_type, n.division, n.used, ns.agree, mn.reg_date, m_name, mn.read";

      $oDB->where("mn.m_idx",$m_idx);
      $oDB->where("ns.m_idx",$m_idx);
      $oDB->where("mn.read",0);
      $oDB->where("ns.agree",'Y');
      $oDB->where("mn.reg_date",$date,">=");

      $oDB->join("TF_notice AS n", "n.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_notice_setting AS ns", "ns.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_hire_tb AS h", "h.h_idx = mn.num", "LEFT");
      $oDB->join("TF_member_tb AS m", "mn.m_idx = m.m_idx", "LEFT");

      $oDB->orderby("mn.reg_date","DESC");

      $row = $oDB->get("TF_member_notice AS mn",null,$columns);

      return $row;

    }

    function jobDetail($args){

        setSEO("공고 상세보기","");
        $now_date = date(YmdHis);
        global $site_info;
        $site_info->layout = "technician";

        global $logged_info;

        global $set_template_file;
        $set_template_file = "technician/job.detail.php";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $oDB;

        $output = new Object();

        $h_idx = $args->document_srl;
        $m_idx = $_SESSION['LOGGED_INFO'];

        $columns = "h.h_idx, h.c_idx, h.o_idx, h.duty_name, ifnull(nullif(o.o_name, ''), '-') AS hire_o_name,";
        $columns .= "h.w_idx, w.w_name, h.salary_idx, s.salary_name, ifnull(nullif(h.h_title, ''), '-') AS h_title,";
        $columns .= "ifnull(nullif(h.job_description, ''), '-') AS job_description,";
        $columns .= "ifnull(nullif(h.job_salary, ''), '-') AS job_salary,";
        $columns .= "ifnull(nullif(h.job_achievement, ''), '-') AS job_achievement,";
        $columns .= "ifnull(nullif(h.job_is_career, ''), '-') AS job_is_career,";
        $columns .= "ifnull(nullif(h.job_manager, ''), '-') AS job_manager,";
        $columns .= "h.job_start_date, h.job_end_date, h.local_idx, l.local_name, h.city_idx,";
        $columns .= "city.city_name, h.district_idx, d.district_name, h.hire_is_show, h.is_my_near,";
        $columns .= "h.represent_hire_check, h.job_idx, h.reg_date, h.edit_date, h.vip,c.c_name, c.c_introduction, c.registration,";
        $columns .= "c.select1, c.select2, c.select3, c.select4,c.phonenumber, c.address, c.address2,c.select5, c.select6, c.select7,";
        $columns .= "c.homepage, c.image, c.reg_date, c.edit_date, c.is_grade,c.m_idx,";
        $columns .= "(SELECT COUNT(*) FROM TF_application_letter al WHERE al.h_idx = $h_idx AND isVisible = 'Y') AS letter_count";

        $oDB->where("h.h_idx",$h_idx);
        $oDB->join("TF_member_commerce_tb c","h.c_idx = c.c_idx","LEFT");
        $oDB->join("TF_occupation o","h.o_idx = o.o_idx","LEFT");
        $oDB->join("TF_work w","h.w_idx = w.w_idx","LEFT");
        $oDB->join("TF_salary s","h.salary_idx = s.salary_idx","LEFT");
        $oDB->join("TF_local_tb l","h.local_idx = l.local_idx","LEFT");
        $oDB->join("TF_city_tb city","h.city_idx = city.city_idx","LEFT");
        $oDB->join("TF_district_tb d","h.district_idx = d.district_idx","LEFT");
        $hire_info = $oDB->get("TF_hire_tb h",null,$columns);

        //기업 필요자격증 조회
        $oDB->where("h_idx",$h_idx);
        $h_certificate = $oDB->get("TF_hire_certificate",null,"certificate_name");

        //다음공고
        $oDB->where("job_end_date",$now_date,'>');
        $oDB->where("h_idx",$h_idx,'>');
        $oDB->where("hire_is_show",'Y');
        $N_hire = $oDB->get("TF_hire_tb AS h",1,'h_idx');


        //이전공고
        $oDB->where("job_end_date",$now_date,'>');
        $oDB->where("h_idx",$h_idx,'<');
        $oDB->where("hire_is_show",'Y');
        $B_hire = $oDB->get("TF_hire_tb AS h",1,'h_idx');

        //탈퇴한 지원자 카운트
        $oDB->where("m.m_name","IS NULL");
        $oDB->where("al.h_idx",$h_idx);
        $oDB->join("TF_member_tb m","al.m_idx = m.m_idx","LEFT");
        $member_count = $oDB->get("TF_application_letter al",null,"count(*) as cnt");

        //관심공고 조회
        $oDB->where("h_idx",$h_idx);
        $oDB->where("m_idx",$m_idx);
        $interest = $oDB->get("TF_interest_career_tb");

        $output->add('h_idx',$h_idx);
        $output->add('N_hire',$N_hire);
        $output->add('B_hire',$B_hire);
        $output->add('interest',$interest);
        $output->add('member_notice',$this->member_notice());
        $output->add('hire_info',$hire_info);
        $output->add('h_certificate',$h_certificate);
        $output->add('member_count',$member_count);

        return $output;

    }

    function duty_list(){
      global $oDB;

      //직종 리스트
      $oDB->orderBy("duty_name","ASC");
      $oDB->orderBy("visible_idx","ASC");
      $oDB->orderBy("o_idx","ASC");
      $duty_list = $oDB->get("TF_duty");

      return $duty_list;
    }

    function occupation_list(){
      global $oDB;

      //직무 리스트
      $oDB->where("o_is_show","Y");
      $occupation_list = $oDB->get("TF_occupation",null,"o_idx, o_name");

      return $occupation_list;
    }

    function local_list(){
      global $oDB;

      //지역 리스트
      $oDB->orderBy("visible_idx","ASC");
      $oDB->where("local_visible","Y");
      $local_list = $oDB->get("TF_local_tb");

      return $local_list;
    }

    function customized_hire(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];
      $now_date = date(YmdHis);

      $oDB->orderby("s_idx","DESC");
      $oDB->where("m.m_idx",$m_idx);
      $oDB->join("TF_member_occupation oc","m.m_idx = oc.m_idx","LEFT");
      $oDB->join("TF_member_language_tb la","m.m_idx = la.m_idx","LEFT");
      $oDB->join("TF_member_career_tb ca","m.m_idx = ca.m_idx","LEFT");
      $oDB->join("TF_member_self_tb self","m.m_idx = self.m_idx","LEFT");
      $oDB->join("TF_member_order ord","m.m_idx = ord.m_idx","LEFT");
      $oDB->join("TF_member_education_tb ed","m.m_idx = ed.m_idx","LEFT");
      $member_info = $oDB->get("TF_member_tb m",null,"m_local_idx, m_city_idx, m_district_idx, s_idx, salary_idx, desired_salary,
                                ifnull(self_introduction, NULL) AS self_introduction, la.seq AS language, oc.o_idx");

      $oDB->where("m_idx",$m_idx);
      $member_certificate = $oDB->get("TF_member_certificate_tb",null,"certificate_name");

      // $member_certificate_array = array();
      // while($row = mysql_fetch_assoc($member_certificate)){
      //   array_push($member_certificate_array, "'".$row['certificate_name']."'");
      // }
      //   array_push($member_certificate_array, "''");

      // 희망급여
      switch ($member_info[0]['salary_idx']) {
        case '1': $salary_y = $member_info[0]['desired_salary'] * 10000; break;
        case '2':	$salary_y = $member_info[0]['desired_salary'] * 10000 * 12; break;
        case '4':	$salary_y = $member_info[0]['desired_salary'] * 209 * 12; break;
        default: $salary_y = 0; break;
      }

      $oDB->where("m_idx",$m_idx);
      $member_resume = $oDB->get("TF_member_career_tb",null,"m_idx, count(*) AS count");


      //$oDB->groupby("h.h_idx");
      $oDB->orderby("vip","DESC");
      $oDB->orderby("h.h_idx","DESC");

      //$oDB->where("certificate_name","IS NULL");
      // $oDB->orwhere("certificate_name", implode(',',$member_certificate_array), "IN");

      if($member_info[0]['m_local_idx'] != -1){
        $oDB->where("h.local_idx",$member_info[0]['m_local_idx']);
      }

      //학력
      switch ($member_info[0]['s_idx']) {
        case '1': $oDB->where("job_achievement",Array('무관', '학력무관', '고졸'), "IN"); break;
        case '2': $oDB->where("job_achievement",Array('무관', '학력무관', '고졸', '초대졸'), "IN"); break;
        case '3': $oDB->where("job_achievement",Array('무관', '학력무관', '고졸', '초대졸','대졸'), "IN"); break;
        case '4': $oDB->where("job_achievement",Array('무관', '학력무관', '고졸', '초대졸','대졸','석사'), "IN"); break;
        case '5': $oDB->where("job_achievement",Array('무관', '학력무관', '고졸', '초대졸','대졸','석사','박사'), "IN"); break;
        default: break;
      }

      // 희망직종
      switch ($member_info[0]['o_idx']) {
        case '1':break;
        case '3': $oDB->where("h.o_idx","3"); break;
        case '4': $oDB->where("h.o_idx","4"); break;
        case '5': $oDB->where("h.o_idx","5"); break;
        default:break;
      }

      $oDB->where("CASE
                  WHEN salary_idx = 1 THEN job_salary * 10000
                  WHEN salary_idx = 2 THEN job_salary * 12 * 10000
                  WHEN salary_idx = 4 THEN job_salary * 209 * 12
                  ELSE 0
                  END",$salary_y,">=");
      $oDB->where("hire_is_show","Y");
      $oDB->where("job_end_date",$now_date,">=");
      $oDB->join("TF_hire_certificate hce","hce.h_idx = h.h_idx","LEFT");
      $oDB->join("TF_district_tb d","h.district_idx = d.district_idx","LEFT");
      $oDB->join("TF_city_tb c","h.city_idx = c.city_idx","LEFT");
      $oDB->join("TF_local_tb l","h.local_idx = l.local_idx","LEFT");
      $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");

      $hire_rows = $oDB->get("TF_hire_tb h",null,"co.image, c_name, h_title, local_name, city_name, district_name,
                              h.local_idx, h.city_idx, h.district_idx, job_achievement,
                              salary_idx, job_salary, job_is_career, h.h_idx, h.o_idx,vip");


      return $hire_rows;
    }

    //입사지원 현황
    function application_letter(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      $oDB->where("al.m_idx",$m_idx);
      $oDB->join("TF_hire_tb h","al.h_idx = h.h_idx","LEFT");
      $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
      $oDB->join("TF_local_tb l","h.local_idx = l.local_idx","LEFT");
      $oDB->join("TF_city_tb c","h.city_idx = c.city_idx","LEFT");
      $oDB->join("TF_district_tb d","h.district_idx = d.district_idx","LEFT");
      $application_letter = $oDB->get("TF_application_letter al",3,"c_name, h_title, local_name, city_name, district_name,
                                      salary_idx, job_salary, job_is_career, al.h_idx, al.isChecked, al.check_date");
      return $application_letter;
    }

    function applicationList(){
      setSEO("입사지원현황","");
      global $site_info;
      $site_info->layout = "technician";

      global $add_body_class;
      $add_body_class[] = "shrink";
      $add_body_class[] = "no_mobile_header";

      global $set_template_file;
      $set_template_file = "technician/application.list.php";

      global $oDB;

      $output = new Object();

      $output->add('interest_rows',$this->interest_hire());
      $output->add('application_letter',$this->application_letter());
      $output->add('member_notice',$this->member_notice());

      return $output;
    }

    function file_list(){
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];

      //파일 리스트
      $oDB->orderBy("reg_date","DESC");
      $oDB->orderBy("file_type","ASC");
      $oDB->where("m_idx",$m_idx);
      $file_list = $oDB->get("TF_member_file");

      return $file_list;
    }

    function news_list(){
      global $oDB;

      //언론보도자료
      $oDB->orderby("n_date","DESC");
      $news_list = $oDB->get("TF_news_tb");

      return $news_list;
    }

    function all_hire_count(){
      global $oDB;

      $row = $oDB->get("TF_hire_tb",null,"count(h_idx) as count_hire");

      return $row;
    }

  }
