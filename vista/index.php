<?php 
    session_start();
    if (empty($_SESSION['user']) && !$_SESSION['permitido']) {
        header('location: ../');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página de Gestión</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="css/datepicker.css">
    <style>
        /*#pan{
            box-shadow: 0px 0px 1px 1px #3C3C3C;
        }*/
        h1{
            margin-top: -29px;
        }
        h3{
            margin-top: -10px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#" onclick="location.reload();">
                        SICDAP
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="location.reload();"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['user']?></a>
                </li>
                <li>
                    <a href="javascript:void(0)" id="per"><span class="glyphicon glyphicon-floppy-saved"></span></span> Gestión de Personal</a>
                </li>
                <li>
                    <a href="javascript:void(0)" id="usuario"><span class="glyphicon glyphicon-pencil"></span> Gestión de Usuarios</a>
                </li>
                <li>
                    <a href="javascript:void(0)" id="entsal"><span class="glyphicon glyphicon-time"></span> Control de Entrada/Salida</a>
                </li>
                 <li>
                    <a href="javascript:void(0)"><span class="glyphicon glyphicon-list-alt"></span> Reportes</a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="cerrarSesion();"><span class="glyphicon glyphicon-log-out"></span> Salir del Sistema</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
<div id="page-content-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">
        <span class="glyphicon glyphicon-home"></span></a>
            <h1 class="text-center"><strong>Bienvenido a SICDAP</strong> <br></h1>
            <p class="text-center text-danger"><em>Eliga una de las opciones en la izquierdo de la pantalla</em></p>
            <p class="text-center">PONER LOGO AQUI CENTRADO</p>
            <div class="col-lg-3">
                <input type="text" placeholder="Cédula del Empleado" id="inBus" onblur="buscarEmpleado();" class="form-control pull-left">
            </div>
            <div class="col-lg-6">
               <div id="emp">
                <h3 class="text-center"><strong>Gestión del Personal</strong></h3>
                    <div role="tabpanel">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Datos del Empleado <span class='glyphicon glyphicon-user'></span></a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Contacto <span class='glyphicon glyphicon-edit'></span></a></li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Datos de Empleo <span class='glyphicon glyphicon-briefcase'></span></a></li>
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                            <form>
                                 <div class="form-group">
                                    <label for="noms">Nombres</label>
                                    <input type="text" class="form-control" id="noms" placeholder="Nombres del Empleado">
                                  </div>
                                  <div class="form-group">
                                    <label for="ape">Apellidos</label>
                                    <input type="text" class="form-control" id="apes" placeholder="Apellidos del empleado">
                                  </div>
                                  <input type="hidden" id="idEmp">
                                  <div class="form-group">
                                    <label for="exampleInputFile">Cédula</label>
                                    <input type="text" class="form-control" id="cedu" placeholder="Cédula del Empleado">
                                  </div>
                                  <div class="form-group">
                                    <label for="ejemplo_password_1">Fecha de Nacimiento</label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' readonly="readonly" class="form-control hab" id="fe_na">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar">
                                                </span>
                                            </span>
                                        </div>
                                  </div>
                                  <label for="">Sexo</label>
                                  <label class="radio-inline">
                                <input type="radio" name="sex" checked id="sex1" value="1"> M
                                </label>
                                <label class="radio-inline">
                                <input type="radio" name="sex" id="sex2" value="0"> F
                                </label>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile">
                            <div class="form-group">
                                <label for="ape">Dirección</label>
                                <textarea name="direc" id="direc" class="form-control" placeholder='Dirección...' cols="10" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ape">Teléfono</label>
                                <input type="text" id="tele" class="form-control" placeholder='Telefono de casa'>
                            </div>
                            <div class="form-group">
                                <label for="ape">Teléfono - Celular</label>
                                <input type="text" id="cell" class="form-control" placeholder='N° de Celular'>
                            </div>
                            <div class="form-group">
                                <label for="ape">Correo Electrónico</label>
                                <input type="text" id="correo" class="form-control" placeholder='Correo Electrónico'>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="messages">
                            <div class="form-group">
                                    <label for="ejemplo_password_1">Fecha de Ingreso</label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' readonly="readonly" class="form-control hab" id="fe_in">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar">
                                                </span>
                                            </span>
                                        </div>
                                  </div>
                                <div class="form-group">
                                    <label for="ape">Cargo</label>
                                    <select name="cargo" class="form-control" id="cargo">
                                        <option value="0" checked>Seleccione</option>
                                        <option value="1">Obrero</option>
                                        <option value="2">Docente</option>
                                        <option value="3">Administrativo</option>
                                        <option value="5">Madre Procesadora</option>
                                        <option value="6">Vigilante</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ape">Turno</label>
                                    <select name="turno" class="form-control" id="turno">
                                        <option value="0" checked>Seleccione</option>
                                        <option value="1">Dia</option>
                                        <option value="2">Tarde</option>
                                        <option value="3">Noche</option>
                                    </select>
                                </div>
                                    <div class="btn-group" role="group" aria-label="...">
                                      <button type="button" onclick="registrarEmpleado();" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span></button>
                                      <button type="button" onclick="actualizarDatosEmp();" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span></button>
                                      <button type="button" onclick="eliminarDatosEmp();" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span></button>
                                      <button type="button" onclick="listarEmpleados();"
                                              data-toggle="modal" data-target="#modalEmp" class="btn btn-success"><span class="glyphicon glyphicon-align-justify"></span></button>
                                    </div>
                                </form>
                        </div>
                      </div>
                    </div>
               </div>
               <div id="usu">
                <h3 class="text-center"><strong>Gestión de Usuarios</strong></h3>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label for=""><em>Buscar usuario</em></label>
                        <input type="text" id="usuAux" placeholder='Usuario' size="10" class="form-control" onblur="buscarUsuario();">
                    </div>
                </div><br><br><br><br>
                <div id="pan" class="panel panel-default">
                    <div class="panel-body">
                        <form action="POST">
                            <div class="form-group">
                                <input type="hidden" id="hideUsu">
                                <label for="ceduEmp">Cédula</label>
                                <input type="text" id="ceduEmpe" placeholder='Cédula del Empleado' class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ceduEmp">Usuario</label>
                                <input type="text" id="user" placeholder='Usuario' class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ceduEmp">Clave</label>
                                <input type="password" id="pass" placeholder='Contraseña' class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ceduEmp">Tipo</label>
                                <select name="tipo" class="form-control" id="tipo">
                                    <option value="-" checked=checked>Seleccione</option>
                                    <option value="0">Usuario</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                            <div class="btn-group">
                                <button type="button" id="btnVeri" onclick="verificarEmpUsuExisten();" class="btn btn-primary"> 
                                <span class="glyphicon glyphicon-floppy-disk"></span></button>

                                <button type="button" onclick="actualizarDatosUsuario($('#usuAux').val());" 
                                class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span></button>

                                <button type="button" onclick="eliminarDatosUsuario($('#usuAux').val());" 
                                class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>

                                <button type="reset" class="btn btn-default"> 
                                <span class="glyphicon glyphicon-erase"></span></button>

                                <button type="button" onclick="listarUsuarios()" data-toggle="modal" data-target="#myModal"
                                class="btn btn-success"><span class="glyphicon glyphicon-align-justify"></span></button>
                            </div>               
                        </form>
                    </div>
                </div>
                </div>
                <div id="conEntSal">
                    <h3 class="text-center"><strong>Control de Entrada y Salida de Empleados</strong></h3>
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <form>
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                              <input type="text" id="ce" class="form-control" placeholder="Cedula del empleado" aria-describedby="basic-addon1">
                            </div><br>
                            <div class="form-group">
                                <select name="tip" class="form-control" id="tip">
                                    <option value="-" checked>Seleccione</option>
                                    <option value="1">Entrada</option>
                                    <option value="0">Salida</option>
                                </select>
                            </div>
                            <center>
                                <div class="btn-group">
                                    <button type="button" onclick="verificarCedulaEmp();" class="btn btn-default">Enviar <span 
                                    class="glyphicon glyphicon-send"></span></button>
                                    <button type="reset" class="btn btn-success">Limpiar <span 
                                    class="glyphicon glyphicon-erase"></span></button>
                                </div>
                            </center>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--AREA MODAL-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
                aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>Listado de usuarios del sistema.</strong></h4>
              </div>
              <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-responsive table-condensed">
                        <tbody id="tbl_usu">
                        </tbody>
                    </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-menu-down"></span></button>
              </div>
            </div>
          </div>
        </div>
        <!--FIN MODAL-->
        <!-- /#page-content-wrapper -->
        <!--MODAL DE EMPLEADOS-->
            <!-- Modal -->
            <div class="modal fade" id="modalEmp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel"><strong>Listado de Empleados</strong></h4>
                  </div>
                  <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-responsive table-condensed" id="tbl_emple">
                            <tbody id="tbl_empList"></tbody>
                        </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class='glyphicon glyphicon-chevron-down'></span></button>
                  </div>
                </div>
              </div>
            </div>
        <!--FIN MODAL DE EMPLEADOS-->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.min.1.11.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/layout.js"></script>
    <script src="../controlador/js/sesion.js"></script>
    <script src="../controlador/js/empleado.js"></script>
    <script src="../controlador/js/usuario.js"></script>
    <script src="../controlador/js/controlES.js"></script>
     <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        $("div[id^='datetimepicker']").datepicker({
            format: 'yyyy-mm-dd',
            language: "es",
            autoclose:true
        });
    </script>
</body>
</html>