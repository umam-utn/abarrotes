<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
  include_once "controlador/ctrlProductos.php";
  $ctrlPro=new ControlProducto();
  if(isset($_REQUEST['nombre'])){
    $nombre=$_REQUEST['nombre'];
    $precio=$_REQUEST['precio'];
    $descripcion=$_REQUEST['descripcion'];
    $categoria=$_REQUEST['categoria'];
    $cant=$_REQUEST['cantidad'];
    $ctrlPro->insertarProducto($nombre,$descripcion,$precio,$categoria,$cant);
  }
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Agregar Producto</h1>
                <div id="formulario">
                    <form class="row g-3" id='forma' action='' method='post' enctype='multipart/form-data'>
                    <p>Nombre</p>
                    <p><input class="form-control" type='text' name='nombre' minlength='3' maxlength='26' placeholder='Coca-Cola' pattern='[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+' required></p>
                    <div class="col-md-6">
                        <p>Precio del producto</p>
                        <p><input class="form-control" type='number' name='precio' min='1.00'step='0.50' required placeholder='$20.00'></p>
                    </div>
                    <div class="col-md-6">
                        <p>Inventario</p>
                        <p><input class="form-control" type='number' name='cantidad' min='1.00'step='1.00' required placeholder='1'></p>
                    </div>
                    <p>Categoría del producto</p>
                    <p><?php $ctrlPro->selectCategoria() ?></p>
                    <p>Descripción</p>
                    <p><textarea class="form-control" rows="4" name='descripcion' placeholder='Coca-cola de 250ml' required></textarea></p>
                    <p>Foto</p>
                    <p><input class="form-control" type='file' name='foto' accept='image/png, .jpeg, .jpg' required></p>
                    <p><button type="submit" class="btn btn-outline-success mb-3">Agregar</button></p>
                </form>
                </div>
            </section>
            <aside id="infoadicional">
                
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>