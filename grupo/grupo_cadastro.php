

<?php
include "../template/header.php";
include "grupo_bd.php";


monta_form_cadastro ();
inserir ();
excluir ();
editar_pessoa();
listar ();

?>

<?php
function monta_form_cadastro() {
	echo "<h2>Informações do grupo</h2>";
	echo "<form method = 'post'>";
	echo "<div id='tab1' class='tabcontent' style='display: block;'>";
	echo "<div class='form'>";
	
	echo "<div class='form_row'>";
	echo "<label>Nome:</label> <input type='text' name = 'nome' class='form_input' >";
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
function inserir() {
	if (! empty ( $_POST ["nome"] ) & ! empty ( $_POST ["incluir"] )) {
		inserir_grupo ( $_POST ["nome"]);
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_POST ["incluir"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir um nome.</span>";
		}
	}
}
function editar_pessoa() {
	if (! empty ( $_POST ["nome"] ) & ! empty ( $_POST ["editar"] )) {
		editar_grupo ( $_POST ["id"], $_POST ["nome"] );
		echo "<span class = 'notification n-success'>Dados salvos.</span>";
	} else {
		if (isset ( $_POST ["editar"] )) {
			echo "<span class = 'notification n-error'>É preciso inserir um nome.</span>";
		}
	}
}

function adicionar_pessoas_grupo() {
	
	
	
}

function excluir() {
	if (! empty ( $_POST ["id"] ) & ! empty ( $_POST ["excluir"] )) {
		
		excluir_pessoas_grupo ( $_POST ["id"] );
		excluir_grupo ( $_POST ["id"] );
		echo "<span class = 'notification n-success'>Grupo removido.</span>";
	}
}
function listar() {
	$grupos = pesquisar_grupos ();
	
	if (count ( $grupos ) > 0) {
		echo "<h2>Grupos</h2>";
		echo "<table id='rounded-corner'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Nome</th>";
		echo "<th>Nº de pessoas no grupo</th>";
		echo "<th>Pessoas do grupo</th>";
		echo "<th></th>";
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
		foreach ( $grupos as $grupo ) {
			
			if ($cont ++ % 2 == 0)
				echo "<tr class='odd'>";
			else
				echo "<tr class='even'>";
			echo "<td>" . $grupo ["nome"] . "</td>";
			echo "<td>".get_num_pessoas_grupo($grupo["id"])."</td>";
			monta_html_select_pessoas($grupo);
			echo "<td><form action = 'grupo_edicao.php' method = 'post'>";
			echo "<input type='hidden' name='editar' value='1' />";
			echo "<input type='hidden' name='id' value='" . $grupo ["id"] . "' />";
			echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/edit.png);repeat-x:no-repeat;width:20px;cursor:pointer;' title = 'clique para editar'/>";
			echo "</form></td>";
			echo "<td>";
			echo "<form method = 'post'>";
			echo "<input type='hidden' name='excluir' value='1' />";
			echo "<input type='hidden' name='id' value='" . $grupo ["id"] . "' />";
			echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/trash.gif);repeat-x:no-repeat;width:20px;cursor:pointer;' title = 'clique para excluir'/>";
			echo "</form>";
			
			echo "</td>";
			echo "<td>";
			echo "<form action = 'grupo_pessoa.php' method = 'post'>";
			echo "<input type='hidden' name='grupo_id' value='" . $grupo ["id"] . "' />";
			echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/people.png);repeat-x:no-repeat;width:34px;height:34px;cursor:pointer;' title = 'clique para adicionar/remover pessoas ao grupo'/>";
			echo "</form>";
				
			echo "</td>";
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	}
}

function monta_html_select_pessoas($grupo) {

	$pessoas = get_pessoas_grupo($grupo["id"]);
	
	echo "<td><select class = 'form_select_1'>";

	for($i = 0; $i < count ( $pessoas ); ++ $i) {

		echo "<option value = '" . $pessoas [$i]["id"] . "'>" . $pessoas [$i]["nome"] . "</option>";
	}
	echo "</select></td>";
}

include "../template/footer.php";

?>