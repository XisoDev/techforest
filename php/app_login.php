<?
	include "./init.php";

	$id         = func_inputString($_REQUEST['id']);
	$pw         = func_inputString($_REQUEST['pw']);
	$auto_login = func_inputString($_REQUEST['auto_login']);

	if(!$id){
		echo "
			<meta charset=\"utf-8\" />
			<script>
				try {
					location.replace('../index.html');
				} catch(exception){
					location.href = '../index.html';
				}
			</script>
		";
		exit;

	} else if(!$pw){
		echo "
			<meta charset=\"utf-8\" />
			<script>
				try {
					location.replace('../index.html');
				} catch(exception){
					location.href = '../index.html';
				}
			</script>
		";
		exit;

	} else if(!$auto_login){ // 자동로그인 값이 없을 경우
		$auto_login = "0";
	}

	if($auto_login == "./img/icon_check_on.png") {
		$auto_login = "1";
	} else {
		$auto_login = "0";
	}


	$sql = "SELECT
				m_idx, m_id, is_commerce, m_local_idx, m_city_idx, m_district_idx
			FROM TF_member_tb
			WHERE m_id = '$id' AND m_pw = '$pw' AND is_out = 'N';";
	$res = mysql_query($sql);


	while ($row = mysql_fetch_assoc($res)) {
		$m_idx			= $row['m_idx'];
		$m_id			= $row['m_id'];
		$is_commerce	= $row['is_commerce'];
		$m_local_idx	= $row['m_local_idx'];
		$m_city_idx		= $row['m_city_idx'];
		$m_district_idx	= $row['m_district_idx'];
	}



	if($is_commerce == "N") {
		if($m_idx) {
			$_SESSION['m_id']				= $m_id;
			$_SESSION['m_idx']				= $m_idx;
			$_SESSION['is_commerce']		= $is_commerce;
			$_SESSION['auto_login']			= $auto_login;
			$_SESSION['type']				= 0;
			$_SESSION['m_local_idx']		= $m_local_idx;
			$_SESSION['m_city_idx']			= $m_city_idx;
			$_SESSION['m_district_idx']		= $m_district_idx;

			echo "
				<meta charset=\"utf-8\" />
				<script>
					try {
						location.replace('../index.html');
					} catch(exception){
						location.href = '../index.html';
					}
				</script>
			";
			exit;

		} else {
			echo "
				<meta charset=\"utf-8\" />
				<script>
					try {
						location.replace('../index.html');
					} catch(exception){
						location.href = '../index.html';
					}
				</script>
			";
			exit;
		}
	} else if($is_commerce == "Y") {
		if($m_idx) {
			$_SESSION['m_id']				= $m_id;
			$_SESSION['m_idx']				= $m_idx;
			$_SESSION['is_commerce']		= $is_commerce;
			$_SESSION['auto_login']			= $auto_login;
			$_SESSION['type']				= 1;
			$_SESSION['m_local_idx']		= $m_local_idx;
			$_SESSION['m_city_idx']			= $m_city_idx;
			$_SESSION['m_district_idx']		= $m_district_idx;

			$sql = "SELECT c_idx FROM TF_member_commerce_tb WHERE m_idx = $m_idx;";
			$res = mysql_query($sql);

			while ($row = mysql_fetch_assoc($res)) {
				$c_idx			= $row['c_idx'];
			}

			if($c_idx) {
				$_SESSION['session_c_idx']		= $c_idx;
			}



			echo "
				<meta charset=\"utf-8\" />
				<script>
					try {
						location.replace('../index.html');
					} catch(exception){
						location.href = '../index.html';
					}
				</script>
			";
			exit;
		} else {
			echo "
				<meta charset=\"utf-8\" />
				<script>
					try {
						location.replace('../index.html');
					} catch(exception){
						location.href = '../index.html';
					}
				</script>
			";
			exit;
		}
	} else {
		echo "
			<meta charset=\"utf-8\" />
			<script>
				try {
					location.replace('../index.html');
				} catch(exception){
					location.href = '../index.html';
				}
			</script>
		";
		exit;
	}

?>
