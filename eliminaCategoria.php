<?php
  include_once "controlador/ctrlCategorias.php";
  $ctrlCate=new ControlCategoria();
  $cve=$_REQUEST['cve'];
  $ctrlCate->eliminaCategoria($cve);
?>