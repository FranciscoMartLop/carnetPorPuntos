<?php

    // Llamamos al archivo de seguridad.

   include ('security.php');

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Alumnado</title>
        <link rel="stylesheet" href="css/students.css">
        <link href="images\iconoIES.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="scripts/js/mi.js"></script>
    </head>

    <body>

        <!-- Descripción del archivo. Página principal de los usuarios alumno. -->
        <!-- Creamos el header que almacenará el logotipo del intituto junto con el sistema de cierre de sesión. -->

        <div class="header">

            <img src="images\LogoInsti.png" alt="logoInstituto" height="88" width="388">

            <?php    
            
                // Iniciamos la conexión con MySQL.

                $mysqli = mysqli_init();
                $conexion = new mysqli('localhost','franweb','Usuario@2016','franweb');
                $conexion->query("SET NAMES 'utf8'");

                // Comprobamos la conexión.

                if ($mysqli->connect_errno) {
                    printf("Falló la conexión: %s\n", $mysqli->connect_error);
                    exit();
                }

                // Selecciona el nombre y los apelldios del alumno que ha iniciado sesión.
            
                $student_name = "select Nombre_alumno, Apellidos_alumno from alumnado where Num_exp =  '" . $_SESSION['user'] . "'";
                $result = $conexion->query($student_name);
                $row = $result->fetch_assoc();
            ?>

                <!-- Mostramos el siguiente mensaje con el nombre del usuario y un enlace para cerrar sesión. -->

                <div class="first_message">
                    <b><?php echo "Bienvenid@, " . $row['Nombre_alumno'] . " " . $row['Apellidos_alumno'] . "   " ?></b>
                    <a href="logout.php">
                        <input type="submit" value="Cerrar sesión">
                    </a>
                </div>

                <?php $result->free(); ?>


        </div>

        <!-- Menú de accesibilidad incluido en todas las páginas. -->

        <div id="menu">
            <ul class="nav">
                <li><a href="home.php#header">Inicio</a></li>
                <li><a href="home.php#works">¿Cómo funciona?</a></li>
                <li><a href="home.php#rules">Reglamento</a></li>
                <li><a href="home.php#zones">Zonas</a></li>
                <li><a href="home.php#awards">Premios</a></li>
            </ul>
        </div>

        <br>
        <br>

        <!-- Slider incluido en todas las páginas. -->

        <div class="slider2">
            <div id="slider">
                <img src="images/encima_escuela_idiomas.jpg">
                <img src="images/salon.jpg">
                <img src="images/entrada_principal.jpg">
            </div>
        </div>

        <?php
        
            // Consulta para el primer cuadro informativo. Selecciona el nombre del alumno, los apellidos, los puntos de su carnet y el nombre de su curso del alumno que ha iniciado sesión.

            $student_data = "select Nombre_alumno, Apellidos_alumno, carnet.Puntos, curso.Nombre from alumnado, curso, carnet where alumnado.Carnet = carnet.Num_exp and alumnado.Codigo_Curso = curso.Codigo_curso and alumnado.Num_exp =  '" . $_SESSION['user'] . "'";
            $result = $conexion->query($student_data);
            $row = $result->fetch_assoc();

       ?>
            <br>

            <!-- Primer cuadro informativo sobre el carnet del alumno que inició sesión. -->

            <div class="main_info">
                <div class="title0">Mi carnet</div>
                <div class="info">
                    <?php echo $row['Nombre_alumno'] . " " . $row['Apellidos_alumno'] . "   " . $row['Nombre'] ?>
                        <br>
                        <br>
                        <?php echo "Tu carnet por puntos tiene " . $row['Puntos'] . "." ?>
                            <br>
                            <br>
                            <?php 
                                if ($row['Puntos'] < 10) {
                                    echo "Te encuentras en la zona <red class='red'>ROJA</red>.";
                                }else if ($row['Puntos'] >= 10 && $row['Puntos'] < 15) {
                                    echo "Te encuentras en la zona <yellow class='yellow'>AMARILLA</yellow>.";
                                }else if ($row['Puntos'] >= 15 && $row['Puntos'] < 20) {
                                    echo "Te encuentras en la zona <green class='green'>VERDE</green>.";
                                }else if ($row['Puntos'] >= 20) {
                                    echo "Te encuentras en la zona <blue class='blue'>AZUL</blue>.";
                                }
                    ?>
                </div>
            </div>
            <br>

            <!-- Segundo cuadro informativo sobre los premios que se pueden conseguir. -->

            <div class="awards">
                <div class="title1">¿Qué se puede conseguir con los puntos?</div>
                <div class="title2">¿Qué premios puedo optar con mis puntos?</div>
                <div class="awards_description">
                    <ul>
                        <blockquote>
                            <li>Ir a la fiesta de fin de curso ( si se tiene 15 o más puntos).</li>
                            <li>Participar y ganar en el sorteo de una tablet.</li>
                            <li>Ir a las excursiones.</li>
                            <li>Diplomas de buen comportamiento.</li>
                            <li>Participar en actividades lúdicas del centro.</li>
                            <li>Periódicamente se compensarán los puntos.</li>
                        </blockquote>
                        <b>Si llega a 20 puntos:</b>
                        <blockquote>
                            <li>Podrá elegir el sitio en la clase por 1 semana.</li>
                            <li>Podrá elegir compañero/a para el próximo trabajo por parejas.</li>
                        </blockquote>
                        <b>Si llega a 25 puntos:</b>
                        <blockquote>
                            <li>Recibirá un diploma.</li>
                            <li>Podrá ser vigilante de pasillo.</li>
                        </blockquote>
                        <b>Si llega a 30 puntos:</b>
                        <blockquote>
                            <li>Pase para poder subir 1 punto en las notas al finalizar el trimestre en alguna asignatura.</li>
                            <li>Pase para salir (1 día) 15 minutos antes al recreo y desayunar gratis en la cafetería.</li>
                            <li>Poder salir de excursión con otros cursos.</li>
                    </ul>
                    </blockquote>
                </div>

                <!-- Tercer cuadro informativo sobre los premios a los que puede optar el alumno dependiendo de sus puntos. -->

                <div class="own_awards">
                    <ul>
                        <?php if ($row['Puntos'] >= 30){?>
                            <blockquote>
                                <li>Ir a la fiesta de fin de curso.</li>
                                <li>Participar y ganar en el sorteo de una tablet.</li>
                                <li>Ir a las excursiones.</li>
                                <li>Diplomas de buen comportamiento.</li>
                                <li>Participar en actividades lúdicas del centro.</li>
                                <li>Puedes elegir el sitio en la clase por 1 semana.</li>
                                <li>Puedes elegir compañero/a para el próximo trabajo por parejas.</li>
                                <li>Recibirás un diploma.</li>
                                <li>Puedes ser vigilante de pasillo.</li>
                                <li>Pase para poder subir 1 punto en las notas al finalizar el trimestre en alguna asignatura.</li>
                                <li>Pase para salir (1 día) 15 minutos antes al recreo y desayunar gratis en la cafetería.</li>
                                <li>Poder salir de excursión con otros cursos.</li>

                            </blockquote>
                            <?php }else if ($row['Puntos'] >= 25){?>
                                <blockquote>
                                    <li>Ir a la fiesta de fin de curso.</li>
                                    <li>Participar y ganar en el sorteo de una tablet.</li>
                                    <li>Ir a las excursiones.</li>
                                    <li>Diplomas de buen comportamiento.</li>
                                    <li>Participar en actividades lúdicas del centro.</li>
                                    <li>Puedes elegir el sitio en la clase por 1 semana.</li>d
                                    <li>Puedes elegir compañero/a para el próximo trabajo por parejas.</li>
                                    <li>Recibirás un diploma.</li>
                                    <li>Podrá ser vigilante de pasillo.</li>
                                </blockquote>
                                <?php }else if ($row['Puntos'] >= 20){?>
                                    <blockquote>
                                        <li>Ir a la fiesta de fin de curso.</li>
                                        <li>Participar y ganar en el sorteo de una tablet.</li>
                                        <li>Ir a las excursiones.</li>
                                        <li>Diplomas de buen comportamiento.</li>
                                        <li>Participar en actividades lúdicas del centro.</li>
                                        <li>Puedes elegir el sitio en la clase por 1 semana.</li>
                                        <li>Puedes elegir compañero/a para el próximo trabajo por parejas.</li>
                                    </blockquote>
                                    <?php }else if ($row['Puntos'] >= 15){?>
                                        <blockquote>
                                            <li>Ir a la fiesta de fin de curso.</li>
                                            <li>Participar y ganar en el sorteo de una tablet.</li>
                                            <li>Ir a las excursiones.</li>
                                            <li>Diplomas de buen comportamiento.</li>
                                            <li>Participar en actividades lúdicas del centro.</li>
                                        </blockquote>
                                        <?php }else {?>
                                            <blockquote>
                                                Necesitarás ganar más puntos para conseguir algún premio.
                                            </blockquote>
                                            <?php }?>
                    </ul>
                </div>
            </div>

            <?php
        
            // Consulta para cuarto cuadro informativo acerca de las normas. Selecciona la puntuación de las normas, los puntos del carnet el código del curso y los motivos de las normas del alumno que ha iniciado sesión.

            $result->free();

            $student_data = "select perdida_ganancia.Puntuacion, carnet.Puntos, curso.Codigo_curso, perdida_ganancia.Motivo from alumnado, curso, carnet, perdida_ganancia where alumnado.Carnet = carnet.Num_exp and alumnado.Codigo_Curso = curso.Codigo_curso and curso.Codigo_curso = perdida_ganancia.Codigo_curso and alumnado.Num_exp =  '" . $_SESSION['user'] . "'";
            $result = $conexion->query($student_data);

            ?>
                <br>
                <br>
                <br>

                <!-- Cuarto cuadro informativo acerca de las normas. Esta dividido en normas que dan puntos y las que quitan puntos. -->

                <div class="rules">
                    <div class="title3">¿Qué normas debo de seguir?</div>
                    <div class="type_rules">
                        <div class="win_points">
                            <div class="title4">He perdido puntos. ¿Por qué?</div>
                            <ul>
                                <?php
                    while ($row = $result->fetch_assoc()) {
                        if ($row['Puntuacion'] < 0) {
                            switch ($row['Codigo_curso']){
                                    case 1: ?>
                                    <li>
                                        <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                    </li>
                                    <?php break;
                                    case 2: ?>
                                        <li>
                                            <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                        </li>
                                        <?php break;
                                    case 3: ?>
                                            <li>
                                                <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                            </li>
                                            <?php break;
                                    case 4: ?>
                                                <li>
                                                    <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                                </li>
                                                <?php break;
                                    case 5: ?>
                                                    <li>
                                                        <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                                    </li>
                                                    <?php break;
                                    case 6: ?>
                                                        <li>
                                                            <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                                        </li>
                                                        <?php break;
                                }
                            }
                        }
                                   ?>
                            </ul>
                        </div>
                        <div class="lose_points">
                            <div class="title4">¿Y cómo puedo recuperarlos?</div>
                            <ul>
                                <?php

                            $result->free();
                            $result = $conexion->query($student_data);

                        while ($row = $result->fetch_assoc()) {
                            if ($row['Puntuacion'] > 0) {
                                switch ($row['Codigo_curso']){
                                    case 1: ?>
                                    <li>
                                        <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                    </li>
                                    <?php break;
                                    case 2: ?>
                                        <li>
                                            <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                        </li>
                                        <?php break;
                                    case 3: ?>
                                            <li>
                                                <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                            </li>
                                            <?php break;
                                    case 4: ?>
                                                <li>
                                                    <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                                </li>
                                                <?php break;
                                    case 5: ?>
                                                    <li>
                                                        <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                                    </li>
                                                    <?php break;
                                    case 6: ?>
                                                        <li>
                                                            <?php echo $row['Motivo'] . ". (" . $row['Puntuacion'] . " puntos)"; ?>
                                                        </li>
                                                        <?php break;
                                }
                            }
                        }
                        ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Pie de página, incluido en todas las páginas. -->

                    <div class="footer">
                        <hr> © 2016 <signature style="float:right;">Francisco José Martín López</signature>
                        <br>
                        <br>
                    </div>
                </div>

                <?php
            $result->free();
            mysqli_close($conexion);
        ?>
    </body>

    <!-- Francisco José Martín López -->

    </html>