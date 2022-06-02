$('#reservationdate').datetimepicker({
    format: 'YYYY-MM-DD HH:mm',
    icons: {
       
          time:'far fa-clock',      
          date:'fa fa-calendar',     
          up:'fa fa-chevron-up',    
          down:'fa fa-chevron-down',      
          previous:'fa fa-chevron-left',       
          next:'fa fa-chevron-right',        
          today:'fa fa-crosshairs',        
          clear:'fa fa-trash-o',       
          close:'fa fa-times'
        
    },
        
});


$(document).on('click','.verify',function(){
    var contact = $(this).attr('id');
    $.ajax({
        url: "/admin/contacts/find/" + contact,
        dataType: "json",
        success: function(response) {

            if(response.found){
                Swal.fire({
                    title: '¿Continuar?',
                    html: response.found,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Nuevo Paciente',
                    confirmButtonText: 'Agendar Cita'
                    }).then((result) => {  //Confirmar Solicitud
                        if (result.value) {
                            
                            $('#patient_id').val(response.patient.id);
                            $('#contact_id').val(response.contact.id);
                            $('#txtname').val(response.patient.name);
                            $('#txtphone').val(response.contact.phone);
                            $('#start_date').val(response.contact.date);

                            $("#newPatient").modal('show');


                        } else if (result.dismiss === Swal.DismissReason.cancel) {

                            $('#patient_id').val('');
                            $('#contact_id').val(response.contact.id);
                            $('#txtname').val(response.contact.name);
                            $('#txtphone').val(response.contact.phone);
                            $('#start_date').val(response.contact.date);

                            $("#newPatient").modal('show');
                        }
                    })
            }

            if(response.notFound){
                Swal.fire({
                    title: '¿Continuar?',
                    html: response.notFound,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Continuar'
                    }).then((result) => {  //Confirmar Solicitud
                        if (result.value) {

                            $('#contact_id').val(response.contact.id);
                            $('#txtname').val(response.contact.name);
                            $('#txtphone').val(response.contact.phone);
                            $('#start_date').val(response.contact.date);

                            $("#newPatient").modal('show');

                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire(
                            'Cancelado',
                            'La Operación ha sido cancelada',
                            'error'
                            )
                        }
                    })
            }
        },
        error: function(response) {
            Swal.fire(
                'Error',
                'Ocurrió un error al procesar esta solicitud',
                'error'
            )
        }
    })

})