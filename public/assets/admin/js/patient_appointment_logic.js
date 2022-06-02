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
        title: '¿Marcar esta cita como cancelada?',
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
                url: "/admin/citas/" + proc_id,
                data: Procedimiento,
                success: function(data) {
                    if(data.success){
                        t.ajax.reload();
                        swalWithBootstrapButtons.fire(
                            'Cancelada!',
                            'La cita se ha marcado como cancelada',
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


//Eliminar con Ajax
$(document).on('click', '.complete', function() {
    appointment = $(this).attr('id');
    Procedimiento = {
        id: appointment,
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': "PUT"
    }


    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })

    swalWithBootstrapButtons.fire({
        title: '¿Marcar esta cita como Realizada?',
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
                url: "/admin/citas/" + appointment,
                data: Procedimiento,
                success: function(data) {
                    if(data.success){
                        t.ajax.reload();
                        swalWithBootstrapButtons.fire(
                            'Realizada!',
                            'La cita se ha marcado como realizada',
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