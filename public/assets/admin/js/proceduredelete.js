//Eliminar con Ajax
$(document).on('click', '.delete', function() {
    proc_id = $(this).attr('id');
    Procedimiento = {
        id: proc_id,
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': "DELETE"
    }


    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })

    swalWithBootstrapButtons.fire({
        title: '¿Deseas Eliminar este Procedimiento?',
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
                url: "/admin/procedures/" + proc_id,
                data: Procedimiento,
                success: function(data) {
                    if(data.success){
                        t.ajax.reload();
                        swalWithBootstrapButtons.fire(
                            'Eliminado!',
                            'El procedimiento ha sido eliminado',
                            'success'
                        )
                    }

                    if(data.invalidated){

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