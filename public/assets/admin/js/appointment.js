$('.select2').select2({
    dropdownParent: $('#newAppointment'),
    width: '100%'
})

$('.select2bx').select2({

})

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
})

$('#reservationdate').datetimepicker({
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

$('#reservationdate1').datetimepicker({
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