{% extends "templates/default.volt" %}
{% block css %}{% endblock%}
{% block javascript %}{% endblock%}
{% block title %}{% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-2 col-md-8 text-center">
            <h1 class="page-header">Conoce cuales tipos de monedas han sido registradas en el sistema.</h1>
        </div>    
    </div>   
    
    <div class="row">
        <div class="col-md-offset-2 col-md-8 text-center">
            <div class="text-right">
                <a href="{{url('currency/add')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
            </div>
            <br>
            {{flashSession.output()}}
        </div>    
    </div>   
    
    {% if page.items|length > 0%}
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="row">
                    {{ partial('partials/pagination', ['pagination_url': 'currency/index']) }}
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Valor CO</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for item in page.items %}
                                <tr {% if item.status == 0 %}class="danger"{% endif %}>
                                    <td>{{item.idCurrency}}</td>
                                    <td>{{item.code}}</td>
                                    <td>{{item.simbol}} - {{item.name}}</td>
                                    <td><strong>{{item.value + 0}}</strong></td>
                                    <td><em><span class="small">Creado {{date('d/M/Y H:i', item.createdon)}} <br> Actualizado {{date('d/M/Y H:i', item.updatedon)}}</span></em></td>
                                    <td class="text-right">
                                        <a href="{{url('currency/update')}}/{{item.idCurrency}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></i></a>
                                        <a id="show-delete-modal" data-toggle="modal" href="#delete-modal" data-id="{{url('currency/remove')}}/{{item.idCurrency}}" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></a>
                                    </td>
                                </tr>   
                            {% endfor %}
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ partial('partials/pagination', ['pagination_url': 'currency/index']) }}
                </div>


                {{ partial('partials/delete-modal', ['resource_name': 'Tipo de moneda']) }}
            </div>
        </div>
    {% else %}        
        {{ partial('partials/empty-rows', ['resource_name': 'Tipo de moneda', 'resource_url': 'currency/add']) }}
    {% endif %} 
{% endblock %} 