@section('template_linked_css')
    <!-- list css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\list-scroll\list.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components\stroll\css\stroll.css')}}">
    @endsection
@role('admin')
@php
    $userCount = \App\Models\User::all()->count();
    $assetCount = \App\Models\Asset::all()->count();
    $licenceCount = \App\Models\Licence::all()->count();
    $sgVpnCount = \App\Models\Sgvpn::all()->count();

    $tagFinder = Illuminate\Support\Facades\DB::table('assets')
    ->select(Illuminate\Support\Facades\DB::raw('YEAR(purchased) as year'),
    Illuminate\Support\Facades\DB::raw('count(id) as counter'),
    )
    ->where('type','Desktop')
    ->where('allocated','Yes')
    ->groupBy(Illuminate\Support\Facades\DB::raw('YEAR(purchased)'),'year')
    ->orderBy('year', 'DESC')
    ->take(7)
    ->get();

    $oldest = Illuminate\Support\Facades\DB::table('assets')
    ->where('type','Laptop')
    ->orWhere('type','Desktop')
    ->orderBy('age', 'DESC')
    ->take(10)
    ->get();

@endphp
@section('content')

                <div class="page-body">
                    <div class="row">
                        <!-- task, page, download counter  start -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">{{$userCount}}</h4>
                                            <h6 class="text-white m-b-0">Registered Users</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-1" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather text-white f-14 m-r-10"></i>Users include all employees</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">{{$assetCount}}</h4>
                                            <h6 class="text-white m-b-0">Assets</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-2" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather text-white f-14 m-r-10"></i>All Whelson assets count</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-pink update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">{{$licenceCount}}</h4>
                                            <h6 class="text-white m-b-0">Licences</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-3" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather text-white f-14 m-r-10"></i>Purchased Licences </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-lite-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">{{$sgVpnCount}}</h4>
                                            <h6 class="text-white m-b-0">SG VPN Users</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-4" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather text-white f-14 m-r-10"></i>Registered SG VPN Users</p>
                                </div>
                            </div>
                        </div>
                        <!-- task, page, download counter  end -->

                        <div class="col-xl-4 col-md-6">
                            <div class="card social-card bg-simple-c-blue">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <i class="feather icon-list f-34 text-c-blue social-icon"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="m-b-0">Backup Sheets</h6>
                                            <p class="m-b-0">Lists the backup sheets for signing off</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url('/backups')}}" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card social-card bg-simple-c-pink">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <i class="feather icon-lock f-34 text-c-pink social-icon"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="m-b-0">SuperGroup VPN</h6>
                                            <p class="m-b-0">Supergroup current user lists ready for printing</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url('/sgvpns')}}" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <div class="card social-card bg-simple-c-green">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <i class="feather icon-wifi f-34 text-c-green social-icon"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="m-b-0">Wireless Access</h6>
                                            <p class="m-b-0">All Whelson Wifi Lists and access information.</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url('/wifis')}}" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Whelson Public IP Addresses</h5>
                                <h6 class="text-danger">ZOL ID - 958</h6>
                            </div>

                        <div class="row card-block">
                            <div class="col-lg-4 col-md-12 ">
                                <h6 class="sub-title">Main Depot</h6>
                                <ul class="basic-list list-icons-img">
                                    <li>
                                        <img src="{{asset('assets\images\powertel_logo.png')}}" class="img-fluid p-absolute d-block text-center" alt="">
                                        <h6>Powertel Last Mile</h6>
                                        <p class="text-danger"> <strong> 196.27.106.70 </strong></p>
                                    </li>
                                    <li>
                                        <h6>LTZ Link</h6>
                                        <img src="{{asset('assets\images\zol_logo.png')}}" class="img-fluid p-absolute d-block text-center" alt="">
                                        <p class="text-danger"> <strong> 197.211.225.50 </strong></p>
                                    </li>
                                    <li>
                                        <h6>Roadgrip</h6>
                                        <img src="{{asset('assets\images\zol_logo.png')}}" class="img-fluid p-absolute d-block text-center" alt="">
                                        <p class="text-danger"> <strong> 197.211.209.127 </strong></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4 col-md-12 ">
                                <h6 class="sub-title">Other Depots</h6>
                                <ul class="basic-list list-icons-img">
                                    <li>
                                        <img src="{{asset('assets\images\zol_logo.png')}}" class="img-fluid p-absolute d-block text-center" alt="">
                                        <h6>Chirundu</h6>
                                        <p class="text-danger"> <strong> 196.27.102.32 </strong></p>
                                    </li>
                                    <li>
                                        <h6>Beitbridge</h6>
                                        <img src="{{asset('assets\images\zol_logo.png')}}" class="img-fluid p-absolute d-block text-center" alt="">
                                        <p class="text-danger"> <strong> 196.27.102.59 </strong></p>
                                    </li>
                                    <li>
                                        <h6>Forbes</h6>
                                        <img src="{{asset('assets\images\powertel_logo.png')}}" class="img-fluid p-absolute d-block text-center" alt="">
                                        <p class="text-danger"> <strong> 154.73.81.164 </strong></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4 col-md-12 ">
                                <h6 class="sub-title">International Depots</h6>
                                <ul class="basic-list list-icons-img">
                                    <li>
                                        <img src="{{asset('assets\images\zol_logo.png')}}" class="img-fluid p-absolute d-block text-center" alt="">
                                        <h6>Beira</h6>
                                        <p class="text-danger"> <strong> 196.40.115.111</strong></p>
                                    </li>
                                    <li>
                                        <h6>DRC</h6>
                                        <img src="{{asset('assets\images\zol_logo.png')}}" class="img-fluid p-absolute d-block text-center" alt="">
                                        <p class="text-danger"> <strong> 41.60.25.222 </strong></p>
                                    </li>
                                    <li>
                                        <h6></h6>
                                        <img src="" class="img-fluid p-absolute d-block text-center" alt="">
                                        <p class="text-danger"> <strong>  </strong></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </div>
                        </div>

                        <!--  sale analytics start -->
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Asset Analysis</h5>
                                    <span>Assets Purchased For the Last 5 years</span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-trash-2 close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div id="area-example"></div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Laptops Analysis</h5>
                                    <span>Laptops Purchased For the Last 5 years</span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-trash-2 close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div id="area-example"></div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Assets Analysis By Age</h5>
                                    <span>10 Oldest Laptops and Desktops with their details</span>

                                </div>
                                <div class="card-block table-border-style">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Age</th>
                                                <th>User</th>
                                                <th>Model</th>
                                                <th>Type</th>
                                                <th>Serial #</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($oldest as $asset)
                                                @php $user = \App\Models\User::where('paynumber', $asset->username)->first();@endphp
                                            <tr>
                                                <th scope="row">{{$asset->age}}</th>
                                                <td>
                                                    @if($user)
                                                    {{$user->first_name}} {{$user->last_name}}
                                                    @endif</td>
                                                <td>{{$asset->model}}</td>
                                                <td>{{$asset->type}}</td>
                                                <td>{{$asset->serial}}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

@endsection

@section('footer_scripts')

    <script type="text/javascript">
        "use strict";
        $(document).ready(function() {

            //lineChart();
            areaChart();
            //donutChart();

            $(window).on('resize',function() {
                window.lineChart.redraw();
                window.areaChart.redraw();
                window.donutChart.redraw();
            });
        });

        /*Area chart*/
        function areaChart() {

            var gore = {!! $tagFinder[0]->year ?: '' !!};
            var kaunta = {!! $tagFinder[0]->counter ?: '' !!};
            var gore1 = {!! $tagFinder[1]->year ?: '' !!};
            var kaunta1 = {!! $tagFinder[1]->counter ?: '' !!};
            var gore2 = {!! $tagFinder[2]->year ?: '' !!};
            var kaunta2 = {!! $tagFinder[2]->counter ?: '' !!};
            var gore3 = {!! $tagFinder[3]->year ?: '' !!};
            var kaunta3 = {!! $tagFinder[3]->counter ?: '' !!};
            var gore4 = {!! $tagFinder[4]->year ?: '' !!};
            var kaunta4 = {!! $tagFinder[4]->counter ?: '' !!};
            var gore5 = {!! $tagFinder[5]->year ?: '' !!};
            var kaunta5 = {!! $tagFinder[5]->counter ?: '' !!};
            var gore6 = {!! $tagFinder[6]->year ?: '' !!};
            var kaunta6 = {!! $tagFinder[6]->counter ?: '' !!};

            window.areaChart = Morris.Area({
                element: 'area-example',
                data: [
                    {year : gore, counter: kaunta},
                    {year : gore1, counter: kaunta1},
                    {year : gore2, counter: kaunta2},
                    {year : gore3, counter: kaunta3},
                    {year : gore4, counter: kaunta4},
                    {year : gore5, counter: kaunta5},
                    {year : gore6, counter: kaunta6},

                ],
                xkey: 'year',
                parseTime: false,
                resize: true,
                redraw: true,
                ykeys: ['counter'],
                labels: ['Desktops'],
                lineColors: ['#93EBDD']
            });
        }

        /*Donut chart*/
        function donutChart() {
            window.areaChart = Morris.Donut({
                element: 'donut-example',
                redraw: true,
                data: [
                    { label: "Download Sales", value: 2 },
                    { label: "In-Store Sales", value: 50 },
                    { label: "Mail-Order Sales", value: 20 }
                ],
                colors: ['#5FBEAA', '#34495E', '#FF9F55']
            });
        }

        // Morris bar chart
        Morris.Bar({
            element: 'morris-bar-chart',
            data: [{
                y: '2006',
                a: 100,
                b: 90,
                c: 60
            }, {
                y: '2007',
                a: 75,
                b: 65,
                c: 40
            }, {
                y: '2008',
                a: 50,
                b: 40,
                c: 30
            }, {
                y: '2009',
                a: 75,
                b: 65,
                c: 40
            }, {
                y: '2010',
                a: 50,
                b: 40,
                c: 30
            }, {
                y: '2011',
                a: 75,
                b: 65,
                c: 40
            }, {
                y: '2012',
                a: 100,
                b: 90,
                c: 40
            }],
            xkey: 'y',
            ykeys: ['a', 'b', 'c'],
            labels: ['A', 'B', 'C'],
            barColors: ['#5FBEAA', '#5D9CEC', '#cCcCcC'],
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            resize: true
        });
        // Extra chart
        Morris.Area({
            element: 'morris-extra-area',
            data: [{
                period: '2010',
                iphone: 0,
                ipad: 0,
                itouch: 0
            }, {
                period: '2011',
                iphone: 50,
                ipad: 15,
                itouch: 5
            }, {
                period: '2012',
                iphone: 20,
                ipad: 50,
                itouch: 65
            }, {
                period: '2013',
                iphone: 60,
                ipad: 12,
                itouch: 7
            }, {
                period: '2014',
                iphone: 30,
                ipad: 20,
                itouch: 120
            }, {
                period: '2015',
                iphone: 25,
                ipad: 80,
                itouch: 40
            }, {
                period: '2016',
                iphone: 10,
                ipad: 10,
                itouch: 10
            }


            ],
            lineColors: ['#fb9678', '#7E81CB', '#01C0C8'],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['Site A', 'Site B', 'Site C'],
            pointSize: 0,
            lineWidth: 0,
            resize: true,
            fillOpacity: 0.8,
            behaveLikeLine: true,
            gridLineColor: '#5FBEAA',
            hideHover: 'auto'

        });

        /*Site visit Chart*/

        Morris.Area({
            element: 'morris-site-visit',
            data: [{
                period: '2010',
                SiteA: 0,
                SiteB: 0,

            }, {
                period: '2011',
                SiteA: 130,
                SiteB: 100,

            }, {
                period: '2012',
                SiteA: 80,
                SiteB: 60,

            }, {
                period: '2013',
                SiteA: 70,
                SiteB: 200,

            }, {
                period: '2014',
                SiteA: 180,
                SiteB: 150,

            }, {
                period: '2015',
                SiteA: 105,
                SiteB: 90,

            }, {
                period: '2016',
                SiteA: 250,
                SiteB: 150,

            }],
            xkey: 'period',
            ykeys: ['SiteA', 'SiteB'],
            labels: ['Site A', 'Site B'],
            pointSize: 0,
            fillOpacity: 0.5,
            pointStrokeColors: ['#b4becb', '#01c0c8'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 0,
            smooth: false,
            hideHover: 'auto',
            lineColors: ['#b4becb', '#01c0c8'],
            resize: true

        });

    </script>
    <script src="{{('assets\js\pcoded.min.js')}}"></script>
    <script src="{{asset('assets\js\jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets\js\SmoothScroll.js')}}"></script>

    @endsection
@endrole
@role('user')
@section('head')
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\data-table\css\buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets\pages\data-table\extensions\select\css\select.dataTables.min.css')}}">

@endsection

@php
    $user = \App\Models\User::where('name', \Illuminate\Support\Facades\Auth::user()->name)->first();
    $assets = \App\Models\Asset::where('username', $user->paynumber)->get();
    $logs = \App\Models\Maintenance::where('username', $user->name)->get();
@endphp

@section('template_linked_css')
    <style>
        div.dataTables_wrapper {
            margin-bottom: 3em;
        }
    </style>

@endsection
@php
    $currentUser = Auth::user()
@endphp

@section('content')

    <div class="page-body">
        <!--profile cover start-->
        <div class="row">
            <div class="col-lg-12">
                <div class="cover-profile">
                    <div class="profile-bg-img">
                        <img class="profile-bg-img img-fluid" src="{{asset('assets\images\user-profile\bg.png')}}" alt="bg-img">
                        <div class="card-block user-info">
                            <div class="col-md-12">
                                <div class="media-left">
                                    @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                        <img src="{{ $user->profile->avatar }}" alt="{{ $user->name }}" class="user-img img-radius">
                                    @else
                                        <div class="user-avatar-nav"></div>
                                    @endif
                                </div>
                                <div class="media-body row">
                                    <div class="col-lg-12">
                                        <div class="user-title">
                                            <div class="well well-lg">
                                                <h2>{{$user->first_name}} {{$user->last_name}}</h2>
                                                <span >{{$user->department}}</span><br>
                                                <span >{{$user->position}}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div>
                                        <div class="pull-right cover-btn">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--profile cover end-->
        <div class="row">
            <div class="col-lg-12">
                <!-- tab header start -->
                <div class="tab-header card">
                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">User Info</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#assets" role="tab">User Assets</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#compliance" role="tab">Maintenance Records</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                </div>
                <!-- tab header end -->
                <!-- tab content start -->
                <div class="tab-content">
                    <!-- tab panel personal start -->
                    <div class="tab-pane active" id="personal" role="tabpanel" >
                        <!-- personal card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">About {{$user->first_name}}</h5>

                            </div>
                            <div class="card-block">
                                <div class="view-info">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="general-info">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xl-6">
                                                        <div class="table-responsive">
                                                            <table class="table m-0">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">Full Name</th>
                                                                    <td>{{$user->first_name}} {{$user->last_name}} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Paynumber</th>
                                                                    <td>{{$user->paynumber}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Department</th>
                                                                    <td>{{$user->department}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Position</th>
                                                                    <td>{{$user->position}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Mobile</th>
                                                                    <td>{{$user->mobile}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- end of table col-lg-6 -->
                                                    <div class="col-lg-12 col-xl-6">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">Email</th>
                                                                    <td><a href="mailto:{{$user->email}}"><span class="__cf_email__">{{$user->email}}</span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Location</th>
                                                                    <td>{{$user->location}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">IP Address</th>
                                                                    <td>{{$user->ip_address}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">On Backup</th>
                                                                    <td>@if($user->backable)Yes @else No @endif</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Password Changed</th>
                                                                    <td>@if($user->backable)Yes on {{$user->pwd_last_changed}} @else No @endif</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- end of table col-lg-6 -->
                                                </div>
                                                <!-- end of row -->
                                            </div>
                                            <!-- end of general info -->
                                        </div>
                                        <!-- end of col-lg-12 -->
                                    </div>
                                    <!-- end of row -->
                                </div>

                            </div>
                            <!-- end of card-block -->
                        </div>
                    </div>
                    <!-- tab pane personal end -->
                    <!-- tab pane info start -->
                    <div class="tab-pane" id="assets" role="tabpanel" >
                        <!-- info card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">{{$user->name}}'s Assets</h5>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="vince-tables" class="table table-striped table-bordered nowrap" >
                                        <thead class="thead">
                                        <tr>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Asset Tag</th>
                                            <th>Serial</th>
                                            <th>Age</th>
                                            <th class="no-search no-sort notexport">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($assets as $asset)
                                            <tr>
                                                <td>{{$asset->model}}</td>
                                                <td>{{$asset->type }}</td>
                                                <td>{{$asset->assettag}}</td>
                                                <td>{{$asset->serial}}</td>
                                                <td>{{$asset->age}}</td>
                                                <td style="white-space: nowrap;">
                                                    <a class="btn btn-success btn-mini" href="{{ URL::to('iassets/' . $asset->id) }}" >
                                                        <i class="feather icon-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- info card end -->
                    </div>
                    <!-- tab pane info end -->
                    <!-- tab pane contact start -->
                    <div class="tab-pane" id="compliance" role="tabpanel" >
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- contact data table card start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-header-text">Maintenance Records</h5>
                                            </div>
                                            <div class="card-block">
                                                <div class="dt-responsive table-responsive">
                                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th>IP Address</th>
                                                            <th>Completed Maintenance</th>
                                                            <th>Monitor</th>
                                                            <th>CPU</th>
                                                            <th>Keyboard</th>
                                                            <th>Mouse</th>
                                                            <th>Desk</th>
                                                            <th>Done On</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($logs as $log)
                                                            <tr>
                                                                <td>{{$log->ip_address}}</td>
                                                                <td>@if($log->all_five) Yes @else No @endif</td>
                                                                <td>@if($log->monitor) Yes @else No @endif</td>
                                                                <td>@if($log->cpu) Yes @else No @endif</td>
                                                                <td>@if($log->keyboard) Yes @else No @endif</td>
                                                                <td>@if($log->mouse) Yes @else No @endif</td>
                                                                <td>@if($log->desk) Yes @else No @endif</td>
                                                                <td>{{$log->created_at}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>IP Address</th>
                                                            <th>Completed Maintenance</th>
                                                            <th>Monitor</th>
                                                            <th>CPU</th>
                                                            <th>Keyboard</th>
                                                            <th>Mouse</th>
                                                            <th>Desk</th>
                                                            <th>Done On</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- contact data table card end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab pane contact end -->
                </div>
                <!-- tab content end -->
            </div>
        </div>
    </div>


    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    <!-- data-table js -->
    <script src="{{asset('bower_components\datatables.net\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\js\jszip.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\js\pdfmake.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\js\vfs_fonts.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\extensions\select\js\dataTables.select.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-responsive\js\dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets\pages\data-table\extensions\select\js\select-custom.js')}}"></script>
    <script>$('#simpletable').DataTable();</script>
@endsection

@endrole
