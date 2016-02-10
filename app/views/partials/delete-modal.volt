<script type="text/javascript">
    $(document).on("click", "#show-delete-modal", function () {
        var myURL = $(this).data('id');
        $("#delete").attr('href', myURL );
    });
</script>

<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar {{resource_name}} </h4>
            </div>
            <div class="modal-body">
                <p>
                    ¿Estas seguro que deseas eliminar el <em><strong>{{resource_name}}</strong></em>? <br>
                    recuerda que si decides eliminarlo, no se podrán recuperar los datos
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-ban"></i></button>
                <a href="" id="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
