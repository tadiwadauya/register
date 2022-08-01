<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/20/2020
 * Time: 6:03 PM
 */
?>
@extends('layouts.app')

@section('template_title')
    Adding SG VPN Account
@endsection


@section('template_linked_css')
    <link rel="stylesheet" href="{{asset('bower_components\select2\css\select2.min.css')}}">
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
                        <h4>SG VPN</h4>
                        <span>Add SG VPN</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/sgvpns')}}">SG VPN</a></li>
                        <li class="breadcrumb-item"><a href="#!">Create SG VPN Account</a></li>
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
                <h5>Adding SG VPN Account </h5>
                <div class="card-header-right">
                    <a href="{{ url('/sgvpns') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to SG VPN List
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => 'sgvpns.store', 'method' => 'POST', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <div class="j-content">
                        <div class="unit">
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                    <input type="checkbox" id="new_account" name="new_account" value="1">
                                    <span class="cr">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                    </span> <span>Permanent Employee New Account?</span>
                                </label>
                            </div>
                        </div>
                        <div class="j-row hidden-new_account hidden">
                            <div class="j-row">
                                <div class="j-span6 j-unit">
                                    <div class="j-input">
                                        <label class="j-label" for="pusername">
                                            Account Username
                                        </label>
                                        {!! Form::text('pusername', NULL, array('id' => 'pusername', 'class' => 'name-group', 'placeholder' => 'e.g. firstname.lastname')) !!}
                                    </div>
                                    @if ($errors->has('pusername'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pusername') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="j-span6 j-unit">
                                    <div class="j-input">
                                        <label class="j-label" for="ppassword">
                                            New Account Password
                                        </label>
                                        {!! Form::text('ppassword', NULL, array('id' => 'ppassword', 'class' => 'name-group', 'placeholder' => 'e.g. SecureRobustPassword')) !!}
                                    </div>
                                    @if ($errors->has('ppassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ppassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="employee">
                                        Employee
                                    </label>
                                    <select class="name-group col-sm-12" name="employee" id="employee">
                                        <option value="">Select User</option>
                                        @if ($users)
                                            @foreach($users as $user)
                                                <option value="{{ $user->first_name }} {{ $user->last_name }}" >{{ $user->first_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {{--{!! Form::text('username', NULL, array('id' => 'username', 'class' => 'name-group', 'placeholder' => 'e.g. Vincent Guyo')) !!}--}}
                                </div>
                                @if ($errors->has('employee'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('employee') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="username">
                                        SG VPN Username
                                    </label>
                                    <select class="name-group col-sm-12" name="username" id="username">
                                        <option value="">Select Username</option>
                                        @if ($sgvpns)
                                            @foreach($sgvpns as $sgvpn)
                                                <option value="{{$sgvpn->username}}" data-price="{{$sgvpn->password}}" data-tager="{{$sgvpn->prev_password}}" >{{$sgvpn->username}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="password">
                                        Current Password
                                    </label>
                                    {!! Form::text('password', NULL, array('id' => 'password', 'class' => 'name-group', 'placeholder' => 'e.g. VeryStrongPassword', 'readonly')) !!}
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="prev_password">
                                        Previous Password
                                    </label>
                                    {!! Form::text('prev_password', NULL, array('id' => 'prev_password', 'class' => 'name-group', 'placeholder' => 'e.g. VeryStrongPassword', 'readonly')) !!}
                                </div>
                                @if ($errors->has('prev_password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('prev_password') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="status">
                                        Status
                                    </label>
                                    <select class="name-group col-sm-12" name="status" id="status">
                                        <option value="Active">Active</option>
                                        <option value="Disabled">Disabled</option>
                                    </select>
                                </div>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="location">
                                        Location
                                    </label>
                                    <select class="name-group col-sm-12" name="location" id="location">
                                        <option value="">Select Location</option>
                                        <option value="Harare">Harare</option>
                                        <option value="Beira">Beira</option>
                                        <option value="Beitbridge">Beitbridge</option>
                                        <option value="Chirundu">Chirundu</option>
                                        <option value="DRC">DRC</option>
                                        <option value="Forbes">Forbes</option>
                                        <option value="Victoria Falls">Victoria Falls</option>
                                        <option value="Zambia">Zambia</option>
                                    </select>
                                </div>

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-unit">
                            <div class="j-input">
                                <label class="j-label" for="comments">
                                   Comments
                                </label>
                                {!! Form::textarea('comments', NULL, array('id' => 'comments', 'class' => 'name-group', 'placeholder' => 'e.g. Phone number needs activation ','spellcheck'=>'true')) !!}
                                @if ($errors->has('comments'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                @endif
                                <span class="j-tooltip j-tooltip-right-top">Any comments on the user,update details needed, issues with the account etc</span>
                            </div>
                        </div>

                        <input type="hidden" name="last_agent" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">

                        <!-- start response from server -->
                        <div class="j-response"></div>
                        <!-- end response from server -->
                    </div>
                    <!-- end /.content -->
                    <div class="j-footer">
                        {!! Form::button('Add Account', array('class' => 'btn btn-primary','type' => 'submit' )) !!}
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
    <script type="text/javascript" src="{{asset('bower_components\select2\js\select2.full.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.maskedinput.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.j-pro.js')}}"></script>

    <script type="text/javascript" src="{{asset('bower_components\datedropper\js\datedropper.min.js')}}"></script>

    <script >
        $("#new_account").on("change", function () {
            $("#new_account").is(":checked") ? $(".hidden-new_account").removeClass("hidden") : $(".hidden-new_account").addClass("hidden")
        });

    </script>

    <script>
        $("#dropper-animation").dateDropper( {
            dropWidth: 200,
            format: "Y-m-d",
            init_animation: "bounce",
            dropPrimaryColor: "#1abc9c",
            dropBorder: "1px solid #1abc9c"
        })
    </script>

    <script type="text/javascript">
        $("#employee").select2({
            placeholder: 'Please select an employee.',
            allowClear:true,
        });
    </script>

    <script type="text/javascript">
        $("#username").select2({
            placeholder: 'Please select a username',
            allowClear:true,
        }).on('change',function(){
            var price = $(this).children('option:selected').data('price');
            var price1 = $(this).children('option:selected').data('tager');
            $('#password').val(price);
            $('#prev_password').val(price1);
        });

    </script>

@endsection
