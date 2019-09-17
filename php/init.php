<?
	if($_SERVER['HTTPS'] != "on"){
		header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	}

	$version_defaultJS = date("YmdHis", filemtime('./js/default.js'));
	$version_defaultCSS = date("YmdHis", filemtime('./css/default.css'));

	session_cache_expire(360);
	session_start();
	define("__TITLE__","기술자숲");

	include "db_connect_cfg.php";
	include "cls.proc.php";

	$con = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) OR DIE ("데이터베이스 연결 실패");
	mysql_select_db($DB_NAME, $con);

	mysql_query("set session character_set_connection=utf8;");
	mysql_query("set session character_set_results=utf8;");
	mysql_query("set session character_set_client=utf8;");



	// 쿼리문 배열로 받아오기
	function record_set($sql) {
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
		return $data;
	}

	// 직종 리스트
	function func_occupation() {
		$sql = "SELECT o_idx, o_name, o_is_show FROM TF_occupation WHERE o_is_show = 'Y' ORDER BY o_idx ASC;";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
		return $data;
	}


	// 지역 - 도 리스트
	function func_location() {
		$sql = "SELECT local_idx, local_name FROM TF_local_tb WHERE local_visible = 'Y' ORDER BY local_idx ASC;";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
		return $data;
	}


	// 배너리스트
	$sql = "SELECT seq, title, image, url, start_date, end_date, reg_date, edit_date
			FROM TF_banner
			WHERE start_date <= NOW() AND end_date >= NOW()
			ORDER BY seq DESC;";
	$banner_list = record_set($sql);

	function func_inputString($str) {
		$str = mysql_real_escape_string($str);
		$str = trim($str);
		return $str;
	}


	include "get_traffic.php";
?>
