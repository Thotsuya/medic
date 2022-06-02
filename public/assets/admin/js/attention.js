$("#attention_table").DataTable({
    "responsive": true,
    "autoWidth": false,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      "order": [[ 0, "desc" ]]
});

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
  },
  buttonsStyling: true
})

function eliminar(id){
    swalWithBootstrapButtons.fire({
      title: '¿Deseas anular este plan de tratamiento?',
      text: "El plan de tratamiento pasará a estado: Anulado",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Anular',
      cancelButtonText: 'Cancelar',
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
        'La operaciòn ha sido cancelada',
        'info'
    )}

    })
}

function restore(id){
    swalWithBootstrapButtons.fire({
        title: '¿Deseas restaurar este plan de tratamiento?',
        text: "Se habilitará nuevamente este plan de tratamiento",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Restaurar',
        cancelButtonText: 'Cancelar',
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
          'La operaciòn ha sido cancelada',
          'info'
      )}
  
      })
}