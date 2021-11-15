<?php
/* Esse pedao de codigo pesquisa pelos ingredientes de uma determinada receita
 * É preciso que haja a passagem do parametro id_receita para a consulta
 */

//	array para armazenar a resposta JSON 
$response = array();

if(isset($_GET['id_receita'])) {
	$id = $_GET['id_receita'];
	
	//	conexao com o db
	include_once("config.php");
	$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");
	
	//	realizando a consulta
	$result = pg_query("
	SELECT quantidade, unidade_medida.unidade_medida, insumo.nome_insumo as insumo
	FROM ingrediente
	INNER JOIN insumo
		ON ingrediente.FK_INSUMO_id_insumo = insumo.id_insumo
	INNER JOIN unidade_medida
		ON ingrediente.FK_UNIDADE_MEDIDA_id_unidade_medida = unidade_medida.id_unidade_medida
	WHERE fk_RECEITA_id_receita = $id
	ORDER BY id_ingrediente ASC;");
	
	//	se houve resposta, crie o array json e envie para a app
	if(pg_num_rows($result) > 0) {
		$response['ingredientes'] = array();
		
		while($row = pg_fetch_array($result)) {
			$ingrediente = array();
			$ingrediente["quantidade"] = $row["quantidade"];
			$ingrediente["unidade_medida"] = $row["unidade_medida"];
			$ingrediente["insumo"] = $row["insumo"];
			array_push($response["ingredientes"], $ingrediente);
		}
		
		// fecha a conexao com o BD
		pg_close($con);
		
		$response["success"] = 1;
		$response["message"] = "Ingredientes carregados com sucesso";
		
		echo json_encode($response);		
	}
	else {
		// fecha a conexao com o BD
		pg_close($con);
		
		$response["success"] = 0;
		$response["message"] = "Receita não encontrada";
		
		echo json_encode($response);
	}
}
else {
	$response["success"] = 0;
	$response["message"] = "Receita não informada";
	
	echo json_encode($response);
}
?>