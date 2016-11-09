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
listar_pessoas ( $_GET ["grupo_id"] );

?>

<?php
function inserir() {
	if (! empty ( $_GET ["adicionar_pessoa"] )) {
		
		if (! inserir_pessoa_escala_jornada ( $_GET ["pessoa_id"], $_GET ["escala_id"], $_GET ["jornada_id"], $_GET ["dia"], $_GET ["mes"], $_GET ["ano"] ))
			echo "<span class = 'notification n-error'>Não foi possível adicionar a pessoa.</span>";
		else
			echo "<span class = 'notification n-success'>Pessoa adicionada.</span>";
	}
}
function excluir() {
	if (! empty ( $_GET ["excluir_pessoa"] )) {
		
		if (! excluir_pessoa_escala_jornada ( $_GET ["pessoa_id"], $_GET ["escala_id"], $_GET ["jornada_id"], $_GET ["dia"], $_GET ["mes"], $_GET ["ano"] ))
			echo "<span class = 'notification n-error'>Não foi possível remover a pessoa.</span>";
		else
			echo "<span class = 'notification n-success'>Pessoa removida.</span>";
	}
}
function listar_pessoas($grupo_id) {
	$grupo = get_grupo_por_id ( $grupo_id );
	$pessoas = get_pessoas_grupo ( $grupo_id );
	
	echo "<form action = 'escala_montagem.php' method = 'GET'>";
	echo "<input type='hidden' name='escala_id' value='" . $_GET ["escala_id"] . "' />";
	echo "<input type='submit' class = 'form_submit' value = 'Voltar' title = 'clique para voltar'/>";
	echo "</form>";
	
	if (count ( $pessoas ) > 0) {
		
		$jornada = get_jornada_por_id ( $_GET ["jornada_id"] );
		
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
			$link_add = "<a href = 'escala_pessoa_jornada.php?pessoa_id=" . $pessoa ["id"];
			$link_add .= "&escala_id=" . $_GET ["escala_id"];
			$link_add .= "&jornada_id=" . $_GET ["jornada_id"];
			$link_add .= "&grupo_id=" . $_GET ["grupo_id"];
			$link_add .= "&dia=" . $_GET ["dia"];
			$link_add .= "&mes=" . $_GET ["mes"];
			$link_add .= "&ano=" . $_GET ["ano"];
			if (! empty ( get_pessoa_escala_jornada ( $pessoa ["id"], $_GET ["escala_id"], $_GET ["jornada_id"], $_GET ["dia"], $_GET ["mes"], $_GET ["ano"] ) )) {
				$link_add .= "&excluir_pessoa=1' title = 'clique para alterar'/><img src = '../resources/img/minus-circle.gif'/></a></td>";
			} else {
				$link_add .= "&adicionar_pessoa=1' title = 'clique para alterar'/><img src = '../resources/img/tick-circle.gif'/></a></td>";
			}
			echo $link_add;
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