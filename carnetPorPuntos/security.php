<?php

    // Descipción del archivo. Seguridad del sistema.

    // Reanudamos la sesión para trabajar con esa variable.

	session_start();

    /* Si el campo autentificado en el array de sesión es diferente del valor 1 nos redirige a home.php, en otras palabras que sino hemos iniciado
    sesión nos redirige a home.php. */

	if($_SESSION['identified']!= 4286573154 )
        header('Location: home.php');

    // Francisco José Martín López
?>
