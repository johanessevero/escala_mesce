<?php

function get_conexao() {
	
	$endereco = "127.0.0.1";
	$usuario = "root";
	$senha = "john";
	/*$senha = "root";*/
	$nome_banco = "escala_mesce";
	
	$conexao = mysqli_connect ( $endereco, $usuario, $senha, $nome_banco );
	
	if (mysqli_errno ( $conexao )) {
		
		echo "Não foi possível conectar ao banco de dados";
		die ();
	}
	
	return $conexao;
}

?>