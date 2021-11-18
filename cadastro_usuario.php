<?php
 
// array for JSON response
$response = array();

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

// check for required fields
if (isset($_POST['nome']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['senha'])) {
 
	$nome = $_POST['nome'];
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$senha = trim(md5($_POST['senha']));
	
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$verifyUsernameExclusivity = pg_query($con, "SELECT username FROM usuario WHERE username='$username'");
		$verifyEmailExclusivity = pg_query($con, "SELECT email FROM usuario WHERE email='$email'");

		if (pg_num_rows($verifyEmailExclusivity) > 0) {
			$response["success"] = 0;
			$response["error"] = "Já existe um usuário cadastrado para esse email.";
		}
		elseif (pg_num_rows($verifyUsernameExclusivity) > 0) {
			$response["success"] = 0;
			$response["error"] = "Esse username já está em uso.";
		}
		elseif(strlen($_POST['senha']) < 6) {
			$response["success"] = 0;
			$response["error"] = "Utilize uma senha com no mínimo 6 caracteres.";
		}
		else {
			$result = pg_query($con, "INSERT INTO usuario(username, email, nome, senha) VALUES('$username', '$email', '$nome', '$senha')");
		 
			if ($result) {
				$response["success"] = 1;
			}
			else {
				$response["success"] = 0;
				$response["error"] = "Error BD: ".pg_last_error($con);
			}
		}
	}
	else {
		$response["success"] = 0;
		$response["error"] = "Email inválido";
	}
}
else {
    $response["success"] = 0;
	$response["error"] = "Faltam parâmetros.";
}

pg_close($con);
echo json_encode($response);
?>