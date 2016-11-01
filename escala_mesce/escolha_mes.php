<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ESCOLHA MÊS</title>
</head>

<body>

<?php include "init.php";?>

	<div>
		<form action = 'configuracao_escala.php'>
			<fieldset>
				<legend>Escolha um mês</legend>
				Mês: <select name = "mes">
			 <?php
				for($i = 2; $i <= 13; ++ $i) {
					
					$mes = date ( "F", mktime ( 0, 0, 0, $i, 0, date ( "Y" ) ) );
					
					echo "<option value = '" . $i . "'>" . $mes . "</option>";
				}
				
				?>
				</select> 
				<input type="submit" value="Nova configuração" />
			</fieldset>
		</form>
	</div>


</body>

</html>