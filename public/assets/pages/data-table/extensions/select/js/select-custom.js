$(document).ready(function() {
    $('#single-select').DataTable({
        select: true
    });
    $('#multi-select').DataTable({
        select: {
            style: 'multi'
        }
    });

    $('#vince-tables').DataTable({
        select: {
            style: 'single'
        },
        processing: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        aLengthMenu: [[10, 25, 50, 100, -1], [ 10, 25, 50, 100, "All"]],
        dom: 'Bfrtip',
        aoColumnDefs: [{
            'bSortable': false,
            'searchable': false,
            'aTargets': ['no-search'],
            'bTargets': ['no-sort']
        }],
        buttons: [{
            "extend":   'pageLength',
            "exportOptions": {
                columns: ':not(.notexport)'
            }
        },
            {
                "extend":   'copy',
                "exportOptions": {
                    columns: ':not(.notexport)'
                }
            },
            {
                "extend":   'csv',
                "exportOptions": {
                    columns: ':not(.notexport)'
                }
            },
            {
                "extend":   'excel',
                "exportOptions": {
                    columns: ':not(.notexport)'
                }
            },
            {
                "extend":   'pdf',
                "exportOptions": {
                    columns: ':not(.notexport)'
                }
            },
            {
                "extend":   'print',
                "exportOptions": {
                    columns: ':not(.notexport)'
                }
            }
        ]

    });

    $('#cell-select').DataTable({
        select: {
            style: 'os',
            items: 'cell'
        }
    });
    $('#checkbox-select').DataTable({
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        order: [
            [1, 'asc']
        ]
    });
    var table = $('#button-select').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'selected',
            'selectedSingle',
            'selectAll',
            'selectNone',
            'selectRows',
            'selectColumns',
            'selectCells'
        ],
        select: true
    });
});
