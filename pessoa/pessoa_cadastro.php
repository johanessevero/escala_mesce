

<?php
include "../template/header.php";
include "pessoa_bd.php";

monta_form_cadastro ();
incluir ();
excluir ();
editar ();
listar ();

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
	echo "<input type='submit' class='form_submit' value='Salvar' title = 'clique para salvar'>";
	echo "</div>";
	echo "<div class='clear'></div>";
	echo "</div>";
	echo "</div>";
	echo "</form>";
}
function incluir() {
	if (! empty ( $_POST ["nome"] ) & ! empty ( $_POST ["email"] ) & ! empty ( $_POST ["incluir"] )) {
		inserir_pessoa ( $_POST ["nome"], $_POST ["email"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_POST ["incluir"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir um nome e um e-mail.</span>";
		}
	}
}
function editar() {
	if (! empty ( $_POST ["nome"] ) & ! empty ( $_POST ["email"] ) & ! empty ( $_POST ["editar"] )) {
		editar_pessoa ( $_POST ["id"], $_POST ["nome"], $_POST ["email"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_POST ["editar"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir um nome e um e-mail.</span>";
		}
	}
}
function excluir() {
	if (! empty ( $_POST ["id"] ) & ! empty ( $_POST ["excluir"] )) {
		
		$grupos = get_grupos_pessoa ( $_POST ["id"] );
		if (count($grupos) > 0) {
			
			echo "<span class = 'notification n-error'>A pessoa não pode ser removida pois está inserida nos seguinte(s) grupo(s):";
			echo "<ul>";
			foreach ($grupos as $grupo) {
				echo "<li>".$grupo["nome"]."</li>";
			}
			echo "</ul>";
			echo "Vá em \"Gerenciar grupos\" e localize esse(s) grupos para retirar as pessoas.</span>";
		} else {
			excluir_pessoa ( $_POST ["id"] );
			echo "<span class = 'notification n-success'>Pessoa removida.</span>";
		}
	}
}
function listar() {
	$pessoas = pesquisar_pessoas ();
	
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
			echo "<td><form action = 'pessoa_edicao.php' method = 'post'>";
			echo "<input type='hidden' name='editar' value='1' />";
			echo "<input type='hidden' name='id' value='" . $pessoa ["id"] . "' />";
			echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/edit.png);repeat-x:no-repeat;width:20px;cursor:pointer;' title = 'clique para editar'/>";
			echo "</form></td>";
			echo "<td>";
			echo "<form method = 'post'>";
			echo "<input type='hidden' name='excluir' value='1' />";
			echo "<input type='hidden' name='id' value='" . $pessoa ["id"] . "' />";
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