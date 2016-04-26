{% extends "templates/default.volt" %}
{% block css %}{% endblock %}
{% block js %} {% endblock %}

{% block content %}
  <div class="row">
    <div class="col-md-offset-3 col-md-6">
      <h1 class="page-header">Este es el listado de tus encuestas</h1>
    </div>    
  </div>   

  <div class="row">
    <div class="col-md-offset-3 col-md-6">
      <div class="text-right">
        <a href="{{url('survey/new')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
      </div>
      <br>
      {{flashSession.output()}}
    </div>    
  </div>   
{% endblock %}
