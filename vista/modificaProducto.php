<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
  include_once "controlador/ctrlProductos.php";
  $ctrlPro=new ControlProducto();
  if(isset($_REQUEST['nombre']) && isset($_REQUEST['clave'])){
    $clave = $_REQUEST['clave'];
    $nombre=$_REQUEST['nombre'];
    $precio=$_REQUEST['precio'];
    $descripcion=$_REQUEST['descripcion'];
    $categoria=$_REQUEST['categoria'];
    $cant=$_REQUEST['cantidad'];
    $ctrlPro->actualizaProducto($clave,$nombre,$descripcion,$precio,$categoria,$cant);
  }else if(isset($_REQUEST['cve'])){
    $cve=$_REQUEST['cve'];
  }else{
    header('Location: productos.php');
  }
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Modificar Producto</h1>
                <div id="formulario">
                    <form class="row g-3" id='forma' action='' method='post' enctype='multipart/form-data'>
                    <?php
                        $ctrlPro->mostrarEditaProducto($cve);
                    ?>  
                    <p>Foto</p>
                    <p><input class='form-control' type='file' name='foto' accept='image/png, .jpeg, .jpg'></p>
                    <p><button type="submit" class="btn btn-outline-success mb-3">Modificar</button></p>
                </form>
                </div>
            </section>
            <aside id="infoadicional">
                
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>