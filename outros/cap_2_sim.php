<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>RELATÓRIO DE ESCALA</title>
</head>
<body>

	<?php monta_html_escala_mes ( 10 );?>
    </body>
</html>

	
    <?php
				/* por algum motivo a entrada numérica para um mês que se que é o número do mês mais 1 */
				function monta_html_escala_mes($mes) {
					$cont_semana = 0;
					
					echo "<table border='1' width='700px' align='center' style='text-align: center;'>";
					echo "<tr>";
					echo "<th colspan='3'>ESCALA MESCE</th>";
					echo "<th>" . date ( "F \d\\e Y", mktime ( 0, 0, 0, $mes + 1, 0, date ( "Y" ) ) ) . "</th>";
					echo "</tr>";
					
					if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, 1, date ( "Y" ) ) ), "Sun" ) != 0) {
						echo "<tr><td colspan='2'>" . ++ $cont_semana . "ª semana</td><td>Horário</td><td>Ministros</td></tr>";
					}
					
					for($i = 1; $i <= date ( "t", mktime ( 0, 0, 0, $mes + 1, 0, date ( "Y" ) ) ); ++ $i) {
						
						if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sun" ) == 0) {
							echo "<tr><td colspan='2'>" . ++ $cont_semana . "ª semana</td><td>Horário</td><td>Ministros</td></tr>";
							echo "<tr><td rowspan='3'>Dia " . date ( "j", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td rowspan='3'>" . date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>08:00</td><td>ministro</td></tr><tr><td>10:00</td><td>ministro</td></tr><tr><td>19:00</td><td>ministro</td></tr>";
						} else if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sat" ) == 0) {
							echo "<tr><td>Dia " . date ( "j", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>" . date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>19:00</td><td>ministro</td></tr>";
						} else {
							echo "<tr><td>Dia " . date ( "j", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>" . date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ) . "</td><td>19:30</td><td>ministro</td></tr>";
						}
					}
					
					echo "</table>";
				}
				function get_quantidade_semanas_mes($mes) {
					$cont = 0;
					
					for($i = 1; $i <= date ( "t", mktime ( 0, 0, 0, $mes, 0, date ( "Y" ) ) ); ++ $i) {
						
						if (strcmp ( date ( "D", mktime ( 0, 0, 0, $mes, $i, date ( "Y" ) ) ), "Sun" ) == 0) {
							$cont += 1;
						}
					}
					
					return $cont;
				}
				
				?>