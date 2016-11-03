

<?php
include "header.php";
include "init.php";
?>

<form action = 'configuracao_escala.php'>
	<div class="table">
		<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left">
		<img src="img/bg-th-right.gif" width="7" height="7" alt=""
			class="right">
		<table class="listing form" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<th class="full" colspan="2"></th>
				</tr>
				<tr>
					<td class="first" width="172"><strong>Mês</strong></td>
					<td class="last"><select name="mes">
			 <?php
				for($i = 2; $i <= 13; ++ $i) {
					
					$mes = date ( "F", mktime ( 0, 0, 0, $i, 0, date ( "Y" ) ) );
					
					echo "<option value = '" . $i . "'>" . $mes . "</option>";
				}
				
				?>
				</select></td>
				</tr>
				<tr class="bg">
					<td class="first"><strong></strong></td>
					<td class="last"><input type="submit"
						value="Nova configuração de escala" /></td>
				</tr>
			</tbody>
		</table>
		<p>&nbsp;</p>
	</div>
</form>


</body>

</html>