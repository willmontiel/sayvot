{% extends "templates/default-clear.volt" %}
{% block css %}
  {# Chosen #}
  {{ stylesheet_link('vendors/x-bootstrap-wizard-v1.1/assets/css/gsdk-base.css') }}
{% endblock%}
{% block javascript %}{% endblock%}
{% block content %}
  <div class="image-container set-full-height">
    <div class="container-fluid fill">
      <div class="row fill">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="wizard-container text-center">
                  <h1 class="page-header">
                    404
                  </h1>
                  
                  <img src="{{url('')}}/images/general/sad-meme.png" width="250"/>
                  
                  <h3>
                    Oh no!, La página que estabas buscando se ha perdido :(
                  </h3>
                  
                  <h4>
                    <a href="{{url('')}}">
                      <img src="{{url('')}}images/sayvot-logo.png" width="100">
                    </a>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
{% endblock %}