

<?php
include "../template/header.php";
include "jornada_bd.php";
include "../escala/escala_bd.php";

incluir ();
excluir ();
editar ();
monta_form_cadastro ();
listar ();

?>

<?php
function monta_form_cadastro() {
	echo "<h2>Informações da jornada</h2>";
	echo "<form method = 'GET'>";
	echo "<div id='tab1' class='tabcontent' style='display: block;'>";
	echo "<div class='form'>";
	
	echo "<div class='form_row'>";
	echo "<label>Hora de início:</label> <input type='text' name = 'hora_inicio' class='form_input' >";
	echo "</div>";
	
	echo "<div class='form_row'>";
	echo "<label>Hora fim:</label> <input type='text' name = 'hora_fim' class='form_input' >";
	echo "</div>";
	
	echo "<div class='form_row'>";
	echo "<label>Descrição:</label> <input type='text' name = 'descricao' class='form_input' >";
	echo "</div>";
	
	echo "<input type='hidden' name='incluir' value='1' />";
	echo "<div class='form_row'>";
	echo "<input type='submit' class='form_submit' value='Salvar' title = 'clique para salvar'>";
	echo "</div>";
	echo "<div class='clear'></div>";
	echo "</div>";
	echo "</div>";
	echo "</form>";
}
function incluir() {
	if (! empty ( $_GET ["hora_inicio"] )  & ! empty ( $_GET ["incluir"] )) {
		inserir_jornada ( $_GET ["hora_inicio"], $_GET ["hora_fim"], $_GET ["descricao"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_GET ["incluir"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir pelo menos uma hora de início.</span>";
		}
	}
}
function editar() {
	if (! empty ( $_GET ["hora_inicio"] ) & ! empty ( $_GET ["hora_fim"] ) & ! empty ( $_GET ["editar"] )) {
		editar_jornada ( $_GET ["id"], $_GET ["hora_inicio"], $_GET ["hora_fim"], $_GET ["descricao"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_GET ["editar"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir uma hora de início e uma hora fim.</span>";
		}
	}
}
function excluir() {
	if (! empty ( $_GET ["id"] ) & ! empty ( $_GET ["excluir"] )) {
		
		$escala_jornada = get_first_jornada ( $_GET ["id"] );
		
		if (! empty ( $escala_jornada )) {
			echo "<span class = 'notification n-error'>A jornada não pode ser removida pois está sendo usada na escala " . get_escala_por_id($escala_jornada ["escala_id"] ) ["descricao"] . ".</span>";
		} else {
			excluir_jornada ( $_GET ["id"] );
			echo "<span class = 'notification n-success'>Jornada removida.</span>";
		}
	}
}
function listar() {
	$jornadas = get_jornadas ();
	
	if (count ( $jornadas ) > 0) {
		echo "<h2>Jornadas</h2>";
		echo "<table id='rounded-corner'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Hora de início</th>";
		echo "<th>Hora fim</th>";
		echo "<th>Descrição</th>";
		echo "<th></th>";
		echo "<th></th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tfoot>";
		echo "<tr>";
		echo "<td colspan='12'></td>";
		echo "</tr>";
		echo "</tfoot>";
		echo "<tbody>";
		
		$cont = 0;
		foreach ( $jornadas as $jornada ) {
			
			if ($cont ++ % 2 == 0)
				echo "<tr class='odd'>";
			else
				echo "<tr class='even'>";
			echo "<td>" . $jornada ["hora_inicio"] . "</td>";
			echo "<td>" . $jornada ["hora_fim"] . "</td>";
			echo "<td>" . $jornada ["descricao"] . "</td>";
			echo "<td>";
			echo "<a href = 'jornada_edicao.php?id=" . $jornada ["id"] . "&editar=1' title = 'clique para alterar'/><img src = '../resources/img/edit.png'/></a></td>";
			echo "<td>";
			echo "<a href = 'jornada_cadastro.php?id=" . $jornada ["id"] . "&excluir=1' title = 'clique para excluir'><img src = '../resources/img/trash.gif'></a>";
			echo "</td>";
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	}
}

include "../template/footer.php";

?>