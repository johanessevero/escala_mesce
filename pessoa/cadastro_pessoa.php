

<?php

include "pessoa_bd.php";
include "../template/header.php";

monta_form_cadastro ();
salvar_pessoa ();
excluir_pessoa ();
listar_pessoas ();

?>







<?php
function monta_form_cadastro() {
	echo "<h2>Informações da pessoa</h2>";
	echo "<form method = 'post'>";
	echo "<div id='tab1' class='tabcontent' style='display: block;'>";
	echo "<div class='form'>";
	
	echo "<div class='form_row'>";
	echo "<label>Nome:</label> <input type='text' name = 'nome' class='form_input' >";
	echo "</div>";
	
	echo "<div class='form_row'>";
	echo "<label>Email:</label> <input type='text' name = 'email' class='form_input' >";
	echo "</div>";
	echo "<input type='hidden' name='incluir' value='1' />";
	echo "<div class='form_row'>";
	echo "<input type='submit' class='form_submit' value='Salvar'>";
	echo "</div>";
	echo "<div class='clear'></div>";
	echo "</div>";
	echo "</div>";
	echo "</form>";
}
function salvar_pessoa() {
	if (! empty ( $_POST ["nome"] ) & ! empty ( $_POST ["email"] ) & ! empty ( $_POST ["incluir"] )) {
		inserir ( $_POST ["nome"], $_POST ["email"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_POST ["incluir"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir um nome e um e-mail.</span>";
		}
	}
}
function excluir_pessoa() {
	if (! empty ( $_POST ["id"] ) & ! empty ( $_POST ["excluir"] )) {
		
		excluir ( $_POST ["id"] );
		echo "<span class = 'notification n-success'>Dados excluídos.</span>";
	}
}
function listar_pessoas() {
	$pessoas = pesquisar ();
	
	if (count ( $pessoas ) > 0) {
		echo "<h2>Pessoas</h2>";
		echo "<table id='rounded-corner'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Nome</th>";
		echo "<th>Email</th>";
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
		foreach ( $pessoas as $pessoa ) {
			
			if ($cont ++ % 2 == 0)
				echo "<tr class='odd'>";
			else
				echo "<tr class='even'>";
			echo "<td>" . $pessoa ["nome"] . "</td>";
			echo "<td>" . $pessoa ["email"] . "</td>";
			echo "<td><a href='#'><img src='img/edit.png' alt='' title='' border='0'></a></td>";
			echo "<td>";
			echo "<form method = 'post'>";
			echo "<input type='hidden' name='excluir' value='1' />";
			echo "<input type='hidden' name='id' value='" . $pessoa ["id"] . "' />";
			echo "<input type='submit' value = '' style = 'background-image:url(img/trash.gif);repeat-x:no-repeat;width:20px;cursor:pointer;' title = 'clique para excluir'/>";
			echo "</form>";
			echo "</td>";
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	}
}

include "../template/footer.php";

?>