

<?php

include "../template/header.php";
?>

<form action='configuracao_escala.php'>
	<h2>Escolha do mês</h2>
	<div id="tab1" class="tabcontent">
		<div class="form">
			<div class="form_row">
				<label>Mês:</label> <select class="form_select" name="mes">
			 <?php
				for($i = 2; $i <= 13; ++ $i) {
					
					$mes = date ( "F", mktime ( 0, 0, 0, $i, 0, date ( "Y" ) ) );
					
					echo "<option value = '" . $i . "'>" . $mes . "</option>";
				}
				
				?>
				 </select>
				<div class="clear"></div><br/>
				<div class="form_row">
					<input type="submit" class="form_submit" value="Nova configuração">
				</div>
				<div class="clear"></div>
			</div>
			<br /><br /><br /><br /><br />
		</div>
	</div>

</form>

<?php include "../template/footer.php"?>