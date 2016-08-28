{% extends "templates/default.volt" %}
{% block css %}
  {{ stylesheet_link('vendors/angular-ui-notification/dist/angular-ui-notification.min.css') }}
  {{ stylesheet_link('vendors/angular-material-design/css/angular-material.min.css') }}
{% endblock %}
{% block javascript %}
  {{ javascript_include('vendors/chosen-1.5.1/chosen.jquery.min.js') }}
  <script>
    var myBaseURL = "{{urlManager.getBaseUri(true)}}";
  </script>
  {{ javascript_include('vendors/angular/angular.min.js') }}
  {{ javascript_include('vendors/angular-material-design/js/angular-animate.min.js') }}
  {{ javascript_include('vendors/angular-material-design/js/angular-aria.min.js') }}
  {{ javascript_include('vendors/angular-material-design/js/angular-messages.min.js') }}
  {{ javascript_include('vendors/angular-material-design/js/angular-material.min.js') }}
  {{ javascript_include('vendors/angular-chosen/angular-chosen.min.js') }}
  {{ javascript_include('vendors/angular-ui-notification/dist/angular-ui-notification.min.js') }}
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
        <label class="control-label">*Nombre:</label> 
        <input type="text" id="name" name="name" class="form-control" maxlength="100" placeholder="Nombre de la encuesta" required="required" autofocus="autofocus" ng-model="name">
      </div>
      
      <div class="form-group">
        <label class="control-label">
          *Tema:
        </label> 

        <md-select placeholder="Selecciona una opción" ng-model="subject" md-on-open="subjectOpen()" ng-change="subjectChange()" class="angular-select">
          <md-option ng-value="{{ '{{sub.id}}' }}" ng-repeat="sub in subjects">{{ '{{sub.text}}' }}</md-option>
        </md-select>
      </div>

      <div class="form-group">
        <label class="control-label">
          *Sub-tema:
        </label> 

        <md-select placeholder="Selecciona una opción" ng-model="subtopic" ng-disabled="!subject" ng-change="subtopicChange()" class="angular-select">
          <md-option ng-value="{{ '{{subt.id}}' }}" ng-repeat="subt in subtopics">{{ '{{subt.text}}' }}</md-option>
        </md-select>
      </div>

      <div class="form-group">
        <label class="control-label">
          *Contenido del sub-tema:
        </label> 

        <md-select placeholder="Selecciona una opción" ng-model="subtopicContent" ng-disabled="!subject || !subtopic" class="angular-select">
          <md-option ng-value="{{ '{{subtc.id}}' }}" ng-repeat="subtc in subtopicsContent">{{ '{{subtc.text}}' }}</md-option>
        </md-select>
      </div>

      <div class="form-group text-right">
        <a href="{{url('survey')}}" class="btn btn-sm btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-sm btn-success" ng-click="newSurvey()">Continuar</button>
      </div> 
    </div>    
  </div>    
{% endblock %}
