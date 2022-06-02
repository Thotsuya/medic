//Eliminar con Ajax
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
})

$(document).on('click', '.delete', function() {
    tag_id = $(this).attr('id');
    Fila = {
        id: tag_id,
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': "DELETE"
    }
   
    swalWithBootstrapButtons.fire({
        title: '¿Deseas Eliminar esta etiqueta?',
        text: "No podrás revertir esta operación",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Continuar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {

            $.ajax({
                type: "DELETE",
                url: "/admin/tags/" + tag_id,
                data: Fila,
                success: function(data) {

                    if(data.errors){
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
                        swalWithBootstrapButtons.fire(
                            'Eliminada!',
                            'La etiqueta ha sido eliminada',
                            'success'
                        )
                    }



                },
                error: function() {
                    swalWithBootstrapButtons.fire(
                        'Error',
                        'Ocurrió un error al realizar esta operación',
                        'error'
                    )
                }
            })

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                'Se ha cancelado la operación',
                'error'
            )
        }
    })


})