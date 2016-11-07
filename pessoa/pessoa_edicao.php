<?php

include "../template/header.php";
include "pessoa_bd.php";

monta_form_edicao();

?>

<?php
function monta_form_edicao() {
	
	$pessoa = pesquisar_pessoa_por_id($_POST["id"]);
	
	echo "<h2>Informações da pessoa</h2>";
	echo "<form action = 'pessoa_cadastro.php' method = 'post'>";
	echo "<div id='tab1' class='tabcontent' style='display: block;'>";
	echo "<div class='form'>";
	
	echo "<div class='form_row'>";
	echo "<label>Nome:</label> <input type='text' value = '".$pessoa["nome"]."' name = 'nome' class='form_input' >";
	echo "</div>";
	
	echo "<div class='form_row'>";
	echo "<label>Email:</label> <input type='text' value = '".$pessoa["email"]."' name = 'email' class='form_input' >";
	echo "</div>";
	echo "<input type='hidden' name='editar' value='1' />";
	echo "<input type='hidden' name='id' value='".$pessoa["id"]."' />";
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
