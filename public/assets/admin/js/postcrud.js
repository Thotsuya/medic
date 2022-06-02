$('#posts_table').DataTable({
    "responsive": true,
      "autoWidth": false,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      "order": [[ 0, "desc" ]]
})

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
  confirmButton: 'btn btn-success',
  cancelButton: 'btn btn-danger'
  },
  buttonsStyling: true
})



function deletePost(id){


  swalWithBootstrapButtons.fire({
    title: '¿Deseas eliminar este Post?',
    text: "No podrás revertir esta operación",
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

function restore(id){
  swalWithBootstrapButtons.fire({
      title: '¿Deseas restaurar esta publicación?',
      text: "Se habilitará nuevamente esta publicación",
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