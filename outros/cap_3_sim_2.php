<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MONTAGEM DA ESCALA</title>
</head>
<body>

	<?php monta_html_form_config_escala_mes( 10 );?>
    </body>
</html>


<?php
/* por algum motivo a entrada numérica para um mês que se que é o número do mês mais 1 */
function monta_html_form_config_escala_mes($mes) {
	$cont_semana = 0;
	
	echo "<form>";
	echo "<table border='1' width='700px' align='center' style='text-align: center;'>";
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
			echo "<tr><td>Dia " . date ( "j", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>" . date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>";
			
			echo "<div><input type='checkbox' checked = 'true' name='dia_" . $i . "_horario_1' value='08:00'>08:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_2' value='09:00'>09:00";
			echo "<input type='checkbox' checked = 'true' name='dia_" . $i . "_horario_3' value='10:00'>10:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_4' value='16:30'>16:30";
			echo "<input type='checkbox' checked = 'true' name='dia_" . $i . "_horario_5' value='19:00'>19:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_6' value='19:30'>19:30";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_7' value='20:30'>20:30</div>";
			
			echo "</td></tr>";
		} else if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sat" ) == 0) {
			echo "<tr><td>Dia " . date ( "j", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>" . date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>";
			echo "<div><input type='checkbox' name='dia_" . $i . "_horario_1' value='08:00'>08:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_2' value='09:00'>09:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_3' value='10:00'>10:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_4' value='16:30'>16:30";
			echo "<input type='checkbox' checked = 'true' name='dia_" . $i . "_horario_5' value='19:00'>19:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_6' value='19:30'>19:30";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_7' value='20:30'>20:30</div>";
			
			echo "</td></tr>";
		} else {
			echo "<tr><td>Dia " . date ( "j", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>" . date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>";
			echo "<div><input type='checkbox' name='dia_" . $i . "_horario_1' value='08:00'>08:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_2' value='09:00'>09:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_3' value='10:00'>10:00";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_4' value='16:30'>16:30";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_5' value='19:00'>19:00";
			echo "<input type='checkbox' checked = 'true' name='dia_" . $i . "_horario_6' value='19:30'>19:30";
			echo "<input type='checkbox' name='dia_" . $i . "_horario_7' value='20:30'>20:30</div>";
			
			echo "</td></tr>";
		}
	}
	
	echo "<tr><td colspan = '3'><input type = 'submit' value = 'Salvar configuração'/>";
	echo "</table>";
	
	echo "</form>";
}
				