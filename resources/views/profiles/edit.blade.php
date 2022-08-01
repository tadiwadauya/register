@extends('layouts.app')

@section('template_title')
    {{$user->name}}'s profile
@endsection

@section('head')
@endsection

@section('template_linked_css')

    <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{asset('bower_components\datedropper\css\datedropper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\j-pro\css\demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\j-pro\css\font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\j-pro\css\j-pro-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\j-pro\css\j-forms.css')}}">

@endsection

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Users</h4>
                        <span>Edit User Info</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/users')}}">Users</a></li>
                        <li class="breadcrumb-item"><a href="#!">Modifying my profile</a></li>
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
                <h5>Users</h5>
                <span>Edit {{$user->name}} profile</span>
                <div class="card-header-right">
                    <i class="feather icon-maximize full-card"></i>
                    <i class="feather icon-minus minimize-card"></i>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::model($user, array('action' => array('ProfilesController@updateUserAccount', $user->id), 'method' => 'PUT', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <div class="j-content">
                        <!-- start name -->
                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="name">
                                        Username
                                    </label>
                                    {!! Form::text('name', $user->name, array('id' => 'name', 'class' => 'name-group', 'placeholder' => 'e.g. jguyo')) !!}

                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="email">
                                        Email
                                    </label>
                                    {!! Form::text('email', $user->email, array('id' => 'email', 'class' => 'name-group', 'placeholder' => 'e.g. jguyo@whelson.co.zw')) !!}
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="first_name">
                                        First Name(s)
                                    </label>
                                    {!! Form::text('first_name', $user->first_name, array('id' => 'first_name', 'class' => 'name-group', 'placeholder' => 'e.g. Jotham')) !!}
                                </div>
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="last_name">
                                        Last Name
                                    </label>
                                    {!! Form::text('last_name', $user->last_name, array('id' => 'last_name', 'class' => 'name-group', 'placeholder' => 'e.g. Guyo')) !!}
                                </div>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-divider j-gap-bottom-25"></div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="paynumber">
                                        Paynumber
                                    </label>
                                    {!! Form::text('paynumber', $user->paynumber , array('id' => 'paynumber', 'class' => 'name-group', 'placeholder' => 'e.g. 12')) !!}
                                </div>
                                @if ($errors->has('paynumber'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('paynumber') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="location">
                                        Location
                                    </label>
                                    <label class="j-input j-select">
                                        <select name="location" id="location">
                                            <option value="{{$user->location}}">{{$user->location}}</option>
                                            <option value="Harare">Harare</option>
                                            <option value="Beira">Beira</option>
                                            <option value="Beitbridge">Beitbridge</option>
                                            <option value="Chirundu">Chirundu</option>
                                            <option value="DRC">DRC</option>
                                            <option value="Forbes">Forbes</option>
                                            <option value="Victoria Falls">Victoria Falls</option>
                                            <option value="Zambia">Zambia</option>
                                        </select>
                                    </label>                                </div>
                                @if ($errors->has('location'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="ip_address">
                                        IP Address
                                    </label>
                                    {!! Form::text('ip_address', $user->ip_address, array('id' => 'ip_address', 'class' => 'name-group', 'placeholder' => 'e.g. 192.168.1.12')) !!}
                                </div>
                                @if ($errors->has('ip_address'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('ip_address') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="mobile">
                                        Mobile Number
                                    </label>
                                    {!! Form::text('mobile', $user->mobile, array('id' => 'mobile', 'class' => 'name-group', 'placeholder' => 'e.g. 0773418009')) !!}
                                </div>
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="department">
                                        Department
                                    </label>
                                    <label class="j-input j-select">
                                        <select name="department" id="department">
                                            <option value="{{$user->department}}">{{$user->department}}</option>
                                            @if ($departments)
                                                @foreach($departments as $department)
                                                    <option value='{{ $department->department }}'>{{ $department->department }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </label>
                                </div>
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="position">
                                        Position
                                    </label>
                                    <label class="j-input j-select">
                                        <select name="position" id="position">
                                            <option value="{{$user->position}}">{{$user->position}}</option>
                                        </select>
                                    </label>
                                </div>
                                @if ($errors->has('position'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- start response from server -->
                        <div class="j-response"></div>
                        <!-- end response from server -->
                    </div>
                    <!-- end /.content -->
                    <div class="j-footer">
                        {!! Form::button('Update My Info', array('class' => 'btn btn-primary','type' => 'submit' )) !!}
                        {!! Form::button('Clear Form', array('class' => 'btn btn-default m-r-20','type' => 'reset' )) !!}
                        {!! Form::close() !!}
                    </div>
                    <!-- end /.footer -->
                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')

    <script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.maskedinput.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.j-pro.js')}}"></script>


    <script src="{{ asset('js/select2.min.js')}}"></script>

    <script type="text/javascript">
        $("#location").select2({
            placeholder: 'Please select a depot.',
            allowClear:true,
        });
    </script>

    <script type="text/javascript">
        $("#position").select2({
            placeholder: 'Please select a Job Title.',
            allowClear:true,
        });
    </script>

    <script type="text/javascript">
        $('#department').select2({
            placeholder: 'Please select a department.',
            allowClear:true,
        }).change(function(){
            var department = $(this).val();
            var _token = $("input[name='_token']").val();
            if(department){
                $.ajax({
                    type:"get",
                    url:'{{url('/getTitles')}}/'+department,
                    _token: _token ,
                    success:function(res) {
                        if(res) {
                            $("#position").empty();
                            $.each(res,function(key, value){
                                $("#position").append('<option value="'+value+'">'+value+'</option>');
                            });
                        }
                    }

                });
            }
        });

    </script>

    @include('scripts.form-modal-script')

@endsection
