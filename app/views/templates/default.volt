<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=1">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <link rel="icon" type="image/x-icon" href="{{url('')}}images/favicons/favicon.ico">
        <title>SayVot</title>
        {{ stylesheet_link('vendors/font-awesome-4.5.0/css/font-awesome.min.css') }}
        {{ javascript_include('vendors/jquery/jquery-1.12.0.min.js') }}
        {{ stylesheet_link('vendors/bootstrap/css/bootstrap.min.css') }}
        
        
        {{ stylesheet_link('vendors/flat-admin/lib/css/animate.min.css') }}
        {{ stylesheet_link('vendors/flat-admin/lib/css/bootstrap-switch.min.css') }}
        {{ stylesheet_link('vendors/flat-admin/lib/css/checkbox3.min.css') }}
        {{ stylesheet_link('vendors/flat-admin/lib/css/jquery.dataTables.min.css') }}
        {{ stylesheet_link('vendors/flat-admin/style.css') }}
        {{ stylesheet_link('vendors/flat-admin/themes/flat-green.css') }}
        
        {#
        {{ stylesheet_link('css/dashboard.css') }}
        
        #}
        {{ stylesheet_link('css/base.css') }}
        
        {% block css %}{% endblock %}
    </head>
    
    {#
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
    #}
    
    <body class="flat-blue">
      <div class="app-container">
          <div class="row content-container">
              <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                  <div class="container-fluid">
                      <div class="navbar-header">
                          <button type="button" class="navbar-expand-toggle">
                              <i class="fa fa-bars icon"></i>
                          </button>
                          <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                              <i class="fa fa-th icon"></i>
                          </button>
                      </div>
                      <ul class="nav navbar-nav navbar-right">
                          <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                              <i class="fa fa-times icon"></i>
                          </button>
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                              <ul class="dropdown-menu animated fadeInDown">
                                  <li class="title">
                                      Notification <span class="badge pull-right">0</span>
                                  </li>
                                  <li class="message">
                                      No new notification
                                  </li>
                              </ul>
                          </li>
                          <li class="dropdown danger">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i> 4</a>
                              <ul class="dropdown-menu danger  animated fadeInDown">
                                  <li class="title">
                                      Notification <span class="badge pull-right">4</span>
                                  </li>
                                  <li>
                                      <ul class="list-group notifications">
                                          <a href="#">
                                              <li class="list-group-item">
                                                  <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> new registration
                                              </li>
                                          </a>
                                          <a href="#">
                                              <li class="list-group-item">
                                                  <span class="badge success">1</span> <i class="fa fa-check icon"></i> new orders
                                              </li>
                                          </a>
                                          <a href="#">
                                              <li class="list-group-item">
                                                  <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> customers messages
                                              </li>
                                          </a>
                                          <a href="#">
                                              <li class="list-group-item message">
                                                  view all
                                              </li>
                                          </a>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                          <li class="dropdown profile">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Will Montiel<span class="caret"></span></a>
                              <ul class="dropdown-menu animated fadeInDown">
                                  <li class="profile-img">
                                      <img src="{{url('')}}/assets/22/images/avatar/22.png" class="profile-img">
                                  </li>
                                  <li>
                                      <div class="profile-info">
                                          <h4 class="username">will.montiel@aol.com</h4>
                                          <div class="btn-group margin-bottom-2x" role="group">
                                              <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Mi Perfil</button>
                                              <button type="button" class="btn btn-default"><i class="fa fa-sign-out"></i> Cerrar sesión</button>
                                          </div>
                                      </div>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </div>
              </nav>
              <div class="side-menu sidebar-inverse">
                  <nav class="navbar navbar-default" role="navigation">
                      <div class="side-menu-container">
                          <div class="navbar-header">
                              <a class="navbar-brand" href="http://www.sayvot.com/">
                                <img alt="SayVot" width="50" height="50" src="{{url('')}}images/logo.png" style="display: inline !important; margin: 5px;">
                                <div class="title">SayVot</div>
                              </a>
                              <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                  <i class="fa fa-times icon"></i>
                              </button>
                          </div>
                          <ul class="nav navbar-nav">
                            
                              <li class="active">
                                  <a href="{{url('')}}">
                                      <span class="icon fa fa-tachometer"></span><span class="title">Inicio</span>
                                  </a>
                              </li>
                              <li class="">
                                  <a href="{{url('')}}">
                                      <span class="icon fa fa-users"></span><span class="title">Usuarios</span>
                                  </a>
                              </li>
                              <li class="">
                                  <a href="{{url('')}}">
                                      <span class="icon fa fa-archive"></span><span class="title">Mi Plan</span>
                                  </a>
                              </li>
                              <li class="panel panel-default dropdown">
                                  <a data-toggle="collapse" href="#dropdown-element">
                                      <span class="icon fa fa-tasks"></span><span class="title">Encuestas</span>
                                  </a>
                                  <!-- Dropdown level 1 -->
                                  <div id="dropdown-element" class="panel-collapse collapse">
                                      <div class="panel-body">
                                          <ul class="nav navbar-nav">
                                              <li><a href="{{url('survey')}}">Ver encuestas</a></li>
                                              <li><a href="{{url('survey/add')}}">Nueva encuesta</a></li>
                                          </ul>
                                      </div>
                                  </div>
                              </li>
                              
                              <li>
                                  <a href="{{url('configuration')}}">
                                      <span class="icon fa fa-cogs"></span><span class="title">Configuración</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                      <!-- /.navbar-collapse -->
                  </nav>
              </div>
              <!-- Main Content -->
              <div class="container-fluid">
                  <div class="side-body padding-top">
                      <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              {% block content %} {% endblock %}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <footer class="app-footer">
              <div class="wrapper text-center">
                  <span class="pull-right">2.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span>
                  <div class="style-footer">
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
          </footer>
        <div>
        <!-- Javascript Libs -->
        
        {{ javascript_include('vendors/bootstrap/js/bootstrap.min.js') }}
        {{ javascript_include('vendors/flat-admin/lib/js/Chart.min.js') }}
        {{ javascript_include('vendors/flat-admin/lib/js/bootstrap-switch.min.js') }}
        {{ javascript_include('vendors/flat-admin/lib/js/jquery.matchHeight-min.js') }}
        {{ javascript_include('vendors/flat-admin/lib/js/jquery.dataTables.min.js') }}
        {{ javascript_include('vendors/flat-admin/lib/js/dataTables.bootstrap.min.js') }}
        {{ javascript_include('vendors/flat-admin/lib/js/ace/ace.js') }}
        {{ javascript_include('vendors/flat-admin/lib/js/ace/model-html.js') }}
        {{ javascript_include('vendors/flat-admin/lib/js/ace/theme-github.js') }}
        {{ javascript_include('vendors/flat-admin/js/app.js') }}
        {{ javascript_include('vendors/flat-admin/js/index.js') }}
        {% block javascript %}{% endblock %}
  </body>
</html>    
    
