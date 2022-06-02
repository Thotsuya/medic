$(function () {
    $("#users_table").DataTable({
      "responsive": true,
      "autoWidth": false,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      }
    });
});

function RestaurarUsuario(id){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
    
      swalWithBootstrapButtons.fire({
          title: '¿Deseas Restaurar este usuario?',
          text: "El usuario volverá a ser dado de alta",
          icon: 'info',
          showCancelButton: true,
          confirmButtonText: 'Restaurar',
          cancelButtonText: 'Cancelar!',
          reverseButtons: true
      }).then((result) => {
          if (result.value) {
                event.preventDefault();
                document.getElementById('restore-form-'+id).submit()
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'La operación ha sido cancelada',
              'error'
            )
          }
      })
}

function EliminarUsuario(id){

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: true
    })
  
    swalWithBootstrapButtons.fire({
        title: '¿Deseas eliminar el Usuario?',
        text: "El usuario será dado de baja",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
              event.preventDefault();
              document.getElementById('delete-form-'+id).submit()
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'La operación ha sido cancelada',
            'error'
          )
        }
    })
  
  
}