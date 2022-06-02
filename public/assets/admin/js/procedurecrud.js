var t = $("#procedimientos_table").DataTable({
    "processing": true,
    "serverSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "ajax": {
        "url": "/admin/procedures"
    },
    "columns": [
        { "data": "id" },
        { "data": "name" },
        { "data": "formatted_price" },
        { "data": "action" }
    ],
    "columnDefs": [
        {
            "targets": 0,
            "className": "text-center",
            "width": "10%"
        },
        {
            "targets": 2,
            "className": "text-center",
            "width": "20%"
        },
        {
            "targets": 3,
            "className": "text-center",
            "width": "10%"
        }
    ],
    "responsive": true,
    "autoWidth": false,
});