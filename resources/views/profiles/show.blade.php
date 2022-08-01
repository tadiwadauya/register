@extends('layouts.app')

@section('template_title')
        {{$user->name}}'s Profile
@endsection

@section('head')
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\data-table\css\buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\data-table\extensions\select\css\select.dataTables.min.css')}}">

@endsection

@section('template_linked_css')
    <style>
        div.dataTables_wrapper {
            margin-bottom: 3em;
        }
    </style>

    @endsection
@php
    $currentUser = Auth::user()
@endphp

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Users</h4>
                        <span>User Profile</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/users/'.$user->name)}}">My Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="page-body">
        <!--profile cover start-->
        <div class="row">
            <div class="col-lg-12">
                <div class="cover-profile">
                    <div class="profile-bg-img">
                        <img class="profile-bg-img img-fluid" src="{{asset('assets\images\user-profile\bg.png')}}" alt="bg-img">
                        <div class="card-block user-info">
                            <div class="col-md-12">
                                <div class="media-left">
                                    @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                        <img src="{{ $user->profile->avatar }}" alt="{{ $user->name }}" class="user-img img-radius">
                                    @else
                                        <div class="user-avatar-nav"></div>
                                    @endif
                                </div>
                                <div class="media-body row">
                                    <div class="col-lg-12">
                                        <div class="user-title">
                                            <div class="well well-lg">
                                                <h2>{{$user->first_name}} {{$user->last_name}}</h2>
                                                <span >{{$user->department}}</span><br>
                                                <span >{{$user->position}}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div>
                                        <div class="pull-right cover-btn">
                                           </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--profile cover end-->
        <div class="row">
            <div class="col-lg-12">
                <!-- tab header start -->
                <div class="tab-header card">
                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">User Info</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#assets" role="tab">User Assets</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#compliance" role="tab">Maintenance Records</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                </div>
                <!-- tab header end -->
                <!-- tab content start -->
                <div class="tab-content">
                    <!-- tab panel personal start -->
                    <div class="tab-pane active" id="personal" role="tabpanel" >
                        <!-- personal card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">About {{$user->first_name}}</h5>

                            </div>
                            <div class="card-block">
                                <div class="view-info">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="general-info">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xl-6">
                                                        <div class="table-responsive">
                                                            <table class="table m-0">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">Full Name</th>
                                                                    <td>{{$user->first_name}} {{$user->last_name}} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Paynumber</th>
                                                                    <td>{{$user->paynumber}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Department</th>
                                                                    <td>{{$user->department}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Position</th>
                                                                    <td>{{$user->position}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Mobile</th>
                                                                    <td>{{$user->mobile}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- end of table col-lg-6 -->
                                                    <div class="col-lg-12 col-xl-6">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">Email</th>
                                                                    <td><a href="mailto:{{$user->email}}"><span class="__cf_email__">{{$user->email}}</span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Location</th>
                                                                    <td>{{$user->location}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">IP Address</th>
                                                                    <td>{{$user->ip_address}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">On Backup</th>
                                                                    <td>@if($user->backable)Yes @else No @endif</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Password Changed</th>
                                                                    <td>@if($user->backable)Yes on {{$user->pwd_last_changed}} @else No @endif</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- end of table col-lg-6 -->
                                                </div>
                                                <!-- end of row -->
                                            </div>
                                            <!-- end of general info -->
                                        </div>
                                        <!-- end of col-lg-12 -->
                                    </div>
                                    <!-- end of row -->
                                </div>

                            </div>
                            <!-- end of card-block -->
                        </div>
                    </div>
                    <!-- tab pane personal end -->
                    <!-- tab pane info start -->
                    <div class="tab-pane" id="assets" role="tabpanel" >
                        <!-- info card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">{{$user->name}}'s Assets</h5>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="vince-tables" class="table table-striped table-bordered nowrap" >
                                        <thead class="thead">
                                        <tr>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Asset Tag</th>
                                            <th>Serial</th>
                                            <th>Age</th>
                                            <th class="no-search no-sort notexport">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($assets as $asset)
                                            <tr>
                                                <td>{{$asset->model}}</td>
                                                <td>{{$asset->type }}</td>
                                                <td>{{$asset->assettag}}</td>
                                                <td>{{$asset->serial}}</td>
                                                <td>{{$asset->age}}</td>
                                                <td style="white-space: nowrap;">
                                                    <a class="btn btn-success btn-mini" href="{{ URL::to('iassets/' . $asset->id) }}" >
                                                        <i class="feather icon-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- info card end -->
                    </div>
                    <!-- tab pane info end -->
                    <!-- tab pane contact start -->
                    <div class="tab-pane" id="compliance" role="tabpanel" >
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- contact data table card start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-header-text">Maintenance Records</h5>
                                            </div>
                                            <div class="card-block">
                                                <div class="dt-responsive table-responsive">
                                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th>IP Address</th>
                                                            <th>Completed Maintenance</th>
                                                            <th>Monitor</th>
                                                            <th>CPU</th>
                                                            <th>Keyboard</th>
                                                            <th>Mouse</th>
                                                            <th>Desk</th>
                                                            <th>Done On</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($logs as $log)
                                                            <tr>
                                                                <td>{{$log->ip_address}}</td>
                                                                <td>@if($log->all_five) Yes @else No @endif</td>
                                                                <td>@if($log->monitor) Yes @else No @endif</td>
                                                                <td>@if($log->cpu) Yes @else No @endif</td>
                                                                <td>@if($log->keyboard) Yes @else No @endif</td>
                                                                <td>@if($log->mouse) Yes @else No @endif</td>
                                                                <td>@if($log->desk) Yes @else No @endif</td>
                                                                <td>{{$log->created_at}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>IP Address</th>
                                                            <th>Completed Maintenance</th>
                                                            <th>Monitor</th>
                                                            <th>CPU</th>
                                                            <th>Keyboard</th>
                                                            <th>Mouse</th>
                                                            <th>Desk</th>
                                                            <th>Done On</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- contact data table card end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab pane contact end -->
                </div>
                <!-- tab content end -->
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
    <script src="{{asset('assets\pages\data-table\extensions\select\js\dataTables.select.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-responsive\js\dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\extensions\select\js\select-custom.js')}}"></script>
    <script>$('#simpletable').DataTable();</script>
@endsection
