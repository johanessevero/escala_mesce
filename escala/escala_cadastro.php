	<?php
	include "../template/header.php";
	include "../pessoa/pessoa_bd.php";
	include "../jornada/jornada_bd.php";
	
	if (empty ( $_POST ["data_inicial"] ) | empty ( $_POST ["data_final"] ) | empty ( $_POST ["grupo"] )) {
		
		echo "<span class = 'notification n-attention'>Para inserir uma nova escala, é preciso escolher uma data de início, uma data fim e um grupo. Clique em \"Gerenciar escalas\"</span>";
	} else {
		monta_html_form_config_escala_mes ( $_POST ["data_inicial"], $_POST ["data_final"], $_POST ["grupo"] );
	}
	
	?>


<?php
/* por algum motivo a entrada numérica para um mês que se que é o número do mês mais 1 */
function monta_html_form_config_escala_mes($data_inicial, $data_final, $grupo) {
	$cont_semana = 0;
	
	$data_inicial_ = explode ( "/", $data_inicial );
	$data_final_ = explode ( "/", $data_final );
	
	if ($data_inicial_ [0] > $data_final_ [0]) {
		
		echo "<span class = 'notification n-error'>É preciso que a data final seja maior que a data inicial.</span>";
	} else if ($data_inicial_ [1] != $data_final_ [1]) {
		echo "<span class = 'notification n-error'>O período precisa estar dentro do mesmo mês.</span>";
	} else if ($data_inicial_ [2] != $data_final_ [2]) {
		echo "<span class = 'notification n-error'>O período precisa estar dentro do mesmo ano.</span>";
	} else {
		echo "<form method = 'post'>";
		echo "<div><input class = 'form_submit' type = 'submit' value = 'Salvar escala'/></div>";
		echo "<h2>Informações da escala </h2>";
		echo "<table id='rounded-corner'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th colspan='4'>" . date ( "d/m/Y", mktime ( 0, 0, 0, $data_inicial_ [1], $data_inicial_ [0], $data_inicial_ [2] ) );
		echo " até " . date ( "d/m/Y", mktime ( 0, 0, 0, $data_final_ [1], $data_final_ [0], $data_final_ [2] ) ) . "</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tfoot>";
		echo "</tfoot>";
		echo "<tbody>";
		
		for($i = date ( "d", mktime ( 0, 0, 0, $data_inicial_ [1], $data_inicial_ [0], $data_inicial_ [2] ) ); $i <= date ( "d", mktime ( 0, 0, 0, $data_final_ [1], $data_final_ [0], $data_final_ [2] ) ); ++ $i) {
			
			if (strcmp ( date ( "D", mktime ( 0, 0, 0, $data_inicial_ [1], $i, $data_inicial_ [2] ) ), "Sun" ) == 0) {
				echo "<tr><th>" . ++ $cont_semana . "ª semana/Dia do mês</th><th>Dia da semana</th><th>Horários</th></tr>";
				// monta_html_horarios ( $i, $mes );
			} else {
				// monta_html_horarios ( $i, $mes );
			}
			
			if ($i % 2 == 0)
				echo "<tr class='odd'>";
			else
				echo "<tr class='even'>";
			
			echo "<td>" . date ( "d", mktime ( 0, 0, 0, $data_inicial_ [1], $i, $data_inicial_ [2] ) ) . "</td>";
			echo "<td>" . date ( "D", mktime ( 0, 0, 0, $data_inicial_ [1], $i, $data_inicial_ [2] ) ) . "</td>";
			monta_html_horarios ( $i, $data_inicial_ [1], $data_inicial_ [2] );
			echo "</tr>";
		}
		
		echo "<tbody>";
		echo "</table>";
		
		echo "</form>";
	}
}
function monta_html_horarios($dia, $mes, $ano) {
	$class_linha = "";
	$jornadas = pesquisar_jornadas ();
	
	echo "<td>";
	
	echo "<table class = 'escolha_horario'>";
	echo "<tr>";
	
	foreach ( $jornadas as $jornada ) {
		
		echo "<td><input class = 'check' type = 'checkbox' value = '".$dia."-".$mes."-".$ano."'/></td>";
		echo "<td>".$jornada ["hora_inicio"] . "-" . $jornada ["hora_fim"] . " "."</td>";
		echo "<td>"."<form method = 'post'>";
		echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/people.png);repeat-x:no-repeat;width:34px;height:34px;cursor:pointer;' title = 'clique para adicionar/remover pessoas à jornada'/>";
		echo "</form>"."</td>";
	}
	
	echo "</tr></table>";
	
	echo "</td>";
}
function monta_html_select_quant_pessoas($horario, $dia) {
	$pessoas = pesquisar_pessoas ();
	
	echo "<select class = 'form_select_1' name = 'quantidade_dia_" . $dia . "_horario_" . $horario . "' title = 'selecione a quantidade de pessoas para esse horário'>";
	for($i = 1; $i <= count ( $pessoas ); ++ $i) {
		
		echo "<option value = '" . $i . "'>" . $i . "</option>";
	}
	
	echo "</select>";
}

include "../template/footer.php";
?>
				