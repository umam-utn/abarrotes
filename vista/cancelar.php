<?php
  if(isset($_SESSION['rol']) && $_SESSION['rol']==1){

  }else{
      header("location:index.php");
  }
  include_once "controlador/ctrlVentas.php";
  $ctrlVen=new ControlVentas();
  $cveVenta = $_REQUEST['cveVenta'];
  $ctrlVen->cancelarVenta($cveVenta);
?>