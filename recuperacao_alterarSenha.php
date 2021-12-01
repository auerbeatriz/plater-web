<?php

// array for JSON response
$response = array();

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

if(isset($_POST['email']) && isset($_POST['senha'])) {
    $email = trim($_POST['email']);
    $senha = md5(trim($_POST['senha']));
    $result = pg_query($con, "UPDATE usuario SET senha='$senha' WHERE email='$email';");

    if($result) {
        $response['success'] = 1;
        $response['message'] = "Senha alterada com sucesso";
    }
    else {
        $response['success'] = 0;
        $response['message'] = "Error BD: ".pg_last_error($con);
    }
}
else {
    $response['success'] = 0;
    $response['message'] = 'Faltam parâmetros.';
}

pg_close($con);
echo json_encode($response);
?>