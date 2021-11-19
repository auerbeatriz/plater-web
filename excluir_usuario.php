<?php
$response = array();

include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

include_once("authentication.php");

if(!is_null($username) && !is_null($senha)) {
    if(authentication($username, $senha, $con)) {
        $result = pg_query($con, "
        BEGIN;
        DELETE FROM usuario_favorita_receita WHERE fk_usuario_username='$username';
        DELETE FROM usuario WHERE username='$username';
        COMMIT;
        END;");
        if($result) {
            $response['success'] = 1;
        }
        else {
            $response['success'] = 0;
            $response['message'] = "Erro BD: " . pg_last_error($con);
        }
    }
    else {
        $response['success'] = 0;
    }
}
else {
    $response['success'] = 0;
    $response['success'] = "Faltam parâmetros";
}

pg_close($con);
echo json_encode($response);
?>