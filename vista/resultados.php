<?php
  include_once "controlador/ctrlProductos.php";
  $ctrlPro=new ControlProducto();
  if(isset($_REQUEST['buscar'])){
      $buscar = $_REQUEST['buscar'];
  }else{
    header("location:index.php");
  }
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Abarrotes Neza</h1>
                <h5><i>La mejor calidad a buenos precios.</i></h5>
                <h1>Resultados</h1>
                <?php
                    $ctrlPro->buscarProducto($buscar);
                ?>
                <h1>Categorias</h1>
                <?php
                    $ctrlPro->catalogoCategorias();
                ?>
            </section>
            <aside id="infoadicional">
                <h1>Resultados</h1>
                <p>Se muestran los resultados de la busqueda realizada.</p>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>