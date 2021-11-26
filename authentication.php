<?php

$username = NULL;
$senha = NULL;

/* Entenda o codigo - Read more: http://www.linhadecodigo.com.br/artigo/894/seguranca-autenticando-o-php-com-http-authentication-required.aspx#ixzz7BvOSFv7U */
// Método para mod_php (Apache)
if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
    $username = trim($_SERVER['PHP_AUTH_USER']);
    $senha = md5(trim($_SERVER['PHP_AUTH_PW']));
}
// Método para demais servers
elseif(isset( $_SERVER['HTTP_AUTHORIZATION'])) {
    if(preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION'])) {
		list($username, $senha) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
	}
}

function authentication($username, $senha, $con) {
    $query = pg_query($con, "SELECT * FROM usuario WHERE username='$username' AND senha='$senha';");

    if(pg_num_rows($query) > 0){
        return true;
    }
    return false;
}

?>