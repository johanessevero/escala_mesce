	<?php
	session_start();
	include "../util/bd_util.php";
	include "../util/util.php";
	include "escala_bd.php";
	include "../pessoa/pessoa_bd.php";
	include "../jornada/jornada_bd.php";
	
	monta_html_relatorio ();
	
	?>
	
	
	<?php
	function monta_html_relatorio() {
		$cont_semana = 0;
		
		$escala = get_escala_por_id ( $_GET ["escala_id"] );
		
		$data_inicio = explode ( "/", get_data ( $escala ["data_inicio"] ) );
		$data_fim = explode ( "/", get_data ( $escala ["data_fim"] ) );
		
		echo "<div>";
		echo "<table id='rounded-corner' cellspacing = 0 cellpadding = 0 bordercolor = 'black' border = 1 style = 'text-align:center;font-size:10pt;width:100%;'>";
		echo "<thead>";
		echo "<tr >";
		echo "<th colspan = '3' >".$escala["descricao"]."</th>";
		echo "<tr></tr>";
		echo "<th colspan='3' >" . date ( "d/m/Y", mktime ( 0, 0, 0, $data_inicio [1], $data_inicio [0], $data_inicio [2] ) );
		echo " até " . date ( "d/m/Y", mktime ( 0, 0, 0, $data_fim [1], $data_fim [0], $data_fim [2] ) ) . "</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tfoot>";
		echo "</tfoot>";
		echo "<tbody>";
		
		for($i = date ( "d", mktime ( 0, 0, 0, $data_inicio [1], $data_inicio [0], $data_inicio [2] ) ); $i <= date ( "d", mktime ( 0, 0, 0, $data_fim [1], $data_fim [0], $data_fim [2] ) ); ++ $i) {
			
			if (strcmp ( date ( "D", mktime ( 0, 0, 0, $data_inicio [1], $i, $data_inicio [2] ) ), "Sun" ) == 0) {
				echo "<tr style = 'background-color:#D3D3D3;'><th >" . ++ $cont_semana . "ª semana/Dia do mês</th><th >Dia da semana</th><th >Horários</th></tr>";
			}
			
		
			echo "<tr>";
			echo "<td >" . date ( "d", mktime ( 0, 0, 0, $data_inicio [1], $i, $data_inicio [2] ) ) . "</td>";
			echo "<td >" . date ( "D", mktime ( 0, 0, 0, $data_inicio [1], $i, $data_inicio [2] ) ) . "</td>";
			monta_html_horarios ( $escala ["id"], $i, $data_inicio [1], $data_inicio [2] );
			echo "</tr>";
		}
		
		echo "<tr><td colspan = '3'>". $escala["observacao"] ."</td></tr>";
		
		echo "<tbody>";
		echo "</table>";
		echo "</div>";
	}
	function monta_html_horarios($escala_id, $dia, $mes, $ano) {
		$class_linha = "";
		$jornadas = get_jornadas_escala ( $escala_id, $dia, $mes, $ano );
		
		echo "<td>";
		
		echo "<table  border = 1 cellspacing = 0 cellpadding = 1 style = 'width:100%;text-align:center;font-size:10pt;'>";
		
		if (count ( $jornadas ) == 0)
			echo "<tr><td >nenhum horário para este dia</td></tr>";
		
		foreach ( $jornadas as $jornada ) {
			
			$pessoas = get_pessoas_escala_jornada ( $escala_id, $jornada ["id"], $dia, $mes, $ano );
			
			echo "<tr >";
			echo "<td style = 'text-align:center;width:50%;border-width:1px;'><b>" . $jornada ["hora_inicio"] . (strcmp($jornada ["hora_fim"], "00:00:00") == 0 ? "" : " - " . $jornada ["hora_fim"]) . " " . $jornada ["descricao"] . "</b></td>";
			echo "<td style = 'text-align:center;width:50%;'>";
			if (count ( $pessoas ) == 0) {
				echo "nenhuma pessoa para esse horário";
			} else {
				for ($i = 1; $i <= count($pessoas); ++$i) {
					
					echo $pessoas[$i-1] ["nome"];
					
					if ($i < count($pessoas))
						echo " - ";
				}
			}
			echo "</td>";
			echo "</tr>";
		}
				
		echo "</table>";
		
		echo "</td>";
	}
	
	?>