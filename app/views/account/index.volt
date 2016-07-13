{% extends "templates/default.volt" %}
{% block css %}{% endblock%}
{% block javascript %}{% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-2 col-md-8 text-center">
            <h1 class="page-header">Este es listado de cuentas registradas en la plataforma</h1>
        </div>    
    </div>   
    
    <div class="row">
        <div class="col-md-offset-2 col-md-8 text-center">
            <div class="text-right">
                <a href="{{url('account/add')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
            </div>
            <br>
            {{flashSession.output()}}
        </div>    
    </div>   
    
    {% if page.items|length > 0%}
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="row">
                    {{ partial('partials/pagination', ['pagination_url': 'account/index']) }}
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Datos de Contacto</th>
                                <th>Ubicación</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for item in page.items %}
                                <tr {% if item.status == 0 %}class="danger"{% endif %}>
                                    <td>{{item.idAccount}}</td>
                                    <td><strong>{{item.name}}</strong> <br> {{item.nit}}</td>
                                    <td>
                                        <dl>
                                            <dd>{{item.email}}</dd>
                                            <dd>{{item.phone}}</dd>
                                            <dd>{{item.address}}</dd>
                                        </dl>
                                    </td>
                                    <td>{{item.country.name}} <br> {{item.city}}</td>
                                    <td>Creado {{date('d/M/Y', item.createdon)}} <br> Actualizado {{date('d/M/Y', item.updatedon)}}</td>
                                    <td class="text-right">
                                        <a href="{{url('account/update')}}/{{item.idAccount}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></i></a>
                                        <a id="show-delete-modal" data-toggle="modal" href="#delete-modal" data-id="{{url('account/deactivate')}}/{{item.idAccount}}" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></a>
                                    </td>
                                </tr>   
                            {% endfor %}
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ partial('partials/pagination', ['pagination_url': 'account/index']) }}
                </div>
            </div>
        </div>
    {% else %}        
        {{ partial('partials/empty-rows', ['resource_name': 'Cuentas', 'resource_url': 'account/add']) }}
    {% endif %} 
{% endblock %} 
