<?php


    include_once "modelo/login.php";
    include_once 'modelo/base.php';

    class ctrlLogin{

        function ingresar($correo,$contra){
            $base1 = new base();
            $usu=new Login();
            $usu->ingresar($correo,$contra,$base1);
        }

        
        function salir(){
            $base1 = new base();
            $usu=new Login();
            $usu->salir();
        }
        function insertarUsuario($nombre,$tel,$dir,$correo,$contrasena){
            $base1 = new base();
            $usu=new Login();
            $usu->insertarUsuario($nombre,$tel,$dir,$correo,$contrasena,$base1);
        }
        function datosUsuario($id_us){
            $base1 = new base();
            $usu=new Login();
            return $usu->datosUsuario($id_us,$base1);
        }
        function modificarUsuario($id_us,$nombre,$tel,$dir,$correo,$contra){
            $base1 = new base();
            $usu=new Login();
            $usu->modificarUsuario($id_us,$nombre,$tel,$dir,$correo,$contra,$base1);
        }

        function mostrarComprasClientes(){
            $base1 = new base();
            $usu=new Login();
            $registros = $usu->listarClientes($base1);
            while ($reg=mysqli_fetch_array($registros)){
                echo '<tr>';
                echo '<td>'.$reg[1].'</td>';
                echo '<td>'.$reg[4].'</td>';
                echo '<td>'.$reg[2].'</td>';
                $pendientes = $usu->contarVentasPendientes($reg[0],$base1);
                while ($p=mysqli_fetch_array($pendientes)){
                    echo '<td>'.$p[0].'</td>';
                }
                $realizadas = $usu->contarVentasRealizadas($reg[0],$base1);
                while ($r=mysqli_fetch_array($realizadas)){
                    echo '<td>'.$r[0].'</td>';
                }
                $canceladas = $usu->contarVentasCanceladas($reg[0],$base1);
                while ($c=mysqli_fetch_array($canceladas)){
                    echo '<td>'.$c[0].'</td>';
                }
                echo '</tr>';
            }
        }
    }

                    
?>
