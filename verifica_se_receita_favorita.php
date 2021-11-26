<?php
$response = array();

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

include_once("authentication.php");

if(!is_null($username) && !is_null($senha) && isset($_POST['id_receita'])) {
    if(authentication($username, $senha, $con)) {
        $id_receita = $_POST['id_receita'];

        $result = pg_query($con, "
        SELECT * FROM usuario_favorita_receita WHERE fk_usuario_username='$username' AND fk_receita_id_receita=$id_receita;
        ");
        if(pg_num_rows($result) > 0) {
            $response['success'] = 1;
        }
        else {
            $response['success'] = 0;
            $response['message'] = "nao favorito";
        }
    }
    else {
        $response['success'] = 0;
        $response['message'] = "usuario incorreto";
    }
}
else {
    $response['success'] = 0;
    $response['message'] = "faltam parametros";
}

pg_close($con);
echo json_encode($response);
?>