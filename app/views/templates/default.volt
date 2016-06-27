<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=1">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <link rel="icon" type="image/x-icon" href="{{url('')}}images/favicons/favicon.ico">
        
        {{ stylesheet_link('vendors/font-awesome-4.5.0/css/font-awesome.min.css') }}
        {{ javascript_include('vendors/jquery/jquery-1.12.0.min.js') }}
        
        
        {{ stylesheet_link('vendors/bootstrap/css/bootstrap.min.css') }}
        {{ stylesheet_link('css/dashboard.css') }}
        {{ stylesheet_link('css/base.css') }}
        
        {% block css %}{% endblock %}
    </head>
    <body>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" href="http://www.sayvot.com/">
              <img alt="SayVot" width="70" height="30" src="{{url('')}}images/sayvot-logo-horizontal.png">
            </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
            <ul class="nav navbar-nav navbar-right">
              <li style="background-color: white;">
                <a href="#">
                  <img src="{{url('')}}/assets/22/images/avatar/22.png" width="25" height="25" />
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  Will Montiel <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Cambiar Contraseña</a></li>
                  <li><a href="#">Mi perfil</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{url('session/logout')}}">Cerrar Sesión</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
                
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                  <ul class="nav nav-sidebar">
                    <li class="active"><a href="{{url('')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> Inicio <span class="sr-only">(current)</span></a></li>
                    <li><a href="#"><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a></li>
                    <li><a href="#"><i class="fa fa-archive" aria-hidden="true"></i> Mi Plan</a></li>
                  </ul>
                  <ul class="nav nav-sidebar">
                    <li><a href="{{url('survey')}}"><i class="fa fa-tasks" aria-hidden="true"></i> Encuestas</a></li>
                  </ul>
                  <ul class="nav nav-sidebar">
                    <li><a href="{{url('configuration')}}"><i class="fa fa-cogs" aria-hidden="true"></i> Configuración</a></li>
                  </ul>
                </div>
                
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    {% block content %} {% endblock %}
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="row">
              <div class="style-footer text-center">
                <ul>
                    <li>
                        <i class="fa fa-facebook"></i>
                    </li>
                    <li>
                        <i class="fa fa-twitter"></i>
                    </li>
                    <li>
                        <i class="fa fa-youtube"></i>
                    </li>
                    <li>
                        <i class="fa fa-instagram"></i>
                    </li>
                </ul> 
              </div> 
            </div> 
             
        </div>
        {{ javascript_include('vendors/bootstrap/js/bootstrap.min.js') }}
        {% block javascript %}{% endblock %}
    </body>
</html>    
    
