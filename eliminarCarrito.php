<?php
    session_start();
    if(!isset($_SESSION['carrito']) || !isset($_REQUEST['cvePro'])){
        header("location:index.php");
    }
    $arreglo = $_SESSION['carrito'];
    for($i=0;$i<count($arreglo);$i++){
        if($arreglo[$i]['idPro']!=$_REQUEST['cvePro']){
            $arregloNuevo[] = array(
                'idPro'=> $arreglo[$i]['idPro'],
                'nombre'=> $arreglo[$i]['nombre'],
                'precio'=> $arreglo[$i]['precio'],
                'imagen'=> $arreglo[$i]['imagen'],
                'cantidad'=> $arreglo[$i]['cantidad']
            );
        }
    }
    if(isset($arregloNuevo)){
        $_SESSION['carrito'] = $arregloNuevo;
        header("location:carrito.php");
    }else{
        //Regitro a eliminar es el único
        unset($_SESSION['carrito']);
        header("location:carrito.php");
    }
?>