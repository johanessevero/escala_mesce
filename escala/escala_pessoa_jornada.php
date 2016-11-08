<?php
include "../template/header.php";
include "escala_bd.php";
include "../pessoa/pessoa_bd.php";
include "../jornada/jornada_bd.php";
include "../grupo/grupo_bd.php";
?>

<?php

inserir ();
excluir ();
listar_pessoas ( $_POST ["grupo_id"] );

?>

<?php
function inserir() {
	if (! empty ( $_POST ["adicionar_pessoa"] )) {
		
		if (! inserir_pessoa_escala_jornada ( $_POST ["pessoa_id"], $_POST ["escala_id"], $_POST ["jornada_id"], $_POST ["dia"], $_POST ["mes"], $_POST ["ano"] ))
			echo "<span class = 'notification n-error'>Não foi possível adicionar a pessoa.</span>";
		else
			echo "<span class = 'notification n-success'>Pessoa adicionada.</span>";
	}
}
function excluir() {
	if (! empty ( $_POST ["excluir_pessoa"] )) {
		
		if (! excluir_pessoa_escala_jornada ( $_POST ["pessoa_id"], $_POST ["escala_id"], $_POST ["jornada_id"], $_POST ["dia"], $_POST ["mes"], $_POST ["ano"] ))
			echo "<span class = 'notification n-error'>Não foi possível remover a pessoa.</span>";
		else
			echo "<span class = 'notification n-success'>Pessoa removida.</span>";
	}
}
function listar_pessoas($grupo_id) {
	$grupo = get_grupo_por_id ( $grupo_id );
	$pessoas = get_pessoas_grupo ( $grupo_id );
	
	echo "<form action = 'escala_montagem.php' method = 'post'>";
	echo "<input type='hidden' name='escala_id' value='" . $_POST ["escala_id"] . "' />";
	echo "<input type='submit' class = 'form_submit' value = 'Voltar' title = 'clique para voltar'/>";
	echo "</form>";
	
	if (count ( $pessoas ) > 0) {
		
		$jornada = get_jornada_por_id ( $_POST ["jornada_id"] );
		
		echo "</tr>";
		echo "<h2>Pessoas - selecione as pessoas do grupo " . $grupo ["nome"] . " que deseja escalar na jornada de " . $jornada ["hora_inicio"] . " - " . $jornada ["hora_fim"] . "</h2>";
		echo "<table id='rounded-corner'>";
		echo "<thead>";
		
		echo "<tr>";
		echo "<th>Nome</th>";
		echo "<th>Email</th>";
		echo "<th>Adicionar/remover</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tfoot>";
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
			echo "<form action = 'escala_pessoa_jornada.php' method = 'post'>";
			echo "<input type='hidden' name='pessoa_id' value='" . $pessoa ["id"] . "' />";
			echo "<input type='hidden' name='escala_id' value='" . $_POST ["escala_id"] . "' />";
			echo "<input type='hidden' name='jornada_id' value='" . $_POST ["jornada_id"] . "' />";
			echo "<input type='hidden' name='grupo_id' value='" . $_POST ["grupo_id"] . "' />";
			echo "<input type='hidden' name='dia' value='" . $_POST ["dia"] . "' />";
			echo "<input type='hidden' name='mes' value='" . $_POST ["mes"] . "' />";
			echo "<input type='hidden' name='ano' value='" . $_POST ["ano"] . "' />";
			if (! empty ( get_pessoa_escala_jornada ( $pessoa ["id"], $_POST ["escala_id"], $_POST ["jornada_id"], $_POST ["dia"], $_POST ["mes"], $_POST ["ano"] ) )) {
				echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/minus-circle.gif);repeat-x:no-repeat;width:20px;height:20px;cursor:pointer;' title = 'clique para remover a pessoa'/>";
				echo "<input type='hidden' name='excluir_pessoa' value='1' />";
			} else {
				echo "<input type='submit' value = '' style = 'background-image:url(../resources/img/tick-circle.gif);repeat-x:no-repeat;width:20px;height:20px;cursor:pointer;' title = 'clique para adicionar a pessoa'/>";
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


?>