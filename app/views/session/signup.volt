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
            
            $('.country').select2().on("select2:select", function(e) {
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
                {{flashSession.output()}}
            </div>
        </div>    
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
           
            <!--      Wizard container        -->   
            <div class="wizard-container"> 
                
                <div class="card wizard-card ct-wizard-green" id="wizard">
                    <form action="{{url('session/signup')}}" method="POST">
                        <div class="wizard-header">
                            <a href="http://creative-tim.com">
                                <div class="logo-container">
                                   <div class="logo">
                                       <img src="{{url('')}}images/sayvot-logo.png" width="100">
                                   </div>
                               </div>
                            </a>
                            <h3>
                               <b>Registra</b> tu perfil <br>
                               <small>Y comienza a encuestar a tu público al instante</small>
                            </h3>
                    	</div>
                    	<ul>
                            <li><a href="#profile" data-toggle="tab">Perfil</a></li>
                            <li><a href="#account" data-toggle="tab">Cuenta</a></li>
                            <li><a href="#plan" data-toggle="tab">Plan</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="profile">
                              <div class="row">
                                  <h4 class="info-text"> Empecemos con la información básica (los campos con * son obligatorios)</h4>
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
                                          <label>*Nombre(s)</label>
                                        {{ userForm.render('name')}}
                                      </div>
                                      
                                      <div class="form-group">
                                          <label>*Apellido(s)</label>
                                        {{ userForm.render('lastname')}}
                                      </div>
                                  </div>
                                  <div class="col-sm-10 col-sm-offset-1">
                                      <div class="form-group">
                                          <label>*Género</label>
                                        {{ userForm.render('gender', {'class': "select2 form-control", 'id' : "gender"})}}
                                      </div>
                                      
                                      <div class="form-group">
                                          <label>*País</label>
                                        {{ userForm.render('country')}}
                                      </div>
                                      
                                      <div class="form-group">
                                          <label>*Departamento/Provincia/Estado</label>
                                        {{ userForm.render('state')}}
                                      </div>
                                      
                                      <div class="form-group">
                                          <label>*Ciudad</label>
                                        {{ userForm.render('city')}}
                                      </div>

                                      <div class="form-group">
                                          <label>*Dirección</label>
                                        {{ userForm.render('address')}}
                                      </div>

                                      <div class="form-group">
                                          <label>*Télefono o Celular</label>
                                        {{ userForm.render('phone')}}
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="account">
                              <div class="row">
                                  <h4 class="info-text"> Ahora continuemos con los datos de tu perfil (los campos con * son obligatorios)</h4>
                                  
                                  <div class="col-sm-10 col-sm-offset-1">
                                      <div class="form-group">
                                          <label>*Dirección de correo eléctronico (se usará para iniciar sesión)</label>
                                        {{ userForm.render('email')}}
                                      </div>
                                      
                                      <div class="form-group">
                                          <label>*Contraseña</label>
                                        {{ userForm.render('pass1')}}
                                      </div>
                                      
                                      <div class="form-group">
                                          <label>*Confirma tu contraseña</label>
                                        {{ userForm.render('pass2')}}
                                      </div>

                                      <div class="form-group">
                                          <label>Cuenta de Twitter</label>
                                        {{ userForm.render('twitter')}}
                                      </div>

                                      <div class="form-group">
                                          <label>Cuenta de Facebook</label>
                                        {{ userForm.render('facebook')}}
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="plan">
                                <h4 class="info-text"> Datos de la cuenta </h4>
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10">
                                        <div class="form-group">
                                            <label for="idAccounttype">*Tipo de cuenta</label>
                                            {{ accountForm.render('idAccounttype')}}
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="simbol">*Nombre de la cuenta, Institución o Compañia</label>
                                            {{ accountForm.render('accountName')}}
                                        </div>

                                        <div class="form-group">
                                            <label for="simbol">*Dirección de correo eléctronico</label>
                                            {{ accountForm.render('accountEmail')}}
                                        </div>

                                        <div class="form-group">
                                            <label for="simbol">*Télefono y/o Celular</label>
                                            {{ accountForm.render('accountPhone')}}
                                        </div>

                                        <div class="form-group">
                                            <label for="simbol">*Dirección</label>
                                            {{ accountForm.render('accountAddress')}}
                                        </div>

                                        <div class="form-group">
                                            <label for="name">*País</label>
                                            {{ accountForm.render('accountIdCountry')}}
                                        </div>

                                        <div class="form-group">
                                            <label for="name">*Ciudad</label>
                                            {{ accountForm.render('city')}}
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
                                            
                                        <div class="form-group">
                                            <label>*Estoy de acuerdo con las politicas</label>
                                            {{ userForm.render('agree')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-success' name='next' value='Siguiente' />
                                <input type='submit' class='btn btn-finish btn-success' name='finish' value='Finalizar' />
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