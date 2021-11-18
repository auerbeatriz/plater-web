<?php

// array for JSON response
$response = array();

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

include_once("authentication.php");

if(!is_null($email) && !is_null($senha) && isset($_POST['opcao']) && isset($_POST['valor']) && isset($_POST['username'])) {
    if(authentication($email, $senha, $con)) {
        $username = $_POST['username'];
        switch($_POST['opcao']) {
            case 'nome':
                $nome = $_POST['valor'];
                $result = pg_query($con, "UPDATE usuario SET nome='$nome' WHERE username='$username';");
                if($result) {
                    $response['success'] = 1;
                    $response['message'] = "Nome alterado com sucesso";
                }
                else {
                    $response['success'] = 0;
                    $response['message'] = "Error BD: ".pg_last_error($con);
                }
                break;
            case 'email':
                $email = trim($_POST['valor']);
                $verifyEmailExclusivity = pg_query($con, "SELECT email FROM usuario WHERE email='$email'");
                if (pg_num_rows($verifyEmailExclusivity) > 0) {
                    $response["success"] = 0;
                    $response["error"] = "Email em uso por outro usuário no momento.";
                }
                elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $response['success'] = 0;
                    $response['message'] = "Email inválido";
                }
                else {
                    $result = pg_query($con, "UPDATE usuario SET email='$email' WHERE username='$username';");
                    if($result) {
                        $response['success'] = 1;
                        $response['message'] = "Email alterado com sucesso";
                    }
                    else {
                        $response['success'] = 0;
                        $response['message'] = "Error BD: ".pg_last_error($con);
                    }
                }
                break;
            case 'senha':
                $senha = trim($_POST['valor']);
                $senha = md5($senha);
                
                $result = pg_query($con, "UPDATE usuario SET senha='$senha' WHERE username='$username';");
                if($result) {
                    $response['success'] = 1;
                    $response['message'] = "Senha alterada com sucesso";
                }
                else {
                    $response['success'] = 0;
                    $response['message'] = "Error BD: ".pg_last_error($con);
                }
                break;
            default:
            $response['success'] = 0;
            $response['message'] = "Opção não informada";
        }
    }
    else {
        $response['success'] = 0;
        $response['message'] = 'É preciso estar logado para alterar os dados.';
    }
}
else {
    $response['success'] = 0;
    $response['message'] = 'Faltam parâmetros.';
}

pg_close($con);
echo json_encode($response);
?>