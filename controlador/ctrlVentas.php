<?php
	include_once "modelo/ventas.php";
	include_once "modelo/base.php";
	
	class ControlVentas{

		function registraVenta($usu,$fecha,$t_compra,$t_pago,$arreglo){
			$base=new base();
			$ventas=new claseVentas();
			$ventas->registraVenta($usu,$fecha,$t_compra,$t_pago,$arreglo,$base);
		}
		function muestraDetalles($cveVenta){
			$base=new base();
			$ventas=new claseVentas();
			$registros=$ventas->consultaProductosVenta($cveVenta,$base);
			while ($reg=mysqli_fetch_array($registros)){
				echo '<tr><td>'.$reg[6].'</td>';
				echo '<td>'.$reg[3].'</td>';
				echo '<td>$'.$reg[5].'</td></tr>';
			}
		}
		function muestraTotal($cveVenta){
			$base=new base();
			$ventas=new claseVentas();
			$registros=$ventas->consultaTotalVenta($cveVenta,$base);
			while ($reg=mysqli_fetch_array($registros)){
				echo '<tr>
						<td><b>Fecha:</b> '.$reg[3].'</td>
						<th colspan="2">
							Total de la compra: $'.$reg[2].'
						</th>
					</tr>';
			}
		}
		function muestraCompras($usu){
			$base=new base();
			$ventas=new claseVentas();
			$registros=$ventas->consultaComprasUsu($usu,$base);
			while ($reg=mysqli_fetch_array($registros)){
				if($reg[4]==1){
					$tipoVenta="Contra-Entrega";
				}else if($reg[4]==2){
					$tipoVenta="Apartado";
				}else if($reg[4]==3){
					$tipoVenta="PayPal";
				}
				if($reg[5]==1){
					$situacion="Pendiente";
				}else if($reg[5]==2){
					$situacion="Completado";
				}else if($reg[5]==3){
					$situacion="Cancelada";
				}
				echo '<tr><td>'.$reg[3].'</td>';
				echo '<td>$'.$reg[2].'</td>';
				echo '<td>'.$tipoVenta.'</td>';
				echo '<td>'.$situacion.'</td>';
				echo "<td><form action='detallesVenta.php' method='POST'><input type='hidden' value='$reg[0]' id='cveVenta' name='cveVenta'><button class='btn btn-outline-warning' type='submit'><i class='bi bi-card-checklist'></i> Ver</button></form></td></tr>";
			}
		}

		function muestraPendientes(){
			$base=new base();
			$ventas=new claseVentas();
			$registros=$ventas->consultaPendientes($base);
			while ($reg=mysqli_fetch_array($registros)){
				if($reg[4]==1){
					$tipoVenta="Contra-Entrega";
				}else if($reg[4]==2){
					$tipoVenta="Apartado";
				}else if($reg[4]==3){
					$tipoVenta="PayPal";
				}
				echo '<tr>';
				echo '<td>'.$reg[0].'</td>';
				echo '<td>'.$reg[7].'</td>';
				echo '<td>'.$reg[9].'</td>';
				echo '<td>'.$reg[8].'</td>';
				echo '<td>'.$reg[3].'</td>';
				echo '<td>$'.$reg[2].'</td>';
				echo '<td>'.$tipoVenta.'</td>';
				echo "<td><form action='detalles.php' method='POST'><input type='hidden' value='$reg[0]' id='cveVenta' name='cveVenta'><button class='btn btn-info' type='submit'><i class='bi bi-card-checklist'></i> Ver</button></td></form>";
				echo "<td><form action='cancelar.php' method='POST' onsubmit='return cancelada();'><input type='hidden' value='$reg[0]' id='cveVenta' name='cveVenta'><button class='btn btn-danger' type='submit'><i class='bi bi-x-octagon-fill'></i></button></form></td>";
				echo "<td><form action='concluir.php' method='POST' onsubmit='return concluir();'><input type='hidden' value='$reg[0]' id='cveVenta' name='cveVenta'><button class='btn btn-success' type='submit'><i class='bi bi-check-lg'></i></button></form></td>";
				echo '</tr>';
			}
		}

		function muestraRealizadas(){
			$base=new base();
			$ventas=new claseVentas();
			$registros=$ventas->consultaRealizadas($base);
			while ($reg=mysqli_fetch_array($registros)){
				if($reg[4]==1){
					$tipoVenta="Contra-Entrega";
				}else if($reg[4]==2){
					$tipoVenta="Apartado";
				}else if($reg[4]==3){
					$tipoVenta="PayPal";
				}
				echo '<tr>';
				echo '<td>'.$reg[0].'</td>';
				echo '<td>'.$reg[7].'</td>';
				echo '<td>'.$reg[9].'</td>';
				echo '<td>'.$reg[8].'</td>';
				echo '<td>'.$reg[3].'</td>';
				echo '<td>$'.$reg[2].'</td>';
				echo '<td>'.$tipoVenta.'</td>';
				echo "<td><form action='detalles.php' method='POST'><input type='hidden' value='$reg[0]' id='cveVenta' name='cveVenta'><button class='btn btn-info' type='submit'><i class='bi bi-card-checklist'></i> Ver</button></td></form>";
				echo '</tr>';
			}
		}

		function muestraCanceladas(){
			$base=new base();
			$ventas=new claseVentas();
			$registros=$ventas->consultaCanceladas($base);
			while ($reg=mysqli_fetch_array($registros)){
				if($reg[4]==1){
					$tipoVenta="Contra-Entrega";
				}else if($reg[4]==2){
					$tipoVenta="Apartado";
				}else if($reg[4]==3){
					$tipoVenta="PayPal";
				}
				echo '<tr>';
				echo '<td>'.$reg[0].'</td>';
				echo '<td>'.$reg[7].'</td>';
				echo '<td>'.$reg[9].'</td>';
				echo '<td>'.$reg[8].'</td>';
				echo '<td>'.$reg[3].'</td>';
				echo '<td>$'.$reg[2].'</td>';
				echo '<td>'.$tipoVenta.'</td>';
				echo "<td><form action='detalles.php' method='POST'><input type='hidden' value='$reg[0]' id='cveVenta' name='cveVenta'><button class='btn btn-info' type='submit'><i class='bi bi-card-checklist'></i> Ver</button></td></form>";
				echo '</tr>';
			}
		}

		function concluyeVenta($cveVenta){
			$base=new base();
			$ventas=new claseVentas();
			$ventas->concluyeVenta($cveVenta,$base);
		}
		function cancelarVenta($cveVenta){
			$base=new base();
			$ventas=new claseVentas();
			$ventas->cancelarVenta($cveVenta,$base);
		}
	}

?>