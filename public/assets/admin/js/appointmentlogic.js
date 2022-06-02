var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
  customButtons: {
    myCustomButton: {
    bootstrapFontAwesome : 'fas fa-calendar-plus',
    text: 'Nueva Cita',
      click: function() {
        $('#newAppointment').modal('show');
      }
    }
  },

  plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
  locale:'es',
  header    : {
    left  : 'prev,next today myCustomButton',
    center: 'title',
    right : 'dayGridMonth,timeGridWeek,timeGridDay'
  },

  themeSystem: 'bootstrap',
  events: '/admin/citas/getappointments',
  eventTimeFormat: { // like '14:30:00'
          hour: '2-digit',
          minute: '2-digit',
          hour12: true
  },
  eventClick:function(info){
    //Para la fecha y hora de cita
    const months = ["Enero", "Febrero", "Marzo","Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    let current_datetime = info.event.start
    let formatted_date = current_datetime.getDate() + " de " + months[current_datetime.getMonth()] + " de " + current_datetime.getFullYear()
    document.getElementById('txtPacienteInfo').innerHTML = info.event.title;
    document.getElementById('txtFechaCitaInfo').innerHTML = formatted_date;
    document.getElementById('txtHoraCitaInfo').innerHTML = formatAMPM(current_datetime);
    document.getElementById('txtDescripcionInfo').innerHTML = info.event._def.extendedProps.description;
    document.getElementById('txtDoctorInfo').innerHTML = info.event._def.extendedProps.doctor.name;
    $('.delete').attr('id',info.event.id)

    //txtDoctorInfo
    $('#infoEvent').modal();
  },
  dateClick:function(info){
    let new_current_datetime = new Date()
    let current_datetime = info.date
    let formatted_date = current_datetime.getFullYear() + "-" + appendLeadingZeroes(current_datetime.getMonth() + 1) + "-" + appendLeadingZeroes(current_datetime.getDate()) + " " + appendLeadingZeroes(new_current_datetime.getHours()) + ":" + appendLeadingZeroes(new_current_datetime.getMinutes())
    //start_date
    $('#start_date').val(formatted_date);
    $('#newAppointment').modal();
  },

});

calendar.render();


function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
  }

function appendLeadingZeroes(n){
  if(n <= 9){
      return "0" + n;
  }
  return n
}