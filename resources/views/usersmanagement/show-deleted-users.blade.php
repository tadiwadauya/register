@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.showing-all-users') !!}
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
                        <h4>Deleted Users</h4>
                        <span>System Users</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/users/deleted')}}">Deleted Users</a>
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
                {{--<h5>Multi Item Selection</h5>
                <span>The select.style option provides the ability to control how items are selected in the table</span>--}}
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                        <li></li>
                    </ul>

                </div>

                <div class="card-header-left">
                    <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" >
                        <i class="feather icon-chevrons-left"></i>
                        Back to Users
                    </a>

                </div>
            </div>
            <div class="card-block">
                @if(count($users) === 0)

                    <tr>
                        <p class="text-center margin-half">
                            No deleted user records found.
                        </p>
                    </tr>

                @else

                <div class="dt-responsive table-responsive">
                    <table id="vince-tables" class="table table-striped table-bordered nowrap" >
                        <thead class="thead">
                        <tr>
                            <th>Paynumber</th>
                            <th>{!! trans('usersmanagement.users-table.name') !!}</th>
                            <th class="hidden-xs">{!! trans('usersmanagement.users-table.email') !!}</th>
                            <th class="hidden-xs">{!! trans('usersmanagement.users-table.fname') !!}</th>
                            <th class="hidden-xs">{!! trans('usersmanagement.users-table.lname') !!}</th>
                            <th>{!! trans('usersmanagement.users-table.role') !!}</th>
                            <th class="hidden-sm hidden-xs hidden-md">Department</th>
                            <th class="hidden-sm hidden-xs hidden-md">Mobile</th>
                            <th class="no-search no-sort notexport">{!! trans('usersmanagement.users-table.actions') !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->paynumber}}</td>
                                <td>{{$user->name}}</td>
                                <td class="hidden-xs"><a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a></td>
                                <td class="hidden-xs">{{$user->first_name}}</td>
                                <td class="hidden-xs">{{$user->last_name}}</td>
                                <td>
                                    @foreach ($user->roles as $user_role)
                                        @if ($user_role->name == 'User')
                                            @php $badgeClass = 'primary' @endphp
                                        @elseif ($user_role->name == 'Admin')
                                            @php $badgeClass = 'warning' @endphp
                                        @elseif ($user_role->name == 'Unverified')
                                            @php $badgeClass = 'danger' @endphp
                                        @else
                                            @php $badgeClass = 'default' @endphp
                                        @endif
                                        <span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="hidden-sm hidden-xs hidden-md">{{$user->department}}</td>
                                <td class="hidden-sm hidden-xs hidden-md">{{$user->mobile}}</td>
                                <td style="white-space: nowrap;">
                                    {!! Form::model($user, array('action' => array('SoftDeletesController@update', $user->id), 'method' => 'PUT')) !!}
                                    {!! Form::button('<i class="feather icon-refresh-cw"></i>', array('class' => 'btn btn-success btn-round btn-mini', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore User')) !!}
                                    {!! Form::close() !!}

                                    <a class="btn btn-mini btn-info btn-round" href="{{ URL::to('users/deleted/' . $user->id) }}" >
                                        <i class="feather icon-eye"></i>
                                    </a>

                                    {!! Form::model($user, array('action' => array('SoftDeletesController@destroy', $user->id), 'method' => 'DELETE', 'class' => 'inline')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button('<i class="feather icon-user-x"></i>', array('class' => 'btn btn-danger btn-mini inline','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                @endif
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
    <script src="{{asset('assets\pages\data-table\extensions\select\js\select-custom.js')}}"></script>

    <script src="{{asset('assets\pages\data-table\extensions\buttons\js\extension-btns-custom.js')}}"></script>
@endsection
