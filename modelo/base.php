<?php
class base{
	public function conectarBD(){
		$con=mysqli_connect("localhost","id17255821_utn","My_utn_2021_Progra","id17255821_abarrotes")or die ("Problemas con la conexión a la base de datos");
		return $con;
	}
	public function desconectarBD(){
		mysqli_close($this->conectarBD());
	}
}
?>
