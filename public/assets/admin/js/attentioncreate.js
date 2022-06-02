const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
})

$('#observaciones').summernote()

$('.select2').select2({
    width: '100%'
})

var t = $('#attention_table').DataTable({
    "paging": true,
    "retrieve": true,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": false,
    "responsive": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "columnDefs": [
        {
            "targets": 3,
            "className": "text-center",
        }
    ],
    "pageLength": 5
});

function agregar(id,nombre){
    console.log(id)
    console.log(nombre)
    t.row.add([
        '<input type="hidden" name="procedimientos[]" value="'+id+'">'+nombre,
        '<input type="number" name="cantidad[]" class="form-control" value="1" required>',
        '<input type="number" name="descuento[]" max="100" class="form-control" value="0" required><input type="hidden" name="prices[]">',
        '<button type="button" class="delete btn btn-danger"><i class="fas fa-times"></i></button>'
    ]).draw( false );
    Toast.fire({
        icon: 'success',
        title: 'Procedimiento / Servicio añadido'
    })
}

$(document).on('click', '.delete', function() {
    var row = $(this).parents('tr');

    if ($(row).hasClass('child')) {
        t.row($(row).prev('tr')).remove().draw();
    }else{
        t
        .row($(this).parents('tr'))
        .remove()
        .draw();
    }
});

$('.guardar').on('click',function(event){

    event.preventDefault()
    swalWithBootstrapButtons.fire({
        title: '¿Deseas guardar este plan de tratamiento?',
        text: "Asegurate de que toda la información sea correcta",
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Continuar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#atencionform').submit();
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



