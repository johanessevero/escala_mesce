

	<?php
	include "../template/header.php";
	include "../pessoa/pessoa_bd.php";
	
	if (isset ( $_POST ["mes"] )) {
		$mes = $_POST ["mes"];
		monta_html_form_cadastro_escala ( $mes );
	} else
		"Nenhum mês selecionado!";
	
	?>

<?php
/* por algum motivo a entrada numérica para um mês que se que é o número do mês mais 1 */
function monta_html_form_cadastro_escala($mes) {
	$cont_semana = 0;
	
	echo "<form method = 'post'>";
	echo "<input type='hidden' name = 'mes' value = '" . $mes . "'/>";
	echo "<table border='1' align='center' style='text-align: center;'>";
	echo "<tr>";
	echo "<th colspan='2'>ESCALA MESCE</th>";
	echo "<th>" . date ( "F \d\\e Y", mktime ( 0, 0, 0, $mes + 1, 0, date ( "Y" ) ) ) . "</th>";
	echo "</tr>";
	
	if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, 1, date ( "Y" ) ) ), "Sun" ) != 0) {
		echo "<tr><td colspan='2'>" . ++ $cont_semana . "ª semana</td><td>Horários</td>";
	}
	
	for($i = 1; $i <= date ( "t", mktime ( 0, 0, 0, $mes + 1, 0, date ( "Y" ) ) ); ++ $i) {
		
		if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sun" ) == 0) {
			echo "<tr><td colspan='2'>" . ++ $cont_semana . "ª semana</td><td>Horários</td>";
			monta_html_horarios ( $i, $mes );
		} else if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sat" ) == 0) {
			monta_html_horarios ( $i, $mes );
		} else {
			monta_html_horarios ( $i, $mes );
		}
	}
	
	echo "<tr><td colspan = '3'><input type = 'submit' value = 'Salvar escala'/>";
	echo "</table>";
	
	echo "</form>";
}
function monta_html_horarios($dia, $mes) {
	$tem_escala = false;
	
	echo "<tr><td>Dia " . date ( "j", mktime ( 0, 0, 0, $mes, $dia, date ( "Y" ) ) ) . "</td><td>" . date ( "D", mktime ( 0, 0, 0, $mes, $dia, date ( "Y" ) ) ) . "</td><td>";
	echo "<div >";
	if (isset ( $_POST ["dia_" . $dia . "_horario_1"] )) {
		echo "<div style = 'display:inline;text-align:left;'>";
		echo "<input type='hidden' name='dia_" . $dia . "_horario_1' value='08:00'>08:00";
		
		for($i = 0; $i < $_POST ["quantidade_dia_" . $dia . "_horario_1"]; ++ $i) {
			monta_html_select_pessoas ( 1, $dia );
		}
		
		echo "</div><br/>";
		$tem_escala = true;
	}
	
	if (isset ( $_POST ["dia_" . $dia . "_horario_2"] )) {
		echo "<div style = 'display:inline;text-align:left;'>";
		echo "<input type='hidden' name='dia_" . $dia . "_horario_2' value='09:00'>09:00";
		for($i = 0; $i < $_POST ["quantidade_dia_" . $dia . "_horario_2"]; ++ $i) {
			monta_html_select_pessoas ( 2, $dia );
		}
		echo "</div><br/>";
		$tem_escala = true;
	}
	
	if (isset ( $_POST ["dia_" . $dia . "_horario_3"] )) {
		echo "<div style = 'display:inline;text-align:left;'>";
		echo "<input type='hidden'  name='dia_" . $dia . "_horario_3' value='10:00'>10:00";
		for($i = 0; $i < $_POST ["quantidade_dia_" . $dia . "_horario_3"]; ++ $i) {
			monta_html_select_pessoas ( 3, $dia );
		}
		echo "</div><br/>";
		$tem_escala = true;
	}
	
	if (isset ( $_POST ["dia_" . $dia . "_horario_4"] )) {
		echo "<div style = 'display:inline;text-align:left;'>";
		echo "<input type='hidden' name='dia_" . $dia . "_horario_4' value='16:30'>16:30";
		for($i = 0; $i < $_POST ["quantidade_dia_" . $dia . "_horario_4"]; ++ $i) {
			monta_html_select_pessoas ( 4, $dia );
		}
		echo "<br/></div>";
		$tem_escala = true;
	}
	
	if (isset ( $_POST ["dia_" . $dia . "_horario_5"] )) {
		echo "<div style = 'display:inline;text-align:left;'>";
		echo "<input type='hidden' name='dia_" . $dia . "_horario_5' value='19:00'>19:00";
		for($i = 0; $i < $_POST ["quantidade_dia_" . $dia . "_horario_5"]; ++ $i) {
			monta_html_select_pessoas ( 5, $dia );
		}
		echo "</div><br/>";
		$tem_escala = true;
	}
	
	if (isset ( $_POST ["dia_" . $dia . "_horario_6"] )) {
		echo "<div style = 'display:inline;text-align:left;'>";
		echo "<input type='hidden' name='dia_" . $dia . "_horario_6' value='19:30'>19:30";
		for($i = 0; $i < $_POST ["quantidade_dia_" . $dia . "_horario_6"]; ++ $i) {
			monta_html_select_pessoas ( 6, $dia );
		}
		echo "</div><br/>";
		$tem_escala = true;
	}
	
	if (isset ( $_POST ["dia_" . $dia . "_horario_7"] )) {
		echo "<div style = 'display:inline;text-align:left;'>";
		echo "<input type='hidden' name='dia_" . $dia . "_horario_7' value='20:30'>20:30</div>";
		for($i = 0; $i < $_POST ["quantidade_dia_" . $dia . "_horario_7"]; ++ $i) {
			monta_html_select_pessoas ( 1, $dia );
		}
		echo "</div><br/>";
		$tem_escala = true;
	}
	
	if (! $tem_escala)
		echo "<div style = 'text-align:center;'>sem escala para esse dia</div>";
	
	echo "</td></tr>";
}
function monta_html_select_pessoas($horario, $dia) {
	
	$pessoas = pesquisar ();
	
	echo "&nbsp;<select name = 'pessoa_dia_" . $dia . "_horario_" . $horario . " title = 'selecione uma pessoa para esse horário'>";
	for($i = 0; $i < count ( $pessoas ); ++ $i) {
		
		echo "<option value = '" . $pessoas [$i]["id"] . "'>" . $pessoas [$i]["nome"] . "</option>";
	}
	echo "</select>&nbsp;";
}

include "../template/footer.php";

?>