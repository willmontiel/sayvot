{% extends "templates/default.volt" %}
{% block css %}
  {{ stylesheet_link('vendors/chosen-1.5.1/chosen.min.css') }}
{% endblock %}
{% block javascript %}
  {{ javascript_include('vendors/chosen-1.5.1/chosen.jquery.min.js') }}
  <script>
    var myBaseURL = "{{urlManager.getBaseUri(true)}}";
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
        <label class="control-label">*Nombre:</label> 
        <input type="text" id="name" name="name" class="form-control" maxlength="100" placeholder="Nombre de la encuesta" required="required" autofocus="autofocus" ng-model="name">
      </div>
      
      <div class="form-group">
        <label class="control-label">
          *Tema:
        </label> 
        <select ng-model="subject" ng-change="subjectChange()" class="chosen">
            <option value="">- Seleccione -</option>
            <option ng-repeat="sub in subjects" value="{{ '{{sub.id}}' }}">{{ '{{sub.text}}' }}</option>
        </select>
      </div>

      <div class="form-group">
        <label class="control-label">
          *Sub-tema:
        </label> 
        <select ng-model="subtopic" ng-disabled="!subject" ng-change="subtopicChange()">
          <option value="">- Seleccione -</option>
          <option ng-repeat="subt in subtopics" value="{{ '{{subt.id}}' }}">{{ '{{subt.text}}' }}</option>
        </select>
      </div>

      <div class="form-group">
        <label class="control-label">
          *Contenido del sub-tema:
        </label> 
        <select ng-model="subtopicContent" ng-disabled="!subject || !subtopic">
            <option value="">- Seleccione -</option>
            <option ng-repeat="subtc in subtopicsContent" value="{{ '{{subtc.id}}' }}">{{ '{{subtc.text}}' }}</option>
        </select>
      </div>

      <div class="form-group text-right">
        <a href="{{url('survey')}}" class="btn btn-sm btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-sm btn-success" ng-click="newSurvey()">Continuar</button>
      </div> 
    </div>    
  </div>    
{% endblock %}
