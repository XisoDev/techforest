<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class page_nosView{

    function index($args){
      global $set_template_file;

      global $add_body_class;
      $add_body_class[] = "no_pc_header";
      $add_body_class[] = "no_pc_footer";

      $output = new Object();

      $set_template_file = "home.php";

      return $output;
    }

}
