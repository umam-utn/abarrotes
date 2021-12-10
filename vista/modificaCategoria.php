<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
  include_once "controlador/ctrlCategorias.php";
  $ctrlCate=new ControlCategoria();
  if(isset($_REQUEST['clave']) && isset($_REQUEST['nombre'])){
    $clave = $_REQUEST['clave'];
    $nombre = $_REQUEST['nombre'];
    $ctrlCate->actualizaCategoria($clave,$nombre);
  }else if(isset($_REQUEST['cve'])){
    $cve=$_REQUEST['cve'];
  }else{
    header('Location: categorias.php');
  }
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Modificar Categoria</h1>
                <div id="formulario">
                    <form id='forma' action='' method='post'>
                        <?php
                            $ctrlCate->mostrarEditaCategoria($cve);
                        ?>    
                        <p><button type="submit" class="btn btn-outline-success mb-3">Modificar</button></p>
                     </form>
                </div>
            </section>
            <aside id="infoadicional">
                
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>