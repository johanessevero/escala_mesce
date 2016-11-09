

<?php
include "../template/header.php";
include "grupo_bd.php";


inserir ();
excluir ();
editar_pessoa();
monta_form_cadastro ();
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
	$grupos = get_grupos ();
	
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
			echo "<td>";
			echo "<a href = 'grupo_edicao.php?id=".$grupo["id"]."&editar=1' title = 'clique para alterar'/><img src = '../resources/img/edit.png'/></a>";
			echo "<td>";
			echo "<a href = 'grupo_cadastro.php?id=".$grupo["id"]."&excluir=1' title = 'clique para excluir'><img src = '../resources/img/trash.gif'></a>";
			echo "</td>";
			echo "<td>";
			echo "<a href = 'grupo_pessoa.php?grupo_id=".$grupo["id"]."' title = 'clique para adiconar pessoas ao grupo'><img src = '../resources/img/people.png'></a>";
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