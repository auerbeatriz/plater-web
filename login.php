<?php

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

// array for JSON response
$response = array();

$email = NULL;
$senha = NULL;

/* Entenda o codigo - Read more: http://www.linhadecodigo.com.br/artigo/894/seguranca-autenticando-o-php-com-http-authentication-required.aspx#ixzz7BvOSFv7U */
// Método para mod_php (Apache)
if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
    $email = trim($_SERVER['PHP_AUTH_USER']);
    $senha = trim(md5($_SERVER['PHP_AUTH_PW']));
}
// Método para demais servers
elseif(isset( $_SERVER['HTTP_AUTHORIZATION'])) {
    if(preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION'])) {
		list($email, $senha) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
	}
}

// Se a autenticação não foi enviada
if(is_null($email)) {
    $response["success"] = 0;
	$response["error"] = "Email ou senha não informado";
}
// Se houve envio dos dados
else {
    $query = pg_query($con, "SELECT senha FROM usuario WHERE email='$email'");

	if(pg_num_rows($query) > 0){
		$row = pg_fetch_array($query);
		
		if($senha == trim($row["senha"])){
			$response["success"] = 1;
		}
		else {
			// senha ou usuario nao confere
			$response["success"] = 0;
			$response["error"] = "Usuário ou senha incorreto";
		}
	}
	else {
		// senha ou usuario nao confere
		$response["success"] = 0;
		$response["error"] = "Usuário não encontrado";
	}
}

pg_close($con);
echo json_encode($response);
?>