<?php
	include_once "modelo/productos.php";
	include_once "modelo/base.php";
	
	class ControlIndex{

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
					  <h5 class="card-title">'.$reg[1].'</h5>
					  <p class="card-text">Precio: $'.$reg[3].'</p>
					  <p class="card-text">'.$reg[2].'</p>
					  <p class="card-text">Existencia: '.$reg[5].'</p>
					  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
						<button class="btn btn-primary me-md-2" type="button">Agregar a carrito</button>
						<button class="btn btn-primary" type="button">Comprar</button>
					  </div>
					</div>
				  </div>
				</div>
			  </div>';
			}
		}
	}

?>