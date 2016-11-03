	<?php
	include "header.php";
	include "init.php";
	include "pessoa_bd.php";
	
	if (isset ( $_GET ["mes"] )) {
		monta_html_form_config_escala_mes ( $_GET ["mes"] - 1 );
	} else
		"Nenhum mês selecionado!";
	?>

</body>
</html>


<?php
/* por algum motivo a entrada numérica para um mês que se que é o número do mês mais 1 */
function monta_html_form_config_escala_mes($mes) {
	$cont_semana = 0;
	
	echo "<form action = 'cadastro_escala.php' method = 'post'>";
	echo "<input type='hidden' name = 'mes' value = '" . $mes . "'/>";
	echo "<table class='listing' cellpadding='0' cellspacing='0'>";
	echo "<tr>";
	echo "<th colspan='2' class = 'first'>ESCALA MESCE</th>";
	echo "<th class = 'last'>" . date ( "F \d\\e Y", mktime ( 0, 0, 0, $mes + 1, 0, date ( "Y" ) ) ) . "</th>";
	echo "</tr>";
	
	if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, 1, date ( "Y" ) ) ), "Sun" ) != 0) {
		echo "<tr><td colspan='2' class = 'first style2'>" . ++ $cont_semana . "ª semana</td><td class = 'first style2'>Horários</td>";
	}
	
	for($i = 1; $i <= date ( "t", mktime ( 0, 0, 0, $mes + 1, 0, date ( "Y" ) ) ); ++ $i) {
		
		if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sun" ) == 0) {
			echo "<tr><td colspan='2' class = 'first style2'>" . ++ $cont_semana . "ª semana</td><td class = 'first style2'>Horários</td>";
			monta_html_horarios ( $i, $mes );
		} else if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sat" ) == 0) {
			monta_html_horarios ( $i, $mes );
		} else {
			monta_html_horarios ( $i, $mes );
		}
	}
	
	echo "<tr><td colspan = '3'><input type = 'submit' value = 'Salvar configuração'/>";
	echo "</table>";
	
	echo "</form>";
}	
function monta_html_horarios($dia, $mes) {
	
	$class_linha = "";
	
	if ($dia % 2 == 0)
		$class_linha = "bg";
		
	
	echo "<tr class = '".$class_linha."'><td  class = 'first style2'>Dia " . date ( 	"j", mktime ( 0, 0, 0, $mes, $dia, date ( "Y" ) ) ) . "</td><td class = 'first style2'>" . date ( "D", mktime ( 0, 0, 0, $mes, $dia, date ( "Y" ) ) ) . "</td><td>";
	echo "<div >";
	echo "<div style = 'display:inline;'>";
	echo "<input type='checkbox' name='dia_" . $dia . "_horario_1' value='08:00'>08:00";
	monta_html_select_quant_pessoas ( 1, $dia );
	echo "</div>";
	echo "<div style = 'display:inline;'>";
	echo "<input type='checkbox' name='dia_" . $dia . "_horario_2' value='09:00'>09:00";
	monta_html_select_quant_pessoas ( 2, $dia );
	echo "</div>";
	echo "<div style = 'display:inline;'>";
	echo "<input type='checkbox'  name='dia_" . $dia . "_horario_3' value='10:00'>10:00";
	monta_html_select_quant_pessoas ( 3, $dia );
	echo "</div>";
	echo "<div style = 'display:inline;'>";
	echo "<input type='checkbox' name='dia_" . $dia . "_horario_4' value='16:30'>16:30";
	monta_html_select_quant_pessoas ( 4, $dia );
	echo "</div>";
	echo "<div style = 'display:inline;'>";
	echo "<input type='checkbox' name='dia_" . $dia . "_horario_5' value='19:00'>19:00";
	monta_html_select_quant_pessoas ( 5, $dia );
	echo "</div>";
	echo "<div style = 'display:inline;'>";
	echo "<input type='checkbox' name='dia_" . $dia . "_horario_6' value='19:30'>19:30";
	monta_html_select_quant_pessoas ( 6, $dia );
	echo "</div>";
	echo "<div style = 'display:inline;'>";
	echo "<input type='checkbox' name='dia_" . $dia . "_horario_7' value='20:30'>20:30</div>";
	monta_html_select_quant_pessoas ( 7, $dia );
	echo "</div>";
	echo "</td></tr>";
}
function monta_html_select_quant_pessoas($horario, $dia) {
	
	$pessoas = pesquisar();
	
	echo "&nbsp;<select name = 'quantidade_dia_" . $dia . "_horario_" . $horario . "' title = 'selecione a quantidade de pessoas para esse horário'>";
	for($i = 1; $i <= count ( $pessoas ); ++ $i) {
		
		echo "<option value = '" . $i . "'>" . $i . "</option>";
	}
	
	echo "</select>";
}

include "footer.php";
?>
				