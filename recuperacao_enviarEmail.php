<?php
//	this function searchs in the database if there is an user account associated with the email given as a parameter
function searchForEmailAccount($email, $con) {
	$query = "SELECT * FROM usuario WHERE email='$email';";
	$result = pg_query($con, $query);
	
	if(pg_fetch_array($result)>0) { return true; }
	else { return false; }
}

//	this function generates a random code and set it up on the database to the user trying to change they password
function generateRecoveryCode($email, $con) {
	$code = rand(1000, 9999);
	//	ENVIA O EMAIL
	$query = "UPDATE usuario SET recovery_code='$code' WHERE email='$email';";
	if(pg_query($con, $query)) { return true; }
	else { return false; }
}

$response = array();

include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

if(isset($_POST['email'])) {
	$email = trim($_POST['email']);
	if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
		if(searchForEmailAccount($email, $con)) {
			if(generateRecoveryCode($email, $con)) {
				$response['success'] = 1;
			}
			else {
				$response['success'] = 0;
				$response['message'] = "Algo deu errado.";
			}
		}
		else {
			$response['success'] = 0;
			$response['message'] = "Email não existe no bando de dados";
		}
	}
	else {
		$response['success'] = 0;
		$response['message'] = "Email inválido";
	}
}
else {
	$response['success'] = 0;
	$response['message'] = "Email não informado";
}

pg_close($con);
echo json_encode($response);
?>