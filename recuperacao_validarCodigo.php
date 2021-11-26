<?php
//	this function compares the code given and the code on the database. If it matches, then the user will be able to change they password and the code on db will be deleted
function verifyRecoveryCode($code, $email, $con) {
	$query = "SELECT * FROM usuario WHERE email='$email' AND recovery_code='$code';";
	$result = pg_query($con, $query);
	if(pg_fetch_array($result)>0) { 
		$query = "UPDATE usuario SET recovery_code='' WHERE email='$email';";
		return (pg_query($con, $query));
	}
	else { return false; }
}

$response = array();

include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

if(isset($_POST['email']) && isset($_POST['code'])) {
	$email = trim($_POST['email']);
	$code = trim($_POST['code']);
	if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
		if(verifyRecoveryCode($code, $email, $con)) {
			$response['success'] = 1;
		}
		else {
			$response['success'] = 0;
			$response['message'] = "Algo deu errado.";
		}
	}
	else {
		$response['success'] = 0;
		$response['message'] = "Email inválido";
	}
}
else {
	$response['success'] = 0;
	$response['message'] = "Faltam parâmetros";	
}

pg_close($con);
echo json_encode($response);

?>