<?php

    // Llamamos al archivo de seguridad.

    include ('security.php');

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Sancionar</title>
        <link rel="stylesheet" href="css/sanction.css">
        <link href="images\iconoIES.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="scripts/js/mi.js"></script>
    </head>

    <body>
        
        <!-- Descripción del archivo. Página secundaria de los usuarios profesor. Aquí se realizan las sanciones a los alumnos --> 
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
            
                $student_name = "select Nombre_profesor from profesor where Id_profesor =  '" . $_SESSION['user'] . "'";
                $result = $conexion->query($student_name);
                $row = $result->fetch_assoc();
            ?>

                <!-- Mostramos el siguiente mensaje con el nombre del usuario y un enlace para cerrar sesión. También se incluye un botón para volver a la página anterior, es decir a la página principal de profesores. -->

                <div class="first_message">
                    <b><?php echo "Bienvenid@, " . $row['Nombre_profesor'] . "  " ?></b>
                    <a href="logout.php">
                        <input type="submit" value="Cerrar sesión">
                    </a>
                    <br>
                    <br>
                    <a href="teachers.php">
                        <input type="submit" value="Volver atrás">
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
        <br>
        <br>

       <!-- Seleccionamos todos los nombres y codigos de curso. -->
       
        <?php
        
            $grades = "SELECT Nombre, Codigo_curso from curso";
            $result1 = $conexion->query($grades);
   
           $selected = "";
        
            // Si el servidor muestra una petición de reenvio del método post crea esa variable.

           if($_SERVER['REQUEST_METHOD']=='POST')
           {
              $selected = $_POST['grade'];
           }

        ?>

           <!-- Formulario para seleccionar el curso para que muestre los alumnos de ese curso. -->
           
            <div class="main">
                <div class="title">Sancionar</div>
                <div class="info">
                    <form action="sanction.php" method="post">
                        <br>
                        <div class="line">
                            <label>Curso: </label>
                            <input type="submit" value="Seleccionar curso">
                            <select name="grade" type="text" class="grade">
                                <?php
                        while ($row1 = $result1->fetch_assoc()) { 
                                    if($row1['Codigo_curso'] == $selected)
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
                            <br>

                        </div>
                    </form>
                    <br>
                    
                    <!-- Si se ha seleccionado un curso entrará en la estructura de control. -->
                    
                    <?php
                        
                    if (!isset($_POST['grade']) && empty($_POST['grade'])){
                    $grade = '';

                    }else{
                        
                        // Muestra el nombre del alumno, los apellidos, el número de expediente y el número del carnet del curso seleccionado.
                        
                        $grade = $_POST['grade'];
                        $students = "select Nombre_alumno, Apellidos_alumno, Num_exp, Carnet from alumnado where Codigo_curso = '" . $grade . "' order by Nombre_alumno";
                        $result2 = $conexion->query($students);
                    
                    ?>
                       
                       <!-- Segundo formulario con los alumnos del curso seleccionado y las normas que restan puntos de ese curso. -->
                       
                        <div class="second_info">
                            <form action="back_sanction.php" method="post">
                                <div class="line">
                                    <label>Nombre del alumno: </label>
                                    <select name="student" type="text" class="field">
                                        <option value="none" selected></option>
                                        <?php
                            while ($row2 = $result2->fetch_assoc()) { ?>
                                            <option value="<?php echo $row2['Num_exp'] ?>">
                                                <?php echo $row2['Nombre_alumno'] . " " . $row2['Apellidos_alumno'] ?>
                                            </option>
                                            <?php } ?>
                                    </select>
                                </div>
                                <br>
                                <?php
                        
                        // Selecciona el id del motivo y el motivo del curso seleccionado con puntuación negativa solamente.
                        
                        $reasons = "SELECT Id_motivo, Motivo from perdida_ganancia where Codigo_curso = '" . $grade . "' and Puntuacion like '-%' order by Puntuacion DESC";
                        $result3 = $conexion->query($reasons);
                    
                    ?>
                                    <div class="line">
                                        <label>Motivo: </label>
                                        <select name="reason" type="text" class="reason">
                                            <option value="none" selected></option>
                                            <?php
                                while ($row3 = $result3->fetch_assoc()) { ?>
                                                <option value="<?php echo $row3['Id_motivo'] ?>">
                                                    <?php echo $row3['Motivo'] ?>
                                                </option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <br>
                                    <input type="hidden" name="grade" value="<?php echo $grade ?>">
                                    <input type="submit" value="Enviar">
                            </form>
                        </div>
                </div>
            </div>


            <?php
                        
                
                $result2->free();
                $result3->free();
                        
                    }
                    
                $result1->free();
                mysqli_close($conexion);
            ?>
                </div>
                </div>
                
                <!-- Pie de página, incluido en todas las páginas. -->
                
                <div class="footer1">
                    <div class="footer">
                        <hr> © 2016 <signature style="float:right;">Francisco José Martín López</signature>
                        <br>
                        <br>
                    </div>
                </div>
    </body>

    <!-- Francisco José Martín López -->
   
    </html>