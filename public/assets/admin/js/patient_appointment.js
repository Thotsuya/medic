var patient = $('#patient_id').val();

$('#attentions_table').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "responsive": true,
    "autoWidth": false,
    "order": [[ 0, "desc" ]]
})

$('#payments_table').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "responsive": true,
    "autoWidth": false,
    "order": [[ 0, "desc" ]]
})

var t = $('#appointments_table').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "ajax": {
        "url": "/admin/patients/appointments/" + patient
    },
    "columns": [
        { "data": "id" },
        { "data": "doctor.name" },
        { "data": "description" },
        { "data": "date" },
        { "data": "time" },
        { "data": "status_badge" },
        { "data": "action" }
    ],
    "columnDefs": [
        {
            "targets": [0,1,3,4,5],
            "className": "text-center",
        },
        {
            "targets": 6,
            "className": "text-center",
            "width": "10%"
        }
    ],
    "order": [[ 0, "desc" ]]
});

$(document).on('click', '[data-toggle="pill"]', function(event) {
    $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
  //$(".table").DataTable().responsive.recalc();
});
