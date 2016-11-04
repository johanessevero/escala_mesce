<?php
function inserir_jornada($hora_inicio, $hora_fim) {
	$sql = "insert into jornada (hora_inicio, hora_fim) values('" . $hora_inicio . "','" . $hora_fim . "')";
	mysqli_query ( get_conexao (), $sql );
}

function editar_jornada($id, $hora_inicio, $hora_fim) {
	
	$sql = "update jornada set hora_inicio = '" . $hora_inicio . "', hora_fim= '" . $hora_fim . "' where id = " . $id;
	mysqli_query ( get_conexao (), $sql );
	
}

function excluir_jornada($id) {

	$sql = "delete from jornada where id = ".$id;
	mysqli_query ( get_conexao (), $sql );

}

function pesquisar_jornada_por_id($id) {
	$sql = "select * from jornada where id = ".$id;
	$resultado = mysqli_query ( get_conexao (), $sql );

	$jornadas = array ();

	while ( $jornada = mysqli_fetch_assoc ( $resultado ) ) {
	
		$jornadas [] = $jornada;
		
	}

	if (count ( $jornadas ) > 0)
		return $jornadas[0];
	else
		return $jornadas;
}

function pesquisar_jornadas() {
	$sql = "select * from jornada";
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$jornadas = array ();
	
	while ( $jornada = mysqli_fetch_assoc ( $resultado ) ) {
		
		$jornadas [] = $jornada;
	}
	
	return $jornadas;
}


?>