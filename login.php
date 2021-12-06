<?php

// array for JSON response
$response = array();

// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));

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