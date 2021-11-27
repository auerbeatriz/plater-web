<?php

$email = 'biaauer03@gmail.com';
$senha = '123456';

/* Entenda o codigo - Read more: http://www.linhadecodigo.com.br/artigo/894/seguranca-autenticando-o-php-com-http-authentication-required.aspx#ixzz7BvOSFv7U */
// Método para mod_php (Apache)
if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
    $email = trim($_SERVER['PHP_AUTH_USER']);
    $senha = trim($_SERVER['PHP_AUTH_PW']);
}
// Método para demais servers
elseif(isset( $_SERVER['HTTP_AUTHORIZATION'])) {
    if(preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION'])) {
		list($email, $senha) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
	}
}

function authentication($email, $senha, $con) {
    $senha = md5($senha);
    $result = pg_query($con, "SELECT * FROM usuario WHERE email='$email' AND senha='$senha';");

    if(pg_num_rows($result) > 0){
        return true;
    }
    return false;
}

function getUsername($email, $senha, $con) {
    $senha = md5($senha);
    $result = pg_query($con, "SELECT username FROM usuario WHERE email='$email' AND senha='$senha';");
    if(pg_num_rows($result) > 0){
        $row = pg_fetch_array($result);
        return $row['username'];
    }
    else {
        return NULL;
    }
}

?>