<?php
if(isset($_SESSION['rol'])){
    header("location:index.php");
}
  include_once "controlador/ctrlLogin.php";
  $ctrlLo=new ctrlLogin();
  if(isset($_REQUEST['correo'])){
      $correo = $_REQUEST['correo'];
      $contra = $_REQUEST['contra'];
      $ctrlLo->ingresar($correo,$contra);
  }
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Iniciar Sesión</h1>
                <form action=""  class="row g-3" method="post">
                <div class="col-md-6">
                    <p>Correo</p>
                    <p><input class="form-control" type='email' name='correo' minlength='10' maxlength='26' required></p>
                </div>
                <div class="col-md-6">
                    <p>Contraseña</p>
                    <p><input class="form-control" type='password' name='contra' minlength='4' maxlength='26' required></p>
                </div>
                <p><button type="submit" class="btn btn-outline-success mb-3">Iniciar Sesión</button></p>
                </form>
            </section>
            <aside id="infoadicional">
                <h1>Abarrotes Neza</h1>
                <p>Bienvenido a nuestro sitio WEB, aquí puedes iniciar sesión.</p>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>
