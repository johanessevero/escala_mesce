<?php
include "../template/header.php";
include "grupo_bd.php";
include "../pessoa/pessoa_bd.php";

?>

<?php

$grupo = get_grupo_por_id ( $_GET ["grupo_id"] );

inserir ( $grupo );
excluir ( $grupo );
listar_pessoas ( $grupo );

?>

<?php
function inserir($grupo) {
	if (! empty ( $_GET ["adicionar_pessoa"] )) {
		
		inserir_pessoa_grupo ( $_GET ["pessoa_id"], $grupo ["id"] );
		echo "<span class = 'notification n-success'>Pessoa adicionada.</span>";
	}
}
function excluir($grupo) {
	if (! empty ( $_GET ["excluir_pessoa"] )) {
		
		excluir_pessoa_grupo ( $_GET ["pessoa_id"], $grupo ["id"] );
		echo "<span class = 'notification n-success'>Pessoa removida.</span>";
	}
}
function listar_pessoas($grupo) {
	$pessoas = get_pessoas ();
	
	echo "<form action = 'grupo_cadastro.php' method = 'GET'>";
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
			
			echo "<input type='hidden' name='grupo_id' value='" . $grupo ["id"] . "' />";
			echo "<input type='hidden' name='pessoa_id' value='" . $pessoa ["id"] . "' />";
			if (! empty ( get_pessoa_grupo ( $pessoa ["id"], $grupo ["id"] ) )) {
				echo "<a href = 'grupo_pessoa.php?grupo_id=" . $grupo ["id"] . "&pessoa_id=" . $pessoa ["id"] . "&excluir_pessoa=1'><img src = '../resources/img/minus-circle.gif'></a>";
			} else {
				echo "<a href = 'grupo_pessoa.php?grupo_id=" . $grupo ["id"] . "&pessoa_id=" . $pessoa ["id"] . "&adicionar_pessoa=1'><img src = '../resources/img/tick-circle.gif'></a>";
			}
			
			echo "</td>";
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	}
}

include "../template/footer.php";

?>