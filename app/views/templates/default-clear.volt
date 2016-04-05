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
        <div class="image-container set-full-height" style="background-image: url('{{url('')}}images/backgrounds/city.jpg')">
            <div class="container-fluid fill">
                <div class="row fill">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        {% block content %} {% endblock %}

                        <div class="style-footer-clear">
                            <div class="social-networks-clear">
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
        </div>
        {{ javascript_include('vendors/bootstrap/js/bootstrap.min.js') }}
        {% block javascript %}{% endblock %}
    </body>
</html>    
    

