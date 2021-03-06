{% extends "templates/default.volt" %}
{% block css %}{% endblock%}
{% block javascript %}{% endblock%}
{% block title %}{% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-2 col-md-8 text-center">
            <h1 class="page-header">Registra un nuevo tipo de moneda.</h1>
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            {{flashSession.output()}}
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form method="post" action="{{url('currency/add')}}">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    {{ currencyForm.render('name')}}
                </div>
                
                <div class="form-group">
                    <label for="code">Código</label>
                    {{ currencyForm.render('code')}}
                </div>
                
                <div class="form-group">
                    <label for="simbol">Símbolo</label>
                    {{ currencyForm.render('simbol')}}
                </div>
                
                <div class="form-group">
                    <label for="simbol">Valor en Colombia</label>
                    {{ currencyForm.render('value')}}
                </div>
                
                <div class="form-group">
                    <label for="status">*Estado</label>
                    <div class="onoffswitch">
                        {{ currencyForm.render('status')}}
                        <label class="onoffswitch-label" for="status">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div> 
                </div> 
                 
                <div class="form-group text-right">
                  <a href="{{url('currency')}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                </div>
            </form>
        </div>    
    </div>    
{% endblock %}