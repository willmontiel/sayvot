{% extends "templates/default.volt" %}
{% block css %}
{% endblock %}

{% block js %} 
{% endblock %}

{% block content %}
  <h1 class="page-header text-center">Configuración de la plataforma</h1>
  <br>
  <br>
  <div class="row placeholders text-center">
      <div class="col-xs-6 col-sm-3 placeholder">
        <i class="fa fa-briefcase icon-menu" aria-hidden="true"></i>
        <h4><a href="{{url('account')}}">Cuentas</a></h4>
        <span class="text-muted">Accounts</span>
      </div>

      <div class="col-xs-6 col-sm-3 placeholder">
          <i class="fa fa-credit-card icon-menu" aria-hidden="true"></i>
          <h4><a href="{{url('accountplan')}}">Planes de pago</a></h4>
          <span class="text-muted">Payment plans</span>
      </div>

      <div class="col-xs-6 col-sm-3 placeholder">
          <i class="fa fa-money icon-menu" aria-hidden="true"></i>
          <h4><a href="{{url('currency')}}">Tipos de moneda</a></h4>
          <span class="text-muted">Currency</span>
      </div>
  </div>
{% endblock %}
