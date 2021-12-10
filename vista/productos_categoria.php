<?php
  include_once "controlador/ctrlProductos.php";
  $ctrlPro=new ControlProducto();
  if(!isset($_GET['cat'])){
    header("location:index.php");
  }
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Abarrotes Neza</h1>
                <h5><i>La mejor calidad a buenos precios.</i></h5>
                <h1>Productos</h1>
                <?php
                    $n_cat=$_GET['cat'];
                    $ctrlPro->catalogoProductosCategoria($n_cat);
                ?>
            </section>
            <aside id="infoadicional">
                <h1>Abarrotes Neza</h1>
                <h5><i>La mejor calidad a buenos precios.</i></h5>
                <h1>Categorias</h1>
                <?php
                    $ctrlPro->catalogoCategorias();
                ?>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>