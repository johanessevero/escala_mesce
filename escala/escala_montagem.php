	<?php
	include "../template/header.php";
	include "escala_bd.php";
	include "../pessoa/pessoa_bd.php";
	include "../jornada/jornada_bd.php";
	
	inserir_jornada_escala_dia ();
	excluir_jornada_escala_dia ();
	monta_html_form_config_escala_mes ();
	
	?>


<?php
function inserir_jornada_escala_dia() {
	if (! empty ( $_POST ["adicionar_jornada"] )) {
		
		if (! inserir_jornada_escala ( $_POST ["escala_id"], $_POST ["jornada_id"], $_POST ["dia"], $_POST ["mes"], $_POST ["ano"] )) {
			echo "<span class = 'notification n-error'>Não foi possível adicionar a jornada.</span>";
		} else
			echo "<span class = 'notification n-success'>Jornada adicionada.</span>";
	}
}
function excluir_jornada_escala_dia() {
	if (! empty ( $_POST ["excluir_jornada"] )) {
		
		if (count ( get_first_pessoa_jornada ( $_POST ["escala_id"], $_POST ["jornada_id"], $_POST ["dia"], $_POST ["mes"], $_POST ["ano"] ) ) == 0) {
			if (! excluir_jornada_escala ( $_POST ["escala_id"], $_POST ["jornada_id"], $_POST ["dia"], $_POST ["mes"], $_POST ["ano"] )) {
				echo "<span class = 'notification n-error'>Não foi possível remover a jornada.</span>";
			} else
				echo "<span class = 'notification n-success'>Jornada removida.</span>";
		} else {
			echo "<span class = 'notification n-error'>Não foi possível remover a jornada pois existem pessoas associadas a essa jornada.</span>";
		}
	}
}
function monta_html_form_config_escala_mes() {
	$cont_semana = 0;
	
	$escala = get_escala_por_id ( $_POST ["escala_id"] );
	
	$data_inicio = explode ( "/", get_data ( $escala ["data_inicio"] ) );
	$data_fim = explode ( "/", get_data ( $escala ["data_fim"] ) );
	
	echo "<form method = 'post'>";
	echo "<h2>Informações da escala </h2>";
	echo "<table id='rounded-corner'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th colspan='4'>" . date ( "d/m/Y", mktime ( 0, 0, 0, $data_inicio [1], $data_inicio [0], $data_inicio [2] ) );
	echo " até " . date ( "d/m/Y", mktime ( 0, 0, 0, $data_fim [1], $data_fim [0], $data_fim [2] ) ) . "</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tfoot>";
	echo "</tfoot>";
	echo "<tbody>";
	
	for($i = date ( "d", mktime ( 0, 0, 0, $data_inicio [1], $data_inicio [0], $data_inicio [2] ) ); $i <= date ( "d", mktime ( 0, 0, 0, $data_fim [1], $data_fim [0], $data_fim [2] ) ); ++ $i) {
		
		if (strcmp ( date ( "D", mktime ( 0, 0, 0, $data_inicio [1], $i, $data_inicio [2] ) ), "Sun" ) == 0) {
			echo "<tr><th>" . ++ $cont_semana . "ª semana/Dia do mês</th><th>Dia da semana</th><th>Horários</th></tr>";
		}
		
		if ($i % 2 == 0)
			echo "<tr class='odd'>";
		else
			echo "<tr class='even'>";
		
		echo "<td>" . date ( "d", mktime ( 0, 0, 0, $data_inicio [1], $i, $data_inicio [2] ) ) . "</td>";
		echo "<td>" . date ( "D", mktime ( 0, 0, 0, $data_inicio [1], $i, $data_inicio [2] ) ) . "</td>";
		monta_html_horarios ( $escala ["id"], $i, $data_inicio [1], $data_inicio [2], $escala ["grupo_id"] );
		echo "</tr>";
	}
	
	echo "<tbody>";
	echo "</table>";
	
	echo "</form>";
}
function monta_html_horarios($escala_id, $dia, $mes, $ano, $grupo_id) {
	$class_linha = "";
	$jornadas = get_jornadas ();
	
	echo "<td>";
	
	echo "<table class = 'escolha_horario'>";
	echo "<tr>";
	
	$cont = 1;
	foreach ( $jornadas as $jornada ) {
		
		echo "<td><b>" . $jornada ["hora_inicio"] . "-" . $jornada ["hora_fim"] . " " . $jornada ["descricao"] . "</b></td>";
		echo "<td><form method = 'post'>";
		if (! empty ( get_escala_jornada ( $escala_id, $jornada ["id"], $dia, $mes, $ano ) )) {
			
			echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/minus-circle.gif);repeat-x:no-repeat;width:20px;height:20px;cursor:pointer;' title = 'clique para remover a jornada da escala'/>";
			echo "<input type='hidden' name='excluir_jornada' value='1' />";
		} else {
			echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/tick-circle.gif);repeat-x:no-repeat;width:20px;height:20px;cursor:pointer;' title = 'clique para adicionar a jornada na escala'/>";
			
			echo "<input type='hidden' name='adicionar_jornada' value='1' />";
		}
		echo "<input type='hidden' name='escala_id' value='" . $escala_id . "' />";
		echo "<input type='hidden' name='jornada_id' value='" . $jornada ["id"] . "' />";
		echo "<input type='hidden' name='dia' value='" . $dia . "' />";
		echo "<input type='hidden' name='mes' value='" . $mes . "' />";
		echo "<input type='hidden' name='ano' value='" . $ano . "' />";
		echo "</form></td>";
		echo "<td>" . "<form action = 'escala_pessoa_jornada.php' method = 'post'>";
		echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/people.png);repeat-x:no-repeat;width:34px;height:34px;cursor:pointer;' title = 'clique para adicionar/remover pessoas à jornada'/>";
		echo "<input type='hidden' name='escala_id' value='" . $escala_id . "' />";
		echo "<input type='hidden' name='jornada_id' value='" . $jornada ["id"] . "' />";
		echo "<input type='hidden' name='dia' value='" . $dia . "' />";
		echo "<input type='hidden' name='mes' value='" . $mes . "' />";
		echo "<input type='hidden' name='ano' value='" . $ano . "' />";
		echo "<input type='hidden' name='grupo_id' value='" . $grupo_id . "' />";
		echo "</form>" . "</td>";
		
		if ($cont % 3 == 0) {
			echo "</tr><tr>";
		}
		
		$cont ++;
	}
	
	echo "</table>";
	
	echo "</td>";
}
function monta_html_select_quant_pessoas($horario, $dia) {
	$pessoas = get_pessoas ();
	
	echo "<select class = 'form_select_1' name = 'quantidade_dia_" . $dia . "_horario_" . $horario . "' title = 'selecione a quantidade de pessoas para esse horário'>";
	for($i = 1; $i <= count ( $pessoas ); ++ $i) {
		
		echo "<option value = '" . $i . "'>" . $i . "</option>";
	}
	
	echo "</select>";
}

include "../template/footer.php";
?>
				