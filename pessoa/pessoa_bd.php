<?php
function inserir_pessoa($nome, $email) { 
	$sql = "insert into pessoa (nome, email, coordenador_id) values('" . $nome . "','" . $email . "',".$_SESSION["coordenador_id"].")";
	mysqli_query ( get_conexao (), $sql );
}

function editar_pessoa($id, $nome, $email) {
	
	$sql = "update pessoa set nome = '" . $nome . "', email= '" . $email . "' where id = " . $id." and coordenador_id = " .$_SESSION["coordenador_id"];
	mysqli_query ( get_conexao (), $sql );
	
}

function excluir_pessoa($id) {

	$sql = "delete from pessoa where id = ".$id." and coordenador_id = " .$_SESSION["coordenador_id"];
	mysqli_query ( get_conexao (), $sql );

}

function pesquisar_pessoa_por_id($id) {
	$sql = "select * from pessoa where id = ".$id." and coordenador_id = " .$_SESSION["coordenador_id"];
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

function pesquisar_pessoas() {
	$sql = "select * from pessoa"." where coordenador_id = " .$_SESSION["coordenador_id"];
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$pessoas = array ();
	
	while ( $pessoa = mysqli_fetch_assoc ( $resultado ) ) {
		
		$pessoas [] = $pessoa;
	}
	
	return $pessoas;
}

function get_grupos_pessoa($pessoa_id) {
	
	$sql = "select * from grupo inner join pessoa_grupo";
	$sql .= " on grupo.id = pessoa_grupo.grupo_id where pessoa_grupo.pessoa_id = " . $pessoa_id;
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$grupos = array ();
	
	while ( $grupo	 = mysqli_fetch_assoc ( $resultado ) ) {
	
		$grupos [] = $grupo;
	}
	
	return $grupos;
	
}


?>