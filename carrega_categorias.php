<?php

$response = array();

include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

$result = pg_query($con, "SELECT * FROM categoria ORDER BY descricao ASC;");
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

pg_close($con);
echo json_encode($response);
?>