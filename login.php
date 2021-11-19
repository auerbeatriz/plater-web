<?php

// array for JSON response
$response = array();

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

include_once("authentication.php");

if(!is_null($username) && !is_null($senha)) {
    if(authentication($username, $senha, $con)) {
        $response["success"] = 1;
        
        // codigo sql da sua consulta
        $response["data"] = "Dados da app";
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