{% extends "templates/default-clear.volt" %}
{% block css %}
    {{ stylesheet_link('vendors/x-bootstrap-wizard-v1.1/assets/css/gsdk-base.css') }}
{% endblock %}
{% block content %}
	<div class="image-container set-full-height" style="background-image: url('{{url('')}}images/backgrounds/city.jpg')">
        <div class="container-fluid fill">
            <div class="row fill">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    
                	<div class="container">   
				        <div class="row">
				        	<div class="col-sm-8 col-sm-offset-2">
				        		<div class="wizard-container">
				        			<div class="panel panel-default">
                                                                    
									  	<div class="panel-body">
										    <form action="{{url('session/login')}}" method="POST">
				                        		<div class="col-sm-10 col-sm-offset-1">
				                        			<div class="form-group text-center">
				                        				<a href="">
					                                       <img src="{{url('')}}images/sayvot-logo.png" width="100">
							                            </a>
							                            <h3>
							                               <b>Iniciar</b> Sesión <br>
							                            </h3>
				                        			</div>
                                                                                    
                                                                                    {{flashSession.output()}}
				                                  	<div class="form-group">
				                                      	<label>*Dirección de correo elétronico</label>
				                                	    <input type="email" class="form-control"required="required" name="email" id="email" />
				                    			  	</div>

				                    			  	<div class="form-group">
				                                      	<label>*Contraseña</label>
				                                	    <input type="password" class="form-control"required="required" name="password" id="password" />
				                    			  	</div>

				                    			  	<div class="form-group text-right">
				                                	    <input type="submit" class="btn btn-small btn-success" value="Iniciar Sesión" />
				                    			  	</div>

				                    			  	<div class="form-group text-right">
				                    			  		<a href="{{url('session/recoverpassword')}}">Olvidé mi contraseña</a>		
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
{% endblock %}