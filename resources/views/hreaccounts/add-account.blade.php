<?php
/**
 * Created by vscode for itreg
 * User: Tadiwa Dauya
 * Date: 6/25/2021
 * Time: 9:04 AM
 */
?>
@extends('layouts.app')

@section('template_title')
    Adding Hre O365 Account
@endsection


@section('template_linked_css')
    <link rel="stylesheet" href="{{asset('bower_components\select2\css\select2.min.css')}}">

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
                        <h4>Hre O365</h4>
                        <span>Add Hre O365</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/hreaccounts')}}">Hre O365</a></li>
                        <li class="breadcrumb-item"><a href="#!">Create Hre O365 Account</a></li>
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
                <h5>Adding Hre O365 Account </h5>
                <div class="card-header-right">
                    <a href="{{ url('/hreaccounts') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to Hre O365 List
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => 'hreaccounts.store', 'method' => 'POST', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <div class="j-content">

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="user">
                                        Employee
                                    </label>
                                    <select class="name-group col-sm-12" name="user" id="user">
                                        <option value="">Select User</option>
                                        @if ($users)
                                            @foreach($users as $user)
                                                <option value="{{ $user->first_name }} {{ $user->last_name }}" >{{ $user->first_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('user'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="email">
                                        O365 Email
                                    </label>
                                    {!! Form::email('email', NULL, array('id' => 'email', 'class' => 'name-group', 'placeholder' => 'e.g. user@whelson.co.zw')) !!}
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
                                    <label class="j-label" for="password">
                                        Current Password
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
                                    <label class="j-label" for="prev_password">
                                        Previous Password
                                    </label>
                                    {!! Form::text('prev_password', NULL, array('id' => 'prev_password', 'class' => 'name-group', 'placeholder' => 'e.g. VeryStrongPassword')) !!}
                                </div>
                                @if ($errors->has('prev_password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('prev_password') }}</strong>
                                        </span>
                                @endif
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

    <script type="text/javascript">
        $("#user").select2({
            placeholder: 'Please select an employee.',
            allowClear:true,
        });
    </script>

@endsection
