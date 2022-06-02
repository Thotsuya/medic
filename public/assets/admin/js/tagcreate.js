$('#btnGuardar').click(function() {
    var ObjEvento = recolectarDatos("POST");
    enviarInformacion('', ObjEvento);
});

function recolectarDatos(method) {
    nuevaEtiqueta = {
        name: $('#name').val(),
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': method
    }
    return (nuevaEtiqueta);
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
        url: "/admin/tags" + '',
        data: objEvento,
        success: function(data) {

            if (data.errors) {
                for (var count = 0; count < data.errors.length; count++) {
                    Toast.fire({
                        icon: 'error',
                        title: data.errors[count]
                    })
                }
            }

            if(data.invalidated){
                Toast.fire({
                    icon: 'error',
                    title: data.invalidated
                })
            }
            
            if(data.success){
                t.ajax.reload();

                $('#newTag').modal('toggle');
                Toast.fire({
                    icon: 'success',
                    title: 'La etiqueta se añadió correctamente'
                })
            }
        },
        error: function() {
            Toast.fire({
                icon: 'error',
                title: 'Ocurrió un error al procesar la solicitud'
            })
        }
    })



}