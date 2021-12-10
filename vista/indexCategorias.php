<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
  include_once "controlador/ctrlCategorias.php";
  $ctrlCate=new ControlCategoria();
  
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Categorias</h1>
                <p><a href="nuevaCategoria.php"><button class="btn btn-outline-success">Nueva Categoria</button></a></p>
                <table class="table table-dark table-striped">
                    <tr>
                        <th>CVE</th>
                        <th>Nombre</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    <?php
                        $ctrlCate->mostrarListaCategoria();
                    ?>
                </table>
            </section>
            <aside id="infoadicional">
                <h1>Administrador</h1>
                <p>Esta sección muestra las categorias registradas.</p>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>