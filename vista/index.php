<?php
  include_once "controlador/ctrlProductos.php";
  $ctrlPro=new ControlProducto();
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Abarrotes Neza</h1>
                <h5><i>La mejor calidad a buenos precios.</i></h5>
                <h1>Productos</h1>
                <?php
                    $ctrlPro->catalogoProductos();
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