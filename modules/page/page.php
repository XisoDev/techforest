<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class pageView{

    function index($args){
        global $set_template_file;
        global $add_body_class;
        global $add_html_header;

        $add_body_class[] = "splash_screen";
        $add_html_header[] = "<link rel=\"stylesheet\" href=\"/oPage/css/splash.css\">";
        $output = new Object();

        $set_template_file = "splash.php";

        return $output;
    }

    function selectType($args){

        global $set_template_file;

        $output = new Object();

        $set_template_file = "home.php";

        return $output;

    }

}