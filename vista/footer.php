
    <footer id="pielogo">
        <div>
            <section class="seccionpie">
                <h1>Abarrotes Neza</h1>
                <p><a href="index.php">Principal</a></p>
                <p><a href="nosotros.php">Nosotros</a></p>
            </section>
            <section class="seccionpie">
                <h1>Registro/Inicio de Sesión</h1>
                <?php if(!isset($_SESSION['rol'])){ ?>
                <p><a href="registro.php">Registrarse</a></p>
                <p><a href="login.php">Inicio de Sesión</a></p>
                <?php }else{ ?>
                <p><a href="salir.php">Salir</a></p>
                <?php } ?>
            </section>
            <section class="seccionpie">
                <address>Nezahualcóyotl, Estado de México</address>
                <small>&copy; Abarrotes Neza, Derechos Reservados 2021</small>
            </section>
            <div class="recuperar"></div>
        </div>
    </footer>
    <script src="js/util.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>