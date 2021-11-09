<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['nome']) && isset($_POST['senha'])) {
 
	$username = trim($_POST['username']);
	$email = $_POST['email'];
	$nome = $_POST['nome'];
	$password = trim($_POST['senha']);
		
	$usuario_existe = pg_query($con, "SELECT username FROM usuario WHERE login='$username'");
	// check for empty result
	if (pg_num_rows($usuario_existe) > 0) {
		$response["success"] = 0;
		$response["error"] = "usuario ja cadastrado";
	}
	else {
		// mysql inserting a new row
		$result = pg_query($con, "INSERT INTO usuario(username, email, nome, senha) VALUES('$username', '$email', '$nome', '$password')");
	 
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
	$response["error"] = "faltam parametros";
}

pg_close($con);
echo json_encode($response);
?>