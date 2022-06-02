  //Initialize Select2 Elements
  $(function(){
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
            })
    
            $('#reservationdate').datetimepicker({
                format: 'L'
            });
  })
  
  
  $("#nombre").on('change keydown paste input', function(value){
    document.getElementById('paciente_nombre').innerHTML = $('#nombre').val();
  });


  $("#cedula").on('change keydown paste input', function(value){
    document.getElementById('txtcedula').innerHTML = $('#cedula').val();
  });

  $("#telefono").on('change keydown paste input', function(value){
    document.getElementById('txttelefono').innerHTML = $('#telefono').val();
  });

  $("#fecha_nacimiento").on('change keydown paste input', function(value){
    document.getElementById('txtfechanac').innerHTML = $('#fecha_nacimiento').val();
  });

  $('.select2').select2({
    dropdownParent: $('#exampleModal'),
    width: '100%'
})

    