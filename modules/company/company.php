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
        // $output->add('hire_call',$this->hire_call());

        $set_template_file = "company/index.php";

        return $output;
    }

    function service($args){
        global $site_info;
        global $oDB;
        $site_info->layout = "company";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        if($args->document_srl){
            $set_template_file = "company/service.view.php";
        }else {
            $set_template_file = "company/service.list.php";
        }

        $output = new Object();

        return $output;

    }


    function serviceHistory($args){
        global $site_info;
        $site_info->layout = "company";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;
        $set_template_file = "company/service.history.php";

        $output = new Object();
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

        $oDB->where("ps_idx",$service_option[0]);
        $pay_row = $oDB->getOne("TF_pay_service");

        $output->add('pay_row',$pay_row);
        $output->add('discount',array($args->discount));

        $set_template_file = "company/service.payment.php";

        return $output;

    }

    //이력서보기
    function application($args){
        // $args->document_srl 여기로 이력서번호가 들어옴.
        global $set_template_file;
        global $site_info;
        global $add_body_class;
        global $oDB;
        $site_info->layout = "company";

        $add_body_class[] = "shrink";

        $output = new Object();

        if($args->document_srl > 0){
            $set_template_file = "company/application.view.php";
            //여기 array 에는 해당 document_srl 로 조회한 job 정보를 넣으면됨.
            //$output->add('oJob',array());

            //상세이력서보기 select
            $m_idx1 = $args->document_srl;
            $oDB->where("m.m_idx",$m_idx1);
            $oDB->join("TF_member_order mo","m.m_idx = mo.m_idx", "LEFT");
            $oDB->join("TF_salary s","mo.salary_idx = s.salary_idx", "LEFT");
            $app_info_row = $oDB->get("TF_member_tb m");

            //면접제안권있는지 확인&잔여횟수 확인
            $m_idx2 = $_SESSION['LOGGED_INFO'];

            $oDB->where("m_idx",$m_idx2);
            $check_voucher = $oDB->get("TF_member_voucher");

            $output->add('app_info_row',$app_info_row);
            $output->add('check_voucher',$check_voucher);


        }else{
            $set_template_file = "404.html";
            $output->setError(-1);
            $output->setMessage('존재하지 않는 이력서를 호출하였습니다.');
        }
        return $output;
    }

    //공고 및 지원자관리의 목록과 상세보기를 컨트롤
    function job($args){
        global $site_info;
        $site_info->layout = "company";

        global $add_body_class;
        $add_body_class[] = "shrink";

        global $set_template_file;

        //$args->document_srl을 db에서 조회해서 존재하는 글이면 view를 뿌리고 아니면 list를 뿌려주면 됩니다.
        $output = new Object();

        global $oDB;

        $now_date = date("YmdHis");
        $m_idx = $_SESSION['LOGGED_INFO'];

        if($args->document_srl > 0){
          $set_template_file = "company/job.view.php";
          //여기 array 에는 해당 document_srl 로 조회한 job 정보를 넣으면됨.
          //$output->add('oJob',array());
          $h_idx = $args->document_srl;
          $c_idx = $_SESSION['c_idx'];

          $oDB->orderBy("al.seq","DESC");
          $oDB->groupBy("al.m_idx");
          $oDB->where("al.isVisible","Y");
          $oDB->where("h.c_idx",$c_idx);
          $oDB->where("al.h_idx",$h_idx);
          $oDB->join("TF_a_line_self ls","ls.m_idx = al.m_idx","LEFT");
          $oDB->join("TF_hire_tb h","al.h_idx = h.h_idx","LEFT");
          $oDB->join("TF_member_tb m","al.m_idx = m.m_idx","LEFT");
          $oDB->join("TF_member_career_tb AS mc", "m.m_idx = mc.m_idx", "LEFT");
          $application_row = $oDB->get("TF_application_letter al",null,"group_concat(distinct(mc.duty_name)) as duty_name, m.m_idx, m.m_name, m.m_human, m.m_birthday, m.m_phone, m.m_email, al.reg_date, a_line_self");

          $output->add('application_row',$application_row);

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
            $row = $oDB->get("TF_hire_tb h",null,"local_name,city_name,district_name,h.h_idx,h_title,salary_idx,job_salary,count(al.m_idx) AS applicant,TO_DAYS(h.job_end_date )-TO_DAYS(NOW( )) AS job_end_day");

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
            $end_row = $oDB->get("TF_hire_tb h",null,"local_name,city_name,district_name,h.h_idx,h_title,salary_idx,job_salary,count(al.m_idx) AS applicant,TO_DAYS(h.job_end_date )-TO_DAYS(NOW( )) AS job_end_day");

            $output->add('row',$row);
            $output->add('end_row',$end_row);
        }

        return $output;
    }

    function job_register($args){
        global $set_template_file;
        $set_template_file = "company/job.reg.php";

        global $site_info;
        $site_info->layout = "company";

        global $add_body_class;
        $add_body_class[] = "shrink";

        $output = new Object();


        return $output;
    }

    function job_appRegister($args){
        global $set_template_file;
        $set_template_file = "company/job.reg.app.php";

        global $site_info;
        $site_info->layout = "company";

        global $add_body_class;
        $add_body_class[] = "shrink";

        $output = new Object();


        return $output;
    }

    function job_appRegisterComplete($args){
        global $set_template_file;
        $set_template_file = "company/job.reg.complete.php";

        $output = new Object();

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

    function new_member(){
        global $oDB;

        $oDB->where("m_birthday",NULL, 'IS NOT');
        $oDB->where("m_address", NULL, 'IS NOT');
        $oDB->where("m_name", NULL, 'IS NOT');
        $oDB->where("mc.m_idx", NULL, 'IS NOT');
        $oDB->where("m_address",'','!=');
        $oDB->where("m_birthday",'','!=');
        $oDB->where("duty_name",'','!=');
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
          $row = $oDB->get("TF_hire_tb h",null,"local_name,city_name,district_name,h.h_idx,h_title,salary_idx,job_salary,count(al.m_idx) AS applicant,TO_DAYS(h.job_end_date )-TO_DAYS(NOW( )) AS job_end_day");

          return $row;

        }

}
