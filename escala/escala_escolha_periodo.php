

<?php

include "../template/header.php";
include "../grupo/grupo_bd.php";

monta_form_cadastro();

?>

<?php 

function monta_form_cadastro() {
	echo "<h2>Período da escala</h2>";
	echo "<form action = 'escala_cadastro.php' method = 'post'>";
	echo "<div id='tab1' class='tabcontent' style='display: block;'>";
	echo "<div class='form'>";

	echo "<div class='form_row'>";
	echo "<label>Data inicial:</label> <input type='text' name = 'data_inicial' class='form_input' >";
	echo "</div>";
	echo "<div class='form_row'>";
	echo "<label>Data final:</label> <input type='text' name = 'data_final' class='form_input' >";
	echo "</div>";
	echo "<input type='hidden' name='incluir' value='1' />";
	monta_html_select_grupos();
	echo "<div class='form_row'>";
	echo "<input type='submit' class='form_submit' value='Nova escala' title = 'clique para criar uma nova escala'>";
	echo "</div>";
	echo "<div class='clear'></div>";
	echo "</div>";
	echo "</div>";
	echo "</form>";
}

function monta_html_select_grupos() {

	$grupos = pesquisar_grupos();

	echo "<div class='form_row'><label>Grupo:</label><select class = 'form_select' name = 'grupo'>";

	echo "<option value = ''></option>";
	for($i = 0; $i < count ( $grupos ); ++ $i) {

		echo "<option value = '" . $grupos [$i]["id"] . "'>" . $grupos [$i]["nome"] . "</option>";
	}
	echo "</select></div>";
}



include "../template/footer.php"?>