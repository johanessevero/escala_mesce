<?php
function inserir_grupo($nome) {
	$sql = "insert into grupo (nome, coordenador_id) values('" . $nome . "', ".$_SESSION["coordenador_id"].")";
	mysqli_query ( get_conexao (), $sql );
}

function inserir_pessoa_grupo($pessoa_id, $grupo_id) {
	$sql = "insert into pessoa_grupo (pessoa_id, grupo_id) values(" . $pessoa_id . ", " . $grupo_id . ")";
	mysqli_query ( get_conexao (), $sql );
}


function editar_grupo($id, $nome) {
	$sql = "update grupo set nome = '" . $nome . "' where id = " . $id ." and coordenador_id = ".$_SESSION["coordenador_id"];
	mysqli_query ( get_conexao (), $sql );
}
function excluir_pessoas_grupo($id) {
	
	$sql = "DELETE FROM pessoa_grupo ";
	$sql .= "WHERE pessoa_grupo.grupo_id = ". $id;
	
	mysqli_query( get_conexao (), $sql );
	
	
}

function excluir_pessoa_grupo($pessoa_id, $grupo_id) {
	$sql = "delete from pessoa_grupo where pessoa_id = " . $pessoa_id . " and " . $grupo_id;
	mysqli_query ( get_conexao (), $sql );
}

function excluir_grupo($id) {
	
	$sql = "DELETE FROM grupo";
	$sql .= " WHERE grupo.id = ".$id." and coordenador_id = " .$_SESSION["coordenador_id"];
	
	mysqli_query( get_conexao (), $sql );
	
}

function get_grupo_por_id($id) {
	$sql = "select * from grupo where id = " . $id . " and coordenador_id = " . $_SESSION["coordenador_id"];
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$grupos = array ();
	
	while ( $grupo = mysqli_fetch_assoc ( $resultado ) ) {
		
		$grupos [] = $grupo;
	}
	
	return $grupos [0];
}
function get_grupos() {
	$sql = "select * from grupo " . "where coordenador_id = " . $_SESSION["coordenador_id"];
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$grupos = array ();
	
	while ( $grupo = mysqli_fetch_assoc ( $resultado ) ) {
		
		$grupos [] = $grupo;
	}
	
	return $grupos;
}

function get_num_pessoas_grupo($grupo_id) {
	$sql = "select count(*) as num_pessoas from pessoa_grupo where grupo_id = " . $grupo_id;
	$resultado = mysqli_query ( get_conexao (), $sql );
	$num_pessoas = mysqli_fetch_assoc ( $resultado );
	
	return $num_pessoas ["num_pessoas"];
}
function get_pessoa_grupo($pessoa_id, $grupo_id) {
	$sql = "select * from pessoa inner join pessoa_grupo";
	$sql .= " on pessoa.id = pessoa_grupo.pessoa_id where pessoa_grupo.grupo_id = " . $grupo_id;
	$sql .= " and pessoa_grupo.pessoa_id = " . $pessoa_id;
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	$pessoas = array ();
	
	while ( $pessoa = mysqli_fetch_assoc ( $resultado ) ) {
		
		$pessoas [] = $pessoa;
	}
	
	if (count ( $pessoas ) > 0)
		return $pessoas[0];
	else
		return $pessoas;
}
function get_pessoas_grupo($grupo_id) {
	$sql = "select * from pessoa inner join pessoa_grupo";
	$sql .= " on pessoa.id = pessoa_grupo.pessoa_id where pessoa_grupo.grupo_id = " . $grupo_id;
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$pessoas = array ();
	
	while ( $pessoa = mysqli_fetch_assoc ( $resultado ) ) {
		
		$pessoas [] = $pessoa;
	}
	
	return $pessoas;
}

?>