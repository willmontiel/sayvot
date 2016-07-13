{% extends "templates/default.volt" %}
{% block css %}{% endblock%}
{% block javascript %}{% endblock%}
{% block title %}{% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-3 col-md-6 text-center">
            <h1 class="page-header">Añadir sub-tema al tema: <em class="bold">{{subject.name}}</em>.</h1>
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            {{flashSession.output()}}
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form method="post" action="{{url('subtopic/add')}}/{{subject.idSubject}}">
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
                <div class="form-group">
                  <a href="{{url('subtopic/index')}}/{{subject.idSubject}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                </div>
            </form>
        </div>    
    </div>    
{% endblock %}

