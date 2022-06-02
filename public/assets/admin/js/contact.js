var t = $("#contacts_table").DataTable({
    "processing": true,
    "serverSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "ajax": {
        "url": "/admin/contacts"
    },
    "columns": [
        { "data": "id" },
        { "data": "name" },
        { "data": "phone" },
        { "data": "email" },
        { "data": "date" },
        { "data": "action" }
    ],
    "columnDefs": [
        {
            "targets": 0,
            "className": "text-center",
            "width": "10%"
        },
        {
            "targets": [2,4],
            "className": "text-center",
            "width": "20%"
        },
        {
            "targets": [5],
            "className": "text-center",
            "width": "10%"
        }
    ],
    "responsive": true,
    "autoWidth": false,
    "order": [[ 0, "desc" ]]
});