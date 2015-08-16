<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/css/bootstrap-theme.css">
    <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    <style>
        #text-tittle{
            font-family: 'Righteous', cursive;
        }
    </style>
</head>
<body>
<h1 id='text-tittle' class="text-center">Bienvenidos al sistema SICDAP</h1>
<div class="col-lg-12">
    &nbsp;
</div>
<div class="col-lg-12">
    &nbsp;
</div>
<div class="col-lg-12">
    &nbsp;
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inicio de Sesión</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" id="user" placeholder="Usuario" name="usuario" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="pass" placeholder="Contraseña" name="contrasena" type="password" value="">
                                </div>
                                <button type="button" onclick="iniciarSesion();" 
                                class="btn btn-lg btn-success btn-block">Iniciar Sesión <span class="glyphicon glyphicon-log-in"></span></button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="js/jquery-1.11.2.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
    <!--File js controller-->
    <script src="controlador/js/sesion.js"></script>
</body>
</html>
