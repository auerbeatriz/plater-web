<?php

// array for JSON response
$response = array();

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

include_once("authentication.php");

if(!is_null($email) && !is_null($senha)) {
    if(authentication($email, $senha, $con)) {
        $userData = getUserData($email, $senha, $con);
        if(count($userData) > 0) {
            $response["username"] = $userData[0];
            $response["nome"] = $userData[1];
            $response["success"] = 1;
        }
    }
    else {
        $response["success"] = 0;
        $response["error"] = "Email ou senha incorretos.";
    }
}
else {
    $response["success"] = 0;
    $response["error"] = "Email ou senha não informados.";
}

pg_close($con);
echo json_encode($response);
?>