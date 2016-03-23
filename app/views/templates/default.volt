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
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="{{url('')}}">
                                <img class="principal-logo" src="{{url('')}}images/sayvot-logo-horizontal.png" >
                            </a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
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
                        <div class="smart-menu">
                            <ul>
                                <li>
                                    <a href="#">
                                        Herramientas
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="#">
                                        Encuestas
                                    </a>    
                                </li>
                                
                                <li>
                                    <a href="#">
                                        Usuarios
                                    </a>    
                                </li>
                                
                                <li>
                                    <a href="#">
                                        Cuentas
                                    </a>
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
    
