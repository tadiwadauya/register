<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 7/11/2020
 * Time: 6:11 PM
 */
?>
@extends('layouts.app')

@section('template_title')
    Change My Password
@endsection

@section('head')
@endsection

@section('template_linked_css')

    <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />

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
                        <h4>Users</h4>
                        <span>My Account </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/users')}}">Users</a></li>
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
                <h5>Change Password</h5>
                <span>Here you can change your account password</span>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-block">
                <div class="j-wrapper j-wrapper-640">
                    {!! Form::open(array('route' => ['changemypwd', $user->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'j-forms j-pro ', 'id'=>'j-pro','autocomplete' => 'new-password', 'enctype'=>'multipart/form-data', 'novalidate'=>"")) !!}
                    @csrf
                    <!-- end /.header -->
                        <div class="j-content">
                            <!-- start login -->
                            <div class="j-unit">
                                <div class="j-input">
                                    <label class="j-icon-right" for="old_password">
                                        <i class="icofont icofont-lock"></i>
                                    </label>
                                    <input type="password" id="old_password" name="old_password" placeholder="Your Old Password">

                                </div>
                            </div>

                            <div class="j-unit">
                                <div class="j-input">
                                    <label class="j-icon-right" for="password">
                                        <i class="icofont icofont-lock"></i>
                                    </label>
                                    <input type="password" id="password" name="password" placeholder="New Password">

                                </div>
                            </div>
                            <!-- end login -->
                            <!-- start password -->
                            <div class="j-unit">
                                <div class="j-input">
                                    <label class="j-icon-right" for="password_confirmation">
                                        <i class="icofont icofont-lock"></i>
                                    </label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">

                                </div>
                            </div>
                            <!-- end password -->

                            <!-- start response from server -->
                            <div class="j-response"></div>
                            <!-- end response from server -->
                        </div>
                        <!-- end /.content -->
                        <div class="j-footer">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                        <!-- end /.footer -->
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    <script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.maskedinput.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.j-pro.js')}}"></script>
@endsection
