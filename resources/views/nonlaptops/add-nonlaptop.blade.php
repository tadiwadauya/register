<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/17/2020
 * Time: 11:35 AM
 */
?>
@extends('layouts.app')

@section('template_title')
    Adding Non Allocated Laptop
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
                        <h4>Non Allocated Laptops</h4>
                        <span>Create Non Allocated Laptop</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/nonlaptops')}}">Non Allocated Laptops</a></li>
                        <li class="breadcrumb-item"><a href="#!">Create Non Allocated Laptop</a></li>
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
                <h5>Adding Non Allocated Laptop - Asset Tag: WASS{{$latestId}} </h5>
                <div class="card-header-right">
                    <a href="{{ url('/nonlaptops') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to Non Allocated Laptops
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => 'nonlaptops.store', 'method' => 'POST', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <input type="hidden" name="assettag" value="WASS{{$latestId}}">

                    <div class="j-content">
                        <!-- start name -->
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
                                                <option value="{{ $user->paynumber }}" >{{ $user->first_name }} {{ $user->last_name }} - {{ $user->paynumber }}</option>
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
                                    <label class="j-label" for="model">
                                        Computer Brand & Model
                                    </label>
                                    {!! Form::text('model', NULL, array('id' => 'model', 'class' => 'name-group', 'placeholder' => 'e.g. Lenovo V510')) !!}
                                </div>
                                @if ($errors->has('model'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('model') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="serial">
                                        Serial Number
                                    </label>
                                    {!! Form::text('serial', NULL, array('id' => 'serial', 'class' => 'name-group', 'placeholder' => 'e.g. ABC12345678')) !!}
                                </div>
                                @if ($errors->has('serial'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('serial') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="purchased">
                                        Date Purchased
                                    </label>
                                    {!! Form::text('purchased', NULL, array('id' => 'dropper-animation', 'class' => 'name-group form-control', 'placeholder' => 'e.g. 2020-01-31')) !!}
                                </div>
                                @if ($errors->has('purchased'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('purchased') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-divider j-gap-bottom-25"></div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="ram">
                                        RAM
                                    </label>
                                    {!! Form::text('ram', NULL, array('id' => 'ram', 'class' => 'name-group', 'placeholder' => 'e.g. 4GB')) !!}
                                </div>
                                @if ($errors->has('ram'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('ram') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="hdd">
                                        Harddrive Capacity
                                    </label>
                                    {!! Form::text('hdd', NULL, array('id' => 'hdd', 'class' => 'name-group', 'placeholder' => 'e.g. 500GB')) !!}
                                </div>
                                @if ($errors->has('hdd'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('hdd') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="antivirus">
                                        Anti Virus
                                    </label>
                                    {!! Form::text('antivirus', NULL, array('id' => 'antivirus', 'class' => 'name-group', 'placeholder' => 'e.g. Eset Smart Security')) !!}
                                </div>
                                @if ($errors->has('antivirus'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('antivirus') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="os">
                                        Operating System
                                    </label>
                                    <label class="j-input j-select">
                                        <select name="os">
                                            <option value="" selected="">Choose Operating System</option>
                                            <option value="Windows XP">Windows XP</option>
                                            <option value="Windows 7">Windows 7</option>
                                            <option value="Windows 8">Windows 8</option>
                                            <option value="Windows 10">Windows 10</option>
                                            <option value="MacOS">MacOS</option>
                                            <option value="Linux">Linux</option>
                                        </select>
                                    </label>
                                </div>
                                @if ($errors->has('os'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('os') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="office">
                                        Office
                                    </label>
                                    <label class="j-input j-select">
                                        <select name="office">
                                            <option value="" selected="">Choose Office Version</option>
                                            <option value="Office 2007">Office 2007</option>
                                            <option value="Office 2010">Office 2010</option>
                                            <option value="Office 2013">Office 2013</option>
                                            <option value="Office 2016">Office 2016</option>
                                        </select>
                                    </label>
                                </div>
                                @if ($errors->has('office'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('office') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="warranty">
                                        Warranty
                                    </label>
                                    {!! Form::text('warranty', NULL, array('id' => 'warranty', 'class' => 'name-group', 'placeholder' => 'e.g. 12 Months')) !!}
                                </div>
                                @if ($errors->has('warranty'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('warranty') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-unit">
                            <div class="j-input">
                                <label class="j-label" for="notes">
                                    Additional Info
                                </label>
                                {!! Form::textarea('notes', NULL, array('id' => 'notes', 'class' => 'name-group', 'placeholder' => 'e.g. Additional notes','spellcheck'=>'true')) !!}
                                @if ($errors->has('notes'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                @endif
                                <span class="j-tooltip j-tooltip-right-top">Any additional info, like processor size, condition, etc</span>
                            </div>
                        </div>


                        <div class="j-span6 j-unit">
                            <div class="j-input">
                                <label class="j-label" for="office">
                                   Allocation
                                </label>
                                <label class="j-input j-select">
                                    <select name="office">
                                        <option value="" selected="">Allocation</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </label>
                            </div>
                            @if ($errors->has('office'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('office') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <!-- start response from server -->
                        <div class="j-response"></div>
                        <!-- end response from server -->
                    </div>
                    <!-- end /.content -->
                    <div class="j-footer">
                        {!! Form::button('Add Non Allocated Laptop', array('class' => 'btn btn-primary','type' => 'submit' )) !!}
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

    <script >
        $("#has_monitor").on("change", function () {
            $("#has_monitor").is(":checked") ? $(".hidden-has_monitor").removeClass("hidden") : $(".hidden-has_monitor").addClass("hidden")
        });

        $("#has_keyboard").on("change", function () {
            $("#has_keyboard").is(":checked") ? $(".hidden-has_keyboard").removeClass("hidden") : $(".hidden-has_keyboard").addClass("hidden")
        });

        $("#has_mouse").on("change", function () {
            $("#has_mouse").is(":checked") ? $(".hidden-has_mouse").removeClass("hidden") : $(".hidden-has_mouse").addClass("hidden")
        });
    </script>

    <script type="text/javascript">
        $("#username").select2({
            placeholder: 'Please select a user.',
            allowClear:true,
        });
    </script>

    <script type="text/javascript" src="{{asset('bower_components\datedropper\js\datedropper.min.js')}}"></script>

    <script>
        $("#dropper-animation").dateDropper( {
            dropWidth: 200,
            format: "Y-m-d",
            init_animation: "bounce",
            dropPrimaryColor: "#1abc9c",
            dropBorder: "1px solid #1abc9c"
        })
    </script>

@endsection
