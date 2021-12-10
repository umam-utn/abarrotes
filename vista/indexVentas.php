<?php
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

}else{
    header("location:index.php");
}
include_once "controlador/ctrlVentas.php";
$ctrlVen=new ControlVentas();
?>
    <main>
        <div>
            <section id="articulosprincipales">
                <h1>Ventas</h1>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Pendientes
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-warning">
                                <tr>
                                    <th>Folio</th>
                                    <th>Cliente</th>
                                    <th>Dirección</th>
                                    <th>Telefono</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Tipo</th>
                                    <th>Detalles</th>
                                    <th>Cancelar</th>
                                    <th>Concluir</th>
                                </tr>
                                <?php
                                    $ctrlVen->muestraPendientes();
                                ?>
                            </table>
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Realizadas
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-success">
                                <tr>
                                    <th>Folio</th>
                                    <th>Cliente</th>
                                    <th>Dirección</th>
                                    <th>Telefono</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Tipo</th>
                                    <th>Detalles</th>
                                </tr>
                                <?php
                                    $ctrlVen->muestraRealizadas();
                                ?>
                            </table>
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Canceladas
                        </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-danger">
                                <tr>
                                    <th>Folio</th>
                                    <th>Cliente</th>
                                    <th>Dirección</th>
                                    <th>Telefono</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Tipo</th>
                                    <th>Detalles</th>
                                </tr>
                                <?php
                                    $ctrlVen->muestraCanceladas();
                                ?>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <div class="recuperar"></div>
        </div>
    </main>