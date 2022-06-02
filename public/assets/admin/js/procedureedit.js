const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

$(document).on('click', '.edit', function() {
    var id = $(this).attr('id');
    $.ajax({
        url: "/admin/procedures/" + id + "/edit",
        dataType: "json",
        success: function(response) {
            $('#name_edit').val(response.data.name);
            $('#proc_id').val(response.data.id);
            $('#precio_edit').val(response.price);
            $('#editProc').modal('show')
        }
    })
})

$('#btnEditar').click(function() {
    $(this).attr('disabled',true)
    $(this).html('')
    $(this).html("Guardando...<div class='ml-1 spinner-border spinner-border-sm text-light' role='status'><span class='sr-only'>Loading...</span></div>")
    var ObjEvento = ObtenerEdicion("PUT");
    EditarProcedimiento('', ObjEvento);
    //console.log(ObjEvento);
});

function ObtenerEdicion(method) {
    ProcEdited = {
        id: $('#proc_id').val(),
        name: $('#name_edit').val(),
        precio: $('#precio_edit').val(),
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': method
    }
    return (ProcEdited);
}

function EditarProcedimiento(accion, objEvento) {


    var id = $('#proc_id').val()
    $.ajax({
        type: "PUT",
        url: "/admin/procedures/" + id,
        data: objEvento,
        success: function(data) {

            if (data.success) {
                $('#editProc').modal('toggle');
                t.ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: data.success
                })
            }
            $('#btnEditar').attr('disabled',false)
            $('#btnEditar').html('')
            $('#btnEditar').html('Guardar')

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

            $('#btnEditar').attr('disabled',false)
            $('#btnEditar').html('')
            $('#btnEditar').html('Guardar')

        }
    })





}
