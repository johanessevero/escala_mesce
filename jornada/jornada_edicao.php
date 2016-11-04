<?php
include "jornada_bd.php";
include "../template/header.php";


monta_form_edicao();

?>

<?php
function monta_form_edicao() {
	
	$jornada = pesquisar_jornada_por_id($_POST["id"]);
	
	echo "<h2>Informações da jornada</h2>";
	echo "<form action = 'jornada_cadastro.php' method = 'post'>";
	echo "<div id='tab1' class='tabcontent' style='display: block;'>";
	echo "<div class='form'>";
	
	echo "<div class='form_row'>";
	echo "<label>Hora de início:</label> <input type='text' value = '".$jornada["hora_inicio"]."' name = 'hora_inicio' class='form_input' >";
	echo "</div>";
	
	echo "<div class='form_row'>";
	echo "<label>Hora fim:</label> <input type='text' value = '".$jornada["hora_fim"]."' name = 'hora_fim' class='form_input' >";
	echo "</div>";
	echo "<input type='hidden' name='editar' value='1' />";
	echo "<input type='hidden' name='id' value='".$jornada["id"]."' />";
	echo "<div class='form_row'>";
	echo "<input type='submit' class='form_submit' value='Alterar' title = 'clique para alterar'>";
	echo "</div>";
	echo "<div class='clear'></div>";
	echo "</div>";
	echo "</div>";
	echo "</form>";
}
?>

<?php

include "../template/footer.php";

?>
