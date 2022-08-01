@role('admin')
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ (Request::is('home') || Request::is('home')) ? 'active' : null }}">
                <a href="{{url('/home')}}" >
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('iassets','desktops','desktops/*','laptops','laptops/*','harddrives','harddrives/*','printers','printers/*','aothers','aothers/*', 'iassets/*', 'iassets/*/edit','assetsreport')  ? 'pcoded-trigger' : null }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-airplay"></i></span>
                    <span class="pcoded-mtext">Assets</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" pcoded-hasmenu {{ Request::is('iassets', 'iassets/*', 'iassets/*/edit', 'iassets/deleted', 'iassets/deleted/*','assetsreport')  ? 'pcoded-trigger' : null }} {{ Request::is('iassets', 'iassets/*/edit') ? 'active' : null }}">
                        <a href="javascript:void(0)">
                            <span class="pcoded-mtext">All Assets</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{ Request::is('iassets', 'iassets/*/edit') ? 'active' : null }}">
                                <a href="{{url('/iassets')}}">
                                    <span class="pcoded-mtext">Assets List</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('assetsreport') ? 'active' : null }}">
                                <a href="{{url('/assetsreport')}}">
                                    <span class="pcoded-mtext">Assets Report</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('iassets/deleted', 'iassets/deleted/*') ? 'active' : null }}">
                                <a href="{{url('/iassets/deleted')}}">
                                    <span class="pcoded-mtext">Deleted Assets</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('desktops', 'desktops/*/edit', 'desktops/*') ? 'active' : null }}">
                        <a href="{{url('/desktops')}}" >
                            <span class="pcoded-mtext">Desktops</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('laptops', 'laptops/*/edit', 'laptops/*') ? 'active' : null }}">
                        <a href="{{url('/laptops')}}" >
                            <span class="pcoded-mtext">Laptops</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('nonlaptops', 'nonlaptops/*/edit', 'nonlaptops/*') ? 'active' : null }}">
                        <a href="{{url('/nonlaptops')}}" >
                            <span class="pcoded-mtext">Non Allocated Laptops</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('nondesktops', 'nondesktops/*/edit', 'nondesktops/*') ? 'active' : null }}">
                        <a href="{{url('/nondesktops')}}" >
                            <span class="pcoded-mtext">Non Allocated Desktops</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('harddrives', 'harddrives/*/edit', 'harddrives/*') ? 'active' : null }}">
                        <a href="{{url('/harddrives')}}" >
                            <span class="pcoded-mtext">Hard drives</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('printers', 'printers/*/edit', 'printers/*') ? 'active' : null }}">
                        <a href="{{url('/printers')}}" >
                            <span class="pcoded-mtext">Printers</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('aothers', 'aothers/*/edit', 'aothers/*') ? 'active' : null }}">
                        <a href="{{url('/aothers')}}" >
                            <span class="pcoded-mtext">Other</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('sgvpns','sgvpns/*','sophosvpns','sophosvpns/*','zamaccounts','zamaccounts/*','licences','licences/*')  ? 'pcoded-trigger' : null }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-codepen"></i></span>
                    <span class="pcoded-mtext">Software</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('sgvpns', 'sgvpns/*/edit', 'sgvpns/*') ? 'active' : null }}">
                        <a href="{{url('sgvpns')}}">
                            <span class="pcoded-mtext">SG VPN</span>
                        </a>
                    </li><li class="{{ Request::is('sophosvpns', 'sophosvpns/*/edit', 'sophosvpns/*') ? 'active' : null }}">
                        <a href="{{url('sophosvpns')}}">
                            <span class="pcoded-mtext">Sophos VPN</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('beitaccounts', 'beitaccounts/*/edit', 'beitaccounts/*') ? 'active' : null }}">
                        <a href="{{url('beitaccounts')}}">
                            <span class="pcoded-mtext">Beit O365</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('hreaccounts', 'hreaccounts/*/edit', 'hreaccounts/*') ? 'active' : null }}">
                        <a href="{{url('hreaccounts')}}">
                            <span class="pcoded-mtext">HRE O365</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('zamaccounts', 'zamaccounts/*/edit', 'zamaccounts/*') ? 'active' : null }}">
                        <a href="{{url('zamaccounts')}}">
                            <span class="pcoded-mtext">ZAM O365</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('licences', 'licences/*/edit', 'licences/*') ? 'active' : null }}">
                        <a href="{{url('licences')}}">
                            <span class="pcoded-mtext">Licences</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('noncompliant','maintenances','maintenances/*','backups','backups/*','wifis','wifis/*')  ? 'pcoded-trigger' : null }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-zap"></i></span>
                    <span class="pcoded-mtext">Maintenance</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('maintenances', 'maintenances/*/edit', 'maintenances/*') ? 'active' : null }}">
                        <a href="{{url('maintenances')}}">
                            <span class="pcoded-mtext">Maintenance Logs</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('noncompliant') ? 'active' : null }}">
                        <a href="{{url('noncompliant')}}">
                            <span class="pcoded-mtext">Maintenance Non-Compliant Users</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('backups', 'backups/*/edit', 'backups/*') ? 'active' : null }}">
                        <a href="{{url('backups')}}">
                            <span class="pcoded-mtext">Backup Sheets</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('wifis', 'wifis/*/edit', 'wifis/*') ? 'active' : null }}">
                        <a href="{{url('wifis')}}">
                            <span class="pcoded-mtext">Wifi Access</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Entities</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('users','users/create', 'users/*', 'users/*/edit')  ? 'pcoded-trigger' : null }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-package"></i></span>
                    <span class="pcoded-mtext">Users</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('users', 'users/*/edit','users/*') ? 'active' : null }}">
                        <a class="" href="{{ url('/users') }}">
                            <span class="pcoded-mtext">Users</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('users/create') ? 'active' : null }}">
                        <a href="{{ url('/users/create') }}">
                            <span class="pcoded-mtext">Add User</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('users/deleted') ? 'active' : null }}">
                        <a href="{{ url('/users/deleted') }}">
                            <span class="pcoded-mtext">Deleted Users</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('departments','departments/create', 'departments/*', 'departments/*/edit')  ? 'pcoded-trigger' : null }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                    <span class="pcoded-mtext">Departments</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('departments', 'departments/*/edit') ? 'active' : null }}">
                        <a href="{{url('/departments')}}">
                            <span class="pcoded-mtext">Departments</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('departments/create') ? 'active' : null }}">
                        <a href="{{url('/departments/create')}}">
                            <span class="pcoded-mtext">Add Department</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('jobtitles','jobtitles/create', 'jobtitles/*', 'jobtitles/*/edit')  ? 'pcoded-trigger' : null }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-briefcase"></i></span>
                    <span class="pcoded-mtext">Job Titles</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('jobtitles', 'jobtitles/*/edit') ? 'active' : null }}">
                        <a href="{{url('/jobtitles')}}">
                            <span class="pcoded-mtext">Job Titles</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('jobtitles/create') ? 'active' : null }}">
                        <a href="{{url('/jobtitles/create')}}">
                            <span class="pcoded-mtext">Add Job Title</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('brands','brands/create', 'brands/*', 'brands/*/edit')  ? 'pcoded-trigger' : null }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-award"></i></span>
                    <span class="pcoded-mtext">Brands</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('brands', 'brands/*/edit') ? 'active' : null }}">
                        <a href="{{ url('/brands') }}">
                            <span class="pcoded-mtext">Brands</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('brands/create') ? 'active' : null }}">
                        <a href="{{ url('/brands/create') }}">
                            <span class="pcoded-mtext">Add Brand</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">System Items</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-settings"></i></span>
                    <span class="pcoded-mtext">Admin</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a class="{{ (Request::is('roles') || Request::is('permissions')) ? 'active' : null }}" href="{{ route('laravelroles::roles.index') }}">
                            <span class="pcoded-mtext">{!! trans('titles.laravelroles') !!}</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a class="{{ Request::is('logs') ? 'active' : null }}" href="{{ url('/logs') }}">
                            <span class="pcoded-mtext">{!! trans('titles.adminLogs') !!}</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a class="{{ Request::is('activity') ? 'active' : null }}" href="{{ url('/activity') }}">
                            <span class="pcoded-mtext">{!! trans('titles.adminActivity') !!}</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a class="{{ Request::is('phpinfo') ? 'active' : null }}" href="{{ url('/phpinfo') }}">
                            <span class="pcoded-mtext">{!! trans('titles.adminPHP') !!}</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a class="{{ Request::is('routes') ? 'active' : null }}" href="{{ url('/routes') }}">
                            <span class="pcoded-mtext">{!! trans('titles.adminRoutes') !!}</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a class="{{ Request::is('active-users') ? 'active' : null }}" href="{{ url('/active-users') }}">
                            <span class="pcoded-mtext">{!! trans('titles.activeUsers') !!}</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a class="{{ Request::is('blocker') ? 'active' : null }}" href="{{ route('laravelblocker::blocker.index') }}">
                            <span class="pcoded-mtext">{!! trans('titles.laravelBlocker') !!}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
        <li class="pcoded">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        </ul>
    </div>
</nav>
@endrole

@role('user')
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ (Request::is('home') || Request::is('home')) ? 'active' : null }}">
                <a href="{{url('/home')}}" >
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                    <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                    <span class="pcoded-mtext">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
@endrole
