<?php
/**
 * Created by PhpStorm for itreg
 * User: Vincent Guyo
 * Date: 7/7/2020
 * Time: 8:34 PM
 */

use App\Traits\CaptureIpTrait;

$ipAddress = new CaptureIpTrait();
//$ipAddress = '192.168.1.23';

$user = \App\Models\User::where('ip_address', $ipAddress->getClientIp())->first();

$agent = $user->name;
$dept = $user->department;
?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <title>Computer Maintenance | Whelson IT Register</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Whelson GDC Transport - IT Register">
    <meta name="keywords" content="Whelson GDC Transport - IT Register by Vincent H Guyo">
    <meta name="author" content="Vincent H Guyo">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets\images\favicon.png')}}" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components\bootstrap\css\bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets\icon\themify-icons\themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets\icon\icofont\css\icofont.css')}}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets\icon\feather\css\feather.css')}}">


    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\j-pro\css\demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\j-pro\css\font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\j-pro\css\j-pro-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\j-pro\css\j-forms.css')}}">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets\css\style.css')}}">
</head>

<body class="fix-menu">
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->

<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <img src="{{asset('assets\images\top_logo_small.png')}}" alt="Whelson GDC Transport">
                </div>
                <div class="card">
                    <div class="card-block">
                        <div class="j-wrapper">
                            <form method="POST" class="j-pro j-multistep" id="j-pro" action="{{ route('selflog.maintenance') }}"  enctype="multipart/form-data" novalidate="">
                                @csrf
                                <input type="hidden" name="agent" value="{{$agent}}">
                                <input type="hidden" name="ip_address" value="{{$ipAddress->getClientIp()}}">
                                <input type="hidden" name="username" value="{{$agent}}">
                                <input type="hidden" name="department" value="{{$dept}}">
                                <!-- end /.header-->
                                <div class="j-content">
                                    <fieldset>
                                        <div class="j-divider-text j-gap-top-20 j-gap-bottom-45">
                                            <span>Step 1/2 - POLICY AND APPROPRIATE USE</span>
                                        </div>
                                        <!-- start name -->
                                        <div class="j-unit">
                                            <p>It is the responsibility of a Computer user to always clean and make sure the set( i.e. the Computer) is dust free at all times. As Whelson Transport IT, we highly recommend users to always take note of the state of their Computers and to always comply with the basic  tips we give to the Users on how to maintain the Computers in good shape and also to avoid unnecessary damage to the machines. Failure to do so will result in immediate filling of a warning letter or Report of the user. Based on this, the following rules must be observed:</p>
                                        </div>
                                        <!-- end name -->
                                        <!-- start email phone -->
                                        <div class="j-row">
                                            <ul>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> A thorough cleaning of the monitor.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> Cleaning the desk especially where the computer set sits on.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> A thorough cleaning of the Desktop CPU unit.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> Avoid placing objects on the Desktop CPU unit.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> Making sure computers are Shut down (the proper procedure of shutting down a Computer) as soon as the user is done with the computer.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> No leg resting on UPS.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> No tempering with the host files that restrict or block sites.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> No changing or tempering with the Administrator passwords.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> No cancelling of the backup script from running.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> Not connecting personal computers to the Local Area Network.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> No changing passwords of the SG-VPN accounts.
                                                </li>
                                                <li>
                                                    <i class="icofont icofont-bubble-right"></i> No Hotspot sharing from a Computer.
                                                </li>
                                            </ul>
                                            <br>
                                            <div class="j-unit checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" name="ihaveread" id="ihaveread" required="required">
                                                    <span class="cr">
                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                        </span>
                                                    <span>I have read and understand these policies</span>
                                                </label>
                                            </div>
                                            <span class="messages"></span>

                                        </div>

                                        <!-- end email phone -->
                                    </fieldset>
                                    <fieldset>
                                        <div class="j-divider-text j-gap-top-20 j-gap-bottom-45">
                                            <span>Step 2/2 - Maintenance Checks</span>
                                        </div>
                                        <p>NB: PLEASE TAKE NOTE THAT THESE STEPS ARE NOT TO BE IGNORED AND THEY ARE CLOSELY MONITERED WHETHER THE USER HAS FOLLOWED THE BASIC AND SIMPLE INSTRUCTIONS OR NOT.</p>
                                        <!-- start guests -->
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
                                        <!-- end guests -->
                                    </fieldset>
                                    <!-- start response from server -->
                                    <div class="j-response"></div>
                                    <!-- end response from server -->
                                </div>
                                <!-- end /.content -->
                                <div class="j-footer">
                                    <button type="submit" class="btn btn-primary j-multi-submit-btn" id="checkBtn" onclick="$('#j-pro')[0].submit();">Done Now.</button>
                                    <button type="button" class="btn btn-primary j-multi-next-btn disabled-view" id="next-button" disabled="">Next</button>
                                    <button type="button" class="btn btn-default m-r-20 j-multi-prev-btn">Back</button>
                                </div>
                                <!-- end /.footer -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end of form -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>
<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>-->

<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="{{asset('bower_components\jquery\js\jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components\jquery-ui\js\jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components\popper.js\js\popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components\bootstrap\js\bootstrap.min.js')}}"></script>
<!-- j-pro js -->
<script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.maskedinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\pages\j-pro\js\jquery.j-pro.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#ihaveread").on("change", function () {
            $("#ihaveread").is(":checked") ?
                $("#next-button").attr("disabled", !1).removeClass("disabled-view") : $("#next-button").attr("disabled", !0).addClass("disabled-view")
        }).change();

        $('#checkBtn').click(function() {
            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
                alert("You must complete at least one check to add record.");
                return false;
            }

        });

        $( "#j-pro" ).justFormsPro({
            rules: {
                "ihaveread[]": {
                    required: true
                },
                "ihaveread_toggle[]": {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true
                },
                adults: {
                    required: true,
                    integer: true,
                    minvalue: 0
                },
                children: {
                    required: true,
                    integer: true,
                    minvalue: 0
                },
                date_from: {
                    required: true
                },
                date_to: {
                    required: true
                },
                message: {
                    required: true
                }
            },
            messages: {
                "ihaveread[]": {
                    required: "Did you read and understand these policies?"
                },
                "ihaveread_toggle[]": {
                    required: "Did you read and understand these policies?"
                },
                email: {
                    required: "Add your email",
                    email: "Incorrect email format"
                },
                phone: {
                    required: "Add your phone"
                },
                adults: {
                    required: "Field is required",
                    integer: "Only integer allowed",
                    minvalue: "Value not less than 0"
                },
                children: {
                    required: "Field is required",
                    integer: "Only integer allowed",
                    minvalue: "Value not less than 0"
                },
                date_from: {
                    required: "Select check-in date"
                },
                date_to: {
                    required: "Select check-out date"
                },
                message: {
                    required: "Enter your message"
                }
            },
            formType: {
                multistep: true
            }
        });
    });
</script>

<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{asset('bower_components\jquery-slimscroll\js\jquery.slimscroll.js')}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{asset('bower_components\modernizr\js\modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components\modernizr\js\css-scrollbars.js')}}"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="{{asset('bower_components\i18next\js\i18next.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components\jquery-i18next\js\jquery-i18next.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\js\common-pages.js')}}"></script>

<script type="text/javascript" src="{{asset('assets\pages\j-pro\js\j-forms-additions.min.js')}}"></script>


<script src="{{asset('assets\js\pcoded.min.js')}}"></script>
</body>

</html>
