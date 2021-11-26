<?php
/* Esse pedao de codigo pesquisa pelos passos de preparo de uma determinada receita
 * É preciso que haja a passagem do parametro id_receita para a consulta
 */

$response = array();

if(isset($_GET['id_receita'])) {
	$id = $_GET['id_receita'];
	
	//	conexao com o db
	include_once("config.php");
	$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");
	
	//	realizando a consulta
	$result = pg_query("
	SELECT id_passo, instrucao, FK_RECEITA_id_receita as id_receita
	FROM passo_preparo
	WHERE fk_RECEITA_id_receita = $id
	ORDER BY numero_sequencia ASC;");
	
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
	pg_close($con);
	
}
else {
	$response["success"] = 0;
	$response["message"] = "Receita não informada";
}
echo json_encode($response);
?>