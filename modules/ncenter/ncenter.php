<?php
/**
 * Created by PhpStorm.
 * User: xiso
 * Date: 2019-05-10
 * Time: 19:17
 */

class ncenterView
{

    function index($args)
    {
        global $set_template_file;

        $output = new Object();

        $set_template_file = "ncenter/list.php";

        return $output;
    }
}
