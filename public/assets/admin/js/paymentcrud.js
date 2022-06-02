const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
  })
  
  function eliminar(id){
      swalWithBootstrapButtons.fire({
        title: '¿Deseas anular este pago?',
        text: "Este pago procederá a ser anulado de este tratamiento",
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