{% extends "templates/default.volt" %}
{% block css %}
  
{% endblock %}
{% block javascript %}
  <script>
    var myBaseURL = "survey";
  </script>
  {{ javascript_include('vendors/angular/angular.min.js') }}
  {{ javascript_include('js/angular/survey/app.js') }}
{% endblock %}

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
  
  <div class="row" ng-app="sayvot" ng-controller="ctrlNewSurvey">
    <div class="col-md-offset-3 col-md-6">
      <div class="form-group">
        <label class="control-label">
          *Nombre:
        </label> 
        <input type="text" id="name" name="name" class="form-control" maxlength="100" placeholder="Nombre del tema" required="required" autofocus="autofocus" ng-model="name">
      </div>
      <div class="form-group text-right">
        <a href="{{url('survey')}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
        <button type="submit" class="btn btn-sm btn-success" ng-click="newSurvey()"><i class="fa fa-check"></i></button>
      </div>
    </div>    
  </div>    
{% endblock %}
