<?php

function printHead() {
  ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FromSpace</title>
  <link rel="stylesheet" href="css/style.css">
  
  <!-- Link bootstrap 4 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  
  <!-- Link style.css principal -->
  <link rel="stylesheet" href="css/style.css">
  
  <link rel="icon" 
      type="image/png" 
      href="img/favicon.ico">

</head>

  <?php
}

//Introducir variable boolean para indicar si se está o no loqueado
function printBody($login) {
  if ($login) {
    ?>
<body>
  <!-- navegador -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="row">
      <div class="col-6">  
        <a class="navbar-brand ml-4 mt-4" href="index.php">
          <img src="img/logo.svg" class="logoimagen" alt="Logo de FromSpace">
        </a>
      </div>
      <div class="col-6">
        <ul class="nav justify-content-end mr-4 mt-4">
          <li class="nav-item">
            <a class="nav-link navLetra" href="video.html">Sobre FromSpace</a>
            </li>
            <li class="nav-item">
            <a class="nav-link navLetra" href="#" data-toggle="modal" data-target="#nuevoPost">Añadir un post</a>
            </li>
            <li class="nav-item">
            <a class="nav-link navLetra" href="?session=close">Cerra sesión</a>
            </li>
          </ul>
      </div>
    </div>
  </nav>

  <div class="container text-center w-50">
    <form method="get">
      <input name="finderfs" type="text" class="form-control form-control-lg" placeholder="Insertar busqueda...">
    </form>
  </div>

  <!-- modal de nuevo post -->
  <div class="modal fade bd-example-modal-lg" id="nuevoPost">
        <form method="post">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Nuevo post</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
              <label><strong>Titulo:</strong></label>
                  <input required class="form-control form-control-lg" type="text" name="titulo">
                <br>
                <label><strong>Descripción:</strong></label>
                  <textarea required class="form-control form-control-lg" type="text" name="descripcion" rows="10"></textarea>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" value="Añadir" id="añadirPost" name="añadirPost"></input>
            </div>
            
          </div>
        </div>
        </form>
     </div>
    <div class="modal fade bd-example-modal-lg" id="comentario">
         <form method="post">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Nuevo comentario</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                  <label><strong>Descripción:</strong></label>
                  <textarea required class="form-control form-control-lg" type="text" name="descripcionReply" rows="10"></textarea>
          
              </div>
              
              <!-- Modal footer -->
              <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Añadir" id="añadirComentario" name="añadirComentario"></input>
              </div>
              
            </div>
          </div>
          </form>
       </div>
    <?php
  }
  
  else {
    ?>
<body>

  <!-- navegador -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="row">
        <div class="col-6">
          <a class="navbar-brand ml-4 mt-4" href="index.php">
            <img src="img/logo.svg" class="logoimagen" alt="Logo de FromSpace">
          </a>
        </div>
        <div class="col-6">
          <ul class="nav justify-content-end mr-4 mt-4">
            <li class="nav-item">
              <a class="nav-link navLetra" href="video.html">Sobre FromSpace</a>
            </li>
              <li class="nav-item">
              <a class="nav-link navLetra" href="#" data-toggle="modal" data-target="#login">Entrar</a>
              </li>
              <li class="nav-item">
              <a class="nav-link navLetra" href="#" data-toggle="modal" data-target="#registro">Registrar</a>
              </li>
            </ul>
        </div>
      </div>
    </nav>

  <!-- buscador -->
  <div class="container">
    <div class="row">
      <div class="form-group col-11 contenedor">
        <form method="get">
          <input name="finderfs" type="text" class="form-control form-control-lg" placeholder="Insertar busqueda...">
        </form>
      </div>
    </div>

    <!-- El Modal login-->
      <div class="modal fade" id="login">
        <form method="post">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Inicio de sesión</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
              <label><strong>Usuario</strong></label>
                  <input required class="form-control form-control-lg" type="loginName" name="loginName">
                <br>
                <label><strong>Contraseña</strong></label>
                  <input required class="form-control form-control-lg" type="password" name="loginPass">
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" value="Login" id="enviarLogin" name="enviarLogin"></input>
            </div>
            
          </div>
        </div>
        </form>
     </div>

     <!-- El Modal registro-->
      <div class="modal fade" id="registro">
        <form method="post">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Nuevo usuario</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <label><strong>Nombre Usuario</strong></label>
                  <input required class="form-control form-control-lg" type="text" name="name" id="name">
                <br>
                <label><strong>Contraseña</strong></label>
                  <input required class="form-control form-control-lg" type="password" name="firstPass" id="firstPass">
                <br>
                <label><strong>Repita la contraseña</strong></label>
                  <input required class="form-control form-control-lg" type="password" name="secPass" id="secPass">
                <br>
                <label><strong>Correo Electrónico</strong></label>
                  <input required class="form-control form-control-lg" type="email" name="email" id="email">
                <br>
                <input required type="checkbox" id="condition" name="condition"> Acepta las condiciones
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" value="Registrarse" id="enviarReg" name="enviarReg"></input>
            </div>
            
          </div>
        </div>
        </form>
     </div>
  </div>
</body>
  <?php
  }
}

function printPosts($id, $user, $title) {
  echo '
<div class="container">
    <!-- El articulo es lo que se tiene que repetir -->
    <div class="article mt-5">
      <div class="media">
        <div class="container">
          <div class="row">
            <img class="align-self-center mr-3 rounded-circle" src="img/usuario.png" style="width: 100px" alt="Imagen de perfil por defecto.">
            <div class="media-body card">
              <h3 class="m-2"><a href="?interiorPost=' . $id . '">' . $title . '</a></h3>
              <p class="ml-2"><sub>Realizado por: <span style="font-weight: bold">' . $user . '</span></sub></p>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
  ';
}

function printPost($id, $user, $title, $body) {
  if($_SESSION['logged']==true) {
    $mensaje = 'btn-success';
    $attr = '';
  }
  else {
    $mensaje = 'disabled';
    $attr = 'disabled';
  }
  echo '
<div class="container">
    <!-- El articulo es lo que se tiene que repetir -->
    <div class="article mt-5">
      <div class="media">
        <div class="container">
          <div class="row">
            <img class="align-self-center mr-3 rounded-circle" src="img/usuario.png" style="width: 100px" alt="Imagene de perfil por defecto">
            <div class="media-body card">
              <h3 class="m-2"><a href="?interiorPost=' . $id . '">' . $title . '</a></h3>
              <p class="ml-2"><sub>Realizado por: <span style="font-weight: bold">' . $user . '</span></sub></p>
              <p class="ml-2">' . $body . '</p>
            </div>
          </div>
          <button class="btn '.$mensaje.' botoncomen" '.$attr.' data-toggle="modal" data-target="#comentario">
          <a class="ml-2 mb-2">Comentario</a>
          </button>
        </div>
      </div> 
    </div>
  </div>

  ';
}

function printReplyPost($user, $body) {
  echo '
<div class="comentario mt-5 ml-5">
      <div class="media">
        <div class="container">
          <div class="row">
            <img class="align-self-start mr-3 rounded-circle" src="img/usuario.png" style="width: 100px" alt="Imagen de perfil por defecto">
            <div class="media-body card">
              <p class="ml-2 mt-2"><sub>Realizado por: <span style="font-weight: bold;">' . $user . '</span></sub></p>
              <p class="ml-2">' . $body . '</p>
            </div>
          </div>
        </div>
      </div> 
    </div>
  ';
}


function printFoot() {
  ?>
  <footer>
    <div class="container text-center mt-5 w-50">
      <p class="licencia"> Copyright (c) 2018 FromSpace </p>
    </div>
  </footer>
  <?php
}

function printError() {
  echo '
  <div class="container mt-5 mb-5">
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Error:</h4>
      <p>Comprueba los datos introducidos.</p>
      <hr>
      <a href="index.php">Cerrar</a>
    </div>
  </div>
    ';
}


?>
</body>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>