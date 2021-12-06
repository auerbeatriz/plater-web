<?php
$response = array();

// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));

include_once("authentication.php");

if(!is_null($email) && !is_null($senha) && isset($_POST['id_receita']) && isset($_POST['username'])) {
    if(authentication($email, $senha, $con)) {
        $id_receita = $_POST['id_receita'];
        $username = trim($_POST['username']);

        $query = "SELECT * FROM usuario_favorita_receita WHERE fk_usuario_username='$username' AND fk_receita_id_receita=$id_receita;";
        $result = pg_query($con, $query);

        if(pg_num_rows($result) > 0) {
            $response['success'] = 1;
            $response['message'] = "Receita favorita";
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