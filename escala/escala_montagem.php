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
	if (! empty ( $_GET ["adicionar_jornada"] )) {
		
		if (! inserir_jornada_escala ( $_GET ["escala_id"], $_GET ["jornada_id"], $_GET ["dia"], $_GET ["mes"], $_GET ["ano"] )) {
			echo "<span class = 'notification n-error'>Não foi possível adicionar a jornada.</span>";
		} else
			echo "<span class = 'notification n-success'>Jornada adicionada.</span>";
	}
}
function excluir_jornada_escala_dia() {
	if (! empty ( $_GET ["excluir_jornada"] )) {
		
		if (count ( get_first_pessoa_jornada ( $_GET ["escala_id"], $_GET ["jornada_id"], $_GET ["dia"], $_GET ["mes"], $_GET ["ano"] ) ) == 0) {
			if (! excluir_jornada_escala ( $_GET ["escala_id"], $_GET ["jornada_id"], $_GET ["dia"], $_GET ["mes"], $_GET ["ano"] )) {
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
	
	$escala = get_escala_por_id ( $_GET ["escala_id"] );
	
	$data_inicio = explode ( "/", get_data ( $escala ["data_inicio"] ) );
	$data_fim = explode ( "/", get_data ( $escala ["data_fim"] ) );
	
	echo "<form method = 'GET'>";
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
		
		echo "<td><b>" . $jornada ["hora_inicio"] . (strcmp($jornada ["hora_fim"], "00:00:00") == 0 ? "" : " - " . $jornada ["hora_fim"]) . " " . $jornada ["descricao"] . "</b></td>";
		echo "<td>";
		$link = "<a href = 'escala_montagem.php?escala_id=" . $escala_id;
		$link .= "&jornada_id=" . $jornada ["id"];
		$link .= "&dia=" . $dia;
		$link .= "&mes=" . $mes;
		$link .= "&ano=" . $ano;
		if (! empty ( get_escala_jornada ( $escala_id, $jornada ["id"], $dia, $mes, $ano ) )) {
			
			$link .= "&escala_montagem.php?&excluir_jornada=1'><img src = '../resources/img/minus-circle.gif'></a>";
		} else {
			$link .= "&escala_montagem.php?&adicionar_jornada=1'><img src = '../resources/img/tick-circle.gif'></a>";
		}
		echo $link;
		echo "</td>";
		echo "<td>";
		$link = "";
		$link = "<a href = 'escala_pessoa_jornada.php?escala_id=" . $escala_id;
		$link .= "&jornada_id=" . $jornada ["id"];
		$link .= "&dia=" . $dia;
		$link .= "&mes=" . $mes;
		$link .= "&ano=" . $ano;
		$link .= "&grupo_id=" . $grupo_id;
		$link .= "'><img src = '../resources/img/people.png'></a>";
		echo $link;
		echo "</td>";
		
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
				