<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <!-- METADATOS -->
  <meta name="author" content="Ahorrando pasos Team">
  <meta name="description" content="Sitio web sobre la huella de carbono ">
  <meta name="keywords"
    content=" Huella, Carbono, Contaminacion en el mundo, CO2, Mitigar el impacto de la huella de carbono, Juego sobre la huella de carbono, Calcular la huella de carbono, Calculadora, , ambiente, medio">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- LINK DE ESTILOS -->
  <link rel="stylesheet" href="../styles/style-calculadora.css">
  <link rel="stylesheet" href="../styles/style-general.css">
  <link rel="stylesheet" href="../styles/style-footer.css">
  <!-- LINK BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- LINK FONTAWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <title>Ahorrando Pasos - Calculadora</title>
</head>

<body>

  <!--SECCIÓN NAV-->
  <nav id="navbar">
    <a href="../index.html"><img src="../imgs/logo-navegacion.png" alt="Logo"></a>

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

  <!-- SECCION HERO CALCULADORA -->
  <section class="seccion-hero-calculadora">
    <div class="hero-calculadora">
      <div class="hero-titulo-calculadora">
        <h2 class="bienvenido-calculadora">Bienvenido a <br><span> la calculadora de tu huella de carbono</span>
        </h2>
        <p class="que-es-calculadora-parrafo">Aquí podras calcular cual es tu huella de carbono mediante el cálculo de
          tu impacto en el día a día.
        </p>
      </div>
    </div>
  </section>

  <!-- SECCION CALCULADORA -->

  <section id="calculadora" class="calculadora">
    <div class="formulario-calculadora">
      <form id="carbon-footprint-form">
        <fieldset>
          <legend>Consumo de Energía</legend>
          <img src="../imgs/svgs/icon-electrodomesticos.png" alt="">
          <label for="electricity">Consumo de Electricidad (kWh)</label> <br>
          <input type="number" id="electricity" name="electricity" required min="0">
          <br>
          <label for="gas">Consumo de Gas (m³)</label><br>
          <input type="number" id="gas" name="gas" required min="0">
        </fieldset>
        <fieldset>
          <legend>Transporte</legend>
          <img src="../imgs/svgs/icon-vehiculos.png" alt="">
          <label for="car-mileage">Kilometraje del Automóvil (km)</label><br>
          <input type="number" id="car-mileage" name="car-mileage" required min="0">
          <br>
          <label for="car-fuel-efficiency">Eficiencia de Combustible del Automóvil (L/100km)</label><br>
          <input type="number" id="car-fuel-efficiency" name="car-fuel-efficiency" required min="0">
          <br>
          <label for="public-transport">Uso de Transporte Público (km)</label><br>
          <input type="number" id="public-transport" name="public-transport" required min="0">
          <br>
          <label for="flights">Vuelos de Avión (km)</label><br>
          <input type="number" id="flights" name="flights" required min="0">
        </fieldset>
        <fieldset>

          <legend>Estilo de Vida y Alimentación</legend>
          <img src="../imgs/svgs/icono-alimentacion.png" alt="">
          <label for="food-consumption">Consumo de Alimentos (kg/persona/año)</label><br>
          <input type="number" id="food-consumption" name="food-consumption" required min="0">
          <br>
          <label for="recycling">Porcentaje de Materiales Reciclados (%)</label><br>
          <input type="number" id="recycling" name="recycling" required min="0" max="100">
        </fieldset>
        <fieldset>
          <legend>Consumo de Agua</legend>
          <img src="../imgs/svgs/gota-agua.png" alt="">
          <label for="water-consumption">Consumo de Agua (m³)</label><br>
          <input type="number" id="water-consumption" name="water-consumption" required min="0">
        </fieldset>
        <fieldset>
          <legend>Manejo de Residuos</legend>
          <img src="../imgs/svgs/icon-basura.png" alt="">
          <label for="waste-generated">Residuos Generados (kg/persona/año)</label><br>
          <input type="number" id="waste-generated" name="waste-generated" required min="0">
          <br>
          <label for="waste-recycled">Residuos Reciclados (%)</label><br>

          <input type="number" id="waste-recycled" name="waste-recycled" required min="0" max="100">
        </fieldset>
        <br>
        <button type="submit">Calcular</button>
      </form>

      <div id="result" class="result-container"></div>
    </div>

    <script src="script-calculadora.js"></script>
  </section>
  <footer>
    <div class="utu-info">
      <div class="first-container">
        <a href="../index.html">
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
  <!-- SCRIPT  FOOTER -->
  <script src="../js/script-footer.js"></script>

  <!-- SCRIPT CALCULADORA -->
  <script src="../js/sript-calculadora.js"></script>
  <!-- SCRIPT BOOTSTRAP -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <!-- SCRIPT NAVBAR -->
  <script src="../js/script-navbar.js"></script>
</body>

</html>