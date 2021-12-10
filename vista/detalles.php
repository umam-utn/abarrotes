<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
include_once "controlador/ctrlVentas.php";
$ctrlVen=new ControlVentas();
$cveVenta = $_REQUEST['cveVenta'];
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Detalles Venta</h1>
                <a href="ventas.php"><button type="button" class="btn btn-outline-info"><i class="bi bi-arrow-left-circle-fill"></i> Regresar</button></a>
                <br><br><b>Folio Venta: </b><?php echo $cveVenta; ?><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ctrlVen->muestraDetalles($cveVenta);
                        ?>
                        <?php
                        $ctrlVen->muestraTotal($cveVenta);
                        ?>
                    </tbody>
                </table>
                
            </section>
            <aside id="infoadicional">
                <h1>Abarrotes Neza</h1>
                <p>Aquí puedes ver los detalles de la compra.</p>
                <?php if(isset($_SESSION['carrito'])){ ?>
                <div class="d-grid gap-2">
                    <a href="index.php"><button type="button" class="btn btn-info" style="width: 100%"><i class="bi bi-bag-fill"></i> Seguir comprando</button></a>
                </div>
                <?php } ?>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>
