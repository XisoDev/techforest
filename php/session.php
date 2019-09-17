<?
	session_cache_expire(1440);
	session_start();
	$m_id				= $_SESSION['m_id'];
	$m_idx				= $_SESSION['m_idx'];
	$is_commerce		= $_SESSION['is_commerce'];
	$auto_login			= $_SESSION['auto_login'];
	$type				= $_SESSION['type'];
	$m_local_idx		= $_SESSION['m_local_idx'];
	$m_city_idx			= $_SESSION['m_city_idx'];
	$m_district_idx		= $_SESSION['m_district_idx'];
	$session_c_idx		= $_SESSION['session_c_idx'];

	// 네이버 토큰
	function generate_state() {
		$mt = microtime();
		$rand = mt_rand();
		return md5($mt . $rand);
	}

	// 상태 토큰으로 사용할 랜덤 문자열을 생성
	$state = generate_state();
	$_SESSION['state']		= $state;
	// 세션 또는 별도의 저장 공간에 상태 토큰을 저장
	//$session->set_state($state);


	//
	// //페이스북 토큰
	// $verify_token = 'YOURVERIFYTOKEN';
	//
  //  if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['hub_mode'])
  //    && $_GET['hub_mode'] == 'subscribe' && isset($_GET['hub_verify_token'])
  //    && $_GET['hub_verify_token'] == $verify_token) {
  //      echo $_GET['hub_challenge'];
  //  } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //    $post_body = file_get_contents('php://input');
  //    $obj = json_decode($post_body, true);
  //    // $ obj는 변경된 필드 목록을 포함합니다.
  //  }

?>
