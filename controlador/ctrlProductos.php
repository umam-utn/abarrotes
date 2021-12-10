<?php
	include_once "modelo/productos.php";
	include_once "modelo/base.php";
	
	class ControlProducto{

		function insertarProducto($nombre,$des,$precio,$categoria,$cant){
			$base=new base();
			$productos=new claseProductos();
			$productos->insertarProducto($nombre,$des,$precio,$categoria,$cant,$base);
		}

		function actualizaProducto($cve,$nombre,$des,$precio,$categoria,$cant){
			$base=new base();
			$productos=new claseProductos();
			$productos->actualizaProducto($cve,$nombre,$des,$precio,$categoria,$cant,$base);
		}

		function eliminaProducto($cve){
			$base=new base();
			$productos=new claseProductos();
			$productos->eliminaProducto($cve,$base);
		}

		function mostrarListaProductos(){
			$base = new base();
			$productos=new claseProductos();
			$registros=$productos->listarProductos($base);

			while ($reg=mysqli_fetch_array($registros)){
				echo '<tr>';
				echo '<td>'.$reg[1].'</td>';
				echo '<td>'.$reg[2].'</td>';
				echo '<td>'.$reg[3].'</td>';
				echo '<td>'.$reg[5].'</td>';
				echo "<td><form action='modificaProducto.php' method='POST'><input type='hidden' value='$reg[0]' id='cve' name='cve'><button class='btn btn-outline-info' type='submit'>Modificar</button></form></td>";
				echo "<td><form action='eliminaProducto.php' onsubmit='return eliminar();' method='POST'><input type='hidden' value='$reg[0]' id='cve' name='cve'><button class='btn btn-outline-warning' type='submit'>Eliminar</button></form></td></tr>";
			}
		}

		function mostrarEditaProducto($cve){
			$base = new base();
			$productos=new claseProductos();
			$registros=$productos->datosProducto($cve,$base);

			while ($reg=mysqli_fetch_array($registros)){
				echo "<p>Nombre</p>
				<p><input class='form-control' type='text' name='nombre' minlength='3' maxlength='26' placeholder='Coca-Cola' pattern='[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+' required value='$reg[1]'></p>
				<div class='col-md-6'><p>Precio del producto</p>
				<p><input class='form-control' type='number' name='precio' min='1.00'step='0.50' required placeholder='$20.00' value='$reg[3]'></p></div>
				<div class='col-md-6'><p>Inventario</p>
				<p><input class='form-control' type='number' name='cantidad' min='1.00'step='1.00' required placeholder='1' value='$reg[5]'></p></div>
				<p>Categoría del producto</p>
				<p>"; 
				$this->selectCategoria2($reg[6]);
				echo "</p> 
				<p>Descripción</p>
				<p><textarea class='form-control' rows='4' name='descripcion' placeholder='Coca-cola de 250ml' required>$reg[2]</textarea></p>";
				echo "<p><input type='hidden' value='$reg[0]' id='clave' name='clave'></p>";
			}
		}
		function selectCategoria(){
			$base = new base();
			$productos=new claseProductos();
			$registros=$productos->listarCategoria($base);
			$x= '<select class="form-select" name="categoria" required><option disabled selected value>Selecione una opción</option>';
			while ($reg=mysqli_fetch_array($registros)){ 
				$x= $x.'<option value="'.$reg[0].'">'.$reg[1].'</option>'; 
			}
			$x=$x."</select>";
			echo $x;
		}
		function selectCategoria2($pro){
			$base = new base();
			$productos=new claseProductos();
			$registros=$productos->listarCategoria($base);
			$x= '<select class="form-select" name="categoria" required><option disabled selected value>Selecione una opción</option>';
			while ($reg=mysqli_fetch_array($registros)){ 
				$x= $x.'<option value="'.$reg[0].'" ';
				if ($pro == $reg[0]){
					$x= $x.'selected';
				}
				$x= $x.'>'.$reg[1].'</option>'; 
			}
			$x=$x."</select>";
			echo $x;
		}
		function buscarProducto($buscar){
			$base = new base();
			$productos=new claseProductos();
			$registros=$productos->buscarProducto($buscar,$base);

			while ($reg=mysqli_fetch_array($registros)){
				echo '<div class="card mb-3" style="width: 100%;">
				<div class="row g-0">
				  <div class="col-md-4">
					<img src="vista/fotos/'.$reg[4].'" class="img-fluid rounded-start" alt="...">
				  </div>
				  <div class="col-md-8">
					<div class="card-body">
					  <h5 class="card-title"><b>'.$reg[1].'</b></h5>
					  <p class="card-text">Precio: $'.$reg[3].'</p>
					  <p class="card-text">'.$reg[2].'</p>
					  <p class="card-text">Inventario: '.$reg[5].'</p>
					  <div class="d-grid gap-2 d-md-flex justify-content-md-end">';
				if(isset($_SESSION['rol'])){
					if(isset($_SESSION['carrito'])){
						$existe = false;
						$arreglo = $_SESSION['carrito'];
						for($i=0;$i<count($arreglo);$i++){
							if($arreglo[$i]['idPro']==$reg[0]){
								$existe = true;
							}
						}
						if($existe==true){
							echo '<form action="eliminarCarrito.php" onsubmit="return eliminar();" method="post"><input type="hidden" value="'.$reg[0].'" name="cvePro" id="cvePro"><button type="submit" class="btn btn-outline-danger"><i class="bi bi-cart-x-fill"></i> Eliminar del carrito</button></form>';
						}else{
							$cantMax=10;
							if($reg[5]<$cantMax){
								$cantMax = $reg[5];
							}
							echo	'<form action="carrito.php" method="post">';
							echo 'Cantidad: <select class="form-select" name="cantidad" id="cantidad">';
							for($i=1;$i<=$cantMax;$i++){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							echo '</select><br>';
							echo	'<input type="hidden" value="'.$reg[0].'" name="cvePro" id="cvePro"><button type="submit" class="btn btn-warning">Agregar a Carrito <i class="bi bi-cart-plus-fill"></i></button></form>';
						}
					}else{
						$cantMax=10;
							if($reg[5]<$cantMax){
							$cantMax = $reg[5];
						}
						echo	'<form action="carrito.php" method="post">';
						echo 'Cantidad: <select class="form-select" name="cantidad" id="cantidad">';
						for($i=1;$i<=$cantMax;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						echo '</select><br>';
						echo	'<input type="hidden" value="'.$reg[0].'" name="cvePro" id="cvePro"><button type="submit" class="btn btn-warning">Agregar a Carrito <i class="bi bi-cart-plus-fill"></i></button></form>';
					}
				}else{
					echo '<p class="card-text"><small class="text-muted">Para comprar o agregar al carrito <a href="login.php">inicia sesión.</a></small></p>';
				}echo	  '</div>
					</div>
				  </div>
				</div>
			  </div>';
			}
		}

		function catalogoProductos(){
			$base = new base();
			$productos=new claseProductos();
			$registros=$productos->listarProductos($base);

			while ($reg=mysqli_fetch_array($registros)){
				echo '<div class="card mb-3" style="width: 100%;">
				<div class="row g-0">
				  <div class="col-md-4">
					<img src="vista/fotos/'.$reg[4].'" class="img-fluid rounded-start" alt="...">
				  </div>
				  <div class="col-md-8">
					<div class="card-body">
					  <h5 class="card-title"><b>'.$reg[1].'</b></h5>
					  <p class="card-text">Precio: $'.$reg[3].'</p>
					  <p class="card-text">'.$reg[2].'</p>
					  <p class="card-text">Inventario: '.$reg[5].'</p>
					  <div class="d-grid gap-2 d-md-flex justify-content-md-end">';
				if(isset($_SESSION['rol'])){
					if(isset($_SESSION['carrito'])){
						$existe = false;
						$arreglo = $_SESSION['carrito'];
						for($i=0;$i<count($arreglo);$i++){
							if($arreglo[$i]['idPro']==$reg[0]){
								$existe = true;
							}
						}
						if($existe==true){
							echo '<form action="eliminarCarrito.php" onsubmit="return eliminar();" method="post"><input type="hidden" value="'.$reg[0].'" name="cvePro" id="cvePro"><button type="submit" class="btn btn-outline-danger"><i class="bi bi-cart-x-fill"></i> Eliminar del carrito</button></form>';
						}else{
							$cantMax=10;
							if($reg[5]<$cantMax){
								$cantMax = $reg[5];
							}
							echo	'<form action="carrito.php" method="post">';
							echo 'Cantidad: <select class="form-select" name="cantidad" id="cantidad">';
							for($i=1;$i<=$cantMax;$i++){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							echo '</select><br>';
							echo	'<input type="hidden" value="'.$reg[0].'" name="cvePro" id="cvePro"><button type="submit" class="btn btn-warning">Agregar a Carrito <i class="bi bi-cart-plus-fill"></i></button></form>';
						}
					}else{
						$cantMax=10;
							if($reg[5]<$cantMax){
							$cantMax = $reg[5];
						}
						echo	'<form action="carrito.php" method="post">';
						echo 'Cantidad: <select class="form-select" name="cantidad" id="cantidad">';
						for($i=1;$i<=$cantMax;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						echo '</select><br>';
						echo	'<input type="hidden" value="'.$reg[0].'" name="cvePro" id="cvePro"><button type="submit" class="btn btn-warning">Agregar a Carrito <i class="bi bi-cart-plus-fill"></i></button></form>';
					}
				}else{
					echo '<p class="card-text"><small class="text-muted">Para comprar o agregar al carrito <a href="login.php">inicia sesión.</a></small></p>';
				}echo	  '</div>
					</div>
				  </div>
				</div>
			  </div>';
			}
		}

		function consultaProducto($clave){
			$base=new base();
			$productos=new claseProductos();
			return $productos->datosProducto($clave,$base);
		}

		function catalogoCategorias(){
			$base=new base();
			$productos=new claseProductos();
			$registros = $productos->catalogoCategorias($base);
			while ($reg=mysqli_fetch_array($registros)){
				echo '<p><a href="productos_categoria.php?cat='.$reg[1].'" class="btn btn-light">'.$reg[2].'('.$reg[0].')</a></p>';
			}
		}

		function catalogoProductosCategoria($n_cat){
			$base = new base();
			$productos=new claseProductos();
			$registros=$productos->listarProductosCategoria($n_cat,$base);

			while ($reg=mysqli_fetch_array($registros)){
				echo '<div class="card mb-3" style="width: 100%;">
				<div class="row g-0">
				  <div class="col-md-4">
					<img src="vista/fotos/'.$reg[4].'" class="img-fluid rounded-start" alt="...">
				  </div>
				  <div class="col-md-8">
					<div class="card-body">
					  <h5 class="card-title"><b>'.$reg[1].'</b></h5>
					  <p class="card-text">Precio: $'.$reg[3].'</p>
					  <p class="card-text">'.$reg[2].'</p>
					  <p class="card-text">Inventario: '.$reg[5].'</p>
					  <div class="d-grid gap-2 d-md-flex justify-content-md-end">';
				if(isset($_SESSION['rol'])){
					if(isset($_SESSION['carrito'])){
						$existe = false;
						$arreglo = $_SESSION['carrito'];
						for($i=0;$i<count($arreglo);$i++){
							if($arreglo[$i]['idPro']==$reg[0]){
								$existe = true;
							}
						}
						if($existe==true){
							echo '<form action="eliminarCarrito.php" onsubmit="return eliminar();" method="post"><input type="hidden" value="'.$reg[0].'" name="cvePro" id="cvePro"><button type="submit" class="btn btn-outline-danger"><i class="bi bi-cart-x-fill"></i> Eliminar del carrito</button></form>';
						}else{
							$cantMax=10;
							if($reg[5]<$cantMax){
								$cantMax = $reg[5];
							}
							echo	'<form action="carrito.php" method="post">';
							echo 'Cantidad: <select class="form-select" name="cantidad" id="cantidad">';
							for($i=1;$i<=$cantMax;$i++){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							echo '</select><br>';
							echo	'<input type="hidden" value="'.$reg[0].'" name="cvePro" id="cvePro"><button type="submit" class="btn btn-warning">Agregar a Carrito <i class="bi bi-cart-plus-fill"></i></button></form>';
						}
					}else{
						$cantMax=10;
							if($reg[5]<$cantMax){
							$cantMax = $reg[5];
						}
						echo	'<form action="carrito.php" method="post">';
						echo 'Cantidad: <select class="form-select" name="cantidad" id="cantidad">';
						for($i=1;$i<=$cantMax;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						echo '</select><br>';
						echo	'<input type="hidden" value="'.$reg[0].'" name="cvePro" id="cvePro"><button type="submit" class="btn btn-warning">Agregar a Carrito <i class="bi bi-cart-plus-fill"></i></button></form>';
					}
				}else{
					echo '<p class="card-text"><small class="text-muted">Para comprar o agregar al carrito <a href="login.php">inicia sesión.</a></small></p>';
				}echo	  '</div>
					</div>
				  </div>
				</div>
			  </div>';
			}
		}
	}

?>