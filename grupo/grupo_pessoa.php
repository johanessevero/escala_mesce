<?php
include "../template/header.php";
include "grupo_bd.php";
include "../pessoa/pessoa_bd.php";

?>

<?php

$grupo = get_grupo_por_id ( $_POST ["grupo_id"] );

inserir ( $grupo );
excluir ( $grupo );
listar_pessoas ( $grupo );

?>

<?php
function inserir($grupo) {
	if (! empty ( $_POST ["adicionar_pessoa"] )) {
		
		inserir_pessoa_grupo ( $_POST ["pessoa_id"], $grupo ["id"] );
		echo "<span class = 'notification n-success'>Pessoa adicionada.</span>";
	}
}
function excluir($grupo) {
	if (! empty ( $_POST ["excluir_pessoa"] )) {
		
		excluir_pessoa_grupo ( $_POST ["pessoa_id"], $grupo ["id"] );
		echo "<span class = 'notification n-success'>Pessoa removida.</span>";
	}
}
function listar_pessoas($grupo) {
	$pessoas = get_pessoas ();
	
	echo "<form action = 'grupo_cadastro.php' method = 'post'>";
	echo "<input type='submit' class = 'form_submit' value = 'Voltar' title = 'clique para voltar'/>";
	echo "</form>";
	
	if (count ( $pessoas ) > 0) {
		echo "</tr>";
		echo "<h2>Pessoas - selecione as pessoas que você quer inserir/remover no grupo \"" . $grupo ["nome"] . "\" </h2>";
		echo "<table id='rounded-corner'>";
		echo "<thead>";
		
		echo "<tr>";
		echo "<th>Nome</th>";
		echo "<th>Email</th>";
		
		echo "<th></th>";
		echo "<th>Adicionar/remover</th>";
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
			echo "<td>" . "<input type = 'hidden' value = " . "adicionar_pessoas" . "/>" . "</td>";
			echo "<td>";
			echo "<form action = 'grupo_pessoa.php' method = 'post'>";
			echo "<input type='hidden' name='grupo_id' value='" . $grupo ["id"] . "' />";
			echo "<input type='hidden' name='pessoa_id' value='" . $pessoa ["id"] . "' />";
			if (! empty ( get_pessoa_grupo ( $pessoa ["id"], $grupo ["id"] ) )) {
				echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/minus-circle.gif);repeat-x:no-repeat;width:20px;height:20px;cursor:pointer;' title = 'clique para remover a pessoa ao grupo'/>";
				echo "<input type='hidden' name='excluir_pessoa' value='1' />";
			} else {
				echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/tick-circle.gif);repeat-x:no-repeat;width:20px;height:20px;cursor:pointer;' title = 'clique para adicionar a pessoa ao grupo'/>";
				echo "<input type='hidden' name='adicionar_pessoa' value='1' />";
			}
			echo "</form>";
			
			echo "</td>";
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	}
}

include "../template/footer.php";

?>