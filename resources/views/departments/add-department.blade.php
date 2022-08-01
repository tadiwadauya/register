<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/26/2020
 * Time: 1:28 AM
 */
?>
@extends('layouts.app')

@section('template_title')
    Adding Department
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
                        <h4>Departments</h4>
                        <span>Create Department</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/departments')}}">Departments</a></li>
                        <li class="breadcrumb-item"><a href="#!">Create Department</a></li>
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
                <h5>Adding Department </h5>
                <div class="card-header-right">
                    <a href="{{ url('/departments') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to Departments
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => 'departments.store', 'method' => 'POST', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <div class="j-content">
                        <!-- start name -->
                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="department">
                                        Department Name
                                    </label>
                                    {!! Form::text('department', NULL, array('id' => 'department', 'class' => 'name-group', 'placeholder' => 'e.g. I.T')) !!}
                                </div>
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="manager">
                                        Manager
                                    </label>
                                    <select class="name-group col-sm-12" name="manager" id="manager">
                                        <option value="">Select Manager</option>
                                        @if ($users)
                                            @foreach($users as $user)
                                                <option value="{{ $user->paynumber }}" >{{ $user->first_name }} {{ $user->last_name }} - {{ $user->paynumber }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('manager'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('manager') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="j-row">
                            <div class="j-span6 j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="asst_manager">
                                        Assistant Manager
                                    </label>
                                    <select class="name-group col-sm-12" name="asst_manager" id="asst_manager">
                                        <option value="">Select Assistant Manager</option>
                                        @if ($users)
                                            @foreach($users as $user)
                                                <option value="{{ $user->paynumber }}" >{{ $user->first_name }} {{ $user->last_name }} - {{ $user->paynumber }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if ($errors->has('asst_manager'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('asst_manager') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="j-span6 j-unit">

                            </div>
                        </div>

                        <!-- start response from server -->
                        <div class="j-response"></div>
                        <!-- end response from server -->
                    </div>
                    <!-- end /.content -->
                    <div class="j-footer">
                        {!! Form::button('Add Department', array('class' => 'btn btn-primary','type' => 'submit' )) !!}
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
        $("#manager").select2({
            placeholder: 'Please select Manager.',
            allowClear:true,
        });
    </script>

    <script type="text/javascript">
        $("#asst_manager").select2({
            placeholder: 'Please select a second in charge.',
            allowClear:true,
        });
    </script>

@endsection

