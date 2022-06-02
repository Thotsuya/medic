$(document).on('click','.restore',function(){
    var id = $(this).attr('id');
    Procedimiento = {
        id: id,
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': "PUT"
    }

    var swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })

    swalWithBootstrapButtons.fire({
        title: '¿Deseas Restaurar este Procedimiento?',
        text: "No podrás revertir esta operación",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Continuar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {

            $.ajax({
                type: "PUT",
                url: "/admin/procedures/restore/" + id,
                data: Procedimiento,
                success: function(data) {
                    
                    if(data.success){
                        t.ajax.reload();
                        swalWithBootstrapButtons.fire(
                            'Restaurado!',
                            'El procedimiento ha sido restaurado',
                            'success'
                        )
                    }

                    if(data.invalidated){
                        swalWithBootstrapButtons.fire(
                            'Error',
                            data.invalidated,
                            'error'
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