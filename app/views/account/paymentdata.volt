{% extends "templates/default-clear.volt" %}
{% block css %}
  {# Chosen #}
  {{ stylesheet_link('vendors/x-bootstrap-wizard-v1.1/assets/css/gsdk-base.css') }}
{% endblock%}
{% block content %}
  <div class="image-container set-full-height" style="background-image: url('{{url('')}}images/backgrounds/abstract.jpg'); background-size: auto !important;">
    <div class="container-fluid fill">
      <div class="row fill">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="row">
            <div class="col-md-offset-3 col-md-6">
              <h1 class="page-header">Debes registrar tu información de pago, para completar tu suscripción</h1>
            </div>    
          </div> 
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="wizard-container">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <form method="post" action="{{url('account/paymentdata')}}/{{account.idAccount}}">
                        <div class="col-sm-10 col-sm-offset-1">
                          <div class="form-group text-center">
                            <a href="">
                              <img src="{{url('')}}images/sayvot-logo.png" width="100">
                            </a>
                          </div>

                          {{flashSession.output()}}

                          <div class="form-group">
                            <label for="simbol">*Nombre a quien facturar</label>
                            {{ paymentForm.render('name')}}
                          </div>

                          <div class="form-group">
                            <label for="simbol">*Número Fiscal/NIT/Número de identificacion</label>
                            {{ paymentForm.render('fiscalNumber')}}
                          </div>

                          <div class="form-group">
                            <label for="simbol">*Correo de Facturación</label>
                            {{ paymentForm.render('email')}}
                          </div>

                          <div class="form-group text-right">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>        
              </div>
            </div>
            <div class="style-footer-clear">
              <div class="social-networks-clear">
                <ul>
                  <li>
                    <i class="fa fa-facebook"></i>
                  </li>
                  <li>
                    <i class="fa fa-twitter"></i>
                  </li>
                  <li>
                    <i class="fa fa-youtube"></i>
                  </li>
                  <li>
                    <i class="fa fa-instagram"></i>
                  </li>
                </ul>    
              </div>    
            </div>    
          </div>
        </div>
      </div>
    </div>
  </div>
{% endblock %}
