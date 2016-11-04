

<?php
include "jornada_bd.php";
include "../template/header.php";

monta_form_cadastro ();
incluir ();
excluir ();
editar ();
listar	();

?>

<?php
function monta_form_cadastro() {
	echo "<h2>Informações da jornada</h2>";
	echo "<form method = 'post'>";
	echo "<div id='tab1' class='tabcontent' style='display: block;'>";
	echo "<div class='form'>";
	
	echo "<div class='form_row'>";
	echo "<label>Hora de início:</label> <input type='text' name = 'hora_inicio' class='form_input' >";
	echo "</div>";
	
	echo "<div class='form_row'>";
	echo "<label>Hora fim:</label> <input type='text' name = 'hora_fim' class='form_input' >";
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
	if (! empty ( $_POST ["hora_inicio"] ) & ! empty ( $_POST ["hora_fim"] ) & ! empty ( $_POST ["incluir"] )) {
		inserir_jornada ( $_POST ["hora_inicio"], $_POST ["hora_fim"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_POST ["incluir"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir uma hora de início e uma hora fim.</span>";
		}
	}
}
function editar() {
	if (! empty ( $_POST ["hora_inicio"] ) & ! empty ( $_POST ["hora_fim"] ) & ! empty ( $_POST ["editar"] )) {
		editar_jornada ( $_POST ["id"], $_POST ["hora_inicio"], $_POST ["hora_fim"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_POST ["editar"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir uma hora de início e uma hora fim.</span>";
		}
	}
}
function excluir() {
	if (! empty ( $_POST ["id"] ) & ! empty ( $_POST ["excluir"] )) {
		
		excluir_jornada ( $_POST ["id"] );
		echo "<span class = 'notification n-success'>Jornada removida.</span>";
	}
}
function listar() {
	$jornadas = pesquisar_jornadas ();
	
	if (count ( $jornadas ) > 0) {
		echo "<h2>Jornadas</h2>";
		echo "<table id='rounded-corner'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Hora de início</th>";
		echo "<th>Hora fim</th>";
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
			echo "<td><form action = 'jornada_edicao.php' method = 'post'>";
			echo "<input type='hidden' name='editar' value='1' />";
			echo "<input type='hidden' name='id' value='" . $jornada ["id"] . "' />";
			echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/edit.png);repeat-x:no-repeat;width:20px;cursor:pointer;' title = 'clique para editar'/>";
			echo "</form></td>";
			echo "<td>";
			echo "<form method = 'post'>";
			echo "<input type='hidden' name='excluir' value='1' />";
			echo "<input type='hidden' name='id' value='" . $jornada ["id"] . "' />";
			echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/trash.gif);repeat-x:no-repeat;width:20px;cursor:pointer;' title = 'clique para excluir'/>";
			echo "</form>";
			echo "</td>";
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	}
}

include "../template/footer.php";

?>