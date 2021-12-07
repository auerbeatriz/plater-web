<?php
//	this function searchs in the database if there is an user account associated with the email given as a parameter
function searchForEmailAccount($email, $con) {
	$query = "SELECT * FROM usuario WHERE email='$email';";
	$result = pg_query($con, $query);
	
	if(pg_num_rows($result)>0) { return true; }
	else { return false; }
}

//	this function generates a random code and set it up on the database to the user trying to change they password
function generateRecoveryCode($email, $con) {
	$code = rand(1000, 9999);
	sendCodeThroughEmail($email, $code);
	$query = "UPDATE usuario SET recovery_code='$code' WHERE email='$email';";
	if(pg_query($con, $query)) { return true; }
	else { return false; }
}

function sendCodeThroughEmail($email, $code) {
	require 'vendor/autoload.php';

	$email = new SendGrid\Mail\Mail();
	$email->setFrom("no-reply@plater.tech", "Team Plater");
	$email->setSubject("Recuperação de senha");
	$email->addTo(
		"$email",
		"Usuário do Plater",
		[
			"code" => "$code"
		],
		0
	);
	$email->setTemplateId("d-fc11f943a4814c4ab0f2b4e2bd223462");
	$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

	try {
		$response = $sendgrid->send($email);
		return $response;
	} catch (Exception $e) {
		echo 'Caught exception: '.  $e->getMessage(). "\n";
	}
}

$response = array();
$con = pg_connect(getenv("DATABASE_URL"));

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