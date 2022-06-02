$('#btnGuardar').click(function() {
    $(this).attr('disabled',true)
    $(this).html('')
    $(this).html("Guardando...<div class='ml-1 spinner-border spinner-border-sm text-light' role='status'><span class='sr-only'>Loading...</span></div>")

    var ObjEvento = recolectarDatos("POST");
    enviarInformacion('', ObjEvento);
});

function recolectarDatos(method) {
    nuevoProc = {
        name: $('#name').val(),
        precio: $('#precio').val(),
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': method
    }
    return (nuevoProc);
}

function enviarInformacion(accion, objEvento) {

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });


    $.ajax({
        type: "POST",
        url: "/admin/procedures",
        dataType: 'json',
        data: objEvento,
        success: function(data) {


            if (data.success) {
                t.ajax.reload();
                $('#newProc').modal('toggle');

                $('#btnGuardar').attr('disabled',false)
                $('#btnGuardar').html('')
                $('#btnGuardar').html('Guardar')

                Toast.fire({
                    icon: 'success',
                    title: 'El procedimiento se añadió correctamente'
                })
            }

        },
        error: function(err) {

            if(err.status == 422){
                $.each(err.responseJSON.errors, function(i,error){
                    Toast.fire({
                        icon: 'error',
                        title: error[0]
                    })
                })
            }
            else{
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrió un error al procesar la solicitud'
                })
            }

            $('#btnGuardar').attr('disabled',false)
            $('#btnGuardar').html('')
            $('#btnGuardar').html('Guardar')
        }
    })


}
