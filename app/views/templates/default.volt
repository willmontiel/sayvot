<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=1">
        <!--
        <link rel="shortcut icon" type="image/x-icon" href="{{url('')}}images/favicon48x48.ico">
        -->
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <link href='https://fonts.googleapis.com/css?family=Exo:400,300,500,600,700,800' rel='stylesheet' type='text/css'>
        
        {{ javascript_include('vendors/jquery/jquery-1.12.0.min.js') }}
        {{ stylesheet_link('vendors/bootstrap/css/bootstrap.min.css') }}
        {{ stylesheet_link('css/base.css') }}
        {% block css %}{% endblock %}
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SayVot</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Cambiar Contraseña</a></li>
                        <li><a href="#">Salir</a></li>
                        <li><a href="#">Will Montiel</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-1 sidebar">
                    <div class="title-container" style="position: relative;">
                        <div class="vertical-text">
                            <div class="title">
                                Dashboard
                            </div>
                            <hr>
                            <div class="subtitle">
                                Lorem ipsum bla bla bla bla
                            </div>
                        </div>   
                    </div>   
                </div>
                <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-11 col-lg-offset-1 main">
                  <h2 class="sub-header">Section title</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Header</th>
                              <th>Header</th>
                              <th>Header</th>
                              <th>Header</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1,001</td>
                              <td>Lorem</td>
                              <td>ipsum</td>
                              <td>dolor</td>
                              <td>sit</td>
                            </tr>
                            <tr>
                              <td>1,002</td>
                              <td>amet</td>
                              <td>consectetur</td>
                              <td>adipiscing</td>
                              <td>elit</td>
                            </tr>
                            <tr>
                              <td>1,003</td>
                              <td>Integer</td>
                              <td>nec</td>
                              <td>odio</td>
                              <td>Praesent</td>
                            </tr>
                            <tr>
                              <td>1,003</td>
                              <td>libero</td>
                              <td>Sed</td>
                              <td>cursus</td>
                              <td>ante</td>
                            </tr>
                            <tr>
                              <td>1,004</td>
                              <td>dapibus</td>
                              <td>diam</td>
                              <td>Sed</td>
                              <td>nisi</td>
                            </tr>
                            <tr>
                              <td>1,005</td>
                              <td>Nulla</td>
                              <td>quis</td>
                              <td>sem</td>
                              <td>at</td>
                            </tr>
                            <tr>
                              <td>1,006</td>
                              <td>nibh</td>
                              <td>elementum</td>
                              <td>imperdiet</td>
                              <td>Duis</td>
                            </tr>
                            <tr>
                              <td>1,007</td>
                              <td>sagittis</td>
                              <td>ipsum</td>
                              <td>Praesent</td>
                              <td>mauris</td>
                            </tr>
                            <tr>
                              <td>1,008</td>
                              <td>Fusce</td>
                              <td>nec</td>
                              <td>tellus</td>
                              <td>sed</td>
                            </tr>
                            <tr>
                              <td>1,009</td>
                              <td>augue</td>
                              <td>semper</td>
                              <td>porta</td>
                              <td>Mauris</td>
                            </tr>
                            <tr>
                              <td>1,010</td>
                              <td>massa</td>
                              <td>Vestibulum</td>
                              <td>lacinia</td>
                              <td>arcu</td>
                            </tr>
                            <tr>
                              <td>1,011</td>
                              <td>eget</td>
                              <td>nulla</td>
                              <td>Class</td>
                              <td>aptent</td>
                            </tr>
                            <tr>
                              <td>1,012</td>
                              <td>taciti</td>
                              <td>sociosqu</td>
                              <td>ad</td>
                              <td>litora</td>
                            </tr>
                            <tr>
                              <td>1,013</td>
                              <td>torquent</td>
                              <td>per</td>
                              <td>conubia</td>
                              <td>nostra</td>
                            </tr>
                            <tr>
                              <td>1,014</td>
                              <td>per</td>
                              <td>inceptos</td>
                              <td>himenaeos</td>
                              <td>Curabitur</td>
                            </tr>
                            <tr>
                              <td>1,015</td>
                              <td>sodales</td>
                              <td>ligula</td>
                              <td>in</td>
                              <td>libero</td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {% block content %}{% endblock %}
        {{ javascript_include('vendors/bootstrap/js/bootstrap.min.js') }}
        {% block javascript %}{% endblock %}
    </body>
</html>    
    
