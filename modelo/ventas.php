<?php
class claseVentas{

	function registraVenta($usu,$fecha,$t_compra,$t_pago,$arreglo,$base){
		$conexion = $base->conectarBD();
		$conexion -> query("INSERT INTO ventas(id_us,total,fecha,tipo,situacion) values('$usu','$t_compra','$fecha','$t_pago','1')")or die ($conexion->error);
		$id_venta = $conexion->insert_id;
		for($i=0;$i<count($arreglo);$i++){
			$idPro = $arreglo[$i]['idPro'];
			$cantidad = $arreglo[$i]['cantidad'];
			$precio = $arreglo[$i]['precio'];
			$sub = $arreglo[$i]['precio']*$arreglo[$i]['cantidad'];
			mysqli_query($base->conectarBD(),"INSERT INTO productos_venta(id_venta,id_producto,cantidad,precio,subtotal)values('$id_venta','$idPro','$cantidad','$precio','$sub');")or die ("Problemas en el insert".mysql_error($base->conectarBD()));
			mysqli_query($base->conectarBD(),"UPDATE productos set cantidad=cantidad-'$cantidad' where id_pro='$idPro'");
        }
		$base->desconectarBD();
		unset($_SESSION['carrito']);
		header("location:gracias.php");
	}
	function consultaComprasUsu($usu,$base){
		$registros=mysqli_query($base->conectarBD(),"SELECT * from ventas WHERE id_us='$usu'")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}
	function consultaProductosVenta($cveVenta,$base){
		$registros=mysqli_query($base->conectarBD(),"SELECT pv.*,p.nombre_pro from productos_venta pv, productos p WHERE id_venta='$cveVenta' AND pv.id_producto=p.id_pro")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}
	function consultaVenta($cveVenta,$base){
		$registros=mysqli_query($base->conectarBD(),"SELECT * from productos_venta WHERE id_venta='$cveVenta'")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}
	function consultaTotalVenta($cveVenta,$base){
		$registros=mysqli_query($base->conectarBD(),"SELECT * from ventas WHERE id_venta='$cveVenta'")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}
	function consultaPendientes($base){
		$registros=mysqli_query($base->conectarBD(),"SELECT v.*, u.* from ventas v, usuario u WHERE situacion=1 AND u.id_us=v.id_us")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}

	function consultaRealizadas($base){
		$registros=mysqli_query($base->conectarBD(),"SELECT v.*, u.* from ventas v, usuario u WHERE situacion=2 AND u.id_us=v.id_us")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}
	function consultaCanceladas($base){
		$registros=mysqli_query($base->conectarBD(),"SELECT v.*, u.* from ventas v, usuario u WHERE situacion=3 AND u.id_us=v.id_us")or die(mysqli_error($base->conectarBD()));
		$base->desconectarBD();
		return $registros;
	}
	function concluyeVenta($cveVenta,$base){
		mysqli_query($base->conectarBD(),"UPDATE ventas set situacion=2 where id_venta='$cveVenta'");
		$base->desconectarBD();
		echo '<script type="text/javascript">
                alert("Venta realizada.");
                window.location.href="ventas.php";
                </script>';
	}

	function cancelarVenta($cveVenta,$base){
		mysqli_query($base->conectarBD(),"UPDATE ventas set situacion=3 where id_venta='$cveVenta'");
		$registros = mysqli_query($base->conectarBD(),"SELECT * from productos_venta WHERE id_venta='$cveVenta'")or die(mysqli_error($base->conectarBD()));
		while ($reg=mysqli_fetch_array($registros)){
			$idPro = $reg[2];
			$cantidad = $reg[3];
			mysqli_query($base->conectarBD(),"UPDATE productos set cantidad=cantidad+'$cantidad' where id_pro='$idPro'");
		}
		$base->desconectarBD();
		echo '<script type="text/javascript">
                alert("Venta cancelada, los productos se añadiran al inventario.");
                window.location.href="ventas.php";
                </script>';
	}
}
?>