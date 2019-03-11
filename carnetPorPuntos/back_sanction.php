<?php

    // Llamamos al archivo de seguridad.

    include('security.php');

    // Descripción del archivo. Código php de la página sanction.php. Realización de la consulta UPDATE e INSERT de las tablas actualizay  carnet.

    // Iniciamos la conexión con MySQL.

    $mysqli = mysqli_init();
    $conexion = new mysqli('localhost','franweb','Usuario@2016','franweb');
    $conexion->query("SET NAMES 'utf8'");

    // Comprobamos la conexión.

    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_error);
        exit();
    }

    // Capturamos los datos provenientes del formulario de la página sanction.php.

    $Codigo_curso = $_POST['grade'];
    $Num_exp = $_POST['student'];
    $Id_motivo = $_POST['reason'];

    $puntuation = "select substring(Puntuacion,2) as Puntuacion from perdida_ganancia where Id_motivo = '" . $Id_motivo . "' and Codigo_curso = '" . $Codigo_curso . "'";
    $result1 = $conexion->query($puntuation);
    $row1 = $result1->fetch_assoc();

    /* Realizamos la consulta correspondiente a la base de datos con los datos obtenidos de los campos. Si no existe fallo en la consulta nos
    redirecciona a teachers.php y mostrará un mensaje de que se ha realizado correctamente la acción. Si existe algún fallo nos redirecciona a teachers.php donde mostrará un mensaje de error. */

    if (!empty($Codigo_curso) and !empty($Num_exp) and !empty($Id_motivo) and $_POST['reason'] != 'none' and $_POST['student'] != 'none'){
        $update = "INSERT INTO `actualiza` (`Id_profesor`, `Num_exp`, `Fecha_hora`, `Codigo_curso`, `Id_motivo`, `Puntuacion`) VALUES ('" . $_SESSION['user'] . "', '" . $Num_exp . "', CURRENT_TIMESTAMP, '" . $Codigo_curso . "', '" . $Id_motivo . "', '-" . $row1['Puntuacion'] . "')";
        $conexion->query($update);
        $license = "UPDATE `carnet` SET `Puntos` = `Puntos` - '" . $row1['Puntuacion'] . "' WHERE `carnet`.`Num_exp` = '" . $Num_exp . "'";
        $conexion->query($license);
        header('Location: teachers.php?sanction=y');
    
    } else
        header('Location: teachers.php?sanction=no');

    // Cerramos la conexión a MySQL.

    mysqli_close($conexion);

    $result1->free();

    // Francisco José Martín López