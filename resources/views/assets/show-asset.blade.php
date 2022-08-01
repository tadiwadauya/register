<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 7/11/2020
 * Time: 8:52 AM
 */
?>
@extends('layouts.app')

@section('template_title')
    Asset Info
@endsection

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Assets</h4>
                        <span>Asset Details</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('/iassets')}}">Assets</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{$asset->assettag}} Info</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card product-detail-page">
                    <div class="card-header">
                        <h5>{{$asset->assettag}} Details</h5>
                        <span>{{$asset->type}} assigned to {{$yuser->first_name}} {{$yuser->last_name}}</span>
                        <div class="card-header-right">
                            <a href="{{ url('/iassets') }}" class="btn btn-round btn-light float-right">
                                <i class="feather icon-chevrons-left" aria-hidden="true"></i>
                                Back to Assets
                            </a>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12 col-xs-12 product-detail" id="product-detail">
                                    <div class="col-lg-12">
                                        <span class="txt-muted d-inline-block">{{$asset->type}} Asset Tag: <strong>{{$asset->assettag}}</strong> </span>
                                        <span class="f-right">Asset Age : {{$asset->age}} </span>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4 class="pro-desc">{{$asset->model}}</h4>
                                    </div>
                                    <div class="col-lg-12">
                                        <table>
                                            <tr>
                                                <td>Assigned to :</td>
                                                <td><strong>{{$yuser->first_name}} {{$yuser->last_name}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Serial Number :</td>
                                                <td><strong>{{$asset->serial}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Purchased On :</td>
                                                <td><strong>{{$asset->purchased}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Warranty :</td>
                                                <td><strong>{{$asset->warranty}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Added On :</td>
                                                <td><strong>{{$asset->created_at}}</strong></td>
                                            </tr>
                                        </table>
                                    </div>

                                        <div class="col-lg-12">
                                        <hr>
                                        <h6 class="f-16 f-w-600 m-t-10 m-b-10">Additional Info</h6>
                                        <p>{{$asset->notes}}</p>
                                        <hr>
                                        @if($asset->type == 'Desktop')
                                        <table>
                                            <tr>
                                                <td>RAM :</td>
                                                <td><strong>{{$assetInfo->ram}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Hard drive :</td>
                                                <td><strong>{{$assetInfo->hdd}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Antivirus :</td>
                                                <td><strong>{{$assetInfo->antivirus}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Operating System :</td>
                                                <td><strong>{{$assetInfo->os}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Office :</td>
                                                <td><strong>{{$assetInfo->office}}</strong></td>
                                            </tr>

                                            @if($assetInfo->has_monitor)
                                                <tr>
                                                    <td>Has Monitor :</td>
                                                    <td><strong>Yes </strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Monitor :</td>
                                                    <td><strong>{{$assetInfo->monitor_name}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Monitor Serial Number :</td>
                                                    <td><strong>{{$assetInfo->monitor_serial}}</strong></td>
                                                </tr>
                                            @endif
                                            @if($assetInfo->has_keyboard)
                                                <tr>
                                                    <td>Has Keyboard :</td>
                                                    <td><strong>Yes</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Keyboard :</td>
                                                    <td><strong>{{$assetInfo->keyboard_name}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Keyboard Serial Number :</td>
                                                    <td><strong>{{$assetInfo->keyboard_serial}}</strong></td>
                                                </tr>
                                            @endif
                                            @if($assetInfo->has_mouse)
                                                <tr>
                                                    <td>Has Mouse :</td>
                                                    <td><strong>Yes</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Mouse :</td>
                                                    <td><strong>{{$assetInfo->mouse_name}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Mouse Serial Number:</td>
                                                    <td><strong>{{$assetInfo->mouse_serial}}</strong></td>
                                                </tr>
                                            @endif
                                        </table>
                                        <hr>
                                    </div>

                                        @elseif($asset->type == 'Laptop')
                                            <div class="col-lg-12">
                                            <table>
                                                <tr>
                                                    <td>RAM :</td>
                                                    <td><strong>{{$assetInfo->ram}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Hard drive :</td>
                                                    <td><strong>{{$assetInfo->hdd}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Antivirus :</td>
                                                    <td><strong>{{$assetInfo->antivirus}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Operating System :</td>
                                                    <td><strong>{{$assetInfo->os}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Office :</td>
                                                    <td><strong>{{$assetInfo->office}}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                        @elseif($asset->type == 'Harddrive')
                                            <div class="col-lg-12">
                                            <table>
                                                <tr>
                                                    <td>Brand :</td>
                                                    <td><strong>{{$assetInfo->brand}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Model :</td>
                                                    <td><strong>{{$assetInfo->model}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Capacity :</td>
                                                    <td><strong>{{$assetInfo->capacity}}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                        @elseif($asset->type == 'Printer')
                                            <div class="col-lg-12">
                                            <table>
                                                <tr>
                                                    <td>Brand :</td>
                                                    <td><strong>{{$assetInfo->brand}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Model :</td>
                                                    <td><strong>{{$assetInfo->model}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Device Type :</td>
                                                    <td><strong>{{$assetInfo->type}}</strong></td>
                                                </tr>

                                            </table>
                                        </div>
                                        @elseif($asset->type == 'Other')
                                            <div class="col-lg-12">
                                            <table>
                                                <tr>
                                                    <td>Brand :</td>
                                                    <td><strong>{{$assetInfo->brand}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Model :</td>
                                                    <td><strong>{{$assetInfo->model}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Device Type :</td>
                                                    <td><strong>{{$assetInfo->type}}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

@endsection
