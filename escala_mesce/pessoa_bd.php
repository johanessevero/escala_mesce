<?php
include "init.php";
function incluir($nome, $email) {
	$sql = "insert into pessoa (nome, email) values(" . $nome . "," . $email . ");";
	mysqli_execute ( get_conexao (), $sql );
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