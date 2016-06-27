{% extends "templates/default.volt" %}
{% block css %}
    {{ stylesheet_link('vendors/select2-4.0.1/css/select2.min.css') }}
{% endblock%}
{% block javascript %}
    {{ javascript_include('vendors/select2-4.0.1/js/select2.min.js') }}
    <script type="text/javascript">
        $(function(){
            $(".select2").select2();
           
            $('#idCountry').select2().on("select2:select", function(e) {
                var id = $(this).val();
                $("#idAccountplan").select2({
                    ajax: {
                        url: '{{url("")}}/accountplan/getplansbycountry/' + id,
                        processResults: function (data) {
                          return {
                                results: data
                          };
                        }
                    }
                });
            });
            
            var id = $("#idCountry").val();
            
            $("#idAccountplan").select2({
                ajax: {
                    url: '{{url("")}}/accountplan/getplansbycountry/' + id,
                    processResults: function (data) {
                      return {
                        results: data
                      };
                    }
                }
            });
            
            $('#idAccountplan').select2().on("select2:select", function(e) {
                $('#loader').show('fast');
                $('#accountplan-data-container').hide('fast');
                var id = $(this).val();
                $.get( "{{url('')}}accountplan/getplandata/" + id, function(data) {
                    $('#ap-name').empty();
                    $('#ap-price').empty();
                    $('#ap-currency').empty();
                    $('#ap-surveyQuantity').empty();
                    $('#ap-questionQuantity').empty();
                    $('#ap-userQuantity').empty();
                    $('#ap-sitesQuantity').empty();
                    
                    $('#ap-advertising').removeClass("label label-success label-danger");
                    $('#ap-sendSMSAuto').removeClass("label label-success label-danger");
                    $('#ap-sendSMS').removeClass("label label-success label-danger");
                    $('#ap-exportContact').removeClass("label label-success label-danger");
                    
                    $('#ap-name').append(data.name);
                    $('#ap-price').append(data.price);
                    $('#ap-currency').append(data.currency);
                    $('#ap-surveyQuantity').append(data.surveyQuantity);
                    $('#ap-questionQuantity').append(data.questionQuantity);
                    $('#ap-userQuantity').append(data.userQuantity);
                    $('#ap-sitesQuantity').append(data.sitesQuantity);
                    $('#ap-advertising').addClass((data.advertising == 1 ? "label label-success" : "label label-danger"));
                    $('#ap-sendSMSAuto').addClass((data.sendSMSAuto == 1 ? "label label-success" : "label label-danger"));
                    $('#ap-sendSMS').addClass((data.sendSMS == 1 ? "label label-success" : "label label-danger"));
                    $('#ap-exportContact').addClass((data.exportContact == 1 ? "label label-success" : "label label-danger"));
                    
                    $('#loader').hide('fast');
                    $('#accountplan-data-container').show('fast');
                });
            });
        });
    </script>   
{% endblock%}
{% block title %}<i class="fa fa-instagram"></i> Cuentas {% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Crea una nueva cuenta</h1>
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            {{flashSession.output()}}
        </div>    
    </div>    
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form method="post" action="{{url('account/add')}}">
                <div class="form-group">
                    <label for="simbol">*Nombre de la cuenta, Institución o Compañia</label>
                    {{ accountForm.render('name')}}
                </div>
                
                <div class="form-group">
                    <label for="simbol">*Dirección de correo eléctronico</label>
                    {{ accountForm.render('email')}}
                </div>
                
                <div class="form-group">
                    <label for="simbol">*Télefono y/o Celular</label>
                    {{ accountForm.render('phone')}}
                </div>
                
                <div class="form-group">
                    <label for="simbol">*Dirección</label>
                    {{ accountForm.render('address')}}
                </div>
                
                <div class="form-group">
                    <label for="name">*País</label>
                    {{ accountForm.render('idCountry')}}
                </div>
                
                <div class="form-group">
                    <label for="name">*Ciudad</label>
                    {{ accountForm.render('city')}}
                </div>
                
                <div class="form-group">
                    <label for="idAccounttype">*Tipo de cuenta</label>
                    {{ accountForm.render('idAccounttype')}}
                </div>
                
                <div class="form-group" id="accountplan-container" >
                    <label for="idAccountplan">*Plan de pago</label>
                    {{ accountForm.render('idAccountplan', {'id': "idAccountplan", 'class': "form-control", 'required': "required", 'name': "idAccountplan"})}}            
                </div>
                
                <div class="form-group">
                    <div class="text-center" id="loader" style="display: none;">
                        <img src="{{url('')}}images/loaders/pacman.gif" width="40">
                    </div>
                        
                    <div class="" id="accountplan-data-container" style="display: none;">
                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <td>    
                                        <span id="ap-name" style="font-weight: 800; font-size: 1.2em;"></span> <br>
                                        <span id="ap-price"></span> <br>
                                        <span id="ap-current"></span>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                Encuestas: <span id="ap-surveyQuantity"></span>
                                            </li>
                                            <li>
                                                Preguntas: <span id="ap-questionQuantity"></span>
                                            </li>
                                            <li>
                                                Usuarios: <span id="ap-userQuantity"></span>
                                            </li>
                                            <li>
                                                <span id="ap-advertising" style="font-weight: 300;">
                                                    Publicidad en app
                                                </span>
                                            </li>
                                            <li>
                                                <span id="ap-sendSMSAuto" style="font-weight: 300;">
                                                    Envío de SMS Automáticos
                                                </span>
                                            </li>
                                            <li>
                                                Sitios a evaluar: <span id="ap-sitesQuantity"></span>
                                            </li>
                                            <li>
                                                <span id="ap-sendSMS" style="font-weight: 300;">
                                                    Envío de SMS
                                                </span>
                                            </li>
                                            <li>
                                                <span id="ap-exportContact" style="font-weight: 300;">
                                                    Exportación de contactos
                                                </span>
                                            </li>
                                        </ul>        
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="code">NIT</label>
                    {{ accountForm.render('nit')}}
                </div>
             
                <a href="{{url('account')}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
            </form>
        </div>    
    </div>    
{% endblock %}