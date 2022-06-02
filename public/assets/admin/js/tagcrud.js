   var t = $("#tags_table").DataTable({
        "processing": true,
        "serverSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "ajax": {
            "url": "/admin/tags"
        },
        "order": [[ 0, "desc" ]],
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "date" },
            { "data": "action" }
        ],
        "columnDefs": [
            {
                "targets": 2,
                "className": "text-center",
                "width": "20%"
            },
            {
                "targets": [0,3],
                "className": "text-center",
                "width": "10%"
            }
        ],
        "responsive": true,
        "autoWidth": false,
    });
