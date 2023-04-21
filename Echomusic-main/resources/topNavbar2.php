    <style type="text/css">
      .g-signin2{
        width: 80%;
        margin: 20px auto;
          display: block;
      }
      .g-signin2 .abcRioButtonBlue{
        width: 100% !important;
      }

    #customBtnGoogle {
      display: block;
    background: #4285f4;
    color: #fff;
    width: 80%;
    margin: 0 auto;
    border: thin solid #4285f4;
    box-shadow: 1px 1px 1px grey;
    white-space: nowrap;
    text-align: center;
}
    #customBtnGoogle:hover {
      cursor: pointer;
    }
    span.label {
      font-family: serif;
      font-weight: normal;
    }
    span.icon {
      background: url('https://developers-dot-devsite-v2-prod.appspot.com/identity/sign-in/g-normal.png') transparent 5px 50% no-repeat;
      display: inline-block;
      vertical-align: middle;
      width: 42px;
      height: 42px;
    }
    span.buttonText {
      display: inline-block;
      vertical-align: middle;

    }
  </style>
<nav id="topNavbar" class="navbar navbar-expand-md navbar-light fixed-top bg-light pt-0 pb-0">

  <div class="container h-100 nav-w" >

    <a id="first-logo" class="navbar-brand h-100" href="https://echomusic.cl/index.php"><img src="https://echomusic.cl/images/logo_brand_4.png" class="h-100"></a>

    <button class="navbar-toggler button-sidebar" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">

      <i class="fas fa-bars"></i></button>

    </button>


    <div class="collapse navbar-collapse h-100 d-none d-md-block" id="navbarsExampleDefault">

    </div>

  </div>
</nav>
    <div id="topNavbar2" class="">
      <div class="container ">
      <div class="row">
        <div id="second-logo" class="col-md-1">
          <a class="navbar-brand h-100" href="https://echomusic.cl/index.php"><img src="https://echomusic.cl/images/logo_brand_3.png" class="img-logo"></a>
        </div>
        <div class="col-md-4 nav-item-one">

            <form action="search.php" method="get">

              <div class="input-group">


                <input class="form-control search-bar" name="search" type="text" placeholder="Buscar Artista" aria-label="Search">

                <a onclick="this.closest('form').submit();return false;"><i class="fas fa-search magnifierIcon"></i><a>

              </div>

            </form>
      </div>
    <div class="col-md-7 d-none d-md-block text-right ">

        <?php
          if(isset($_SESSION['user']) && $_SESSION['user'] != ""){
        ?>

        <!-- Aqui va el menú dropdown -->
        <div id="navbar-dropmenu" class="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?=$_SESSION['name_user']?> <span class="caret"></span></a>
              <ul id="navbar-dropmenu-ul" class="dropdown-menu" role="menu">

                <li><a class="nav-link" href="https://echomusic.cl/dashboard.php">Mi panel de control<span class="sr-only">(current)</span></a></li>

                <? if($_SESSION['type_user']=='1'): ?>
                  <li><a class="nav-link" href="https://echomusic.cl/profile.php?userid=<?=$_SESSION['user']?>">Mi perfil<span class="sr-only">(current)</span></a></li>
                <? else:?>
                <? endif; ?>
                <li><a class="nav-link" href="https://echomusic.cl/search.php">Artistas<span class="sr-only">(current)</span></a></li>

                <li><a class="nav-link" href="https://echomusic.cl/calendar_echomusic.php">Cartelera<span class="sr-only">(current)</span></a></li>

                <li><a class="nav-link" href="https://echomusic.cl/search_crowdfunding.php">Crowdfunding<span class="sr-only">(current)</span></a></li>

                <li><a class="nav-link" href="/blog">Blog<span class="sr-only">(current)</span></a></li>

                <li><a class="nav-link" href="https://echomusic.cl/startEvent.php">Crear Evento<span class="sr-only">(current)</span></a></li>

                <li> <a class="nav-link" href="https://echomusic.cl/logout.php" onclick="signOut();">Cerrar Sesión<span class="sr-only">(current)</span></a></li>

              </ul>
            </li>
          </ul>
        </div>

        <?php }else{ ?>
      <ul class="navbar-nav nav-item-two"  style="">

          <li class="nav-item active">

            <a class="nav-link" style="cursor:pointer;" data-toggle="modal" data-target="#loginModal">Iniciar Sesión <span class="sr-only">(current)</span></a>

          </li>

          <li class="nav-item bg-orange">

            <a class="nav-link text-white" href="https://echomusic.cl/register.php">Registrarme</a>

          </li>

          <li>
            <div id="navbar-dropmenu" class="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menú <span class="caret"></span></a>
                  <ul id="navbar-dropmenu-ul" class="dropdown-menu" role="menu">

                    <li><a class="nav-link" href="https://echomusic.cl/index.php">Inicio<span class="sr-only">(current)</span></a></li>

                    <li><a class="nav-link" href="https://echomusic.cl/search.php">Artistas<span class="sr-only">(current)</span></a></li>

                    <li><a class="nav-link" href="https://echomusic.cl/calendar_echomusic.php">Cartelera<span class="sr-only">(current)</span></a></li>

                    <li><a class="nav-link" href="https://echomusic.cl/search_crowdfunding.php">Crowdfunding<span class="sr-only">(current)</span></a></li>

                    <li><a class="nav-link" href="/blog">Blog<span class="sr-only">(current)</span></a></li>

                    <li><a class="nav-link" href="https://echomusic.cl/startEvent.php">Crear Evento<span class="sr-only">(current)</span></a></li>

                    <li><a class="nav-link" href="https://echomusic.cl/about.php">Sobre Nosotros<span class="sr-only">(current)</span></a></li>


                  </ul>
                </li>
              </ul>
            </div>
          </li>

      </ul>

        <?php } ?>

    </div>
    </div>
    </div>
    </div>
<div id="sidebarRight" class="sidebar">
  Menú
  <?php if(isset($_SESSION['user']) && $_SESSION['user'] != ""){ ?>
    <ul class="sidebar-list">
      <li class="sidebar-item"><a href="https://echomusic.cl/dashboard.php" class="sidebar-anchor">Mi Panel de Control</a></li>
      <? if($_SESSION['type_user']=='1'): ?>
        <li class="sidebar-item"><a href="profile.php?userid=<?=$_SESSION['user']?>" class="sidebar-anchor">Mi Perfil</a></li>
      <? else:?>
      <? endif;?>
      <li class="sidebar-item"><a href="https://echomusic.cl/search.php" class="sidebar-anchor">Artistas</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/calendar_echomusic.php" class="sidebar-anchor">Cartelera</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/search_crowdfunding.php" class="sidebar-anchor">Crowdfunding</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/about.php" class="sidebar-anchor">¿Qué es EchoMusic?</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/contacto_empresas.php" class="sidebar-anchor">Asesoría Empresas</a></li>
      <li class="sidebar-item"><a href="/blog" class="sidebar-anchor">Blog</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/startEvent.php" class="sidebar-anchor">Crear Evento</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/logout.php" class="sidebar-anchor" onclick="signOut();">Cerrar Sesión</a></li>
    </ul>
  <?php }else{ ?>
    <ul class="sidebar-list">
      <li class="sidebar-item"><a href="https://echomusic.cl/login.php" class="sidebar-anchor">Iniciar Sesión</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/register.php" class="sidebar-anchor">Registrate</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/search.php" class="sidebar-anchor">Artistas</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/calendar_echomusic.php" class="sidebar-anchor">Cartelera</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/search_crowdfunding.php" class="sidebar-anchor">Crowdfunding</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/about.php" class="sidebar-anchor">¿Qué es EchoMusic?</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/contacto_empresas.php" class="sidebar-anchor">Asesoría Empresas</a></li>
      <li class="sidebar-item"><a href="/blog" class="sidebar-anchor">Blog</a></li>
      <li class="sidebar-item"><a href="https://echomusic.cl/startEvent.php" class="sidebar-anchor">Crear Evento</a></li>
    </ul>
  <?php } ?>
</div>


<!-- Modal Agregar a Include php-->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">

<div class="modal-dialog">

  <div class="modal-content">
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span>

      </button>
    <div class="modal-header">

      <img src="https://echomusic.cl/images/logo_brand_3.png" class="modal-title logo-modal" id="loginModalLabel">



    </div>

    <div class="modal-body">

      <div class="">

        <div class="row">

          <h2 class="col-12">Para continuar, inicia sesión:</h2>
          <?php
            if ( isset($errMSG) ) {
              echo '<h2 class="col-12 text-danger">'.$errMSG.'</h2>';
            }
          ?>
          <div class="col-12">
            <div id="my-signin2" class="g-signin2" ></div>

            <form action="" method="post">
                <input type="hidden" name="googleID_token" id="googleID_token">
                <input type="hidden" name="first_name" id="first_name">
                <input type="hidden" name="last_name" id="last_name">
                <input type="hidden" name="email" id="email">
            </form>
          </div>

          <hr>

          <h2 class="col-12">O utiliza tu cuenta EchoMusic:</h2>

          <form class="col-12" action="" method="POST">

           <div class="form-group">

             <input type="email"  name="email" class="form-control" id="" placeholder="Correo electrónico">

           </div>

           <div class="form-group">

             <input type="password" name="password" class="form-control" id="" placeholder="Contraseña">

           </div>

           <div class="form-group custom-control custom-checkbox">
            <div class="row">
            <div class="col-md-6">
              <input type="checkbox" class="custom-control-input" id="customCheck1">

              <label class="custom-control-label" for="customCheck1">Recordar mi sesión</label>
            </div>
            <div class="col-md-6 text-right">
              <button type="submit" name="login_button" class="btn btn-primary px-3">Iniciar Sesión</button>
            </div>
          </div>
           </div>



         </form>

           <div class="col-12 text-right">

            <a href="https://echomusic.cl/recover.php">¿Olvidaste tu contraseña?</a>

          </div>

        </div>

      </div>

    </div>

    <div class="modal-footer text-center">

      <h3>¿Aún no tienes cuenta?</h3>

      <a href="https://echomusic.cl/register.php" class="btn btn-outline-secondary text-orange">Regístrate en EchoMusic</a>

    </div>

  </div>

</div>

</div>
