<?php
//session_start();
if(isset($_SESSION['rol']) && $_SESSION['rol']==1){
    header("location:productos.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Abarrotes Neza</title>
    <meta charset="utf-8">
    <meta name="description" content="Página WEB Abarrotes Neza">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="stylesheet" href="vista/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header id="cabeceralogo" style='background-image: url("vista/img/fondo.png");'>
        <div>
            <h1>Abarrotes Neza</h1>
        </div>
    </header>
    <nav class="navbar-expand-lg navbar navbar-dark" style="background: #20c997;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="vista/img/icono.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="nosotros.php">Nosotros</a>
                </li>
                <?php if(isset($_SESSION['rol'])){ ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="carrito.php"><i class="bi bi-cart-fill"></i> Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="perfil.php">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="salir.php">Salir</a>
                </li>
                <?php }else{ ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="registro.php">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="login.php">Iniciar Sesión</a>
                </li>
                <?php } ?>
            </ul>
            <form class="d-flex" action="busqueda.php" method="post">
                <input class="form-control me-2" id="buscar" name="buscar" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-light" type="submit">Buscar</button>
            </form>
            </div>
        </div>
    </nav>