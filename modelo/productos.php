<?php
class claseProductos{

	public function insertarProducto($nombre,$des,$precio,$categoria,$cant,$base){
		
		$registro=mysqli_query($base->conectarBD(),"SELECT * from productos where nombre_pro='$nombre'") or die(mysqli_error($base->conectarBD()));
		if ($reg=mysqli_fetch_array($registro)){
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Ya se encuentra registrado un producto con ese nombre.");
                window.location.href="nuevoProducto.php";
                </script>';
		}
		else{
			$foto=$this->subirFoto();
			mysqli_query($base->conectarBD(),"INSERT INTO productos(nombre_pro,descripcion,precio,imagen,cantidad,id_cat)values('$nombre','$des','$precio','$foto','$cant','$categoria')")or die ("Problemas en el insert".mysql_error($base->conectarBD()));
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Producto agregado de manera exitosa.");
                window.location.href="productos.php";
                </script>';
		}
	}


	public function listarProductos($base){
		$registros=mysqli_query($base->conectarBD(),"SELECT * from productos WHERE cantidad>0 ORDER BY nombre_pro")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}

	public function listarProductosCategoria($n_cat,$base){
		$registros=mysqli_query($base->conectarBD(),"SELECT * from productos WHERE cantidad>0 AND id_cat = '$n_cat' ORDER BY nombre_pro")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}

	public function datosProducto($cve,$base){
		$registros=mysqli_query($base->conectarBD(),"SELECT * from productos WHERE id_pro = '$cve'")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}

	public function actualizaProducto($cve,$nombre,$des,$precio,$categoria,$cant,$base){
		$registro=mysqli_query($base->conectarBD(),"SELECT * from productos where nombre_pro='$nombre' AND id_pro != '$cve'") or die("error al conectar");
		$row_cnt = mysqli_num_rows($registro);
		if ($row_cnt>0){
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Ya se encuentra registrado un producto con ese nombre.");
                window.location.href="nuevoProducto.php";
                </script>';
		}else{
			$this->actualizaFoto($cve,$base);
			mysqli_query($base->conectarBD(),"UPDATE productos SET nombre_pro='$nombre', descripcion='$des', precio='$precio', cantidad='$cant', id_cat='$categoria' where id_pro='$cve'");
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Producto modificado.");
                window.location.href="productos.php";
                </script>';
		}
	}

	public function eliminaProducto($cve,$base){
		$this->eliminaFoto($cve,$base);
		mysqli_query($base->conectarBD(),"DELETE from productos where id_pro='$cve'") or
		die(mysqli_error($base->conectarBD()));
		echo '<script type="text/javascript">
                alert("Producto eliminado.");
                window.location.href="productos.php";
                </script>';
	}
	
	public function subirFoto(){
		if(isset($_FILES['foto'])){ 
		     $tipoArchivo = $_FILES['foto']['type'];
		     switch($tipoArchivo) {
	                case 'image/png':
	                   $ex=".png";
	                   break;
	                case 'image/jpeg':
	                   $ex=".jpg";
	                   break;
	            }
		     if($_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/png"){
			     	$nuevoNombre=time().$ex;
		            $ruta_del_archivo = 'vista/fotos/'.$nuevoNombre;
		     		if(move_uploaded_file($_FILES['foto']['tmp_name'],$ruta_del_archivo)){
		     			return $foto=$nuevoNombre;
		            }else{
		            	$foto="noDis.jpg";
		            }
		     }
		}else{
			$foto="noDis.jpg";
		}
	        return $foto;
	}

	public function actualizaFoto($cve,$base){
		if(isset($_FILES['foto'])){ 
		     $tipoArchivo = $_FILES['foto']['type'];
		     switch($tipoArchivo) {
	                case 'image/png':
	                   $ex=".png";
	                   break;
	                case 'image/jpeg':
	                   $ex=".jpg";
	                   break;
	            }
		     if($_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/png"){
			     	$nuevoNombre=time().$ex;
		            $ruta_del_archivo = 'vista/fotos/'.$nuevoNombre;
		     		if(move_uploaded_file($_FILES['foto']['tmp_name'],$ruta_del_archivo)){
		     			$foto=$nuevoNombre;
		     			$this->eliminaFoto($cve,$base);
			            mysqli_query($base->conectarBD(),"UPDATE productos set imagen='$foto' where id_pro='$cve'");
						$base->desconectarBD();
		            }else{

		            }
		     }
		}else{
			
		}
	}
	public function eliminaFoto($cve,$base){
		$foto=mysqli_query($base->conectarBD(),"SELECT imagen from productos WHERE id_pro='$cve'")or die(mysqli_error($base->conectarBD()));
			if ($tem=mysqli_fetch_array($foto)){
				$vT="vista/fotos/".$tem['imagen'];
				unlink("$vT");
			}
	}
	public function listarCategoria($base){
		$registros=mysqli_query($base->conectarBD(),"SELECT * from categoria")or die(mysqli_error($base->conectarBD()));
		
		$base->desconectarBD();
		return $registros;
	}
	public function buscarProducto($buscar,$base){
		$registros=mysqli_query($base->conectarBD(),"SELECT P.*, C.nombre_cat from productos P, categoria C WHERE P.id_cat = C.id_cat AND cantidad>0 AND (nombre_pro LIKE '%$buscar%' OR nombre_cat LIKE '%$buscar%')" )or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}

	public function catalogoCategorias($base){
		$registros=mysqli_query($base->conectarBD(),"SELECT COUNT(p.id_pro), p.id_cat, c.nombre_cat from productos p, categoria c WHERE p.id_cat = c.id_cat AND cantidad>0 GROUP BY p.id_cat" )or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}

}
?>