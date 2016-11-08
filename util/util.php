<?php 

function get_data($data) {
	
	$data_ = explode("-",$data);
	
	$dia = $data_[2];
	$mes = $data_[1];
	$ano = $data_[0];
	
	return $dia."/".$mes."/".$ano;
	
}

?>

