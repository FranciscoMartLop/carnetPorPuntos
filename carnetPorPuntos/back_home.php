<?php

    // Descripción del archivo. Código php de la página home.php. Conexión al sistema.

    // Llamamos al archivo de seguridad.

    include('security.php');

    // Iniciamos la conexión con MySQL.

    $mysqli = mysqli_init();
    $conexion = new mysqli('localhost','franweb','Usuario@2016','franweb');

    // Comprobamos la conexión.

    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_errno);
        exit();
    }

    if(isset($_POST['login'])) {
        
        // Comprobamos que se hayan enviado los datos del formulario.
        // Comprobamos que los campos usuarios_nombre y usuario_clave no estén vacíos.
        
        if(empty($_POST['user'])) {
           header("Location: home.php?errorusuario=si");
            
        }else {
            
            // "Limpiamos" los campos del formulario de posibles códigos maliciosos.
            
            $user = $_POST['user'];
            $password = $_POST['password'];
            $password = sha1($password);
        }
    }
        
    // Realizamos las consultas de datos para la siguiente comparación de estos.

    $student_name = "select Num_exp from alumnado where Num_exp = '" . $user . "'";
    $result1 = $conexion->query($student_name);

    $teacher_name = "select Id_profesor, Password from profesor where Id_profesor = '$user' and Password = '" . $password . "'" ;
    $result2 = $conexion->query($teacher_name);

    if ($row1 = $result1->fetch_assoc() and $password == sha1("")) {
        
        // Creamos variable de sesión y nos redirecciona a students.php.
        
       $_SESSION['identified'] = 4286573154;
       $_SESSION['user'] = $user;
       $_SESSION['pass'] = $password;
        header ("Location: students.php");
    }

    else if ($row2 = $result2->fetch_assoc()) {

        // Creamos variable de sesión y nos redirecciona a teachers.php.

        $_SESSION['identified'] = 4286573154;
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $password;
        header ("Location: teachers.php");
    }
     else
        header("Location: home.php?errorusuario=si");

    $result1->free();
    $result2->free();
    mysqli_close($conexion);

    // Francisco José Martín López
?>