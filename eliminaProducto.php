<?php
  include_once "controlador/ctrlProductos.php";
  $ctrlPro=new ControlProducto();
  $cve=$_REQUEST['cve'];
  $ctrlPro->eliminaProducto($cve);
?>