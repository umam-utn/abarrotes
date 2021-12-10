<?php
	include_once "modelo/categorias.php";
	include_once "modelo/base.php";
	
	class ControlCategoria{

		function insertarCategoria($nombre){
			$base=new base();
			$categorias=new claseCategorias();
			$categorias->insertarCategoria($nombre,$base);
		}

		function actualizaCategoria($cve,$nombre){
			$base=new base();
			$categorias=new claseCategorias();
			$categorias->actualizaCategoria($cve,$nombre,$base);
		}

		function eliminaCategoria($cve){
			$base=new base();
			$categorias=new claseCategorias();
			$categorias->eliminaCategoria($cve,$base);
		}

		function mostrarListaCategoria(){
			$categorias = new claseCategorias();
			$base = new base();
			$registros=$categorias->listarCategoria($base);

			while ($reg=mysqli_fetch_array($registros)){
				echo '<tr><td>'.$reg[0].'</td>';
				echo '<td>'.$reg[1].'</td>';
				echo "<td><form action='modificaCategoria.php' method='POST'><input type='hidden' value='$reg[0]' id='cve' name='cve'><button class='btn btn-outline-info' type='submit'>Modificar</button></form></td>";
				echo "<td><form action='eliminaCategoria.php' onsubmit='return eliminar();' method='POST'><input type='hidden' value='$reg[0]' id='cve' name='cve'><button class='btn btn-outline-warning' type='submit'>Eliminar</button></form></td></tr>";
			}
		}

		function mostrarEditaCategoria($cve){
			$categorias = new claseCategorias();
			$base = new base();
			$registros=$categorias->datosCategoria($cve,$base);

			while ($reg=mysqli_fetch_array($registros)){
				echo "<p>Nombre</p>";
				echo "<p><input class='form-control' type='text' name='nombre' minlength='3' maxlength='26' placeholder='Letras de la A a la Z y espacios máximo 25 caracteres.' pattern='[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+' required value='$reg[1]'></p>";
				echo "<p><input type='hidden' value='$reg[0]' id='clave' name='clave'></p>";
			}
		}

	}

?>