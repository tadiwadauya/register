<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/19/2020
 * Time: 3:06 PM
 */
?>
@extends('layouts.app')

@section('template_title')
    Adding Other Asset
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
                        <h4>Printers</h4>
                        <span>Add Asset</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/aothers')}}">Printers</a></li>
                        <li class="breadcrumb-item"><a href="#!">Create Asset</a></li>
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
                <h5>Adding Other Asset </h5>
                <div class="card-header-right">
                    <a href="{{ url('/aothers') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to Assets
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => 'aothers.store', 'method' => 'POST', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <input type="hidden" name="assettag" value="WASS{{$latestId}}">

                    <div class="j-content">
                        <div class="j-row">
                            <div class="j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="type">
                                        Device Type
                                    </label>
                                    <select class="name-group col-sm-12" name="type" id="type">
                                    <option value="">Please select device type </option>
                                        <option value="Camera">Camera</option>
                                        <option value="Phone">Phone</option>
                                        <option value="IP Phone">IP Phone</option>
                                        <option value="Server">Server</option>
                                        <option value="Calculator">Calculator</option>
                                        <option value="Headphones">Headphones</option>
                                        <option value="Tablet">Tablet</option>
                                        <option value="Laminator">Laminator</option>
                                        <option value="Diagnostic Machine">Diagnostic Machine</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="username">
                                        Asset User
                                    </label>
                                    <select class="name-group col-sm-12" name="username" id="username">
                                        <option value="">Select User</option>
                                        @if ($users)
                                            @foreach($users as $user)
                                                <option value="{{ $user->paynumber }}" >{{ $user->first_name }} {{ $user->last_name }} - {{ $user->paynumber }}</option>
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
                            <div class="j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="brand">
                                        Brand
                                    </label>
                                    <select class="name-group col-sm-12" name="brand" id="brand">
                                        <option value="">Select Brand</option>
                                        @if ($brands)
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->brand }}" >{{ $brand->brand }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                @if ($errors->has('brand'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('brand') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="model">
                                        Model
                                    </label>
                                    {!! Form::text('model', NULL, array('id' => 'model', 'class' => 'name-group', 'placeholder' => 'e.g. XL12345')) !!}
                                </div>
                                @if ($errors->has('model'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('model') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="serial">
                                        Serial Number
                                    </label>
                                    {!! Form::text('serial', NULL, array('id' => 'serial', 'class' => 'name-group', 'placeholder' => 'e.g. DB1233445 ')) !!}
                                </div>
                                @if ($errors->has('serial'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('serial') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
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
                                <span class="j-tooltip j-tooltip-right-top">Any additional info regarding the asset is added here etc</span>
                            </div>
                        </div>

                        <!-- start response from server -->
                        <div class="j-response"></div>
                        <!-- end response from server -->
                    </div>
                    <!-- end /.content -->
                    <div class="j-footer">
                        {!! Form::button('Add Asset', array('class' => 'btn btn-primary','type' => 'submit' )) !!}
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
        $("#username").select2({
            placeholder: 'Please select a user.',
            allowClear:true,
        });
    </script>

    <script type="text/javascript">
        $("#brand").select2({
            placeholder: 'Please select a brand.',
            allowClear:true,
        });
    </script>

@endsection
