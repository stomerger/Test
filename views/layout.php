<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio)) {
        $inicio = false;
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>
    
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="barra">
            

                <div class="derecha">
                   
                    <nav class="navegacion">
                        
                        <?php if($auth): ?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
                
            </div> <!--.barra-->

        </div>
    </header>


    <?php echo $contenido; ?>


    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
               
            </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="../build/js/modernizr.js"></script>
</body>
</html>