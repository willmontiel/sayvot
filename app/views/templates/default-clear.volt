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
        {% block content %} {% endblock %}
        
        {{ javascript_include('vendors/bootstrap/js/bootstrap.min.js') }}
        {% block javascript %}{% endblock %}
    </body>
</html>    
    

