<?php

function get_conexao() {
	
	$endereco = "127.0.0.1";
	$usuario = "root";
	/**CASA**/
	//$senha = "john";
	/**INEP**/
	$senha = "root";
	$nome_banco = "escala_web";
	
	$conexao = mysqli_connect ( $endereco, $usuario, $senha, $nome_banco );
	
	if (mysqli_errno ( $conexao )) {
		
		echo "<span class = 'notification n-error'>Não foi possível conectar ao banco de dados</span>";
		die ();
	}
	
	return $conexao;
}

?>