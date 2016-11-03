	<?php
	include "../template/header.php";
	include "../pessoa/pessoa_bd.php";
	
	if (isset ( $_GET ["mes"] )) {
		monta_html_form_config_escala_mes ( $_GET ["mes"] - 1 );
	} else
		"Nenhum mês selecionado!";
	?>


<?php
/* por algum motivo a entrada numérica para um mês que se que é o número do mês mais 1 */
function monta_html_form_config_escala_mes($mes) {
	$cont_semana = 0;
	
	echo "<form action = 'cadastro_escala.php' method = 'post'>";
	echo "<div><input class = 'form_submit' type = 'submit' value = 'Salvar configuração'/></div>";
	echo "<input type='hidden' name = 'mes' value = '" . $mes . "'/>";
	echo "<h2>Configuração de escala</h2>";
	echo "<table id='rounded-corner'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th colspan='2'>ESCALA MESCE</th>";
	echo "<th>" . date ( "F \d\\e Y", mktime ( 0, 0, 0, $mes + 1, 0, date ( "Y" ) ) ) . "</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tfoot>";
	echo "<tr>";
	echo "<td colspan='12'></td>";
	echo "</tr>";
	echo "</tfoot>";
	echo "<tbody>";
	echo "</tr>";
	
	if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, 1, date ( "Y" ) ) ), "Sun" ) != 0) {
		// echo "<th colspan = '4'>" . ++ $cont_semana . "ª semana</th>";
		echo "<th>" . ++ $cont_semana . "ª semana/Dia do mês</th><th>Dia da semana</th><th>Horários</th>";
	}
	
	for($i = 1; $i <= date ( "t", mktime ( 0, 0, 0, $mes + 1, 0, date ( "Y" ) ) ); ++ $i) {
		
		if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sun" ) == 0) {
			// echo "<th colspan = '4'>" . ++ $cont_semana . "ª semana</th>";
			echo "<th>" . ++ $cont_semana . "ª semana/Dia do mês</th><th>Dia da semana</th><th>Horários</th>";
			monta_html_horarios ( $i, $mes );
		} else if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sat" ) == 0) {
			monta_html_horarios ( $i, $mes );
		} else {
			monta_html_horarios ( $i, $mes );
		}
	}
	
	echo "<tbody>";
	echo "</table>";
	
	echo "</form>";
}
function monta_html_horarios($dia, $mes) {
	$class_linha = "";
	
	if ($dia % 2 == 0)
		$class_linha = "even";
	else
		$class_linha = "odd";
	
	echo "<tr class = '" . $class_linha . "'>";
	echo "<td>Dia " . date ( "j", mktime ( 0, 0, 0, $mes, $dia, date ( "Y" ) ) ) . "</td>";
	echo "<td>" . date ( "D", mktime ( 0, 0, 0, $mes, $dia, date ( "Y" ) ) ) . "</td>";
	echo "<td>";
	
	/* horários */
	
	echo "<table><tr>";
	
	/* horario 1 */
	
	echo "<td><table class = 'escolha_horario'>";
	echo "<tr>";
	echo "<td><input class = 'check' type='checkbox' name='dia_" . $dia . "_horario_1' value='08:00'></td>";
	echo "<td>";
	monta_html_select_quant_pessoas ( 1, $dia );
	echo "</td>";
	echo "<td>08:00</td>";
	echo "</tr>";
	echo "</table></td>";
	
	/* fim horario 1 */
	
	/* horario 2 */
	
	echo "<td><table class = 'escolha_horario'>";
	echo "<tr>";
	echo "<td><input class = 'check' type='checkbox' name='dia_" . $dia . "_horario_2' value='09:00'></td>";
	echo "<td>";
	monta_html_select_quant_pessoas ( 2, $dia );
	echo "</td>";
	echo "<td>09:00</td>";
	echo "</tr>";
	echo "</table></td>";
	
	/* fim horario 2 */
	
	/* horario 3 */
	
	echo "<td><table class = 'escolha_horario'>";
	echo "<tr>";
	echo "<td><input class = 'check' type='checkbox' name='dia_" . $dia . "_horario_3' value='10:00'></td>";
	echo "<td>";
	monta_html_select_quant_pessoas ( 3, $dia );
	echo "</td>";
	echo "<td>10:00</td>";
	echo "</tr>";
	echo "</table></td></tr><tr>";
	
	/* fim horario 3 */
	
	/* horario 4 */
	
	echo "<td><table class = 'escolha_horario'>";
	echo "<tr>";
	echo "<td><input class = 'check' type='checkbox' name='dia_" . $dia . "_horario_4' value='16:30'></td>";
	echo "<td>";
	monta_html_select_quant_pessoas ( 4, $dia );
	echo "</td>";
	echo "<td>16:30</td>";
	echo "</tr>";
	echo "</table></td>";
	
	/* fim horario 4 */
	
	/* horario 5 */
	
	echo "<td><table class = 'escolha_horario'>";
	echo "<tr>";
	echo "<td><input class = 'check' type='checkbox' name='dia_" . $dia . "_horario_5' value='19:00'></td>";
	echo "<td>";
	monta_html_select_quant_pessoas ( 5, $dia );
	echo "</td>";
	echo "<td>19:00</td>";
	echo "</tr>";
	echo "</table></td>";
	
	/* fim horario 5 */
	
	/* horario 6 */
	
	echo "<td><table class = 'escolha_horario'>";
	echo "<tr>";
	echo "<td><input class = 'check' type='checkbox' name='dia_" . $dia . "_horario_6' value='19:30'></td>";
	echo "<td>";
	monta_html_select_quant_pessoas ( 6, $dia );
	echo "</td>";
	echo "<td>19:30</td>";
	echo "</tr>";
	echo "</table></td></tr><tr>";
	
	/* fim horario 6 */
	
	/* horario 7 */
	
	echo "<td><table class = 'escolha_horario'>";
	echo "<tr>";
	echo "<td><input class = 'check' type='checkbox' name='dia_" . $dia . "_horario_7' value='20:30'></td>";
	echo "<td>";
	monta_html_select_quant_pessoas ( 7, $dia );
	echo "</td>";
	echo "<td>20:30</td>";
	echo "</tr>";
	echo "</table></td></tr>";
	
	/* fim horario 7 */
	
	echo "</table></tr>";
	
	/* fim horarios */
	
	echo "</td></tr>";
}
function monta_html_select_quant_pessoas($horario, $dia) {
	$pessoas = pesquisar ();
	
	echo "<select class = 'form_select_1' name = 'quantidade_dia_" . $dia . "_horario_" . $horario . "' title = 'selecione a quantidade de pessoas para esse horário'>";
	for($i = 1; $i <= count ( $pessoas ); ++ $i) {
		
		echo "<option value = '" . $i . "'>" . $i . "</option>";
	}
	
	echo "</select>";
}

include "../template/footer.php";
?>
				