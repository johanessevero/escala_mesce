<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>CADASTRO DE PESSOAS</title>
</head>

<body>

<?php include "init.php";?>

	<div>
		<form>

			<fieldset>
				<legend>Cadastro de pessoas</legend>
				<label>Nome: <input type="text" name="nome">
				</label> <input type="submit" value="Salvar" />
			</fieldset>

		</form>
	</div>
	<br />
	
	
	<?php
	
	echo "<table border = '1'>";
	echo "<th>Nome</th>";
	monta_html_listagem_pessoas ();
	
	echo "</table>"?>


</body>

</html>

<?php
function monta_html_listagem_pessoas() {
	if (isset ( $_GET ["nome"] )) {
		
		$_SESSION ["pessoas"] [] = $_GET ["nome"];
	}
	
	if (isset ( $_SESSION ["pessoas"] )) {
		
		$cont = 0;
		foreach ( $_SESSION ["pessoas"] as $pessoa ) {
			
			echo "<tr><td>" . $pessoa . "</td></tr>";
		}
	}
}

?>