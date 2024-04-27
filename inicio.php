<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>thunderbike Inicio</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="thundrbike/png" href="img/thunderbike.png">
  <style>
    .password-toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }
    header {
      display: flex;
      align-items: center;
      width: 40%;
      margin: 50px auto 0px;
    }

    header img {
      margin-right: 50px; /* Espacio entre el logo y el texto */
    }
  
  #background-video {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: -1;
  background-size: cover;
}

  </style>
</head>
<body>
<video id="background-video" autoplay muted loop>
  <source src="img/bicicletas.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
  <header>
  <img src="img/thunderbike.png" alt="thunderbike" style="width: 65px; height: 65px;">
    <h1>THUNDERBIKE</h1>
  </header>
  <main>
    <!-- Botón de inicio de sesión -->
    <div class="container">
      <a href="logeo.php" class="logo-btn">Iniciar Sesión</a>
    </div>

    <!-- Carrusel -->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/tx.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="img/bici.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="img/terreno.png" class="d-block w-100" alt="...">
        </div>
      </div>
    </div>

    <section class="about-us">
      <h2><center>Sobre nosotros</center></h2>
      <p>Bienvenido a nuestra tienda de bicicletas, donde la pasión por el ciclismo se fusiona con el compromiso de ofrecerte la mejor experiencia sobre dos ruedas. Nos enorgullece ser mucho más que un simple punto de venta;
         somos un destino para ciclistas de todos los niveles que buscan no solo productos de calidad, sino también un equipo apasionado que comparte su entusiasmo por el ciclismo.</p>
      <p>En nuestro establecimiento, cada visita es una oportunidad para sumergirse en el mundo emocionante de las bicicletas. Desde los principiantes hasta los ciclistas experimentados, todos son recibidos con la misma calidez y dedicación.
       Nuestro equipo está compuesto por verdaderos entusiastas del ciclismo, personas que viven y respiran la cultura ciclista y que están aquí no solo como vendedores, sino como compañeros de viaje en tu emocionante travesía ciclista.</p>
      <p>Nuestra misión es simple pero poderosa: proporcionarte no solo productos de primera calidad, sino también una experiencia de compra excepcional. Nos esforzamos por ser más que una tienda; somos una comunidad donde los ciclistas pueden reunirse,
      compartir experiencias y obtener el conocimiento y el apoyo que necesitan para llevar su pasión al siguiente nivel.</p>
      <p>Desde bicicletas de montaña diseñadas para conquistar senderos escarpados hasta bicicletas de carretera aerodinámicas para desafiar el asfalto, nuestro amplio catálogo abarca una variedad de estilos, marcas y modelos para satisfacer
      las necesidades y deseos de cada ciclista. Además de bicicletas, también ofrecemos una amplia gama de accesorios y equipo, desde cascos y luces hasta ropa técnica y herramientas de mantenimiento, todo cuidadosamente seleccionado para mejorar tu experiencia en cada viaje.</p>
      <p>Pero más allá de simplemente ofrecerte productos, estamos aquí para ofrecerte orientación y asesoramiento experto. Nos encanta compartir nuestro conocimiento y experiencia contigo, ya sea que estés buscando tu primera bicicleta o buscando mejorar
      tu equipo actual. Estamos comprometidos a ayudarte a encontrar la bicicleta perfecta que se adapte a tus necesidades, habilidades y objetivos, porque creemos que cada ciclista merece tener una experiencia excepcional sobre dos ruedas.</p>
      <p>En resumen, en nuestra tienda no solo encontrarás bicicletas y accesorios de alta calidad, sino también un equipo apasionado y comprometido que está aquí para inspirarte, apoyarte y ayudarte a alcanzar tus metas ciclistas.
      Únete a nosotros y descubre el placer y la libertad de pedalear en nuestra apasionante comunidad ciclista. ¡Bienvenido a tu nueva casa para todo lo relacionado con el ciclismo!</p>

    </section>

    <section class="redes-sociales">
      <h2><center>Contáctanos en redes sociales</center></h2>
      <ul>
        <center>
        <img src="img/facebook.png" alt="" style="width: 50px; height: 50px;">
        <li><a href="https://www.facebook.com/" target="_blank">Facebook</a></li>
        <img src="img/Twitter.png" alt="" style="width: 50px; height: 50px;">
        <li><a href="https://twitter.com/" target="_blank">Twitter</a></li>
        <img src="img/instagram.png" alt="" style="width: 50px; height: 50px;">
        <li><a href="https://www.instagram.com/" target="_blank">Instagram</a></li>
        </center>
      </ul>
    </section>
  </main>
  
  <footer>
    <center>V1.0.1 © Todos los derechos reservados. Thunderbike</center>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome -->
  
  <script>
    // Función para alternar entre mostrar/ocultar la contraseña al hacer clic en el icono del ojo
    var passwordToggles = document.querySelectorAll(".password-toggle");
    passwordToggles.forEach(function(toggle) {
      toggle.addEventListener("click", function() {
        var passwordInput = this.previousElementSibling;
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          this.classList.remove("fa-eye-slash");
          this.classList.add("fa-eye");
        } else {
          passwordInput.type = "password";
          this.classList.remove("fa-eye");
          this.classList.add("fa-eye-slash");
        }
      });
    });
  </script>
</body>
</html>
