<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=1">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <link rel="icon" type="image/x-icon" href="{{url('')}}images/favicons/favicon.ico">
        
        {{ stylesheet_link('vendors/font-awesome-4.5.0/css/font-awesome.min.css') }}
        {{ javascript_include('vendors/jquery/jquery-1.12.0.min.js') }}
        {{ stylesheet_link('css/base.css') }}
        {{ stylesheet_link('vendors/bootstrap/css/bootstrap.min.css') }}
        {% block css %}{% endblock %}
    </head>
    <body>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" href="http://www.sayvot.com/">
              <img alt="SayVot" width="30" height="30" src="{{url('')}}images/logo.png">
            </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              {# <li class="active"> #}
              <li>
                <a href="{{url('')}}">Inicio</a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  Herramientas <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Usuarios</a></li>
                  <li><a href="#">Mi Plan</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{url('configuration')}}">Configuración</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #8BC53E">
                  Encuestas <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('survey')}}">Mis Encuentas</a></li>
                  <li><a href="#">Nueva Encuesta</a></li>
                  {#
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                  #}
                </ul>
              </li>
            </ul>
            
            
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
      
      {#
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                        <div class="navbar-header">
                            <a href="{{url('')}}">
                                <img class="principal-logo" src="{{url('')}}images/sayvot-logo-horizontal.png" >
                            </a>
                        </div>
                          
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Cambiar Contraseña</a></li>
                            <li><a href="#">Salir</a></li>
                            <li><a href="#">Will Montiel</a></li>
                        </ul>
                      </div>
                    </div>
                </div>
            </div>
        </nav>
#}
        <div class="container-fluid fill">
            <div class="row fill">
                
                {#
                <div class="col-sm-2 col-md-1 col-lg-1 sidebar">
                    <div class="title-container" style="position: relative;">
                        <div class="vertical-text">
                            <div class="title">
                                {% block title %} {% endblock %}
                            </div>
                        </div>   
                    </div>   
                </div>
                
                <div class="col-sm-10 col-sm-offset-2 col-md-11 col-md-offset-1 col-lg-11 col-lg-offset-1 main">
                #}
                <div class="col-sm-12 col-md-12 col-lg-12 main">
                    {% block content %} {% endblock %}
                    
                    <div class="style-footer">
                        <div class="social-networks">
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
            </div>
        </div>
        {{ javascript_include('vendors/bootstrap/js/bootstrap.min.js') }}
        {% block javascript %}{% endblock %}
    </body>
</html>    
    
