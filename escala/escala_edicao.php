<?php
include "../template/header.php";
include "escala_bd.php";
include "../grupo/grupo_bd.php";

monta_html_form_edicao();

?>

<?php
function monta_html_form_edicao() {
	
	$escala = get_escala_por_id($_POST["escala_id"]);
	
	echo "<h2>Informações da escala</h2>";	
	echo "<form action = 'escala_cadastro.php' method = 'post'>";
	echo "<div id='tab1' class='tabcontent' style='display: block;'>";
	echo "<div class='form'>";
	
	echo "<div class='form_row'>";
	echo "<label>Data inicial:</label> <input type='text' value = '".get_data($escala["data_inicio"])."' name = 'data_inicio' class='form_input' >";
	echo "</div>";
	
	echo "<div class='form_row'>";
	echo "<label>Data final:</label> <input type='text' value = '".get_data($escala["data_fim"])."' name = 'data_fim' class='form_input' >";
	echo "</div>";
	
	echo "<div class='form_row'>";
	echo "<label>Descrição:</label> <input type='text' value = '".$escala["descricao"]."' name = 'descricao' class='form_input' >";
	echo "</div>";
	
	echo "<div class='form_row'>";
	echo "<label>Observação:</label> <input type='textarea' name = 'observacao' class='form_textarea' >";
	echo "</div>";
	

	monta_html_select_grupos($escala["grupo_id"]);
	
	echo "<input type='hidden' name='editar' value='1' />";
	echo "<input type='hidden' name='escala_id' value='".$escala["id"]."' />";
	echo "<div class='form_row'>";
	echo "<input type='submit' class='form_submit' value='Alterar' title = 'clique para alterar'>";
	echo "</div>";
	echo "<div class='clear'></div>";
	echo "</div>";
	echo "</div>";
	echo "</form>";
	
}

function monta_html_select_grupos($grupo_id) {
	$grupos = get_grupos();

	echo "<div class='form_row'><label>Grupo:</label><select class = 'form_select' name = 'grupo_id'>";

	echo "<option value = ''></option>";
	for($i = 0; $i < count ( $grupos ); ++ $i) {
		if ($grupo_id == $grupos [$i] ["id"]) {
			echo "<option selected value = '" . $grupos [$i] ["id"] . "'>" . $grupos [$i] ["nome"] . "</option>";
		}
		else
			echo "<option value = '" . $grupos [$i] ["id"] . "'>" . $grupos [$i] ["nome"] . "</option>";
	}
	echo "</select></div>";
}

?>

<?php

include "../template/footer.php";

?>
