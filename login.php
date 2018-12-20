

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CONSULTA</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
   <!-- Animate.css -->
   
    <!-- Custom Theme Style -->
    <link href="build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login" >
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" class="" action="iniciarsession.php">
              <h1 style="color: aliceblue; font-size: 35px; width: 100%; font-weight: 500;">Iniciar Sesión</h1>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                  <input style="font-weight: 100;" type="text" class="form-control" id="usuario_id" name="usuario_name" placeholder="Usuaio" autocomplete="off" required="required" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                  <input style="font-weight: 100;" type="password" class="form-control"  id="password_id"   name="password_name"  placeholder="Contraseña"  autocomplete="off" required="required" />
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                  <a href="#" style="color: aliceblue; font-size: 10px; width: 100%; font-weight: 100%;">Regístrarte Aqui</a>
                  <br>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 xs-mb-5 text-center"><br>
                  <button type="submit" class="btn btn-lg btn-block btn-primary">Ingresar</button>
              <br>
                </div>
              </div>              
            </form>
          </section>
        </div>
      </div>
    </div>
<script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   
    <script src="build/js/index.js"></script>
  </body>
</html>