{% extends "templates/default.volt" %}
{% block css %}
    {{ stylesheet_link('vendors/select2-4.0.1/css/select2.min.css') }}
{% endblock%}
{% block javascript %}
    {{ javascript_include('vendors/select2-4.0.1/js/select2.min.js') }}
    <script type="text/javascript">
        $(function () {
            $(".select2").select2();
        });
    </script>    
{% endblock%}
{% block title %}{% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-2 col-md-8 text-center">
            <h1 class="page-header">Registra un plan de pago con las caracteristicas que necesites.</h1>
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            {{flashSession.output()}}
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form method="post" action="{{url('accountplan/add')}}">
                <div class="form-group">
                    <label for="name">*Nombre</label>
                    {{ accountPlanForm.render('name')}}
                </div>
                
                <div class="form-group">
                    <label for="advertising">*Publicidad en la aplicación android</label>
                     <div class="onoffswitch">
                        {{ accountPlanForm.render('advertising')}}
                        <label class="onoffswitch-label" for="advertising">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                     </div>
                </div>
                
                <div class="form-group">
                    <label for="surveyQuantity">*Cantidad de encuestas disponibles</label>
                    {{ accountPlanForm.render('surveyQuantity')}}
                </div>
                
                <div class="form-group">
                    <label for="questionQuantity">*Cantidad de preguntas disponibles por cada encuesta</label>
                    {{ accountPlanForm.render('questionQuantity')}}
                </div>
                
                <div class="form-group">
                    <label for="userQuantity">*Cantidad de usuarios que se pueden crear en la cuenta</label>
                    {{ accountPlanForm.render('userQuantity')}}
                </div>
                
                <div class="form-group">
                    <label for="sendSMSAuto">*Envío de SMS automáticos(Depende también de la cantidad de sitios configurada)</label>
                     <div class="onoffswitch">
                        {{ accountPlanForm.render('sendSMSAuto')}}
                        <label class="onoffswitch-label" for="sendSMSAuto">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                     </div>
                </div>
                
                <div class="form-group">
                    <label for="sitesQuantity">*Cantidad de sitios disponibles que serán evualadas al momento de enviar el SMS automático</label>
                    {{ accountPlanForm.render('sitesQuantity')}}
                </div>
                
                <div class="form-group">
                    <label for="sendSMS">*Envío de SMS</label>
                    <div class="onoffswitch">
                        {{ accountPlanForm.render('sendSMS')}}
                        <label class="onoffswitch-label" for="sendSMS">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="quickView">*Vista rápida</label>
                    <div class="onoffswitch">
                        {{ accountPlanForm.render('quickView')}}
                        <label class="onoffswitch-label" for="quickView">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="exportContact">*Exportación de contactos</label>
                    <div class="onoffswitch">
                        {{ accountPlanForm.render('exportContact')}}
                        <label class="onoffswitch-label" for="exportContact">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="idCurrency">*Pais</label>
                    {{ accountPlanForm.render('idCountry')}}
                </div>
                
                <div class="form-group">
                    <label for="price">*Precio</label>
                    {{ accountPlanForm.render('price')}}
                </div>
                
                <div class="form-group">
                    <label for="exportContact">*Estado</label>
                    <div class="onoffswitch">
                        {{ accountPlanForm.render('status')}}
                        <label class="onoffswitch-label" for="status">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div> 
                </div>
                      
                <div class="form-group text-right">
                  <a href="{{url('accountplan')}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                </div>
            </form>
        </div>    
    </div>    
{% endblock %}
