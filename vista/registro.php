<?php
if(isset($_SESSION['rol'])){
    header("location:index.php");
}
  include_once "controlador/ctrlLogin.php";
  $ctrlLo=new ctrlLogin();
  if(isset($_REQUEST['nombre'])){
      $nombre = $_REQUEST['nombre'];
      $tel = $_REQUEST['tel'];
      $dir = $_REQUEST['dir'];
      $correo = $_REQUEST['correo'];
      $contra = $_REQUEST['contra'];
      $ctrlLo->insertarUsuario($nombre,$tel,$dir,$correo,$contra);
  }
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Registro</h1>
                <form class="row g-3" action="" method="post">
                    <div class="col-md-6">
                        <p>Nombre</p>
                        <p><input class="form-control" type='text' name='nombre' minlength='4' maxlength='26' required></p>
                    </div>
                    <div class="col-md-6">
                        <p>Telefono</p>
                        <p><input class="form-control" type='tel' name='tel' minlength='8' maxlength='12' required></p>
                    </div>
                    <div class="col-md-6">
                        <p>Dirección</p>
                        <p><input class="form-control" type='text' name='dir' minlength='4' maxlength='26' required></p>
                    </div>
                    <div class="col-md-6">
                        <p>Correo</p>
                        <p><input class="form-control" type='email' name='correo' minlength='10' maxlength='26' required></p>
                    </div>
                    <div class="col-md-6">
                        <p>Contraseña</p>
                        <p><input class="form-control" type='password' name='contra' minlength='4' maxlength='26' required></p>
                    </div>
                    <p><button type="submit" class="btn btn-outline-success mb-3">Registrarme</button></p>
                </form>
            </section>
            <aside id="infoadicional">
                <h1>Bienvenido</h1>
                <p>Aquí puedes registrarte.</p>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>