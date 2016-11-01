<?php
$host = '127.0.0.1';
$usuario = "root";
$senha = "root";
$nome_banco = "escala_mesce";
function get_conexao() {
	$conexao = mysqli_connect ( $host, $usuario, $senha, $nome_banco );
	
	if (mysqli_errno ( $conexao )) {
		
		echo "Não foi possível conectar ao banco de dados";
		die ();
	}
	
	return $conexao;
}

?>