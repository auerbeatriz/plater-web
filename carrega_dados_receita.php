<?php
 
/* Esse código retorna os ingredientes e os passos de preparo de uma determinada receita (de acordo com o id_receita passado).
 * Essa e uma requisicao do tipo GET. Os resultados sao obtidos por meio de filtros com o parametro id_receita.
 */
 
// array que guarda a resposta da requisicao
$response = array();
 
//$_GET["id_receita"] = 2;
 
	// Verifica se o parametro id_receita foi enviado na requisicao
	if (isset($_GET["id_receita"])) {
		
		// Aqui sao obtidos os parametros
		$id_receita = $_GET['id_receita'];
		
		// conecao com o db
		include_once("config.php");
		$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");
	 
		// obtem do db os ingredientes e os passos de preparo da receita passada
		$resultIngr = pg_query($con, "SELECT quantidade, unidade_medida.unidade_medida AS unidade_medida, insumo.nome_insumo AS insumo FROM ingrediente
								INNER JOIN insumo
									ON ingrediente.FK_INSUMO_id_insumo = insumo.id_insumo
								INNER JOIN unidade_medida
									ON ingrediente.FK_UNIDADE_MEDIDA_id_unidade_medida = unidade_medida.id_unidade_medida
								WHERE fk_RECEITA_id_receita = $id_receita
								ORDER BY id_ingrediente ASC;");	
	 
		$resultTut = pg_query($con, "SELECT instrucao FROM passo_preparo
									WHERE fk_RECEITA_id_receita = $id_receita
									ORDER BY numero_sequencia ASC;");
			
		//	se houverem ingrendientes e passos cadastrados para a receita informada
		if (pg_num_rows($resultIngr) > 0 && pg_num_rows($resultTut) > 0) {
			$response["ingredientes"] = array();
			$response["tutorial"] = array();
			
			//	aloca os ingredientes dentro da chave "ingredientes" de response
			while ($row = pg_fetch_array($resultIngr)) {
				$ingrediente = array();
				$ingrediente["quantidade"] = $row["quantidade"];
				$ingrediente["unidade_medida"] = $row["unidade_medida"];
				$ingrediente["insumo"] = $row["insumo"];
				
				array_push($response["ingredientes"], $ingrediente);
			}
			
			//	aloca os passos de preparo dentro da chave "tutorial" de response
			while ($row = pg_fetch_array($resultTut)) {
				$passoPreparo = array();
				$passoPreparo["instrucao"] = $row["instrucao"];
				
				array_push($response["tutorial"], $passoPreparo);
			}
			
			$response["success"] = 1;
			$response["message"] = "Ingredientes e tutorial obtidos";
			// fecha a conexao com o BD
			pg_close($con);
	 
			// converte a resposta para o formato JSON.
			echo json_encode($response);
		} else {
			// caso nao retorne dados de alguma tabela
			$response["success"] = 0;
			$response["message"] = "Erro: Nao existem dados para essa receita";
	 
			// Fecha a conexao com o BD
			pg_close($con);
	 
			// Converte a resposta para o formato JSON.
			echo json_encode($response);
		}
	} else {
		/* Se a requisicao foi feita incorretamente, ou seja, os parametros 
		 * nao foram enviados corretamente para o servidor, o cliente 
		 * recebe a chave "success" com valor 0. A chave "message" indica o 
		 * motivo da falha. */
		$response["success"] = 0;
		$response["message"] = "Receita nao informada";
	 
		// Converte a resposta para o formato JSON.
		echo json_encode($response);
	}
?>