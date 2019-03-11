<?php

    // Llamamos al archivo de seguridad.

    include ('security.php');

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Profesores</title>
        <link rel="stylesheet" href="css/teachers.css">
        <link href="images\iconoIES.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="scripts/js/mi.js"></script>
    </head>

    <body>

        <!-- Descripción del archivo. Página principal de los usuarios profesor. -->
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

                // Selecciona el nombre del profesor que ha iniciado sesión.
            
                $student_name = "select Nombre_profesor from profesor where Id_profesor =  '" . $_SESSION['user'] . "'";
                $result = $conexion->query($student_name);
                $row = $result->fetch_assoc();
                ?>

                <!-- Mostramos el siguiente mensaje con el nombre del usuario y un enlace para cerrar sesión. -->

                <div class="first_message">
                    <b><?php echo "Bienvenid@, " . $row['Nombre_profesor'] . "  " ?></b>
                    <a href="logout.php">
                        <input type="submit" value="Cerrar sesión">
                    </a>
                </div>

                <?php $result->free(); ?>


        </div>

        <!-- Menú de accesibilidad incluido en todas las páginas. Este menú incluye ods opciones diferentes a los demás que son sancionar y premiar. Estas opciones te enviarán a las páginas correspondientes. -->

        <div id="menu">
            <ul class="nav">
                <li><a href="home.php#header">Inicio</a></li>
                <li><a href="home.php#works">¿Cómo funciona?</a></li>
                <li><a href="home.php#rules">Reglamento</a></li>
                <li><a href="sanction.php">Sancionar</a></li>
                <li><a href="reward.php">Premiar</a></li>
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

        <!-- Seleccionamos todos los nombres y codigos de curso. -->

        <?php
        
            $grades = "SELECT Nombre, Codigo_curso from curso";
            $result1 = $conexion->query($grades);
        
            // Si el servidor muestra una petición de reenvio del método post crea esa variable.

           if($_SERVER['REQUEST_METHOD']=='POST')
           {
               $grade = $_POST['grade'];
           }

        ?>

            <br>
            <br>

            <!-- Formulario de la pestaña para seleccionar los cursos. -->

            <div class="management">
                <form action="teachers.php" method="post" class="grade_form">
                    Cursos:
                    <select name="grade" id="grade_id">
                        <?php
                        while ($row1 = $result1->fetch_assoc()) { 
                                    if($row1['Codigo_curso'] == $grade)
                                    { ?>
                            <option value="<?php echo $row1['Codigo_curso'] ?>" selected>
                                <?php echo $row1['Nombre'] ?>
                            </option>
                            <?php }
                                    else
                                    { ?>
                                <option value="<?php echo $row1['Codigo_curso'] ?>">
                                    <?php echo $row1['Nombre'] ?>
                                </option>
                                <?php }
                                 }
                                ?>
                    </select>
                    <input type="submit" value="Seleccionar curso">
                    <input type="submit" name="all_students" value="Mostrar todos los alumnos">
                </form>
            </div>

            <!-- Si se elige un curso y se reeenvía el formulario aparecerán las demás pesatañas de alumno y mes. Los alumnos que aparezcan serán  los del curso seleccionado. -->

            <?php

                if (!isset($_POST['grade']) && empty($_POST['grade'])){
                    $grade = '';

                    }else{
                    
                            // Selecciona el número de expediente, el nombre del alumno y los apellidos del alumno del curso seleccionado ordenados alfabéticamente por el nombre del alumno.        
                    
                            $grade = $_POST['grade'];
                            $students_name = 'SELECT Num_exp, Nombre_alumno, Apellidos_alumno FROM alumnado, curso where curso.Codigo_curso = '.$grade.' AND alumnado.Codigo_curso = curso.Codigo_curso ORDER BY Apellidos_alumno';
                            $result = $conexion->query($students_name);
                    
                    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['choose_student'])) {
                            $student = $_POST['student'];
                            $month = $_POST['month'];
                       }

                ?>

                <!-- Formulario que muestra los alumnos del curso seleccionado y los meses. -->

                <div class="management">
                    <form action="teachers.php" method="post" class="student_form">
                        Alumnos:
                        <select name="student" id="student_id">
                            <?php
                        while ($row = $result->fetch_assoc()) { 
                               if($row['Num_exp'] == $student) { ?>
                                <option value="<?php echo $row['Num_exp'] ?>" selected>
                                    <?php echo $row['Nombre_alumno'] . " " . $row['Apellidos_alumno'] ?>
                                </option>
                                <?php } else { ?>
                                    <option value="<?php echo $row['Num_exp'] ?>">
                                        <?php echo $row['Nombre_alumno'] . " " . $row['Apellidos_alumno'] ?>
                                    </option>
                                    <?php } 
                            $month_selected = "select SUBSTRING(CURDATE(), 6, 2) as Mes_actual";
                            $result8 = $conexion->query($month_selected);
                            $row8 = $result8->fetch_assoc();
                            $month = $row8['Mes_actual'];
                        } ?>
                        </select>
                        <div class="month">
                            Mes:
                            <select name="month" id="month_id">
                                <?php if($month == "01") { ?>
                                    <option value="01" selected>Enero</option>
                                    <?php } else { ?>
                                        <option value="01">Enero</option>
                                        <?php } if($month == "02") { ?>
                                            <option value="02" selected>Febrero</option>
                                            <?php } else { ?>
                                                <option value="02">Febrero</option>
                                                <?php } if($month == "03") { ?>
                                                    <option value="03" selected>Marzo</option>
                                                    <?php } else { ?>
                                                        <option value="03">Marzo</option>
                                                        <?php } if($month == "04") { ?>
                                                            <option value="04" selected>Abril</option>
                                                            <?php } else { ?>
                                                                <option value="04">Abril</option>
                                                                <?php } if($month == "05") { ?>
                                                                    <option value="05" selected>Mayo</option>
                                                                    <?php } else { ?>
                                                                        <option value="05">Mayo</option>
                                                                        <?php } if($month == "06") { ?>
                                                                            <option value="06" selected>Junio</option>
                                                                            <?php } else { ?>
                                                                                <option value="06">Junio</option>
                                                                                <?php } if($month == "09") { ?>
                                                                                    <option value="09" selected>Septiembre</option>
                                                                                    <?php } else { ?>
                                                                                        <option value="09">Septiembre</option>
                                                                                        <?php } if($month == "10") { ?>
                                                                                            <option value="10" selected>Octubre</option>
                                                                                            <?php } else { ?>
                                                                                                <option value="10">Octubre</option>
                                                                                                <?php } if($month == "11") { ?>
                                                                                                    <option value="11" selected>Noviembre</option>
                                                                                                    <?php } else { ?>
                                                                                                        <option value="11">Noviembre</option>
                                                                                                        <?php } if($month == "12") { ?>
                                                                                                            <option value="12" selected>Diciembre</option>
                                                                                                            <?php } else { ?>
                                                                                                                <option value="12">Diciembre</option>
                                                                                                                <?php } ?>
                            </select>
                            <input type="submit" name="choose_student" value="Seleccionar alumno">
                            <input type="hidden" name="grade" value="<?php echo $grade; ?>">
                        </div>
                    </form>
                </div>

                <!-- Si se ha enviado el formulario anterior, entrará en la siguiente estructura de control donde aparecerán tablas con las siguientes consultas. -->

                <?php
                }
        
            if (!isset($_POST['all_students'])){
                $bottom = 0;
                
                }else{
                    $grade = $_POST['grade'];
                    
                    // Selecciona todos los alumnos y los puntos que tiene cada alumno del curso seleccionado ordenados alfabéticamente por apellidos.
                
                    $students = "SELECT alumnado.Nombre_alumno, alumnado.Apellidos_alumno, carnet.Puntos from alumnado, carnet, curso where curso.Codigo_curso = alumnado.Codigo_curso and alumnado.Carnet = carnet.Num_exp and curso.Codigo_curso = '". $grade ."' order by alumnado.Apellidos_alumno ";
                    $result6 = $conexion->query($students);
                                
            ?>
                    <br>
                    <br>

                    <!-- Tabla informativa sobre todos los alumnos y los puntos actuales de cada alumno. -->

                    <table class="all_students">
                        <tr class="tables_title">
                            <td>Alumno</td>
                            <td>Puntos</td>
                        </tr>

                        <?php
                            while ($row6 = $result6->fetch_assoc()) { ?>
                            <tr class="info">
                                <td style="padding-left: 5%; padding-right: 5%;">
                                    <?php echo $row6['Nombre_alumno'] . " " . $row6['Apellidos_alumno'] ?>
                                </td>
                                <td align="center">
                                    <?php echo $row6['Puntos'] ?>
                                </td>
                            </tr>
                            <?php }
                            ?>

                    </table>

                    <?php
        
                $result6->free();
                
            }
        
            if (!isset($_POST['choose_student'])){
                    $student = '';
                if (!isset($_POST['all_students'])){
                    $bottom = 0;
                }
                
                    }else{
                        $student = $_POST['student'];
                        $month = $_POST['month'];
                        $grade = $_POST['grade'];
                
                        // Selecciona los puntos de inicio del mes seleccionado, el nombre del curso, el nombre del alumno, el número del carnet, el nombre del alumno y los apellidos del alumno que se hayan seleccionado.
                        
                        $name_points = 'SELECT historial_carnet.Puntos_ini, curso.Nombre, carnet.Num_exp, Nombre_alumno, Apellidos_alumno FROM alumnado, carnet, curso, historial_carnet where alumnado.Carnet = carnet.Num_exp and carnet.Num_exp = historial_carnet.Num_exp and alumnado.Num_exp = '.$student.' AND alumnado.Codigo_curso = curso.Codigo_curso  and SUBSTRING(Inicio_mes, 6, 2) = '.$month.' ORDER BY Nombre_alumno';
                        $result1 = $conexion->query($name_points);
                        $row1 = $result1->fetch_assoc();
                        
                        // Seleccionamos la suma de todos los puntos que sean negativos del alumno que se haya seleccionado y del mes.

                        $loss = "SELECT SUM(Puntuacion) as Perdida from actualiza, alumnado, carnet where Puntuacion like '-%' and carnet.Num_exp = alumnado.Carnet and alumnado.Num_exp = '" . $student . "' and carnet.Num_exp = actualiza.Num_exp and SUBSTRING(Fecha_hora, 6, 2) = '" . $month . "'";
                        $result2 = $conexion->query($loss);
                        $row2 = $result2->fetch_assoc();
                
                        // Seleccionamos la suma de todos los puntos que sean postivios del alumno que se haya seleccionado y del mes.

                        $gain = "SELECT SUM(Puntuacion) as Ganancia from actualiza, alumnado, carnet where Puntuacion not like '-%' and carnet.Num_exp = alumnado.Carnet and alumnado.Num_exp = '" . $student . "' and carnet.Num_exp = actualiza.Num_exp and SUBSTRING(Fecha_hora, 6, 2) = '" . $month . "'";
                        $result3 = $conexion->query($gain);
                        $row3 = $result3->fetch_assoc();

                        // Seleccionamos la suma del total de puntuación de las normas acontecidas al alumno del mes seleccionado más los puntos de inicio del mes seleccionado del alumno y curso elegidos.
                        
                        $balance = "SELECT (SUM(Puntuacion) + historial_carnet.Puntos_ini) as Balance from actualiza, alumnado, carnet, historial_carnet where carnet.Num_exp = alumnado.Carnet and carnet.Num_exp = historial_carnet.Num_exp and alumnado.Num_exp = '" . $student . "' and carnet.Num_exp = actualiza.Num_exp and SUBSTRING(actualiza.Fecha_hora, 6, 2) = '" . $month . "' and SUBSTRING(historial_carnet.Inicio_mes, 6, 2) = '" . $month . "'";
                        $result4 = $conexion->query($balance);
                        $row4 = $result4->fetch_assoc();
                
                        // Seleccionamos la fecha y hora y el motivo de las normas acontecidas al alumno seleccionado en el mes seleccionado. Están ordenados por la fecha del suceso.

                        $event = "select actualiza.Fecha_hora, perdida_ganancia.Motivo from actualiza, perdida_ganancia, alumnado, carnet, curso where carnet.Num_exp = alumnado.Carnet and alumnado.Num_exp = '" . $student . "' and carnet.Num_exp = actualiza.Num_exp and curso.Codigo_curso = perdida_ganancia.Codigo_curso and SUBSTRING(actualiza.Fecha_hora, 6, 2) = '" . $month . "' and perdida_ganancia.Codigo_curso = '". $grade ."' and actualiza.Codigo_curso = perdida_ganancia.Codigo_curso and perdida_ganancia.Id_motivo = actualiza.Id_motivo order by actualiza.Fecha_hora DESC";
                        $result5 = $conexion->query($event);

                if ($month == '01'){
                    $month = 'Enero';
                }else if($month == '02'){
                    $month = 'Febrero';
                }else if($month == '03'){
                    $month = 'Marzo';
                }else if($month == '04'){
                    $month = 'Abril';
                }else if($month == '05'){
                    $month = 'Mayo';
                }else if($month == '06'){
                    $month = 'Junio';
                }else if($month == '09'){
                    $month = 'Septiembre';
                }else if($month == '10'){
                    $month = 'Octubre';
                }else if($month == '11'){
                    $month = 'Noviembre';
                }else if($month == '12'){
                    $month = 'Diciembre';
                }
                

            ?>
                        <br>
                        <br>

                        <!-- Primera tabla informativa que muestra el nombre del alumno, junto con los puntos que ha perdido, ha ganado y el balance total de los puntos que tiene en este mes o hasta la fecha actual si el mes seleccionado es el actual. -->

                        <table class="info_table">
                            <tr class="tables_title">
                                <td colspan="2">Carnet convivencia por puntos</td>
                                <td colspan="2">
                                    <?php echo $row1['Nombre'] ?>
                                </td>
                                <td>
                                    <?php echo $month ?>
                                </td>
                            </tr>
                            <tr class="tables_title">
                                <td>Alumno</td>
                                <td>Inicio</td>
                                <td>Pérdida</td>
                                <td>Ganancia</td>
                                <td>Balance</td>
                            </tr>
                            <tr class="info">
                                <td>
                                    <?php echo $row1['Nombre_alumno'] . " " . $row1['Apellidos_alumno'] ?>
                                </td>
                                <td>
                                    <?php echo $row1['Puntos_ini'] ?>
                                </td>
                                <td>
                                    <?php echo $row2['Perdida'] ?>
                                </td>
                                <td>
                                    <?php echo $row3['Ganancia'] ?>
                                </td>
                                <td>
                                    <?php echo $row4['Balance'] ?>
                                </td>
                            </tr>
                        </table>

                        <br>
                        <br>

                        <!-- Segunda tabal informativa que muestra los eventos acontecidos junto con la hora y día del evento al alumno seleccionado ordenados por fecha del suceso. -->

                        <table class="events_table">
                            <tr class="tables_title">
                                <td>Suceso</td>
                                <td>Fecha</td>
                            </tr>

                            <?php

                    while ($row5 = $result5->fetch_assoc()) {
                            $fecha = "SELECT DATE_FORMAT('" . $row5['Fecha_hora'] . "', '%W') as Fecha_hora";
                            $result7 = $conexion->query($fecha);
                            $row7 = $result7->fetch_assoc();
                            $day = $row7['Fecha_hora'];
                        
                            if ($day == 'Monday'){
                                $day = 'Lunes';
                            }else if($day == 'Tuesday'){
                                $day = 'Martes';
                            }else if($day == 'Wednesday'){
                                $day = 'Miercoles';
                            }else if($day == 'Thrusday'){
                                $day = 'Jueves';
                            }else if($day == 'Friday'){
                                $day = 'Viernes';
                            }else if($day == 'Saturday'){
                                $day = 'Sabado';
                            }else if($day == 'Sunday'){
                                $day = 'Domingo';
                            }
                        
                            ?>
                                <tr class="info">
                                    <td align="center">
                                        <?php echo $row5['Fecha_hora'] . " " . $day ?>
                                    </td>
                                    <td style="padding-left: 5%; padding-right: 5%;">
                                        <?php echo $row5['Motivo'] ?>
                                    </td>
                                </tr>
                                <?php 
                    $result7->free();
                    } ?>

                        </table>



                        <?php
                
            $result->free();
            $result1->free();
            $result2->free();
            $result3->free();
            $result4->free();
            $result5->free();

            } 
                mysqli_close($conexion);
        
                        // Comprobamos el funcionamiento de las sanciones y premios y mostramos el mensaje correspondiente dependiendo de si se han realizado correctamente o no.

                        if (isset($_GET['sanction']) and !strcmp($_GET['sanction'], 'y')){ ?>
                            <p class='error'>Sanción realizada correctamente</p>
                            <?php  }
                            if (isset($_GET['sanction']) and !strcmp($_GET['sanction'], 'no')){ ?>
                                <p class='error2'>Sanción realizada incorrectamente.</p>
                                <?php
                                            }
                                if (isset($_GET['reward']) and !strcmp($_GET['reward'], 'y')){ ?>
                                    <p class='error'>Premio realizado correctamente</p>
                                    <?php  }
                                        if (isset($_GET['reward']) and !strcmp($_GET['reward'], 'no')){ ?>
                                        <p class='error2'>Premio realizado incorrectamente.</p>
                                        <?php
                                            }
        
                        // Capturamos si se ha ejecutado el segundo formulario para cambiar los estilos de la página.
        
                        if (isset($_POST['choose_student']) or isset($_POST['all_students'])){
                            $bottom = 'none';
                        } else {
                            $bottom = 0;
                        }
                                                ?>
                                            <br>

                                            <!-- Estética de la página web. -->

                                            <style>
                                                .footer {
                                                    position: absolute;
                                                    width: 89%;
                                                    bottom: <?php echo $bottom ?>;
                                                    margin: 0 auto;
                                                }
                                                
                                                @media screen and (max-height: 570px) {
                                                    .footer {
                                                        bottom: initial;
                                                    }
                                                }
                                            </style>

                                            <!-- Pie de página, incluido en todas las páginas. -->

                                            <div class="footer1">
                                                <div class="footer">
                                                    <hr> © 2016
                                                    <signature style="float:right;">Francisco José Martín López</signature>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
    </body>

    <!-- Francisco José Martín López -->

    </html>