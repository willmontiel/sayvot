{% extends "templates/default.volt" %}
{% block css %}{% endblock%}
{% block javascript %}{% endblock%}
{% block title %}<i class="fa fa-instagram"></i> Planes de pago{% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1 class="page-header">Conoce los planes de pago de la plataforma</h1>
        </div>    
    </div>   
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="text-right">
                <a href="{{url('accountplan/add')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
            </div>
            <br>
            {{flashSession.output()}}
        </div>    
    </div>   
    
    {% if page.items|length > 0%}
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="row">
                    {{ partial('partials/pagination', ['pagination_url': 'accountplan/index']) }}
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Datos básicos</th>
                                <th>Configuración</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for item in page.items %}
                                <tr {% if item.status == 0 %}class="danger"{% endif %}>
                                    <td>{{item.idAccountplan}}</td>
                                    <td>
                                        <span class="medium">{{item.name}}</span> <br>
                                        {{item.currency.simbol}}{{item.price + 0}} <br>
                                        {{item.currency.name}}<br>
                                        <em>
                                            <span class="little">
                                                Creado {{date('d/M/Y H:s', item.createdon)}}, Actualizado {{date('d/M/Y H:s', item.updatedon)}}
                                            </span>
                                        </em>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                Encuestas: {{item.surveyQuantity}}
                                            </li>
                                            <li>
                                                Preguntas: {{item.questionQuantity}}
                                            </li>
                                            <li>
                                                Usuarios: {{item.userQuantity}}
                                            </li>
                                            <li>
                                                <span class="label label-{% if item.sendSMSAuto == 0%}danger{% else %}success{% endif %}" style="font-weight: 300;">
                                                    Envío de SMS Automáticos
                                                </span>
                                            </li>
                                            <li>
                                                Sitios a evaluar: {{item.sitesQuantity}}
                                            </li>
                                            <li>
                                                <span class="label label-{% if item.sendSMS == 0%}danger{% else %}success{% endif %}" style="font-weight: 300;">
                                                    Envío de SMS
                                                </span>
                                            </li>
                                            <li>
                                                <span class="label label-{% if item.quickView == 0%}danger{% else %}success{% endif %}" style="font-weight: 300;">
                                                    Vista rápida
                                                </span>
                                            </li>
                                            <li>
                                                <span class="label label-{% if item.exportContact == 0%}danger{% else %}success{% endif %}" style="font-weight: 300;">
                                                    Exportación de contactos
                                                </span>
                                            </li>
                                        </ul>    
                                    </td>
                                    <td class="text-right">
                                        <a href="{{url('accountplan/update')}}/{{item.idAccountplan}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></i></a>
                                        <a id="show-delete-modal" data-toggle="modal" href="#delete-modal" data-id="{{url('accountplan/remove')}}/{{item.idAccountplan}}" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></a>
                                    </td>
                                </tr>   
                            {% endfor %}
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ partial('partials/pagination', ['pagination_url': 'accountplan/index']) }}
                </div>


                {{ partial('partials/delete-modal', ['resource_name': 'Plan de pago']) }}
            </div>
        </div>
    {% else %}        
        {{ partial('partials/empty-rows', ['resource_name': 'Plan de pago', 'resource_url': 'accountplan/add']) }}
    {% endif %} 
{% endblock %} 
