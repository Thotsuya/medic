$(function () {
    $("#patients_table").DataTable({
      "responsive": true,
      "autoWidth": false,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      "order": [[ 0, "desc" ]]
    });
  });

function eliminar(id){

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
  },
  buttonsStyling: true
})

swalWithBootstrapButtons.fire({
      title: '¿Deseas dar de baja a este paciente?',
      text: "El paciente pasará a estado inactivo",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Dar de Baja',
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


function activar(id){

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
  },
  buttonsStyling: true
})

swalWithBootstrapButtons.fire({
      title: '¿Deseas habilitar al paciente?',
      text: "El paciente pasará a estado: Activo",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Habilitar',
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


