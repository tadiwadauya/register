<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/24/2020
 * Time: 4:35 PM
 */
?>
@extends('layouts.app')

@section('template_title')
    Backup Sheets
@endsection

@section('head')

    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\data-table\css\buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\data-table\extensions\select\css\select.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\data-table\extensions\buttons\css\buttons.dataTables.min.css')}}">

@endsection

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Backup Sheets</h4>
                        <span>Computer backup sheets for computers on LAN network</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/backups')}}">Computer Backup</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
        <div class="card">
            <div class="card-header">
                <h5>Maintenance Logs</h5>
                <div class="card-header-right">

                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="vince-tables" class="table table-striped cell-border" style="width:100%">
                        <thead class="thead">
                        <tr>
                            <th>Department</th>
                            <th>IP Address</th>
                            <th>Username</th>
                            <th>User</th>
                            <th>Signature</th>
                            <th>Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($backups as $backup)
                            <tr>
                                <td>{{$backup->department}}</td>
                                <td>{{$backup->ip_address}}</td>
                                <td>{{$backup->first_name}} {{$backup->last_name}}</td>
                                <td></td>
                                <td>{{$backup->user_sign}}</td>
                                <td>{{$backup->comment}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    <!-- data-table js -->
    <script src="{{asset('bower_components\datatables.net\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\js\jszip.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\js\pdfmake.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\js\vfs_fonts.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\extensions\buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\extensions\buttons\js\buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\extensions\buttons\js\jszip.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\extensions\buttons\js\vfs_fonts.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\extensions\buttons\js\buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\extensions\select\js\dataTables.select.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-responsive\js\dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}"></script>
    <script>
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
    "customize": function (xlsx) {
    var sheet = xlsx.xl.worksheets['sheet1.xml'];
    var numrows = 3;
    var clR = $('row', sheet);

    //update Row
    clR.each(function () {
    var attr = $(this).attr('r');
    var ind = parseInt(attr);
    ind = ind + numrows;
    $(this).attr("r",ind);
    });

    // Create row before data
    $('row c ', sheet).each(function () {
    var attr = $(this).attr('r');
    var pre = attr.substring(0, 1);
    var ind = parseInt(attr.substring(1, attr.length));
    ind = ind + numrows;
    $(this).attr("r", pre + ind);
    });

    function Addrow(index,data) {
    msg='<row r="'+index+'">'
        for(i=0;i<data.length;i++){
        var key=data[i].key;
        var value=data[i].value;
        msg += '<c t="inlineStr" r="' + key + index + '">';
            msg += '<is>';
                msg +=  '<t>'+value+'</t>';
                msg+=  '</is>';
            msg+='</c>';
        }
        msg += '</row>';
    return msg;
    }
        var today = new Date();
        var date = today.getDate() +'-'+(today.getMonth()+1)+'-'+ today.getFullYear();

    //insert
    var r1 = Addrow(1, [{ key: 'A', value: 'Backup' }, { key: 'B', value: '' }]);
    var r2 = Addrow(2, [{ key: 'A', value: 'Date' }, { key: 'B', value: date }]);
    var r3 = Addrow(3, [{ key: 'A', value: 'IT Department' }, { key: 'B', value: '......................................' }]);

    sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2+ r3+ sheet.childNodes[0].childNodes[1].innerHTML;
    },
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
    </script>


    <script src="{{asset('assets\pages\data-table\extensions\buttons\js\extension-btns-custom.js')}}"></script>
@endsection


