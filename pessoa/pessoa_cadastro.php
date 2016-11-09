

<?php
include "../template/header.php";
include "pessoa_bd.php";


incluir ();
excluir ();
editar ();
monta_form_cadastro ();
listar ();

?>

<?php
function monta_form_cadastro() {
	echo "<h2>Informações da pessoa</h2>";
	echo "<form method = 'GET'>";
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
	if (! empty ( $_GET ["nome"] ) & ! empty ( $_GET ["email"] ) & ! empty ( $_GET ["incluir"] )) {
		inserir_pessoa ( $_GET ["nome"], $_GET ["email"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_GET ["incluir"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir um nome e um e-mail.</span>";
		}
	}
}
function editar() {
	if (! empty ( $_GET ["nome"] ) & ! empty ( $_GET ["email"] ) & ! empty ( $_GET ["editar"] )) {
		editar_pessoa ( $_GET ["id"], $_GET ["nome"], $_GET ["email"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_GET ["editar"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir um nome e um e-mail.</span>";
		}
	}
}
function excluir() {
	if (! empty ( $_GET ["id"] ) & ! empty ( $_GET ["excluir"] )) {
		
		$grupos = get_grupos_pessoa ( $_GET ["id"] );
		if (count($grupos) > 0) {
			
			echo "<span class = 'notification n-error'>A pessoa não pode ser removida pois está inserida nos seguinte(s) grupo(s):";
			echo "<ul>";
			foreach ($grupos as $grupo) {
				echo "<li>".$grupo["nome"]."</li>";
			}
			echo "</ul>";
			echo "Vá em \"Grupos\" e localize esse(s) grupo(s) para retirar as pessoas.</span>";
		} else {
			excluir_pessoa ( $_GET ["id"] );
			echo "<span class = 'notification n-success'>Pessoa removida.</span>";
		}
	}
}
function listar() {
	$pessoas = get_pessoas ();
	
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
			echo "<td>";
			echo "<a href = 'pessoa_edicao.php?id=".$pessoa["id"]."&editar=1' title = 'clique para alterar'/><img src = '../resources/img/edit.png'/></a>";
			echo "<td>";
			echo "<a href = 'pessoa_cadastro.php?id=".$pessoa["id"]."&excluir=1' title = 'clique para excluir'><img src = '../resources/img/trash.gif'></a>";
			echo "</td>";
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	}
}

include "../template/footer.php";

?>