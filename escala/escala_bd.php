<?php
function inserir_escala($escala) {
	$sql = "insert into escala (data_inicio, data_fim, descricao, grupo_id, coordenador_id)";
	$sql .= " values ('" . $escala ["data_inicio"] . "','";
	$sql .= $escala ["data_fim"] . "','" . $escala ["descricao"] . "'," . $escala ["grupo_id"] . "," . $_SESSION ["coordenador_id"] . ")";
	
	return mysqli_query ( get_conexao (), $sql );
}
function excluir_escala($id) {
	$sql = "delete from pessoa_escala where escala_id = " . $id;
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	if ($resultado) {
		$sql_1 = "delete from escala_jornada where escala_id = " . $id;
		$resultado = mysqli_query ( get_conexao (), $sql_1 );
		if ($resultado) {
			$sql_2 = "delete from escala where id = " . $id;
			$resultado = mysqli_query ( get_conexao (), $sql_2 );
		}
	}
	
	return $resultado;
}
function editar_escala($escala) {
	$sql = "update escala set descricao = '" . $escala ["descricao"] . "', data_inicio = '" . $escala ["data_inicio"] . "', data_fim = '" . $escala ["data_fim"] . "', grupo_id = " . $escala ["grupo_id"] . " where id = " . $escala ["id"] . " and coordenador_id = " . $_SESSION ["coordenador_id"];
	
	return mysqli_query ( get_conexao (), $sql );
}
function inserir_jornada_escala($escala_id, $jornada_id, $dia, $mes, $ano) {
	$sql = "insert into escala_jornada";
	$sql .= "(escala_id, jornada_id, dia, mes, ano)";
	$sql .= " values (" . $escala_id . "," . $jornada_id . "," . $dia . "," . $mes . "," . $ano . ")";
	
	return mysqli_query ( get_conexao (), $sql );
}
function inserir_pessoa_escala_jornada($pessoa_id, $escala_id, $jornada_id, $dia, $mes, $ano) {
	$sql = "insert into pessoa_escala (pessoa_id, escala_id, jornada_id, dia, mes, ano)";
	$sql .= " values (";
	$sql .= $pessoa_id;
	$sql .= " ," . $escala_id;
	$sql .= " ," . $jornada_id;
	$sql .= " ," . $dia;
	$sql .= " ," . $mes;
	$sql .= " ," . $ano . ")";
	
	return mysqli_query ( get_conexao (), $sql );
}
function excluir_pessoa_escala_jornada($pessoa_id, $escala_id, $jornada_id, $dia, $mes, $ano) {
	$sql = "delete from pessoa_escala";
	$sql .= " where pessoa_escala.escala_id = " . $escala_id;
	$sql .= " and pessoa_escala.pessoa_id = " . $pessoa_id;
	$sql .= " and pessoa_escala.jornada_id = " . $jornada_id;
	$sql .= " and pessoa_escala.dia = " . $dia;
	$sql .= " and pessoa_escala.mes = " . $mes;
	$sql .= " and pessoa_escala.ano = " . $ano;
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	return mysqli_query ( get_conexao (), $sql );
}
function excluir_jornada_escala($escala_id, $jornada_id, $dia, $mes, $ano) {
	$sql = "delete from escala_jornada";
	$sql .= " where ";
	$sql .= "escala_id = " . $escala_id . " and jornada_id = " . $jornada_id . " and dia = " . $dia . " and mes = " . $mes . " and ano = " . $ano;
	
	return mysqli_query ( get_conexao (), $sql );
}
function get_escalas() {
	$sql = "select * from escala where coordenador_id = " . $_SESSION ["coordenador_id"];
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$escalas = array ();
	
	while ( $escala = mysqli_fetch_assoc ( $resultado ) ) {
		
		$escalas [] = $escala;
	}
	
	return $escalas;
}
function get_escala_por_id($id) {
	$sql = "select * from escala where id = " . $id . " and coordenador_id = " . $_SESSION ["coordenador_id"];
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	
	$escalas = array ();
	
	while ( $escala = mysqli_fetch_assoc ( $resultado ) ) {
		
		$escalas [] = $escala;
	}
	
	return $escalas [0];
}
function get_escala_jornada($escala_id, $jornada_id, $dia, $mes, $ano) {
	$sql = "select * from jornada inner join escala_jornada";
	$sql .= " on jornada.id = escala_jornada.jornada_id";
	$sql .= " where escala_jornada.escala_id = " . $escala_id;
	$sql .= " and escala_jornada.jornada_id = " . $jornada_id;
	$sql .= " and escala_jornada.dia = " . $dia;
	$sql .= " and escala_jornada.mes = " . $mes;
	$sql .= " and escala_jornada.ano = " . $ano;
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	$escalas = array ();
	
	while ( $escala = mysqli_fetch_assoc ( $resultado ) ) {
		
		$escalas [] = $escala;
	}
	
	if (count ( $escalas ) > 0)
		return $escalas [0];
	else
		return $escalas;
}
function get_jornadas_escala($escala_id, $dia, $mes, $ano) {
	$sql = "select * from jornada inner join escala_jornada";
	$sql .= " on jornada.id = escala_jornada.jornada_id";
	$sql .= " where escala_jornada.escala_id = " . $escala_id;
	$sql .= " and escala_jornada.dia = " . $dia;
	$sql .= " and escala_jornada.mes = " . $mes;
	$sql .= " and escala_jornada.ano = " . $ano;
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	$escalas = array ();
	
	while ( $escala = mysqli_fetch_assoc ( $resultado ) ) {
		
		$escalas [] = $escala;
	}
	
	return $escalas;
}
function get_pessoa_escala_jornada($pessoa_id, $escala_id, $jornada_id, $dia, $mes, $ano) {
	$sql = "select * from pessoa inner join pessoa_escala";
	$sql .= " on pessoa.id = pessoa_escala.pessoa_id";
	$sql .= " where pessoa_escala.escala_id = " . $escala_id;
	$sql .= " and pessoa_escala.pessoa_id = " . $pessoa_id;
	$sql .= " and pessoa_escala.jornada_id = " . $jornada_id;
	$sql .= " and pessoa_escala.dia = " . $dia;
	$sql .= " and pessoa_escala.mes = " . $mes;
	$sql .= " and pessoa_escala.ano = " . $ano;
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	$pessoas = array ();
	
	while ( $pessoa = mysqli_fetch_assoc ( $resultado ) ) {
		
		$pessoas [] = $pessoa;
	}
	
	if (count ( $pessoas ) > 0)
		return $pessoas [0];
	else
		return $pessoas;
}
function get_pessoas_escala_jornada($escala_id, $jornada_id, $dia, $mes, $ano) {
	$sql = "select * from pessoa inner join pessoa_escala";
	$sql .= " on pessoa.id = pessoa_escala.pessoa_id";
	$sql .= " where pessoa_escala.escala_id = " . $escala_id;
	$sql .= " and pessoa_escala.jornada_id = " . $jornada_id;
	$sql .= " and pessoa_escala.dia = " . $dia;
	$sql .= " and pessoa_escala.mes = " . $mes;
	$sql .= " and pessoa_escala.ano = " . $ano;
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	$pessoas = array ();
	
	while ( $pessoa = mysqli_fetch_assoc ( $resultado ) ) {
		
		$pessoas [] = $pessoa;
	}
	
	return $pessoas;
}
function get_first_escala_pessoa($escala_id) {
	$sql = "select * from pessoa inner join pessoa_escala";
	$sql .= " on pessoa.id = pessoa_escala.pessoa_id";
	$sql .= " where pessoa_escala.escala_id = " . $escala_id;
	$sql .= " ORDER BY pessoa_escala.escala_id ASC LIMIT 1";
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	$pessoas = array ();
	
	while ( $pessoa = mysqli_fetch_assoc ( $resultado ) ) {
		
		$pessoas [] = $pessoa;
	}
	
	if (count ( $pessoas ) > 0)
		return $pessoas [0];
	else
		return $pessoas;
}
function get_first_escala_jornada($escala_id) {
	$sql = "select * from jornada inner join escala_jornada";
	$sql .= " on jornada.id = escala_jornada.jornada_id";
	$sql .= " where escala_jornada.escala_id = " . $escala_id;
	$sql .= " ORDER BY escala_jornada.escala_id ASC LIMIT 1";
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	$escalas = array ();
	
	while ( $escala = mysqli_fetch_assoc ( $resultado ) ) {
		
		$escalas [] = $escala;
	}
	
	if (count ( $escalas ) > 0)
		return $escalas [0];
	else
		return $escalas;
}
function get_first_pessoa_jornada($escala_id, $jornada_id, $dia, $mes, $ano) {
	$sql = "select * from pessoa inner join pessoa_escala";
	$sql .= " on pessoa.id = pessoa_escala.pessoa_id";
	$sql .= " where pessoa_escala.escala_id = " . $escala_id;
	$sql .= " and pessoa_escala.jornada_id = " . $jornada_id;
	$sql .= " and pessoa_escala.dia = " . $dia;
	$sql .= " and pessoa_escala.mes = " . $mes;
	$sql .= " and pessoa_escala.ano = " . $ano;
	$sql .= " ORDER BY pessoa_escala.jornada_id ASC LIMIT 1";
	
	$resultado = mysqli_query ( get_conexao (), $sql );
	$pessoas = array ();
	
	while ( $pessoa = mysqli_fetch_assoc ( $resultado ) ) {
		
		$pessoas [] = $pessoa;
	}
	
	if (count ( $pessoas ) > 0)
		return $pessoas [0];
	else
		return $pessoas;
}

?>
