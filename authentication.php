<?php

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

function authentication($email, $senha, $con) {
    $query = pg_query($con, "SELECT * FROM usuario WHERE email='$email' AND senha='$senha';");

    if(pg_num_rows($query) > 0){
        return true;
    }
    return false;
}

?>