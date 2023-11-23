<?php
// Iniciar o destruir la sesión
session_start();

// Conexión a la base de datos
$servername = "utuserver.duckdns.org:3306";
$username = "utu";
$password = "utu2023";
$dbname = "HuellaCarbono";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$limitePreguntas = 10;
$indicePregunta = 1; // Comenzar desde la pregunta 1
$juegoEnCurso = false;

// Obtener la pregunta y respuesta de la base de datos
if ($_SERVER["REQUEST_METHOD"] === "POST")


    // Obtener la pregunta y respuesta de la base de datos
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Verificar si se hizo clic en "Iniciar Juego" o "Reiniciar Juego"
        if (isset($_POST['iniciarJuego']) || isset($_POST['reiniciarJuego'])) {
            $juegoEnCurso = true;
            $_SESSION['juegoEnCurso'] = true;
            $indicePregunta = 1;
            $resultado = null;
        }
        if (isset($_POST['reiniciarJuego'])) {
            $juegoEnCurso = false;
            $_SESSION['juegoEnCurso'] = false;
        }

        // Si el juego está en curso, procesar respuestas y mostrar preguntas
        if ($juegoEnCurso = true) {
            $indicePregunta = isset($_POST['indice']) ? $_POST['indice'] : 1;

            // Comprobar si se envió una respuesta
            if (isset($_POST['respuesta'])) {
                $respuestaUsuario = $_POST['respuesta'];

                // Obtener la respuesta correcta de la base de datos
                $sql = "SELECT PreguntaID, Pregunta, TruueFalse FROM Preguntas WHERE PreguntaID = $indicePregunta";
                $result = mysqli_query($con, $sql);

                // Verificar si hay filas en el resultado
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $preguntaActual = $row['Pregunta'];
                    $respuestaCorrecta = $row['TruueFalse'];

                    // Verificar si la respuesta del usuario es correcta
                    if ($respuestaUsuario == $respuestaCorrecta) {

                    }
                }

                // Avanzar al índice de la siguiente pregunta
                $indicePregunta++;
            }

            // Verificar si hay más preguntas
            if ($indicePregunta <= $limitePreguntas) {
                $sql = "SELECT PreguntaID, Pregunta, TruueFalse FROM Preguntas WHERE PreguntaID = $indicePregunta";
                $result = mysqli_query($con, $sql);

                // Verificar si hay filas en el resultado
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $preguntaActual = $row['Pregunta'];
                    $respuestaCorrecta = $row['TruueFalse'];
                } else {
                    // Si no hay más preguntas, puedes manejarlo de acuerdo a tus necesidades
                    $resultado = "Fin del juego";
                    $juegoEnCurso = false;  // Establecer el juego en curso a falso al final del juego
                    unset($_SESSION['juegoEnCurso']);  // Eliminar la variable de sesión
                }
            } else {
                // Obtener todas las preguntas y respuestas al final del juego
                $sqlTodas = "SELECT PreguntaID, Pregunta, Respuesta, TruueFalse FROM Preguntas";
                $resultTodas = mysqli_query($con, $sqlTodas);

                // Mostrar todas las preguntas y respuestas
                if ($resultTodas && mysqli_num_rows($resultTodas) > 0) {
                    echo "<h2>Todas las preguntas y respuestas:</h2>";
                    echo "<ul>";

                    while ($rowTodas = mysqli_fetch_assoc($resultTodas)) {
                        $preguntaTodas = $rowTodas['Pregunta'];
                        $ID = $rowTodas['PreguntaID'];
                        $solucion = $rowTodas['Respuesta'];
                        $respuestaTodas = $rowTodas['TruueFalse'];

                        echo "<li><strong>Pregunta $ID:</strong> $preguntaTodas <br> <strong>Respuesta:</strong> " . $solucion . " " . ($respuestaTodas == 1 ? 'Correcto' : 'Incorrecto') . "</li>";
                    }

                    echo "</ul>";
                    echo '<form method="post">
                        <input type="hidden" name="reiniciarJuego" value="1">
                        <input type="submit" value="Reiniciar Juego">
                      </form>';
                } else {
                    echo "No hay preguntas disponibles.";
                }
            }
        }
    }

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- METADATOS -->
    <meta name="author" content="Ahorrando pasos Team">
    <meta name="description" content="Sitio web sobre la huella de carbono ">
    <meta name="keywords"
        content="Huella, Carbono, Contaminacion en el mundo, CO2, Mitigar el impacto de la huella de carbono, Juego sobre la huella de carbono, Calcular la huella de carbono, Calculadora, , ambiente, medio">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINK ESTILOS -->
    <link rel="stylesheet" href="../styles/style-informacion.css">
    <link rel="stylesheet" href="../styles/style-general.css">
    <link rel="stylesheet" href="../styles/style-juego.css">
    <!-- LINK BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- LINK FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Juego didáctico</title>

    <!-- ESTILOS -->
    <style>
        body {
            padding-top: 100px;
        }


        .quiz-container {
            display: flex;
            flex-direction: column;
            width: 80%;
            margin: auto;
            text-align: center;
            backdrop-filter: blur(8px);
            border: 2px solid #342e16;
            border-radius: 30px;
        }

        .iniciar-juego {
            border-style: none;
            font-size: 30px;
            display: flex;
            margin: 80px auto;
            border-radius: 50px;
            padding: 10px 30px;
            background-color: #9ea078;
            color: white;
            font-weight: 600;
            border: 2px solid #342e16;
            transition: all 0.3s ease-in-out;


        }

        .iniciar-juego:hover {
            color: black;
            background-color: white;
            transform: translateY(-10px);
            transition: all 0.4s ease-in-out;
        }

        h1 {
            font-size: 50px;
            padding-top: 80px;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
        }

        .numero-pregunta {
            font-size: 40px;
        }

        .pregunta-actual {
            font-size: 25px;
        }

        .botones-respuesta {
            width: 100%;
        }

        .botones-respuesta input {}

        .botones-respuesta:focus-within {}




        /*--------------------INICIO FOOTER GENERAL--------------------*/
        footer {
            border-top: 10px solid #529a58;
            background-color: #204e44;
            color: var(--blanco-2);
            width: 100vw;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 99999;
        }

        footer .container-us {
            border-top: 10px solid #529a58;
            background-color: #529a58;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            list-style: circle;
        }

        footer a,
        footer a:visited {
            color: white;
            text-decoration: none;
        }

        footer .utu-info {
            width: 100vw;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            justify-content: space-between;
            text-shadow: 0px 0px 1px var(--negro);
        }

        footer .utu-info>div {
            display: flex;
        }

        footer .utu-info .end-container a {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        footer .utu-info>div p {
            padding: 4px;
        }

        footer .utu-info>div i {
            color: var(--blanco-2);
            text-align: center;
            padding: 10px;
            font-size: 1.2rem;
        }

        footer img {
            width: 100px;
            margin: 20px 0px 10px;
            align-self: center;
            filter: drop-shadow(0px 1px 1px var(--sombra));
        }

        /*--------------------FIN FOOTER GENERAL--------------------*/
        /*--------------------INICIO FOOTER TABLET Y MENOS--------------------*/
        @media (width<769px) {
            footer .container-us {
                flex-direction: column;
            }

            footer .container-us h3 {
                border-bottom: 3px solid #529a58;
            }

            footer .utu-info {
                flex-direction: column;
            }

            footer .utu-info>div {
                flex-direction: column;
                align-items: flex-start;
            }

            footer .utu-info .first-container>a {
                align-self: center;
            }

            footer img {
                align-self: center;
                filter: drop-shadow(0px 1px 1px var(--sombra));
            }

            footer .middle-container .us-button {
                display: none;
            }

            #x-mark {
                display: none;
            }
        }

        /*--------------------FIN FOOTER TABLET Y MENOS--------------------*/
        /* INICIO ADAPTACION DE DIMENSION A LAPTOP */
        @media (width > 768px) {
            footer {
                padding: 10px 0px;
                box-shadow: 0px 0px 4px #529a58;
                border-top: 2px solid var(--blanco-2);
                z-index: 9999;
            }

            footer .container-us {
                display: none;
                flex-direction: column;
                justify-content: space-evenly;
                align-items: center;
                flex-wrap: wrap;
                position: fixed;
                bottom: 100px;
                width: 500px;
                height: 400px;
                border: 2px solid;
                border-radius: 5px;
                z-index: 9999;
                font-weight: 600;
            }

            #x-mark {
                display: flex;
                align-items: center;
                justify-content: center;
                align-self: flex-end;
                position: fixed;
                cursor: pointer;
                bottom: 420px;
                margin-right: 30px;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
                background-color: #529a58;
                color: var(--blanco);
                border: 2px solid var(--blanco-2);
            }

            #x-mark:hover {
                background-color: var(--blanco-2);
                color: var(--azul);
                border: 2px solid #529a58;
            }

            footer .container-us h3 {
                display: none;
            }

            footer .container-us li {
                letter-spacing: 3px;
                word-spacing: 4px;
                margin-top: 10px;
                padding: 6px 0px;
            }

            footer .utu-info {
                max-width: calc(100% - 300px);
                display: flex;
                align-items: center;
                background-color: #204e44;
            }

            footer .utu-info>div {
                flex-direction: column;
                align-items: flex-start;
                padding-bottom: 40px;
            }

            footer .utu-info>div h3 {
                padding: 10px 0px;
                color: var(--blanco);
            }

            footer .utu-info .first-container>a {
                align-self: center;
            }

            footer .utu-info a:hover {
                filter: brightness(1.5);
            }

            footer .middle-container .us-button {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            footer .middle-container .us-button button {
                background: none;
                margin: 10px 0px;
                padding: 10px;
                border-radius: 10px;
                background-color: var(--blanco-2);
                color: #529a58;
                border: 2px solid #529a58;
                cursor: pointer;
            }

            footer .middle-container .us-button button:hover {
                background-color: #529a58;
                color: var(--blanco);
                border: 2px solid var(--azul-claro);
            }
        }
    </style>

</head>
<header>

    <!--SECCIÓN NAV-->
    <section class="seccion-navbar">
        <nav id="navbar">
            <a href="./index.index"><img src="../imgs/logo-navegacion.png" alt="Logo"></a>

            <h2>Ahorrando Pasos</h2>

            <ul>
                <li><a href="../index.html">Información</a></li>
                <li><a href="../pages/calculadora.php">Calculadora</a></li>
                <li><a href="../pages/juego.php">Juego didáctico</a></li>
            </ul>
            <div class="menu-icon" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>

        </nav>
    </section>
</header>

<body>
    <section class="seccion-juego">
        <div class="quiz-container">
            <h1>Verdadero o Falso</h1>
            <?php if (!$juegoEnCurso) { ?>
                <form method="post">
                    <input type="hidden" name="iniciarJuego" value="1">
                    <input class="iniciar-juego" type="submit" value="Iniciar Juego">
                </form>
            <?php } elseif ($indicePregunta <= $limitePreguntas) { ?>
                <form method="post">
                    <p class="numero-pregunta">Pregunta N°
                        <?php echo $indicePregunta; ?>:
                    </p>
                    <p class="pregunta-actual">
                        <?php echo isset($preguntaActual) ? $preguntaActual : ''; ?>
                    </p>
                    <input type="hidden" name="indice" value="<?php echo $indicePregunta; ?>">
                    <div class="botones-respuesta">
                        <label>
                            <input type="radio" name="respuesta" value="1"> Correcto
                        </label>
                        <label>
                            <input type="radio" name="respuesta" value="0"> Incorrecto
                        </label>
                    </div>
                    <br>
                    <input type="submit" value="Responder">
                </form>
            <?php } ?>
            <?php if (isset($resultado)) {
                echo "<p class='result'>$resultado</p>";
            } ?>
            <?php if ($juegoEnCurso && $indicePregunta <= $limitePreguntas) { ?>
                <form method="post">
                    <input type="hidden" name="indice" value="<?php echo $indicePregunta; ?>">
                </form>
            <?php } ?>
        </div>
    </section>
    <!-- SCRIPT  FOOTER -->
    <script src="../js/script-footer.js"></script>
    <!-- SCRIPT BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- SCRIPT NAVBAR -->
    <script src="../js/script-navbar.js"></script>


</body>
<footer>
    <div class="utu-info">
        <div class="first-container">
            <a href="./index.html">
                <img src="../imgs/utu-blanco.png">
            </a>
            <h3>Escuela Técnica de Trinidad</h3>
            <a target="_blank" href="https://maps.app.goo.gl/mLupkzYxS2bBtx1i9">
                <p>25 de Agosto 427, 85000</p>
                <p>Trinidad, Departamento de Flores</p>
            </a>
        </div>
        <div class="middle-container">
            <div class="contact">
                <h3>Contacto</h3>
                <p>Teléfono: <a href="">4364 2426</a></p>
                <p>Email: <a target="_blank" href="">tecnicatrinidad@gmail.com</a></p>
            </div>
            <div class="us-button">
                <button onclick="toggleUs(1)">
                    <h4>Equipo de desarrollo</h4>
                </button>
            </div>
        </div>
        <div class="end-container">
            <h3>Redes</h3>
            <a target="_blank" href="https://www.instagram.com/ututecnicatrinidad/">
                <i class="fa-brands fa-instagram"></i>
                @ututecnicatrinidad
            </a>
            <a target="_blank" href="https://www.facebook.com/utu.trinidad.58/?locale=es_LA">
                <i class="fa-brands fa-facebook"></i>
                Utu Trinidad
            </a>
            <a href="091337739">
                <i class="fa-brands fa-whatsapp"></i>
                091 337 739
            </a>
        </div>
    </div>
    <div class="container-us" id="menu-us">
        <h3>Nosotros</h3>
        <button id="x-mark" onclick="closeUs(0)"><i class="fa-solid fa-xmark"></i></button>
        <li>Brian Bidondo</li>
        <li>Diego Barrera</li>
        <li>Lautaro Deccia</li>
        <li>Axel Hernández</li>
        <li>Mauricio Belén</li>
    </div>


</footer>

</html>