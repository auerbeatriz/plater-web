<?php
$response = array();

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

include_once("authentication.php");

if(!is_null($username) && !is_null($senha) && isset($_POST['opcao']) && isset($_GET['id_receita'])) {
    if(authentication($username, $senha, $con)) {
        $id_receita = $_GET['id_receita'];

        switch($_POST['opcao']) {
            case '1':
                //  favorita a receita
                $result = pg_query($con, "INSERT INTO usuario_favorita_receita VALUES ('$username',$id_receita);");
                if($result) {
                    $response['success'] = 1;
                }
                else {
                    $response['success'] = 0;
                    $response['message'] = "Error BD: " . pg_last_error($con);
                }
                break;
            case '0':
                //  desfavorita a receita
                $result = pg_query($con, "DELETE FROM usuario_favorita_receita WHERE fk_usuario_username='$username' AND fk_receita_id_receita=$id_receita;");
                if($result) {
                    $response['success'] = 1;
                }
                else {
                    $response['success'] = 0;
                    $response['message'] = "Error BD: " . pg_last_error($con);
                }
                break;
        }
    }
    else {
        $response['success'] = 0;
        $response['message'] = "Você não está logado.";
    }
}
else {
    $response['success'] = 0;
    $response['message'] = 'Faltam parâmetros.';
}

pg_close($con);
echo json_encode($response);
?>