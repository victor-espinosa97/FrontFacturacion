<?php 
    session_start();
    session_destroy();
    include_once('templeate/subs_header.php');  
?>

<body class="page-contact">

  <main id="main">
    <section id="contact" class="contact">
      <div class="container position-relative" data-aos="fade-up">

        <div class="row gy-4 d-flex justify-content-center">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">

            <form action="plataform/dashboard/" method="post" role="form" class="php-email-form">
              <center>
                <img src="assets/imgs/login.png" width="200" alt="Logo"/>
                <br><br>
              </center>
              <h1>Ingreso del personal</h1>
              <hr>
              <div class="row">
                <div class="col-md-12 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico" required>
                </div>
                <div class="col-md-12 form-group">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
                </div>
              </div>
              <div class="text-center"><button name="btn_login" value="valida" type="submit">Ingresar</button></div>
            </form>

          </div>

        </div>

      </div>
    </section>

  </main>

  
  <?php include_once('templeate/subs_footer.php');?>