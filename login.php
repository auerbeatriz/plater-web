<?php

// array for JSON response
$response = array();

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

include_once("authentication.php");

if(!is_null($email) && !is_null($senha)) {
    if(authentication($email, $senha, $con)) {
        $username = getUsername($email, $senha, $con);
        if($username != NULL) {
            $response["success"] = 1;
            $response["username"] = $username;
        }
    }
    else {
        $response["success"] = 0;
        $response["error"] = "Usuário ou senha incorretos.";
    }
}
else {
    $response["success"] = 0;
    $response["error"] = "Email ou senha não informados.";
}

pg_close($con);
echo json_encode($response);
?>