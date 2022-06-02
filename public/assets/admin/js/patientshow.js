$(function(){
    $('#birthdate').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#appointment_date').datetimepicker({
      format: 'YYYY-MM-DD hh:mm A',
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
})

  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
      alwaysShowClose: true
    });
  });

  $('.textarea').summernote()

  $('.select2').select2({
    width: '100%'
  })


$('#btnAgregar').click(function(){
    var ObjEvento=recolectarDatos("POST");
    enviarInformacion('',ObjEvento);
});

function recolectarDatos(method){
  nuevoEvento={
      patient_id:$('#patient_uuid').val(),
      descripcion:$('#descripcion').val(),
      non_registered: $('#checkPatient').is(':checked'),
      color:$('#color').val(),
      textcolor:'#FFFFFF',
      start:$('#start_date').val(),
      end:$('#start_date').val(),
      '_token':$("meta[name='csrf-token']").attr("content"),
      '_method':method
  }
  return (nuevoEvento);
}

function enviarInformacion(accion,objEvento){

  var Toast = Swal.mixin({
       toast: true,
       position: 'top-end',
       showConfirmButton: false,
       timer: 3000
  });

     $.ajax({
         type:"POST",
         url:"/admin/citas",
         data:objEvento,

         success:function(data){

          if (data.errors) {
               for (var count = 0; count < data.errors.length; count++) {
                   Toast.fire({
                       icon: 'error',
                       title: data.errors[count]
                   })
               }
          }

          if(data.invalidated){
              Toast.fire({
                  icon: 'error',
                  title: data.invalidated
              })
          }

           if(data.success){

              var isShown = $('#newAppointment').hasClass('show');
              if (isShown) {
                  $('#newAppointment').modal('toggle');
              }

              t.ajax.reload();

             Toast.fire({
                icon: 'success',
                title: data.success
             })

           }


         },
         error:function(){
              Toast.fire({
                  icon: 'error',
                  title: 'Ocurrió un error al procesar esta solicitud'
              })
         }
     })
}