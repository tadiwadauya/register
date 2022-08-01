<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/21/2020
 * Time: 12:58 AM
 */
?>
@extends('layouts.app')

@section('template_title')
    Adding Sophos Account
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
                        <h4>Sophos</h4>
                        <span>Add Sophos Account</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/sophosvpns')}}">Sophos</a></li>
                        <li class="breadcrumb-item"><a href="#!">Create Sophos Account</a></li>
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
                <h5>Adding Sophos Account </h5>
                <div class="card-header-right">
                    <a href="{{ url('/sophosvpns') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to Sophos List
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => 'sophosvpns.store', 'method' => 'POST', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <div class="j-content">

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="employee">
                                        Employee
                                    </label>
                                    {!! Form::text('employee', NULL, array('id' => 'employee', 'class' => 'name-group', 'placeholder' => 'e.g. Vincent Guyo')) !!}
                                </div>
                                @if ($errors->has('employee'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('employee') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="user">
                                        Sophos Username
                                    </label>
                                    {!! Form::text('user', NULL, array('id' => 'user', 'class' => 'name-group', 'placeholder' => 'e.g. vincent')) !!}

                                </div>
                                @if ($errors->has('user'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="password">
                                        Password
                                    </label>
                                    {!! Form::text('password', NULL, array('id' => 'password', 'class' => 'name-group', 'placeholder' => 'e.g. VeryStrongPassword')) !!}
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="status">
                                        Status
                                    </label>
                                    <select class="name-group col-sm-12" name="status" id="status">
                                        <option value="Active">Active</option>
                                        <option value="Disabled">Disabled</option>
                                        <option value="Not yet reset">Not yet reset</option>
                                    </select>
                                </div>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="accounttype">
                                        Account Type
                                    </label>
                                    <select class="name-group col-sm-12" name="accounttype" id="accounttype">
                                        <option value="User">User</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>

                                @if ($errors->has('accounttype'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('accounttype') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">

                                </div>

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('location') }}</strong>
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
