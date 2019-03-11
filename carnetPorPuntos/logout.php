<?php

    // Descripción del archivo. Realización del cierre de la sesión.

    // Llamamos al archivo de seguridad.

    include ('security.php');

    // Eliminamos toda la información registrada la variable de sesión.

    session_destroy();

    // Nos envia a la página home.php.

    header('location: home.php');

    // Francisco José Martín López
?>
