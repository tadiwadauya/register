<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/22/2020
 * Time: 2:27 PM
 */
?>
@extends('layouts.app')

@section('template_title')
    Add Maintenance Log
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
                        <h4>Maintenance</h4>
                        <span>Add Maintenance Log</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/maintenances')}}">Maintenance</a></li>
                        <li class="breadcrumb-item"><a href="#!">Manually Adding Maintenance Entry</a></li>
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
                <h5>Adding Maintenance Log </h5>
                <div class="card-header-right">
                    <a href="{{ url('/maintenances') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to List
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => 'maintenances.store', 'method' => 'POST', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <input type="hidden" name="agent" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">

                    <div class="j-content">

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="username">
                                        Computer User
                                    </label>
                                    <select class="name-group col-sm-12" name="username" id="username">
                                        <option value="">Select User</option>
                                        @if ($users)
                                            @foreach($users as $user)
                                                <option value="{{ $user->first_name }} {{ $user->last_name }}" data-price="{{$user->department}}" >{{ $user->first_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {{--{!! Form::text('username', NULL, array('id' => 'username', 'class' => 'name-group', 'placeholder' => 'e.g. Vincent Guyo')) !!}--}}
                                </div>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="ip_address">
                                        User's IP Address
                                    </label>
                                    {!! Form::text('ip_address', $ipAddress->getClientIp(), array('id' => 'ip_address', 'class' => 'name-group ipv4', 'placeholder' => 'e.g. 192.168.1.23', 'data-mask' => '99/99/9999 99:99:99')) !!}
                                </div>
                                @if ($errors->has('ip_address'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('ip_address') }}</strong>
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
                                    {!! Form::text('department', NULL, array('id' => 'department', 'class' => 'name-group', 'placeholder' => 'e.g. I.T.', 'readonly')) !!}
                                </div>
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">

                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-unit">
                                    <h4 class="sub-title">Maintenance Checks</h4>
                                    <div class="border-checkbox-section">
                                        <div class="border-checkbox-group border-checkbox-group-success">
                                            <input class="border-checkbox" type="checkbox" id="monitor" name="monitor" value="1">
                                            <label class="border-checkbox-label" for="monitor">Monitor Cleaned?</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-success">
                                            <input class="border-checkbox" type="checkbox" id="cpu" name="cpu" value="1">
                                            <label class="border-checkbox-label" for="cpu">CPU Cleaned?</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-success">
                                            <input class="border-checkbox" type="checkbox" id="keyboard" name="keyboard" value="1">
                                            <label class="border-checkbox-label" for="keyboard">Keyboard Cleaned?</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-success">
                                            <input class="border-checkbox" type="checkbox" id="mouse" name="mouse" value="1">
                                            <label class="border-checkbox-label" for="mouse">Mouse Cleaned?</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-success">
                                            <input class="border-checkbox" type="checkbox" id="desk" name="desk" value="1">
                                            <label class="border-checkbox-label" for="desk">Desk Cleaned?</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <!-- start response from server -->
                        <div class="j-response"></div>
                        <!-- end response from server -->
                    </div>
                    <!-- end /.content -->
                    <div class="j-footer">
                        {!! Form::button('Add Entry', array('id'=>'checkBtn','class' => 'btn btn-primary','type' => 'submit' )) !!}
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
        $("#username").select2({
            placeholder: 'Please select a username',
            allowClear:true,
        }).on('change',function(){
            var price = $(this).children('option:selected').data('price');
            $('#department').val(price);
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#checkBtn').click(function() {
                checked = $("input[type=checkbox]:checked").length;

                if(!checked) {
                    alert("You must complete at least one check to add record.");
                    return false;
                }

            });
        });

    </script>


@endsection
