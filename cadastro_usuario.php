<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['nome']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['senha'])) {
 
	$nome = $_POST['nome'];
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$senha = trim(md5($_POST['senha']));
	
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$usuario_existe = pg_query($con, "SELECT username FROM usuario WHERE username='$username'");
		// check for empty result
		if (pg_num_rows($usuario_existe) > 0) {
			$response["success"] = 0;
			$response["error"] = "Usuário já cadastrado";
		}
		else {
			// mysql inserting a new row
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
	$response["error"] = "faltam parametros";
}

pg_close($con);
echo json_encode($response);
?>