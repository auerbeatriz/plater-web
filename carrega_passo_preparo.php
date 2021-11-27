<?php
/* Esse pedao de codigo pesquisa pelos passos de preparo de uma determinada receita
 * É preciso que haja a passagem do parametro id_receita para a consulta
 */

$response = array();

include_once("authentication.php");
include_once("config.php");

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

if(isset($_GET['id_receita']) && !is_null($email) && !is_null($senha)) {
	if(authentication($email, $senha, $con)) {
		$id = $_GET['id_receita'];
		$query = "SELECT id_passo, instrucao, FK_RECEITA_id_receita as id_receita
		FROM passo_preparo
		WHERE fk_RECEITA_id_receita = $id
		ORDER BY numero_sequencia ASC;";
		$result = pg_query($con, $query);
		
		//	se houve resposta, crie o array json e envie para a app
		if(pg_num_rows($result) > 0) {
			$response['modo_preparo'] = array();
			
			while($row = pg_fetch_array($result)) {
				$passoPreparo = array();
				$passoPreparo["id"] = $row["id_passo"];
				$passoPreparo["instrucao"] = $row["instrucao"];
				array_push($response["modo_preparo"], $passoPreparo);
			}
			
			$response["success"] = 1;	
		}
		else {		
			$response["success"] = 0;
			$response["message"] = "Receita não encontrada";
		}
	}
	else {
		$response["success"] = 0;
		$response["message"] = "Autenticação requerida";
	}
}
else {
	$response["success"] = 0;
	$response["message"] = "Receita não informada";
}

pg_close($con);
echo json_encode($response);
?>