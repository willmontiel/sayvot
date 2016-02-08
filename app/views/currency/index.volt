{% extends "templates/default.volt" %}
{% block css %}{% endblock%}
{% block javascript %}{% endblock%}
{% block title %}<i class="fa fa-instagram"></i> Monedas{% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h1 class="page-header">Conoce cuales monedas han sido registradas en el sistema.</h1>
        </div>    
    </div>   
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="text-right">
                <a href="{{url('currency/add')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
            </div>
            <br>
            {{flashSession.output()}}
        </div>    
    </div>   
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
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
                            <th>Símbolo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for item in page.items %}
                            <tr {% if item.status == 0 %}class="danger"{% endif %}>
                                <td>{{item.idcurrency}}</td>
                                <td>{{item.code}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.simbol}}</td>
                                <td class="text-right">
                                    <a href="{{url('currency/update')}}/{{item.idcurrency}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></i></a>
                                    <a href="{{url('currency/remove')}}/{{item.idcurrency}}" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></a>
                                </td>
                            </tr>   
                        {% endfor %}
                    </tbody>
                </table>
            </div>
                    
            <div class="row">
                {{ partial('partials/pagination', ['pagination_url': 'currency/index']) }}
            </div>
        </div>
    </div>
{% endblock %} 