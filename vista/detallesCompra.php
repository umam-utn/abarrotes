<?php
if(!isset($_SESSION['rol']) || !isset($_SESSION['carrito'])){
    header("location:index.php");
}
include_once "controlador/ctrlVentas.php";
$ctrlVen=new ControlVentas();
if(isset($_REQUEST['total_compra']) || isset($_REQUEST['t_pago'])){
    $t_compra = $_REQUEST['total_compra'];
    $t_pago = $_REQUEST['t_pago'];
    $arreglo = $_SESSION['carrito'];
    $fecha = date('Y-m-d h:m:s');
    $usu = $_SESSION['id'];
    $ctrlVen->registraVenta($usu,$fecha,$t_compra,$t_pago,$arreglo);
}
$total = 0;
$fecha = date('Y-m-d');
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Detalles compra</h1>
                
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($_SESSION['carrito'])){
                        
                        $arregloCarrito = $_SESSION['carrito'];
                        for($i=0;$i<count($arregloCarrito);$i++){ ?>
                        <tr>
                            <td><?php echo $arregloCarrito[$i]['nombre'] ?></td>
                            <td><?php echo $arregloCarrito[$i]['cantidad'] ?></td>
                            <td>$<?php echo $arregloCarrito[$i]['precio']*$arregloCarrito[$i]['cantidad'] ?></td>
                        </tr>
                    <?php 
                        $total = $total + ($arregloCarrito[$i]['precio']*$arregloCarrito[$i]['cantidad']);
                    } } ?>
                        <tr>
                            <th colspan="2">
                                Total de la compra
                            </th>
                            <th>
                                $<?php echo $total ?>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <p><b>Fecha:</b> <?php echo $fecha;?></p>
                <p><b>Opciones de pago</b></p>
                <ol>
                    <li>Contra - entrega: Se paga en el domicilio al recibir el producto. El domicilio se tomara de la dirección proporcionada en el perfil del cliente. </li>
                    <li>Apartado: Los productos se apartan en la tienda, el pago se realiza cuando el cliente pasa por sus productos.</li>
                    <li>Paypal: No disponible de momento.</li>
                </ol>
                <form onsubmit="return confirmar();" action="" method="post" >
                    <select class="form-select" aria-label="Default select example" name="t_pago" id="t_pago" required>
                        <option selected disabled value>Opciones de pago</option>
                        <option value="1">Contra - entrega</option>
                        <option value="2">Apartado</option>
                        <option value="3" disabled>PayPal - Proximamente</option>
                    </select>
                    <input type="hidden" value="<?php echo $total ?>" name="total_compra" id="total_compra"><br>
                    <p><b>Nota: </b>Si el cliente no se encuentra en la ubicación o no pasa por sus productos en un periodo de 12hrs la venta será cancelada por el administrador y el cliente podra ser sancionado por mal uso de la plataforma.</p>
                    <p><button type="submit" class="btn btn-outline-success mb-3">Realizar compra.</button></p>
                </form>
            </section>
            <aside id="infoadicional">
                <h1>Abarrotes Neza</h1>
                <p>Aquí puedes ver los detalles de la compra a realizar y las opciones de pago.</p>
                <?php if(isset($_SESSION['carrito'])){ ?>
                <div class="d-grid gap-2">
                    <a href="index.php"><button type="button" class="btn btn-info" style="width: 100%"><i class="bi bi-bag-fill"></i> Seguir comprando</button></a>
                </div>
                <?php } ?>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>
