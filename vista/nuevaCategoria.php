<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
  include_once "controlador/ctrlCategorias.php";
  $ctrlCate=new ControlCategoria();
  if(isset($_REQUEST['nombre'])){
    $nombre=$_REQUEST['nombre'];
    $ctrlCate->insertarCategoria($nombre);
  }
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Agregar Categoria</h1>
                <div id="formulario">
                    <form id='forma' action='' method='post'>
                    <p>Nombre</p>
                    <p><input class="form-control" type='text' name='nombre' minlength="3" maxlength="26" placeholder="Letras de la A a la Z y espacios máximo 25 caracteres." pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" required></p>
                    <p><button type="submit" class="btn btn-outline-success mb-3">Agregar</button></p>
                </form>
                </div>
            </section>
            <aside id="infoadicional">
                
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>