<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
  include_once "controlador/ctrlProductos.php";
  $ctrlPro=new ControlProducto();
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Productos</h1>
                <p><a href="nuevoProducto.php"><button class="btn btn-outline-success">Nuevo Producto</button></a></p>
                <table class="table table-dark table-striped">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Inventario</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    <?php
                        $ctrlPro->mostrarListaProductos();
                    ?>
                </table>
            </section>
            <aside id="infoadicional">
                <h1>Administrador</h1>
                <p>Esta sección muestra los productos registrados.</p>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>