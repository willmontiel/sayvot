{% extends "templates/default.volt" %}
{% block css %}{% endblock%}
{% block javascript %}{% endblock%}
{% block title %}{% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-3 col-md-6 text-center">
            <h1 class="page-header">Crear nueva encuesta</h1>
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            {{flashSession.output()}}
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form method="post" action="">
                <div class="form-group text-right">
                  <a href="{{url('survey')}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                </div>
            </form>
        </div>    
    </div>    
{% endblock %}
