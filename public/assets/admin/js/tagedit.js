//Editar con Ajax
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});


$(document).on('click', '.edit', function() {
    var id = $(this).attr('id');
    $.ajax({
        url: "/admin/tags/" + id + "/edit",
        dataType: "json",
        success: function(response) {
            $('#name_edit').val(response.data.name);
            $('#id_tag').val(response.data.id);
            $('#editTag').modal('show')
        },
        error: function(response){
            Toast.fire({
                icon: 'error',
                title: 'Ocurrió un error al procesar la solicitud'
            })
        }
    })
})



$('#btnEditar').click(function() {
    var ObjEvento = ObtenerEdicion("PUT");
    EditarEtiqueta('', ObjEvento);
});

function ObtenerEdicion(method) {
    etiquetaEdit = {

        id: $('#id_tag').val(),
        name: $('#name_edit').val(),
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': method
    }
    return (etiquetaEdit);
}

function EditarEtiqueta(accion, objEvento) {

    

    var id =  $('#id_tag').val()
    
    $.ajax({
        type: "PUT",
        url: "/admin/tags/" + id,
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

                $('#editTag').modal('toggle');
                Toast.fire({
                    icon: 'success',
                    title: 'La etiqueta se modificó correctamente'
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