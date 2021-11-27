<?php

$response = array();

include_once("config.php");
include_once("authentication.php");

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

if(!is_null($email) && !is_null($senha)) {
    if(authentication($email, $senha, $con)) {
        $query = "SELECT * FROM categoria ORDER BY descricao ASC;";
        $result = pg_query($con, $query);

        if(pg_num_rows($result) > 0) {
            while($row = pg_fetch_array($result)) {
                $categoria = array();
                $categoria['id_categoria'] = $row['id_categoria'];
                $categoria['categoria'] = $row['descricao'];

                array_push($response, $categoria);
            }
            $response['success'] = 1;
        }
        else {
            $response['success'] = 0;
            $response['message'] = "Não existem categorias ainda.";
        }
    }
    else {
        $response['success'] = 0;
        $response['message'] = "Autenticação requerida.";
    }
}
else {
    $response['success'] = 0;
    $response['message'] = "Faltam parâmetros";
}

pg_close($con);
echo json_encode($response);
?>