<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
include_once "controlador/ctrlLogin.php";
$ctrlLo=new ctrlLogin();
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Clientes</h1>
                <table class="table table-dark table-striped">
                    <tr>
                        <th rowspan="2">Nombre</th>
                        <th rowspan="2">Correo</th>
                        <th rowspan="2">Teléfono</th>
                        <th colspan="3">Compras</th>
                    </tr>
                    <tr>
                        <th>Pedientes</th>
                        <th>Realizadas</th>
                        <th>Canceladas</th>
                    </tr>
                    <?php
                        $ctrlLo->mostrarComprasClientes();
                    ?>
                </table>
            </section>
            <aside id="infoadicional">
                <h1>Administrador</h1>
                <p>Esta sección muestra información de los clientes resgistrados.</p>
            </aside>
            <div class="recuperar"></div>
        </div>
    </main>