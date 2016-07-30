{% extends "templates/default.volt" %}
{% block css %}{% endblock %}
{% block js %} {% endblock %}

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
      <form method="post" action="{{url('subject/add')}}">
        {% for element in form %}
          <div class="form-group">
            {{ element.label(['class': 'control-label']) }}
            {% if element.getName() == "status"%}
              <div class="onoffswitch">
                {{ element.render() }}
                <label class="onoffswitch-label" for="status">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
              </div> 
            {% else %}
              {{ element.render() }}
            {% endif %}
          </div>
        {% endfor %}
        <div class="form-group text-right">
          <a href="{{url('subject')}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
          <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
        </div>
      </form>
    </div>    
  </div>    
{% endblock %}
