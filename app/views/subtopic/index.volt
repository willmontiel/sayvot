{% extends "templates/default.volt" %}
{% block css %}{% endblock%}
{% block javascript %}{% endblock%}
{% block title %}{% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-2 col-md-8 text-center">
            <h1 class="page-header">Este el listado de sub-temas del tema: <em class="bold">{{subject.name}}</em>.</h1>
        </div>    
    </div>   
    
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="text-right">
              <a href="{{url('subject')}}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Regresar al listado de temas"><i class="fa fa-reply"></i></a>
              <a href="{{url('subtopic/add')}}/{{subject.idSubject}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
            </div>
            <br>
            {{flashSession.output()}}
        </div>    
    </div>   
    
    {% if page.items|length > 0%}
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="row">
                    {{ partial('partials/pagination', ['pagination_url': 'subject/index/' ~ subject.idSubject ]) }}
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for item in page.items %}
                                <tr {% if item.status == 0 %}class="danger"{% endif %}>
                                    <td>{{item.idSubtopic}}</td>
                                    <td>
                                      <strong>{{item.name}}</strong> <br>
                                      <em><span class="small">Creado {{date('d/M/Y H:i', item.createdon)}} <br> Actualizado {{date('d/M/Y H:i', item.updatedon)}}</span></em>
                                    </td>
                                    <td>
                                      <span class="small">{{item.description}}</span>
                                    </td>
                                    <td class="text-right">
                                      <a href="{{url('subtopic/update')}}/{{item.idSubtopic}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></i></a>
                                      <a href="{{url('subtopiccontent/add')}}/{{item.idSubtopic}}" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Añadir contenido al sub-tema"><i class="fa fa-commenting"></i></i></a>
                                    </td>
                                </tr>   
                            {% endfor %}
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ partial('partials/pagination', ['pagination_url': 'subject/index/' ~ subject.idSubject ]) }}
                </div>

                {#
                {{ partial('partials/delete-modal', ['resource_name': 'Tema']) }}
                #}
            </div>
        </div>
    {% else %}        
        {{ partial('partials/empty-rows', ['resource_name': 'Sub-temas', 'resource_url': 'subtopic/add/' ~ subject.idSubject]) }}
    {% endif %} 
{% endblock %} 

