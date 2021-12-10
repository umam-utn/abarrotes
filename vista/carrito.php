<?php
if(!isset($_SESSION['rol'])){
    header("location:index.php");
}
include_once "controlador/ctrlProductos.php";
$ctrlPro=new ControlProducto();
$total = 0;
if(isset($_SESSION['carrito'])){
    //si existe buscamos si ya estaba agregado el producto
    if(isset($_REQUEST['cvePro'])){
        $clave = $_REQUEST['cvePro'];
        $arreglo = $_SESSION['carrito'];
        $existe = false;
        $numero = 0;
        $cantidad = $_REQUEST['cantidad'];
        for($i=0;$i<count($arreglo);$i++){
            if($arreglo[$i]['idPro']==$clave){
                $existe = true;
                $numero = $i;
            }
        }
        if($existe==true){
            $arreglo[$numero]['cantidad'] = $arreglo[$numero]['cantidad']+$cantidad;
            $_SESSION['carrito'] = $arreglo;
        }else{
            //No estaba el registro
            $nombre = "";
            $precio = "";
            $imagen = "";
            $clave = $_REQUEST['cvePro'];
            $cantidad = $_REQUEST['cantidad'];
            $res = $ctrlPro->consultaProducto($clave);
            $fila = mysqli_fetch_row($res);
            $nombre = $fila['1'];
            $precio = $fila['3'];
            $imagen = $fila['4'];
            $arregloNuevo = array(
                'idPro'=> $clave,
                'nombre'=> $nombre,
                'precio'=> $precio,
                'imagen'=> $imagen,
                'cantidad'=> $cantidad
            );
            array_push($arreglo, $arregloNuevo);
            $_SESSION['carrito'] = $arreglo;
        }
    }
}else{
    //creamos variable session
    if(isset($_REQUEST['cvePro'])){
        $nombre = "";
        $precio = "";
        $imagen = "";
        $clave = $_REQUEST['cvePro'];
        $cantidad = $_REQUEST['cantidad'];
        $res = $ctrlPro->consultaProducto($clave);
        $fila = mysqli_fetch_row($res);
        $nombre = $fila['1'];
        $precio = $fila['3'];
        $imagen = $fila['4'];
        $arreglo[] = array(
            'idPro'=> $clave,
            'nombre'=> $nombre,
            'precio'=> $precio,
            'imagen'=> $imagen,
            'cantidad'=> $cantidad
        );
        $_SESSION['carrito'] = $arreglo;
    }
}
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Carrito</h1>
                
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Total</th>
                            <th scope="col">Quitar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($_SESSION['carrito'])){
                        
                        $arregloCarrito = $_SESSION['carrito'];
                        for($i=0;$i<count($arregloCarrito);$i++){ ?>
                        <tr>
                            <th scope="row"><?php echo $arregloCarrito[$i]['idPro'] ?></th>
                            <td><?php echo $arregloCarrito[$i]['nombre'] ?></td>
                            <td><img src="vista/fotos/<?php echo $arregloCarrito[$i]['imagen'] ?>" style="width: 5rem;"></td>
                            <td>$<?php echo $arregloCarrito[$i]['precio'] ?></td>
                            <td><?php echo $arregloCarrito[$i]['cantidad'] ?></td>
                            <td>$<?php echo $arregloCarrito[$i]['precio']*$arregloCarrito[$i]['cantidad'] ?></td>
                            <td><form action="eliminarCarrito.php" onsubmit='return eliminar();' method="post"><input type="hidden" value="<?php echo $arregloCarrito[$i]['idPro'] ?>" name="cvePro" id="cvePro"><button type="submit" class="btn btn-outline-danger"><i class="bi bi-cart-x-fill"></i></button></form></td>
                        </tr>
                    <?php 
                        $total = $total + ($arregloCarrito[$i]['precio']*$arregloCarrito[$i]['cantidad']);
                    } } ?>
                        <tr>
                            <th colspan="5">
                                Total de la compra
                            </th>
                            <th colspan="2">
                                $<?php echo $total ?>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </section>
            <aside id="infoadicional">
                <h1>Abarrotes Neza</h1>
                <p>Aquí puedes ver los productos en tu carrito.</p>
                <?php if(isset($_SESSION['carrito'])){ ?>
                <div class="d-grid gap-2">
                    <a href="index.php"><button type="button" class="btn btn-info" style="width: 100%"><i class="bi bi-bag-fill"></i> Seguir comprando</button></a>
                    <a href="detallesCompra.php"><button type="button" class="btn btn-success" style="width: 100%"><i class="bi bi-cash-coin"></i> Terminar compra</button></a>
                </div>
                <?php } ?>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>
