<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
include_once "controlador/ctrlVentas.php";
$ctrlVen=new ControlVentas();
$id_us=$_SESSION['id'];
include_once "controlador/ctrlLogin.php";
$ctrlLo=new ctrlLogin();
$datosUsuario = $ctrlLo->datosUsuario($id_us);
while ($reg=mysqli_fetch_array($datosUsuario )){
    $correo= $reg[4];
    $nombre = $reg[1];
    $telefono = $reg[2];
    $dir = $reg[3];
}
    if(isset($_REQUEST['nombre']) && isset($_REQUEST['tel']) && isset($_REQUEST['dir']) && isset($_REQUEST['nombre'])){
        $nombre = $_REQUEST['nombre'];
        $tel = $_REQUEST['tel'];
        $dir = $_REQUEST['dir'];
        $correo = $_REQUEST['correo'];
        $contra = $_REQUEST['contra'];
        $ctrlLo->modificarUsuario($id_us,$nombre,$tel,$dir,$correo,$contra);
    }
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Cuenta</h1>
                <form class="row g-3" action="" method="post">
                    <div class="col-md-6">
                        <p>Nombre</p>
                        <p><input class="form-control" type='text' name='nombre' minlength='4' maxlength='26' value="<?php echo $nombre; ?>" required></p>
                    </div>
                    <div class="col-md-6">
                        <p>Telefono</p>
                        <p><input class="form-control" type='tel' name='tel' minlength='8' maxlength='12' value="<?php echo $telefono; ?>" required></p>
                    </div>
                    <div class="col-md-6">
                        <p>Dirección</p>
                        <p><input class="form-control" type='text' name='dir' minlength='4' maxlength='26' value="<?php echo $dir; ?>" required></p>
                    </div>
                    <div class="col-md-6">
                        <p>Correo</p>
                        <p><input class="form-control" type='email' name='correo' minlength='10' maxlength='26' value="<?php echo $correo; ?>" required></p>
                    </div>
                    <div class="col-md-6">
                        <p>Contraseña</p>
                        <p><input class="form-control" type='password' name='contra' minlength='4' maxlength='26'></p>
                    </div>
                    <p><button type="submit" class="btn btn-outline-success mb-3">Modificar Datos</button></p>
                </form>
            </section>
            <aside id="infoadicional">
                <h1>Administrador</h1>
                <p>Aquí puede modificar los detalles de su cuenta.</p>
                <?php if(isset($_SESSION['carrito'])){ ?>
                <div class="d-grid gap-2">
                    <a href="index.php"><button type="button" class="btn btn-info" style="width: 100%"><i class="bi bi-bag-fill"></i> Seguir comprando</button></a>
                </div>
                <?php } ?>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>
