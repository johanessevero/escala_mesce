<?php
function inserir($nome, $email) {
	$sql = "insert into pessoa (nome, email) values('" . $nome . "','" . $email . "')";
	mysqli_query ( get_conexao (), $sql );
}

function editar($id, $nome, $email) {
	
	$sql = "update pessoa set nome = '" . $nome . "', email= '" . $email . "' where id = " . $id;
	mysqli_query ( get_conexao (), $sql );
	
}

function excluir($id) {

	$sql = "delete from pessoa where id = ".$id;
	mysqli_query ( get_conexao (), $sql );

}

function pesquisar_por_id($id) {
	$sql = "select * from pessoa where id = ".$id;
	$resultado = mysqli_query ( get_conexao (), $sql );

	$pessoas = array ();

	while ( $pessoa = mysqli_fetch_assoc ( $resultado ) ) {
	
		$pessoas [] = $pessoa;
		
	}

	return $pessoas;
}

function pesquisar() {
	$sql = "select * from pessoa";
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$pessoas = array ();
	
	while ( $pessoa = mysqli_fetch_assoc ( $resultado ) ) {
		
		$pessoas [] = $pessoa;
	}
	
	return $pessoas;
}


?>