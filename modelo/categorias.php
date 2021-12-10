<?php
class claseCategorias{

	public function insertarCategoria($nombre,$base){
		
		$registro=mysqli_query($base->conectarBD(),"SELECT * from categoria where nombre_cat='$nombre'") or die(mysqli_error($base->conectarBD()));
		if ($reg=mysqli_fetch_array($registro)){
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Ya se encuentra registrada una categoria con ese nombre.");
                window.location.href="nuevaCategoria.php";
                </script>';
		}
		else{
			mysqli_query($base->conectarBD(),"INSERT INTO categoria(nombre_cat
)values('$nombre')")or die ("Problemas en el insert".mysql_error($base->conectarBD()));
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Categoria registrada.");
                window.location.href="categorias.php";
                </script>';
		}
	}


	public function listarCategoria($base){
		$registros=mysqli_query($base->conectarBD(),"SELECT * from categoria ORDER BY nombre_cat")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}

	public function datosCategoria($cve,$base){
		$registros=mysqli_query($base->conectarBD(),"SELECT * from categoria WHERE id_cat = '$cve'")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}

	public function actualizaCategoria($cve,$nombre,$base){
		$registro=mysqli_query($base->conectarBD(),"SELECT * from categoria where nombre_cat='$nombre' AND id_cat != '$cve'") or die("error al conectar");
		$row_cnt = mysqli_num_rows($registro);
		if ($row_cnt>0){
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Ya se encuentra registrada una categoria con ese nombre.");
                window.location.href="categorias.php";
                </script>';
		}else{
			mysqli_query($base->conectarBD(),"UPDATE categoria set nombre_cat='$nombre' where id_cat='$cve'");
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Categoria modificada.");
                window.location.href="categorias.php";
                </script>';
		}
	}

	public function eliminaCategoria($cve,$base){
		$registro=mysqli_query($base->conectarBD(),"SELECT * from productos where id_cat='$cve'") or die("error al conectar");
		$row_cnt = mysqli_num_rows($registro);
		if ($row_cnt>0){
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("No se puede eliminar debido a que esta asociada a un producto.");
                window.location.href="categorias.php";
                </script>';
		}else{
			mysqli_query($base->conectarBD(),"DELETE from categoria where id_cat='$cve'") or
			die(mysqli_error($base->conectarBD()));
			echo '<script type="text/javascript">
                alert("Categoria eliminada.");
                window.location.href="categorias.php";
                </script>';
		}
	}
	
}
?>