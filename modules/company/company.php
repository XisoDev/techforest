<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class companyView{

    function index($args){
        global $set_template_file;
        global $site_info;
        $site_info->layout = "company";


        $output = new Object();

        $output->add('application_list',$this->getApplicationCompany());
        $output->add('new_member2',$this->new_member2());
        $output->add('now_application',$this->now_application());
        $output->add('hire_ing',$this->hire_ing());
        $output->add('member_notice',$this->member_notice());
        $output->add('hire_end',$this->hire_end());
        $output->add('news_list',$this->news_list());

        $set_template_file = "company/index.php";

        return $output;
    }

    function service($args){
        setSEO("서비스 이용현황","기술자를 쉽게 찾을 수 있는 유료서비스를 이용해보세요.");
        global $site_info;
        global $oDB;
        global $logged_info;
        $site_info->layout = "company";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;

        $output = new Object();
        $output->add('member_notice',$this->member_notice());
        if($args->document_srl){
            $set_template_file = "company/service.view.php";


            $c_idx = $logged_info['c_idx'];
            $m_idx = $_SESSION['LOGGED_INFO'];
            $now_date = date(YmdHis);

            //선택한 유료서비스 조회
            $oDB->where("ps_idx",$args->document_srl);
            $pay_row = $oDB->getOne("TF_pay_service");

            //진행중인 공고 불러오기
            $oDB->where("c_idx",$c_idx);
            $oDB->where("job_end_date",$now_date,">");
            $choose_hire = $oDB->get("TF_hire_tb");

            //공고등록권 구매했는지 확인
            $oDB->where("expire_date",$now_date,">");
            $oDB->where("m_idx",$m_idx);
            $check_voucher = $oDB->get("TF_member_voucher",null,"h_idx");


            $output->add('pay_row',$pay_row);
            $output->add('member_notice',$this->member_notice());
            $output->add('check_voucher',$check_voucher);
            $output->add('choose_hire',$choose_hire);
            $output->add('false_sub_visual',true);
        }else {
            $set_template_file = "company/service.list.php";
        }
        return $output;
    }


    function serviceHistory($args){
        global $site_info;
        global $add_body_class;
        global $set_template_file;
        global $oDB;

        $output = new Object();
        $site_info->layout = "company";
        $add_body_class[] = "shrink";
        $add_body_class[] = "no_mobile_header";

        $set_template_file = "company/service.history.php";

        $m_idx = $_SESSION['LOGGED_INFO'];

        $oDB->where("m_idx",$m_idx);
        $oDB->join("TF_pay_service ps","ps.ps_idx = v.ps_idx","LEFT");
        $voucher_list = $oDB->get("TF_member_voucher v");

        $oDB->where("m_idx",$m_idx);
        $oDB->join("TF_pay_service ps","ps.ps_idx = p.ps_idx","LEFT");
        $payment_list = $oDB->get("TF_payment p");

        $output->add('voucher_list',$voucher_list);
        $output->add('payment_list',$payment_list);
        $output->add('member_notice',$this->member_notice());
        return $output;

    }

    function servicePayment($args){

        global $site_info;
        global $set_template_file;
        global $add_body_class;
        global $oDB;

        $output = new Object();
        $site_info->layout = "company";
        $add_body_class[] = "shrink";
        $service_option = explode(",",$args->service_option);
        $output->add('member_notice',$this->member_notice());
        $set_template_file = "company/service.payment.php";

        return $output;

    }

    //이력서보기
    function application($args){
        setSEO("지원자 상세보기","채용담당자님의 기업에 지원한 기술자를 자세히 살펴보세요");
        // $args->document_srl 여기로 이력서번호가 들어옴.
        global $set_template_file;
        global $site_info;
        global $add_body_class;
        global $oDB;
        $site_info->layout = "company";

        $add_body_class[] = "shrink";

        $output = new Object();
        $output->add('member_notice',$this->member_notice());
        if($args->document_srl > 0){
            $add_body_class[] = "no_mobile_header";
            $set_template_file = "company/application.view.php";
            //여기 array 에는 해당 document_srl 로 조회한 job 정보를 넣으면됨.
            //$output->add('oJob',array());
            $now_date = date("YmdHis");

            //상세이력서보기 select
            $m_idx1 = $args->document_srl;
            $oDB->where("m.m_idx",$m_idx1);
            $oDB->join("TF_a_line_self ls", "ls.m_idx = m.m_idx","LEFT");
            $oDB->join("TF_member_order mo","m.m_idx = mo.m_idx", "LEFT");
            $oDB->join("TF_salary s","mo.salary_idx = s.salary_idx", "LEFT");
            $app_info_row = $oDB->get("TF_member_tb m");

            //상세이력서보기 - 희망직종
            $oDB->where("m_idx",$m_idx1);
            $oDB->join("TF_occupation oc","mo.o_idx = oc.o_idx","LEFT");
            $occupation_row = $oDB->get("TF_member_occupation mo",null,"o_name");

            //상세이력서보기 - 자기소개
            $oDB->where("m_idx",$m_idx1);
            $introduction_row = $oDB->get("TF_member_self_tb",null,"self_introduction");

            //상세이력서보기 - 학력
            $oDB->orderBy("e.seq","ASC");
            $oDB->where("m_idx",$m_idx1);
            $oDB->join("TF_school s","e.s_idx = s.s_idx","LEFT");
            $education_row = $oDB->get("TF_member_education_tb e",null,"school_name, school_major, school_grade, max_grade, school_graduated, is_ged, e.s_idx");

            //상세이력서보기 - 경력
            $oDB->orderBy("career_idx","DESC");
            $oDB->orderBy("is_newcommer","ASC");
            $oDB->where("m_idx",$m_idx1);
            $career_row = $oDB->get("TF_member_career_tb",null,"c_name, c_position, c_content, c_start_date, c_end_date, is_newcommer, career_idx");

            //상세이력서보기 - 자격증
            $oDB->orderBy("certificate_idx","DESC");
            $oDB->orderBy("is_certificate","DESC");
            $oDB->where("m_idx",$m_idx1);
            $certificate_row = $oDB->get("TF_member_certificate_tb",null,"certificate_name, certificate_date, is_certificate");

            //상세이력서보기 - 어학
            $oDB->orderBy("language_idx","DESC");
            $oDB->where("m_idx",$m_idx1);
            $language_row = $oDB->get("TF_member_language_tb",null,"lc_d_idx, score, language_date");

            //상세이력서보기 - 관련서류보기
            $oDB->orderBy("reg_date","DESC");
            $oDB->orderBy("file_type","ASC");
            $oDB->where("m_idx",$m_idx1);
            $file_row = $oDB->get("TF_member_file");

            //공고등록권 구매했는지 확인
            $oDB->where("expire_date",$now_date,">");
            $oDB->where("h_idx",$args->h_idx);
            $check_voucher = $oDB->get("TF_member_voucher",null,"v_idx,m_idx,h_idx,ps_idx,reg_date,expire_date");

            //면접제안한 회원인지 확인
            $oDB->where("applicant_idx",$m_idx1);
            $oDB->where("h_idx",$args->h_idx);
            $check_applicant = $oDB->get("TF_suggest_interview");

            $output->add('app_info_row',$app_info_row);
            $output->add('occupation_row',$occupation_row);
            $output->add('check_voucher',$check_voucher);
            $output->add('check_applicant',$check_applicant);
            $output->add('introduction_row',$introduction_row);
            $output->add('education_row',$education_row);
            $output->add('career_row',$career_row);
            $output->add('certificate_row',$certificate_row);
            $output->add('language_row',$language_row);
            $output->add('file_row',$file_row);
            $output->add('application_m_idx',$m_idx1);


        }else{
            $set_template_file = "404.html";
            $output->setError(-1);
            $output->setMessage('존재하지 않는 이력서를 호출하였습니다.');
        }
        return $output;
    }

    //공고 및 지원자관리의 목록과 상세보기를 컨트롤
    function job($args){
        setSEO("공고·지원자관리","채용담당자님이 등록한 공고 및 지원자를 확인하세요.");
        global $site_info;
        $site_info->layout = "company";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;

        //$args->document_srl을 db에서 조회해서 존재하는 글이면 view를 뿌리고 아니면 list를 뿌려주면 됩니다.
        $output = new Object();
        $output->add('member_notice',$this->member_notice());
        global $oDB;

        $now_date = date("YmdHis");
        $m_idx = $_SESSION['LOGGED_INFO'];

        if($args->document_srl > 0){
          $set_template_file = "company/job.view.php";
          //여기 array 에는 해당 document_srl 로 조회한 job 정보를 넣으면됨.
          //$output->add('oJob',array());
          $h_idx = $args->document_srl;
          $c_idx = $_SESSION['c_idx'];

          //지원자현황
          $oDB->orderBy("al.seq","DESC");
          $oDB->groupBy("al.m_idx");
          $oDB->where("al.isVisible","Y");
          $oDB->where("h.c_idx",$c_idx);
          $oDB->where("al.h_idx",$h_idx);
          $oDB->join("TF_a_line_self ls","ls.m_idx = al.m_idx","LEFT");
          $oDB->join("TF_hire_tb h","al.h_idx = h.h_idx","LEFT");
          $oDB->join("TF_member_tb m","al.m_idx = m.m_idx","LEFT");
          $oDB->join("TF_member_career_tb AS mc", "m.m_idx = mc.m_idx", "LEFT");
          $oDB->join("TF_application_fitness af", "m.m_idx = af.m_idx", "LEFT");
          $application_row = $oDB->get("TF_application_letter al",null,"group_concat(distinct(mc.duty_name)) as duty_name,h.h_idx, m.m_idx, m.m_name, m.m_human, m.m_birthday, m.m_phone, m.m_email, al.reg_date, a_line_self, fitness");

          //면접자현황
          $oDB->where("si.h_idx",$h_idx);
          $oDB->join("TF_hire_tb h","h.h_idx = si.h_idx","LEFT");
          $oDB->join("TF_member_tb m","m.m_idx = si.applicant_idx","LEFT");
          $interview_list = $oDB->get("TF_suggest_interview si",null,"h_title,m.m_name,way,m.m_phone,si.reg_date");

          $output->add('application_row',$application_row);
          $output->add('interview_list',$interview_list);


        }else{
            $set_template_file = "company/job.list.php";
            //date 포맷은 텍스트로 쓰셔요~

            //m_idx없을때
            if(!$m_idx || $m_idx < 1){

            }
            //진행중인 공고리스트
            $oDB->orderby("h.h_idx","DESC");
            $oDB->groupBy("h.h_idx");
            $oDB->where("co.m_idx",$m_idx);
            $oDB->where("h.job_end_date",$now_date,">");
            $oDB->joinwhere("TF_application_letter al","al.isVisible","Y");
            $oDB->join("TF_application_letter al","al.h_idx = h.h_idx","LEFT");
            $oDB->join("TF_district_tb d","d.district_idx = h.district_idx","LEFT");
            $oDB->join("TF_city_tb c","c.city_idx = h.city_idx","LEFT");
            $oDB->join("TF_local_tb l","l.local_idx = h.local_idx","LEFT");
            $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
            $row = $oDB->get("TF_hire_tb h",null,"job_is_career,c_name,local_name,city_name,district_name,h.h_idx,h_title,salary_idx,job_salary,count(al.m_idx) AS applicant,TO_DAYS(h.job_end_date )-TO_DAYS(NOW( )) AS job_end_day");

            //마감된 공고리스트
            $oDB->orderby("h.h_idx","DESC");
            $oDB->groupBy("h.h_idx");
            $oDB->where("co.m_idx",$m_idx);
            $oDB->where("h.job_end_date",$now_date,"<");
            $oDB->joinwhere("TF_application_letter al","al.isVisible","Y");
            $oDB->join("TF_application_letter al","al.h_idx = h.h_idx","LEFT");
            $oDB->join("TF_district_tb d","d.district_idx = h.district_idx","LEFT");
            $oDB->join("TF_city_tb c","c.city_idx = h.city_idx","LEFT");
            $oDB->join("TF_local_tb l","l.local_idx = h.local_idx","LEFT");
            $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
            $end_row = $oDB->get("TF_hire_tb h",null,"job_is_career,c_name,local_name,city_name,district_name,h.h_idx,h_title,salary_idx,job_salary,count(al.m_idx) AS applicant,TO_DAYS(h.job_end_date )-TO_DAYS(NOW( )) AS job_end_day");

            $output->add('row',$row);
            $output->add('end_row',$end_row);
        }

        return $output;
    }

    function hireList($args){
      setSEO("진행중인 공고","진행중인 공고를 확인하세요.");
      global $site_info;
      $site_info->layout = "company";

      global $add_body_class;
      $add_body_class[] = "shrink";

      global $set_template_file;
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];
      $now_date = date("YmdHis");

      $set_template_file = "company/hire.list.php";
      $output = new Object();

      //진행중인 공고리스트
      $oDB->orderby("h.h_idx","DESC");
      $oDB->groupBy("h.h_idx");
      $oDB->where("co.m_idx",$m_idx);
      $oDB->where("h.job_end_date",$now_date,">");
      $oDB->joinwhere("TF_application_letter al","al.isVisible","Y");
      $oDB->join("TF_application_letter al","al.h_idx = h.h_idx","LEFT");
      $oDB->join("TF_district_tb d","d.district_idx = h.district_idx","LEFT");
      $oDB->join("TF_city_tb c","c.city_idx = h.city_idx","LEFT");
      $oDB->join("TF_local_tb l","l.local_idx = h.local_idx","LEFT");
      $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
      $row = $oDB->get("TF_hire_tb h",null,"job_is_career,c_name,local_name,city_name,district_name,h.h_idx,h_title,salary_idx,job_salary,count(al.m_idx) AS applicant,TO_DAYS(h.job_end_date )-TO_DAYS(NOW( )) AS job_end_day");


      $output->add('member_notice',$this->member_notice());
      $output->add('row',$row);

      return $output;
    }

    function hireEndList($args){
      setSEO("마감된 공고","마감된 공고를 확인하세요.");
      global $site_info;
      $site_info->layout = "company";

      global $add_body_class;
      $add_body_class[] = "shrink";

      global $set_template_file;
      global $oDB;

      $m_idx = $_SESSION['LOGGED_INFO'];
      $now_date = date("YmdHis");

      $set_template_file = "company/hire.endlist.php";
      $output = new Object();

      //마감된 공고리스트
      $oDB->orderby("h.h_idx","DESC");
      $oDB->groupBy("h.h_idx");
      $oDB->where("co.m_idx",$m_idx);
      $oDB->where("h.job_end_date",$now_date,"<");
      $oDB->joinwhere("TF_application_letter al","al.isVisible","Y");
      $oDB->join("TF_application_letter al","al.h_idx = h.h_idx","LEFT");
      $oDB->join("TF_district_tb d","d.district_idx = h.district_idx","LEFT");
      $oDB->join("TF_city_tb c","c.city_idx = h.city_idx","LEFT");
      $oDB->join("TF_local_tb l","l.local_idx = h.local_idx","LEFT");
      $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
      $end_row = $oDB->get("TF_hire_tb h",null,"job_is_career,c_name,local_name,city_name,district_name,h.h_idx,h_title,salary_idx,job_salary,count(al.m_idx) AS applicant,TO_DAYS(h.job_end_date )-TO_DAYS(NOW( )) AS job_end_day");


      $output->add('member_notice',$this->member_notice());
      $output->add('end_row',$end_row);

      return $output;
    }

    function job_register($args){
        setSEO("기업정보등록","기업정보등록 하시고 알맞는 기술자를 찾아보세요.");
        global $set_template_file;
        $set_template_file = "company/job.reg.php";

        global $site_info;
        $site_info->layout = "company";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $oDB;
        $output = new Object();

        $m_idx = $_SESSION['LOGGED_INFO'];

        $oDB->where("m_idx",$m_idx);
        $company_info = $oDB->get("TF_member_commerce_tb");

        $output->add('company_info',$company_info);
        $output->add('member_notice',$this->member_notice());
        return $output;
    }

    function job_appRegister($args){
        setSEO("공고등록","공고등록 하시고 알맞는 기술자를 찾아보세요.");
        global $set_template_file;
        $set_template_file = "company/job.reg.app.php";

        global $site_info;
        $site_info->layout = "company";

        global $add_body_class;
        $add_body_class[] = "shrink";

        $output = new Object();

        $output->add('member_notice',$this->member_notice());
        return $output;
    }

    function jobDetail($args){
        setSEO("공고 상세보기","");
        global $site_info;
        $site_info->layout = "company";

        global $logged_info;

        global $set_template_file;
        $set_template_file = "company/job.detail.php";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $oDB;

        $output = new Object();

        $h_idx = $args->document_srl;

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

        //탈퇴한 지원자 카운트
        $oDB->where("m.m_name","IS NULL");
        $oDB->where("al.h_idx",$h_idx);
        $oDB->join("TF_member_tb m","al.m_idx = m.m_idx","LEFT");
        $member_count = $oDB->get("TF_application_letter al",null,"count(*) as cnt");

        $output->add('member_notice',$this->member_notice());
        $output->add('hire_info',$hire_info);
        $output->add('h_certificate',$h_certificate);
        $output->add('$member_count',$member_count);

        return $output;

    }

    function job_appRegisterComplete($args){
        global $set_template_file;
        global $add_body_class;

        $add_body_class[] = "no_pc_header";
        $add_body_class[] = "no_pc_footer";
        $add_body_class[] = "no_mobile_header";
        $set_template_file = "company/job.reg.complete.php";

        $output = new Object();
        $output->add('member_notice',$this->member_notice());
        return $output;
    }


    function getApplicationCompany(){
        global $oDB;

        $oDB->orderBy("al.reg_date","DESC");
        $oDB->join("TF_hire_tb h", "al.h_idx = h.h_idx", "LEFT");
        $oDB->join("TF_member_commerce_tb mc", "h.c_idx = mc.c_idx", "LEFT");
        $row = $oDB->get("TF_application_letter al",3,"al.h_idx,al.reg_date,mc.c_name");

        return $row;
    }

    function h_duty_name(){
      global $oDB;

      $now_date = date(YmdHis);

      $m_idx = $_SESSION['LOGGED_INFO'];

      $oDB->where("co.m_idx",$m_idx);
      $oDB->where("h.job_end_date",$now_date,">");
      // $oDB->where("h.h_idx",6917,'<=');
      $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
      $oDB->groupBy("h.h_idx");

      $row = $oDB->get("TF_hire_tb AS h",null,"h.h_idx, h.o_idx, h.duty_name");

      return $row;
    }

    function new_member(){
        global $oDB;

        $member_duty = $this->h_duty_name();
        $h_duty_name = array();
        foreach($member_duty as $val){
          if($val['duty_name'] == ''){}else{$h_duty_name[] = $val['duty_name'];}
        }
        if(count($h_duty_name) == 0){
          // echo "duty_name 없음";
          $oDB->where("duty_name",'','!=');
        }else{
          // echo "duty_name 있음";
          $oDB->where("duty_name",$h_duty_name,"IN");
        }

        $oDB->where("m_birthday",NULL, 'IS NOT');
        $oDB->where("m_address", NULL, 'IS NOT');
        $oDB->where("m_name", NULL, 'IS NOT');
        $oDB->where("mc.m_idx", NULL, 'IS NOT');
        $oDB->where("m_address",'','!=');
        $oDB->where("m_birthday",'','!=');

        $oDB->where("substr(m_birthday,1,4) != 0000");
        $oDB->where("substr(m_phone,1,3) != 000");
        $oDB->where("substr(m_phone,5,4) != 0000");
        $oDB->orderBy("rand()");
        $oDB->join("TF_member_career_tb mc", "m.m_idx = mc.m_idx", "LEFT");
        $row = $oDB->get("TF_member_tb m",4,"m.m_idx");

        return $row;
    }

    function new_member2(){
        global $oDB;

        $columns = "distinct m.m_idx, group_concat(distinct(mc.duty_name)) as duty_name,";
        $columns .= "concat(concat(substr(m.m_name,1,1),'*'),substr(m.m_name,3,10)) as m_name,";
        $columns .= "YEAR(CURRENT_TIMESTAMP) - YEAR(m_birthday) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(m_birthday, 5))+1 as m_birthday,";
        $columns .= "m_phone, m_address, local_name, city_name, district_name, m_city_idx, m_district_idx";

        // $rand_new_member = $this->new_member();
        // $oDB->where(sprintf("(m.m_idx = %s or m.m_idx = %s or m.m_idx = %s or m.m_idx = %s)",$rand_new_member[0]['m_idx'],$rand_new_member[1]['m_idx'],$rand_new_member[2]['m_idx'],$rand_new_member[3]['m_idx']));
        $rand_new_member = $this->new_member();
        $m_idxs = array();
        foreach($rand_new_member as $val) $m_idxs[] = $val['m_idx'];

        $oDB->where("m.m_idx",$m_idxs,"IN");
        $oDB->where("duty_name","",'!=');
        $oDB->groupBy("m.m_idx");
        $oDB->join("TF_member_career_tb AS mc", "m.m_idx = mc.m_idx", "LEFT");
        $oDB->join("TF_local_tb AS l", "m.m_local_idx = l.local_idx", "LEFT");
        $oDB->join("TF_city_tb AS c", "m.m_city_idx = c.city_idx", "LEFT");
        $oDB->join("TF_district_tb AS d", "m.m_district_idx = d.district_idx", "LEFT");
        $row = $oDB->get("TF_member_tb AS m",null,$columns);

        return $row;
    }

    function  now_application(){
      global $oDB;

      $oDB->orderby("al.reg_date","DESC");
      $oDB->join("TF_hire_tb h","al.h_idx = h.h_idx", "LEFT");
      $oDB->join("TF_member_commerce_tb mc","h.c_idx = mc.c_idx", "LEFT");
      $row = $oDB->get("TF_application_letter al",3,"al.h_idx, al.reg_date, mc.c_name");

      return $row;
    }

    function hire_ing(){
      global $oDB;

      $now_date = date(YmdHis);

      $m_idx = $_SESSION['LOGGED_INFO'];

      $oDB->orderby("h.h_idx","DESC");
      $oDB->groupBy("h.h_idx");
      $oDB->where("co.m_idx",$m_idx);
      $oDB->where("h.job_end_date",$now_date,">");
      $oDB->joinwhere("TF_application_letter al","al.isVisible","Y");
      $oDB->join("TF_application_letter al","al.h_idx = h.h_idx","LEFT");
      $oDB->join("TF_district_tb d","d.district_idx = h.district_idx","LEFT");
      $oDB->join("TF_city_tb c","c.city_idx = h.city_idx","LEFT");
      $oDB->join("TF_local_tb l","l.local_idx = h.local_idx","LEFT");
      $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
      $row = $oDB->get("TF_hire_tb h",null,"c_name,local_name,city_name,district_name,h.h_idx,h_title,salary_idx,job_salary,count(al.m_idx) AS applicant,TO_DAYS(h.job_end_date )-TO_DAYS(NOW( )) AS job_end_day");

      return $row;

    }

    function member_notice(){
      global $oDB;

      $date = date("Y-m-d H:i:s", strtotime("-7 day")); // 어제

      $m_idx = $_SESSION['LOGGED_INFO'];

      $columns = "h_title, mn_idx, mn.m_idx, mn.n_idx, mn.num, n.notice_type, n.division, n.used, ns.agree, mn.reg_date, m_name, mn.read";

      $oDB->where("mn.m_idx",$m_idx);
      $oDB->where("mn.read",0);
      $oDB->where("mn.reg_date",$date,">=");

      $oDB->join("TF_notice AS n", "n.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_notice_setting AS ns", "ns.n_idx = mn.n_idx", "LEFT");
      $oDB->join("TF_hire_tb AS h", "h.h_idx = mn.num", "LEFT");
      $oDB->join("TF_member_tb AS m", "mn.m_idx = m.m_idx", "LEFT");

      $oDB->orderby("mn.reg_date","DESC");

      $row = $oDB->get("TF_member_notice AS mn",null,$columns);

      return $row;

    }

    function hire_end(){
      global $oDB;
      $m_idx = $_SESSION['LOGGED_INFO'];
      $now_date = date(YmdHis);

      //마감된 공고리스트
      $columns = "local_name,city_name,district_name,h.h_idx,h_title,salary_idx,job_end_date,job_salary,count(al.m_idx) AS applicant,TO_DAYS(h.job_end_date )-TO_DAYS(NOW( )) AS job_end_day";

      $oDB->orderby("h.h_idx","DESC");
      $oDB->groupBy("h.h_idx");

      $oDB->where("co.m_idx",$m_idx);
      $oDB->where("h.job_end_date",$now_date,"<");

      $oDB->joinwhere("TF_application_letter al","al.isVisible","Y");
      $oDB->join("TF_application_letter al","al.h_idx = h.h_idx","LEFT");
      $oDB->join("TF_district_tb d","d.district_idx = h.district_idx","LEFT");
      $oDB->join("TF_city_tb c","c.city_idx = h.city_idx","LEFT");
      $oDB->join("TF_local_tb l","l.local_idx = h.local_idx","LEFT");
      $oDB->join("TF_member_commerce_tb co","h.c_idx = co.c_idx","LEFT");
      $row = $oDB->get("TF_hire_tb h",null,$columns);

      return $row;

    }


    function news_list(){
      global $oDB;

      //언론보도자료
      $oDB->orderby("n_date","DESC");
      $news_list = $oDB->get("TF_news_tb");

      return $news_list;
    }


}
