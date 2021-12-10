
<?php
    

 class Login{

    public function ingresar($correo,$contra,$base){
			 
        $registro=mysqli_query($base->conectarBD(),"SELECT * FROM usuario WHERE correo='$correo'") or die("Error en la consulta");
        if ($reg=mysqli_fetch_array($registro)) {
            $contraReal=$reg['contrasena'];
            if($contra==$contraReal){
                    $base->desconectarBD();
                    $_SESSION['id']=$reg['id_us'];
                    $_SESSION['rol']=$reg['id_rol'];
                    if($reg['id_rol']==2){
                        header("location:index.php");
                    }else if($reg['id_rol']==1){
                        header("location:productos.php");
                    }
                }else{
                echo '<script type="text/javascript">
                alert("Las contraseñas no coinciden.");
                window.location.href="index.php";
                </script>';
            }
        }else{
            echo '<script type="text/javascript">
                    alert("Usuario no encontrado.");
                    window.location.href="index.php";
                    </script>';
        }
        
    }
    
    public function salir(){
        //session_start();
        session_unset();
        session_destroy();
        echo '<script type="text/javascript">
                alert("Regrese pronto.");
                window.location.href="index.php";
                </script>';
    }

    public function insertarUsuario($nombre,$tel,$dir,$correo,$contrasena,$base){
		
		$registro=mysqli_query($base->conectarBD(),"SELECT * from usuario where correo='$correo'") or die(mysqli_error($base->conectarBD()));
		if ($reg=mysqli_fetch_array($registro)){
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Correo en uso.");
                window.location.href="index.php";
                </script>';
		}
		else{
			mysqli_query($base->conectarBD(),"INSERT INTO usuario(nombre_us,telefono,direccion,correo,contrasena,id_rol)values('$nombre','$tel','$dir','$correo','$contrasena','2')")or die ("Problemas en el insert".mysql_error($base->conectarBD()));
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("Registro exitoso.");
                window.location.href="login.php";
                </script>';
		}
    }
    
    public function datosUsuario($id_us,$base){
		$registro=mysqli_query($base->conectarBD(),"SELECT * from usuario where id_us='$id_us'") or die(mysqli_error($base->conectarBD()));
		return $registro;
    }
    
    public function modificarUsuario($id_us,$nombre,$tel,$dir,$correo,$contra,$base){
        $registro=mysqli_query($base->conectarBD(),"SELECT * from usuario where correo='$correo' AND id_us != '$id_us'") or die("error al conectar");
		$row_cnt = mysqli_num_rows($registro);
		if ($row_cnt>0){
			$base->desconectarBD();
			echo '<script type="text/javascript">
                alert("El correo ya se encuentra registrado por otro usuario.");
                window.location.href="perfil.php";
                </script>';
		}else{
            mysqli_query($base->conectarBD(),"UPDATE usuario set nombre_us='$nombre', telefono='$tel', direccion='$dir', correo='$correo' where id_us='$id_us'");
            if($contra != ""){
                mysqli_query($base->conectarBD(),"UPDATE usuario set contrasena='$contra' where id_us='$id_us'");
            }
            $base->desconectarBD();
            if($_SESSION['rol']==2){
			    echo '<script type="text/javascript">
                alert("Cuenta modificada.");
                window.location.href="perfil.php";
                </script>';
            }else if($_SESSION['rol']==1){
			    echo '<script type="text/javascript">
                alert("Cuenta modificada.");
                window.location.href="perfilAdmin.php";
                </script>';
            }
		}
    }
    function listarClientes($base){
        $registro=mysqli_query($base->conectarBD(),"SELECT u.* from usuario u  where u.id_rol = 2 ") or die(mysqli_error($base->conectarBD()));
		return $registro;
    }
    function contarVentasPendientes($usu,$base){
        $registro=mysqli_query($base->conectarBD(),"SELECT COUNT(id_us) as pendientes FROM ventas WHERE situacion = 1 AND id_us='$usu'") or die(mysqli_error($base->conectarBD()));
		return $registro;
    }
    function contarVentasRealizadas($usu,$base){
        $registro=mysqli_query($base->conectarBD(),"SELECT COUNT(id_us) as realizadas FROM ventas WHERE situacion = 2 AND id_us='$usu'") or die(mysqli_error($base->conectarBD()));
		return $registro;
    }
    function contarVentasCanceladas($usu,$base){
        $registro=mysqli_query($base->conectarBD(),"SELECT COUNT(id_us) as canceladas FROM ventas WHERE situacion = 3 AND id_us='$usu'") or die(mysqli_error($base->conectarBD()));
		return $registro;
    }
 }
?>