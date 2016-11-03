

<?php
include "init.php";
include "pessoa_bd.php";
include "header.php";

monta_form_cadastro ();
salvar_pessoa ();
excluir_pessoa ();
listar_pessoas ();

?>

</body>

</html>

<?php
function monta_form_cadastro() {
	echo "<form method = 'post' method = 'post'>";
	echo "<table class='listing form' cellpadding='0' cellspacing='0'>";
	echo "<tbody><tr>";
	echo "<th class='full' colspan='2'></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class='first' width='172'><strong>Nome</strong></td>";
	echo "<td class='last'><input class='text' name = 'nome' type='text'></td>";
	echo "</tr>";
	echo "<tr class='bg'>";
	echo "<td class='first'><strong>E-mail</strong></td>";
	echo "<td class='last'><input class='text' name = 'email' type='text'></td>";
	echo "</tr>";
	echo "<tr class='first'>";
	echo "<td class='first'><strong></strong></td>";
	echo "<td class='last'><input type='submit' value='Salvar' /></td>";
	echo "</tr>";
	echo "<input type='hidden' name='incluir' value='1' />";
	echo "</tbody></table>";
	echo "</form>";
}
function salvar_pessoa() {
	if (! empty ( $_POST ["nome"] ) & ! empty ( $_POST ["email"] ) & ! empty ( $_POST ["incluir"] )) {
		inserir ( $_POST ["nome"], $_POST ["email"] );
		echo "<br/><br/>Dados salvos.<br/><br/>";
	} else {
		if (isset ( $_POST ["incluir"] )) {
			echo "<br/><br /><div class = 'box'>É preciso inserir um nome e um e-mail.</div><br/><br/>";
		}
	}
}
function excluir_pessoa() {
	if (! empty ( $_POST ["id"] ) & ! empty ( $_POST ["excluir"] )) {
		
		excluir ( $_POST ["id"] );
		echo "<br/><br/><div class = 'box'>Dados excluídos.</div><br/><br/>";
	}
}
function listar_pessoas() {
	$pessoas = pesquisar ();
	
	if (count ( $pessoas ) > 0) {
		echo "<table class='listing' cellpadding='0' cellspacing='0'>";
		echo "<tbody><tr>";
		echo "<th class='first' width='177'>Nome</th>";
		echo "<th>E-mail</th>";
		echo "<th class = 'last'></th>";
		echo "</tr>";
		
		foreach ( $pessoas as $pessoa ) {
			
			echo "<tr>";
			echo "<td class='first style1'>" . $pessoa ["nome"] . "</td>";
			echo "<td class='first style1'>" . $pessoa ["email"] . "</td>";
			echo "<td><form method = 'post'>";
			echo "<input type='hidden' name='excluir' value='1' />";
			echo "<input type='hidden' name='id' value='" . $pessoa ["id"] . "' />";
			echo "<input type='submit' value = '' style = 'background-image:url(img/hr.gif);repeat-x:no-repeat;width:20px;cursor:pointer;' title = 'clique para excluir'/>";
			echo "</form></td>";
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	}
}

include "footer.php";

?>