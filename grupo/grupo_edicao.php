<?php
include "../template/header.php";
include "grupo_bd.php";



monta_form_edicao();

?>

<?php
function monta_form_edicao() {
	
	$grupo = get_grupo_por_id($_GET["id"]);
	
	echo "<h2>Informações da grupo</h2>";
	echo "<form action = 'grupo_cadastro.php' method = 'post'>";
	echo "<div id='tab1' class='tabcontent' style='display: block;'>";
	echo "<div class='form'>";
	
	echo "<div class='form_row'>";
	echo "<label>Nome:</label> <input type='text' value = '".$grupo["nome"]."' name = 'nome' class='form_input' >";
	echo "</div>";
	
	echo "<input type='hidden' name='editar' value='1' />";
	echo "<input type='hidden' name='id' value='".$grupo["id"]."' />";
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
