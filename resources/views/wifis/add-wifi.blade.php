<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/26/2020
 * Time: 12:06 AM
 */
?>
@extends('layouts.app')

@section('template_title')
    Add WiFi Network
@endsection

@section('head')
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
                        <h4>WiFi</h4>
                        <span>Add WiFi</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/wifis')}}">WiFi</a></li>
                        <li class="breadcrumb-item"><a href="#!">Add WiFi</a></li>
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
                <h5>Create New Wifi Network</h5>
                <div class="card-header-right">
                    <a href="{{ route('wifis') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to WiFi List
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => 'wifis.store', 'method' => 'POST', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <div class="j-content">

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="wifi">
                                        WiFi SSID
                                    </label>
                                    {!! Form::text('wifi', NULL, array('id' => 'wifi', 'class' => 'form-control', 'placeholder' => 'e.g. WhelsonMainWifi')) !!}
                                </div>
                                @if ($errors->has('wifi'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('wifi') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="location">
                                        Location
                                    </label>
                                    {!! Form::text('location', NULL, array('id' => 'location', 'class' => 'form-control', 'placeholder' => 'e.g. Accounts Office')) !!}
                                </div>
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
                                    <label class="j-label" for="password">
                                        Password
                                    </label>
                                    {!! Form::text('password', NULL, array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'e.g. VeryStrongPassword')) !!}
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="username">
                                        Router Username
                                    </label>
                                    {!! Form::text('username', NULL, array('id' => 'username', 'class' => 'form-control', 'placeholder' => 'e.g. Root')) !!}
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
                                    <label class="j-label" for="router_pwd">
                                        Router Password
                                    </label>
                                    {!! Form::text('router_pwd', NULL, array('id' => 'router_pwd', 'class' => 'form-control', 'placeholder' => 'e.g. IAmAStrongPassword')) !!}
                                </div>
                                @if ($errors->has('router_pwd'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('router_pwd') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="router_ip">
                                        Router IP Address
                                    </label>
                                    {!! Form::text('router_ip', NULL, array('id' => 'router_ip', 'class' => 'form-control', 'placeholder' => 'e.g. 192.168.1.23. Use 0.0.0.0 for DHCP wifis')) !!}
                                </div>
                                <span class="help-block" id="validate_ip"></span>
                                @if ($errors->has('router_ip'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('router_ip') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="ip_range">
                                        IP Range
                                    </label>
                                    {!! Form::text('ip_range', NULL, array('id' => 'ip_range', 'class' => 'form-control', 'placeholder' => 'e.g. 192.168.10.2-254')) !!}
                                </div>
                                @if ($errors->has('ip_range'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('ip_range') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">

                            </div>
                        </div>

                        <div class="j-unit">
                            <div class="j-input">
                                <label class="j-label" for="comments">
                                    Additional Info
                                </label>
                                {!! Form::textarea('comments', NULL, array('id' => 'comments', 'class' => 'name-group', 'placeholder' => 'e.g. Any comments about the wifi network','spellcheck'=>'true')) !!}
                                @if ($errors->has('comments'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                @endif
                                <span class="j-tooltip j-tooltip-right-top">Any comments about the network,if any, etc</span>
                            </div>
                        </div>

                        <!-- start response from server -->
                        <div class="j-response"></div>
                        <!-- end response from server -->
                    </div>
                    <!-- end /.content -->
                    <div class="j-footer">
                        {!! Form::button('Add Wi-Fi', array('class' => 'btn btn-primary','type' => 'submit' )) !!}
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

    <script>
        var pattern = /\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b/;
        x = 46;
        $('#router_ip').keypress(function (e) {
            if (e.which != 8 && e.which != 0 && e.which != x && (e.which < 48 || e.which > 57)) {
                console.log(e.which);
                return false;
            }
        }).keyup(function () {
            var this1 = $(this);
            if (!pattern.test(this1.val())) {
                $('#validate_ip').text('Not a valid IP address');
                while (this1.val().indexOf("..") !== -1) {
                    this1.val(this1.val().replace('..', '.'));
                }
                x = 46;
            } else {
                x = 0;
                var lastChar = this1.val().substr(this1.val().length - 1);
                if (lastChar == '.') {
                    this1.val(this1.val().slice(0, -1));
                }
                var ip = this1.val().split('.');
                if (ip.length == 4) {
                    $('#validate_ip').text('Valid IP');
                }
            }
        });
    </script>

@endsection
