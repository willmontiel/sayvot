{% extends "templates/default.volt" %}
{% block css %}
    {{ stylesheet_link('vendors/select2-4.0.1/css/select2.min.css') }}
{% endblock%}
{% block javascript %}
    {{ javascript_include('vendors/select2-4.0.1/js/select2.min.js') }}
    <script type="text/javascript">
        $(function(){
            $(".select2").select2();
            
            $(".idCountry").select2({
                ajax: {
                  url: "http://localhost/sayvot/accountplan/getplansbycountry/1",
                  dataType: 'json',
                  delay: 250,
                  data: function (params) {
                    return {
                      q: params.term, // search term
                      page: params.page
                    };
                  },
                  processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                      results: data.items,
                      pagination: {
                        more: (params.page * 30) < data.total_count
                      }
                    };
                  },
                  cache: true
                },
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                minimumInputLength: 1,
            });
        });
    </script>   
{% endblock%}
{% block title %}<i class="fa fa-instagram"></i> Cuentas {% endblock%}
{% block content %}
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
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
                    <label for="simbol">*Nombre de la cuenta</label>
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
                
                <div class="form-group">
                    <label for="idAccountplan">*Plan de pago</label>
                    {{ accountForm.render('idAccountplan')}}
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