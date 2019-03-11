<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/home.css">
    <link href="images\iconoIES.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script src="scripts/js/mi.js"></script>
</head>

<body>
  
    <!-- Descripción del archivo. Página principal de la aplicación web. --> 
    <!-- Creamos el header que almacenará el logotipo del intituto junto con el sistema de login. -->
   
    <div class="header" id="header">

        <img src="images\LogoInsti.png" alt="logoInstituto" height="88" width="388">

        <form action="back_home.php" method="post" class="login">
            <label>Usuario: </label>
            <input name="user" type="text">
            <label>Contraseña: </label>
            <input name="password" type="password">
            <input name="login" type="submit" value="Iniciar sesión">

            <?php
                if (isset($_GET['errorusuario']) and !strcmp($_GET['errorusuario'], 'si')){ ?>
                <p class='error'>Usuario o contraseña incorrectos</p>
                <?php  } ?>

        </form>

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
    
    <!-- Primer cuadro informativo acerca del carnet por puntos. -->
    
    <div class="info">
        <div class="title1" id="works">¿Qué es el carnet por puntos?</div>
        <div class="how_works">
            <ul>
                <div class="w_left">
                    <div class="subtitle">¿En qué consiste?</div>
                    <blockquote>
                        <p>El carnet por puntos es una de las medidas que se han puesto en marcha con la finalidad de mejorar el ambiente y la convivencia en nuestro centro.</p>
                        <img src="images/alumnos1.jpg" width="100%">
                        <p>Este sistema consiste en que el alumno irá perdiendo o ganando puntos dependiendo de su conducta. Para ello habrá que respetar unas normas, muy sencillas y razonables, que tienen que ver con la conducta en el centro, dentro y fuera de las clases.</p>
                        <p>También se ha creado un sistema para mantener informado al alumno y a las familias sobre el carnet por puntos. Ellos podrán <a href="home.php#header" class="links">acceder</a> mediante un usuario que se les dará. Así podrán comprobar sus puntos, los premios que pueden tener y la zona en la que están.</p>
                    </blockquote>
                </div>
                <div class="w_right">
                    <div class="subtitle">¿Cómo funciona?</div>
                    <blockquote>
                        <p>Los alumnos alumnos irán ganando o perdiendo puntos en función de su conducta. Dependiendo de los puntos que tengan y la zona en la que se encuentren podrán optar a unos premios u otros.</p>
                        <img src="images/alumnos2.jpg" width="100%">
                        <p>Las personas, quienes serán capaces de conceder o quitar puntos, será cualquier profesor/a del instituto dentro o fuera de clase.</p>
                        <p>Cabe destacar de forma importante que el nuevo carnet de conducta por puntos <b>no sustituye a las sanciones vigentes; es complementario</b>. Ser castigado con pérdida de puntos no significa que no pueda además ser castigado con las normas correspondientes que el centro tenga.</p>
                    </blockquote>
                </div>
            </ul>
        </div>

       <!-- Segundo cuadro infromativo acerca del reglamento del carnet por puntos. -->
       
        <div class="title1" id="rules">¿Cómo funciona el reglamento?</div>
        <div class="rules">
            <ul>
                <div class="r_left">
                    <div class="subtitle">Pérdida de puntos</div>
                    <blockquote>
                        <img src="images/tarjetaRoja.jpg" width="35%" align="center" class="photo1">
                        <p>Todos los alumnos partirán con 0 puntos en su carnet. A partir de esos puntos, se le podrá restar puntos, dependiendo de su conducta.</p>
                        <p>Si el alumno llega a 0 puntos o pierde su carnet, tendrá que recuperarlo con tareas y partirá de 0 puntos.</p>
                        <p>Toda la información sobre las normas de pérdida de puntos aparecerá en el <a href="home.php#header" class="links">perfil</a> de cada alumno.</p>
                    </blockquote>
                </div>
                <div class="r_right">
                    <div class="subtitle">Recuperación de puntos</div>
                    <blockquote>
                        <img src="images/tarjetaVerde.jpg" width="35%" align="center" class="photo1">
                        <p>El carnet por puntos también ofrece a los alumnos una serie de actividades orientadas a poder recuperar los puntos debido a su mal comportamiento. De esta forma, podrán llegar a conseguir grandes premios y subir de zona.</p>
                        <p>Toda la información sobre las normas de recuperación de puntos aparecerá en el <a href="home.php#header" class="links">perfil</a> de cada alumno.</p>
                    </blockquote>
                </div>
            </ul>
        </div>
        
        <!-- Tercer cuadro informativo acerca de las zonas del carnet por puntos. -->
        
        <div class="title1" id="zones">Zonas</div>
        <div class="zones">
            <ul>
                <div class="up">
                    <div class="z_left">
                        <div class="red">Zona Roja</div>
                        <blockquote>
                            <a href="home.php#header"><img src="images/zonaRoja.jpg" width="100%"></a>
                            <p>Si tu carnet tienes menos de 10 puntos estás en zona roja.</p>
                            <p>Estar en esta zona implica la obligación de recuperar puntos mediante actividades definidas por el centro con carácter inmediato.</p>
                        </blockquote>
                    </div>
                    <div class="z_right">
                        <div class="yellow">Zona Amarilla</div>
                        <blockquote>
                            <a href="home.php#header"><img src="images/zonaAmarilla.jpg" width="100%"></a>
                            <p>Si tu carnet tiene entre 10 y 15 puntos estás en zona amarilla.</p>
                            <p>Estar en esta zona implica la obligación de recuperar puntos mediante actividades definidas por el centro durante la semana siguiente a la entrada en esta zona.</p>
                        </blockquote>
                    </div>
                </div>
                <div class="down">
                    <div class="z_left">
                        <div class="green">Zona Verde</div>
                        <blockquote>
                            <a href="home.php#header"><img src="images/zonaVerde.jpg" width="100%"></a>
                            <p>Si tu carnet tiene entre 15 y 20 puntos estás en la zona verde.</p>
                            <p>Estar en esta zona no implica sanciones, pero puedes ganar más puntos con actitudes que favorezcan la convivencia. De esta forma podrás alcanzar la zona azul que te llevará a lograr grandes premios.</p>
                        </blockquote>
                    </div>
                    <div class="z_right">
                        <div class="blue">Zona Azul</div>
                        <blockquote>
                            <a href="home.php#awards"><img src="images/zonaAzul.jpg" width="100%"></a>
                            <p>Si tu carnet tiene más de 20 puntos estás en la zona azul.</p>
                            <p>Estar en esta zona tiene su recompensa, pero puedes seguir ganando puntos si sigues con una actitud que favorezca la convivencia y lograr mejores premios.</p>
                        </blockquote>
                    </div>
                </div>
            </ul>
        </div>
        
        <!-- Cuarto cuadro informativo acerca de los premios del carnet por puntos. -->
        
        <div class="title1" id="awards">Premios</div>
        <div class="awards">
            <ul>
                <div class="a_middle">
                    <div class="subtitle">¿Qué se puede conseguir con los puntos?</div>
                    <blockquote>
                        <p>Con los puntos podemos llegar a conseguir grandes premios, pero para poder empezar a ganar algún premio, además de llevar un buen comportamiento debemos de estar, al menos, en la zona vede.</p>
                        <img src="images/trofeo.jpg" width="20%" align="center">
                        <p>Para poder optar a grandes premios deberemos de estar el la zona azul. A mayor número de puntos tengamos, conseguiremos mejores premios. Algunos de estos premios son:</p>
                        <img src="images/palmeritaChocolate.jpg" width="20%" align="right">
                        <blockquote>
                            <p>Pase para subir 1 punto en las notas al finalizar el trimestre en alguna asignatura.</p>
                            <p>Pase para salir 15 minutos antes al recreo y desayunar gratis en la cafetería.</p>
                        </blockquote>
                        <p>Para más información sobre los premios, accede a tu <a href="home.php#header" class="links">perfil</a>.</p>
                    </blockquote>
                </div>
            </ul>
        </div>
        
        <!-- Pie de página, incluido en todas las páginas. -->
        
        <div class="footer">
            <hr> © 2016 <signature style="float:right;">Francisco José Martín López</signature>
            <br>
            <br>
        </div>
    </div>
</body>

<!-- Francisco José Martín López -->

</html>