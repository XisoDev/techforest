<?
    $con=mysql_connect("localhost","wimirgsjsoop","gsjsoop..kno1"); 

    $select = mysql_select_db("wimirgsjsoop",$con);

	mysql_query("set session character_set_connection=utf8;");
	mysql_query("set session character_set_results=utf8;");
	mysql_query("set session character_set_client=utf8;");

?>
