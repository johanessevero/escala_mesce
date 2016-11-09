<?php
function inserir_jornada($hora_inicio, $hora_fim, $descricao) {
	$sql = "insert into jornada (hora_inicio, hora_fim, descricao, coordenador_id) values('" . $hora_inicio . "','" . $hora_fim . "','". $descricao . "'," . $_SESSION["coordenador_id"] . ")";
	mysqli_query ( get_conexao (), $sql );
}

function editar_jornada($id, $hora_inicio, $hora_fim, $descricao) {
	
	$sql = "update jornada set hora_inicio = '" . $hora_inicio . "', hora_fim= '" . $hora_fim . "', descricao = '".$descricao."' where id = " . $id ." and coordenador_id = " .$_SESSION["coordenador_id"];
	mysqli_query ( get_conexao (), $sql );
	
}

function excluir_jornada($id) {

	$sql = "delete from jornada where id = ".$id ." and coordenador_id = " .$_SESSION["coordenador_id"];
	mysqli_query ( get_conexao (), $sql );

}

function get_jornada_por_id($id) {
	$sql = "select * from jornada where id = ".$id ." and coordenador_id = " .$_SESSION["coordenador_id"];
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

function get_jornadas() {
	$sql = "select * from jornada "." where coordenador_id = " .$_SESSION["coordenador_id"];
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$jornadas = array ();
	
	while ( $jornada = mysqli_fetch_assoc ( $resultado ) ) {
		
		$jornadas [] = $jornada;
	}
	
	return $jornadas;
}

function get_first_jornada($id) {
	$sql = "select * from escala_jornada where jornada_id = ".$id;
	$sql .= " ORDER BY escala_jornada.jornada_id ASC LIMIT 1";
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



?>