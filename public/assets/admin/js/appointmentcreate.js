$('#btnAgregar').click(function(){
    var ObjEvento=recolectarDatos("POST");
    enviarInformacion('',ObjEvento);
});

$('#btnAñadir').click(function(){
    var ObjEvento=recolectarData("POST");
    enviarInformacion('',ObjEvento);
});

function recolectarData(method){
    nuevoEvento={
        patient_id:$('#id_patient').val(),
        non_registered: $('#checkPatient').is(':checked'),
        patient_name: $('#patient_name').val(),
        descripcion:$('#descripcion1').val(),
        color:$('#color1').val(),
        textcolor:'#FFFFFF',
        start:$('#start_date1').val(),
        end:$('#start_date1').val(),
        '_token':$("meta[name='csrf-token']").attr("content"),
        '_method':method
    }
    return (nuevoEvento);
}

function recolectarDatos(method){
    nuevoEvento={
        patient_id:$('#patient_id').val(),
        descripcion:$('#descripcion').val(),
        color:$('#color').val(),
        textcolor:'#FFFFFF',
        start:$('#start_date').val(),
        end:$('#start_date').val(),
        '_token':$("meta[name='csrf-token']").attr("content"),
        '_method':method
    }
    return (nuevoEvento);
}

//New feature
//As requested by cx, he wants to be able to create an appointment for non-registered patients
//We use a checkbox in the frontend to check if there's a patient in the registry or not
$('#checkPatient').on('change',function(event){
    if (event.currentTarget.checked) {
        $("#id_patient").prop("disabled", true);
        $("#non_registered_patient").show();
    } else {
        $("#id_patient").prop("disabled", false);
        $("#non_registered_patient").hide();
    }
})

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

                //console.log(data);
                var isShown = $('#newAppointment').hasClass('show');
                if (isShown) {
                        $('#newAppointment').modal('toggle');
                }

               Toast.fire({
                  icon: 'success',
                  title: data.success
               })
               calendar.refetchEvents();

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


