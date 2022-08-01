<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/21/2020
 * Time: 10:34 AM
 */
?>
@extends('layouts.app')

@section('template_title')
    Adding Licence
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
                        <h4>Licence</h4>
                        <span>Add Licence</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/licences')}}">Licence</a></li>
                        <li class="breadcrumb-item"><a href="#!">Create Licence</a></li>
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
                <h5>Adding Licence </h5>
                <div class="card-header-right">
                    <a href="{{ url('/licences') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to Licence List
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => 'licences.store', 'method' => 'POST', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <div class="j-content">

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="licname">
                                        Licence
                                    </label>
                                    {!! Form::text('licname', NULL, array('id' => 'licname', 'class' => 'name-group', 'placeholder' => 'e.g. ESET Endpoint Protection Standard')) !!}
                                </div>
                                @if ($errors->has('licname'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('licname') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="lickey">
                                        Licence Key
                                    </label>
                                    {!! Form::text('lickey', NULL, array('id' => 'lickey', 'class' => 'name-group', 'placeholder' => 'e.g. ZXCV-BNMA-SDFG-HJKL')) !!}
                                </div>
                                @if ($errors->has('lickey'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('lickey') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="software">
                                        Software
                                    </label>
                                    {!! Form::text('software', NULL, array('id' => 'software', 'class' => 'name-group', 'placeholder' => 'e.g. Eset Antivirus')) !!}
                                </div>
                                @if ($errors->has('software'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('software') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="lic_users">
                                        Licence Capacity
                                    </label>
                                    {!! Form::text('lic_users', NULL, array('id' => 'lic_users', 'class' => 'name-group', 'placeholder' => 'e.g. 100 Computers')) !!}
                                </div>
                                @if ($errors->has('lic_users'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('lic_users') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="expirydate">
                                        Expiry date
                                    </label>
                                    {!! Form::text('expirydate', NULL, array('id' => 'dropper-animation', 'class' => 'name-group', 'placeholder' => 'e.g. 2020-01-31')) !!}
                                </div>
                                @if ($errors->has('expirydate'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('expirydate') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="date_bought">
                                        Date Bought
                                    </label>
                                    {!! Form::text('date_bought', NULL, array('id' => 'date_bought', 'class' => 'name-group', 'placeholder' => 'e.g. 2019-01-31')) !!}
                                </div>
                                @if ($errors->has('date_bought'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('date_bought') }}</strong>
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
                        {!! Form::button('Add Licence', array('class' => 'btn btn-primary','type' => 'submit' )) !!}
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

    <script type="text/javascript" src="{{asset('bower_components\datedropper\js\datedropper.min.js')}}"></script>

    <script>
        $("#dropper-animation").dateDropper( {
            dropWidth: 200,
            format: "Y-m-d",
            init_animation: "bounce",
            dropPrimaryColor: "#1abc9c",
            dropBorder: "1px solid #1abc9c"
        })

        $("#date_bought").dateDropper( {
            dropWidth: 200,
            format: "Y-m-d",
            init_animation: "bounce",
            dropPrimaryColor: "#1abc9c",
            dropBorder: "1px solid #1abc9c"
        })
    </script>

@endsection
