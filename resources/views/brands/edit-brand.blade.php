<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 6/19/2020
 * Time: 10:49 AM
 */
?>
@extends('layouts.app')

@section('template_title')
    Adding Edit
@endsection


@section('template_linked_css')
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
                        <h4>Brands</h4>
                        <span>Modify Brand</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/brands')}}">Brands</a></li>
                        <li class="breadcrumb-item"><a href="#!">Modify Brand</a></li>
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
                <h5>Changing Brand </h5>
                <div class="card-header-right">
                    <a href="{{ url('/brands') }}" class="btn btn-round btn-light float-right">
                        <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                        Back to Brands
                    </a>
                </div>

            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => ['brands.update', $brand->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}

                    {!! csrf_field() !!}

                    <div class="j-content">
                        <!-- start name -->
                        <div class="j-row">
                            <div class="j-unit">
                                <div class="j-input">
                                    <label class="j-label" for="brand">
                                        Brand Name
                                    </label>
                                    {!! Form::text('brand', $brand->brand, array('id' => 'brand', 'class' => 'name-group', 'placeholder' => 'e.g. Lenovo')) !!}
                                </div>
                                @if ($errors->has('brand'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('brand') }}</strong>
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
                        {!! Form::button('Update Brand', array('class' => 'btn btn-primary','type' => 'submit' )) !!}
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

@endsection

