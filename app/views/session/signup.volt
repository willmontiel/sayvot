{% extends "templates/default-clear.volt" %}
{% block css %}
    {{ stylesheet_link('vendors/x-bootstrap-wizard-v1.1/assets/css/gsdk-base.css') }}
    {{ stylesheet_link('vendors/select2-4.0.1/css/select2.min.css') }}
{% endblock %}
{% block javascript %}
    {{ javascript_include('vendors/x-bootstrap-wizard-v1.1/assets/js/jquery.bootstrap.wizard.js') }}
    {{ javascript_include('vendors/x-bootstrap-wizard-v1.1/assets/js/jquery.validate.min.js') }}
    {{ javascript_include('vendors/x-bootstrap-wizard-v1.1/assets/js/wizard.js') }}
    {{ javascript_include('vendors/select2-4.0.1/js/select2.min.js') }}
    <script type="text/javascript">
        $(function(){
            var id = 1;
            $(".select2").select2();
           
            $('#idAccounttype').select2().on("select2:select", function(e) {
                $('#nit-container').hide('fast');
                var type = $(this).val();
                if (type == 3) {
                    $('#nit-container').show('fast');
                }
            });
            
            $('#idCountry').select2().on("select2:select", function(e) {
                id = $(this).val();
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
{% endblock %}
{% block content %}
         <!--   Big container   -->
    <div class="container">
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
           
            <!--      Wizard container        -->   
            <div class="wizard-container"> 
                
                <div class="card wizard-card ct-wizard-green" id="wizard">
                    <form action="" method="">
                <!--        You can switch "ct-wizard-orange"  with one of the next bright colors: "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"             -->
                
                    	<div class="wizard-header">
                        	<h3>
                        	   <b>Registra</b> tu perfil <br>
                        	   <small>Y comienza a encuestar a tu público al instante</small>
                        	</h3>
                    	</div>
                    	<ul>
                            <li><a href="#profile" data-toggle="tab">Perfil</a></li>
                            <li><a href="#account" data-toggle="tab">Cuenta</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="profile">
                              <div class="row">
                                  <h4 class="info-text"> Let's start with the basic information (with validation)</h4>
                                  <div class="col-sm-4 col-sm-offset-1">
                                     <div class="picture-container">
                                          <div class="picture">
                                              <img src="{{url('')}}images/general/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                              <input type="file" id="wizard-picture">
                                          </div>
                                          <h6>Choose Picture</h6>
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>First Name <small>(required)</small></label>
                                        <input name="firstname" type="text" class="form-control" placeholder="Andrew...">
                                      </div>
                                      <div class="form-group">
                                        <label>Last Name <small>(required)</small></label>
                                        <input name="lastname" type="text" class="form-control" placeholder="Smith...">
                                      </div>
                                  </div>
                                  <div class="col-sm-10 col-sm-offset-1">
                                      <div class="form-group">
                                          <label>Email <small>(required)</small></label>
                                          <input name="email" type="email" class="form-control" placeholder="andrew@creative-tim.com">
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="account">
                                <h4 class="info-text"> Datos de la cuenta </h4>
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10">
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
                                        
                                        <div id="nit-container" class="form-group" style="display: none;">
                                            <label for="code">NIT</label>
                                            {{ accountForm.render('nit')}}
                                        </div>

                                        <div class="form-group" id="accountplan-container" >
                                            <label for="idAccountplan">*Plan</label>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-success' name='next' value='Siguiente' />
                                <input type='button' class='btn btn-finish btn-success' name='finish' value='Finalizar' />
                            </div>
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-default btn-sm' name='previous' value='Atras' />
                            </div>
                            <div class="clearfix"></div>
                        </div>	
                    </form>
                </div>
        
            </div> <!-- wizard container -->
        </div>
        </div><!-- end row -->
    </div> <!--  big container -->    
{% endblock %}