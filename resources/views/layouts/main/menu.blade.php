<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
        <div class="sidebar-collapse" style="overflow: hidden; width: auto; height: 100%;">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" src="{{ URL::asset('rams/images/rams_white.png') }}" width="150" />
                        </span>
                        <span class="clear">
                            <span class="block m-t-xs text-white"><strong class="font-bold">{{ Auth::user()->fullname }}</strong></span>
                            <span class="text-xs block text-white">{{ Auth::user()->getFullnameJawatan() }}</span>
                        </span>
                    </div>
                    <div class="logo-element">
                        RA
                    </div>
                </li>
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('dashboard')}}">
                        <span class="pull-left">
                            <i class="fa fa-bar-chart-o"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label menuload">Laman Utama</span>
                        </span>
                    </a>
                </li>
                <li class="border-bottom"></li>

                {{-- Program Menaik Taraf Keselamatan Jalan Raya --}}
                @if(Auth::user()->admin() || Auth::user()->adminjkr())
                <li>
                    <div class="row">
                        <div class="text-center">
                            <span class="simple_tag">PROGRAM MENAIK TARAF<br />KESELAMATAN JALAN RAYA</span>
                        </div>
                    </div>
                </li>

                <li class="{{ (preg_match('/(reportBlackspot)|(dataBlackspot)|(laporanBlackspot)|(laporanPetaBlackspot)/', Request::path()) ? 'active' : '') }}">
                    <a href="#">
                        <span class="pull-left">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label">Black Spot</span> <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('reportBlackspot') ? 'active' : '' }} menuload">
                            <a href="{{ url('reportBlackspot')}}"><i class="fa fa-ellipsis-h"></i>Data</a>
                        </li>
                        <li class="{{ Request::is('dataBlackspot') ? 'active' : '' }} menuload">
                            <a href="{{ url('dataBlackspot')}}"><i class="fa fa-ellipsis-h"></i>Peta Terkini</a>
                        </li>
                        <li class="{{ Request::is('laporanBlackspot') ? 'active' : '' }} menuload">
                            <a href="{{ url('laporanBlackspot')}}"><i class="fa fa-ellipsis-h"></i>Prestasi</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (preg_match('/(reportLampujalan)|(dataLampujalan)|(laporanLampujalan)|(analisisLampujalan)|(laporanPetaLampujalan)/', Request::path()) ? 'active' : '') }}">
                    <a href="#">
                        <span class="pull-left">
                            <i class="fa fa-lightbulb-o"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label">Lampu Jalan</span> <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('reportLampujalan') ? 'active' : '' }} menuload">
                            <a href="{{ url('reportLampujalan')}}"><i class="fa fa-ellipsis-h"></i>Data</a>
                        </li>
                        <li class="{{ Request::is('dataLampujalan') ? 'active' : '' }} menuload">
                            <a href="{{ url('dataLampujalan')}}"><i class="fa fa-ellipsis-h"></i>Peta Terkini</a>
                        </li>
                        <li class="{{ Request::is('analisisLampujalan') ? 'active' : '' }} menuload">
                            <a href="{{ url('analisisLampujalan')}}"><i class="fa fa-ellipsis-h"></i>Analisis Waran</a>
                        </li>
                        <li class="{{ Request::is('laporanLampujalan') ? 'active' : '' }} menuload">
                            <a href="{{ url('laporanLampujalan')}}"><i class="fa fa-ellipsis-h"></i>Prestasi</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (preg_match('/(reportJejantas)|(dataJejantas)|(laporanJejantas)|(analisisJejantas)|(laporanPetaJejantas)/', Request::path()) ? 'active' : '') }}">
                    <a href="#">
                        <span class="pull-left">
                            <i class="fa fa-slack"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label">Jejantas</span> <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('reportJejantas') ? 'active' : '' }} menuload">
                            <a href="{{ url('reportJejantas')}}"><i class="fa fa-ellipsis-h"></i>Data</a>
                        </li>
                        <li class="{{ Request::is('dataJejantas') ? 'active' : '' }} menuload">
                            <a href="{{ url('dataJejantas')}}"><i class="fa fa-ellipsis-h"></i>Peta Terkini</a>
                        </li>
                        <li class="{{ Request::is('analisisJejantas') ? 'active' : '' }} menuload">
                            <a href="{{ url('analisisJejantas')}}"><i class="fa fa-ellipsis-h"></i>Analisis Waran</a>
                        </li>
                        <li class="{{ Request::is('laporanJejantas') ? 'active' : '' }} menuload">
                            <a href="{{ url('laporanJejantas')}}"><i class="fa fa-ellipsis-h"></i>Prestasi</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (preg_match('/(reportLpksi)|(dataLpksi)|(laporanLpksi)|(analisisLpksi)|(laporanPetaLpksi)/', Request::path()) ? 'active' : '') }}">
                    <a href="#">
                        <span class="pull-left">
                            <i class="fa fa-align-justify"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label">LPKSI</span> <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('reportLpksi') ? 'active' : '' }} menuload">
                            <a href="{{ url('reportLpksi')}}"><i class="fa fa-ellipsis-h"></i>Data</a>
                        </li>
                        <li class="{{ Request::is('dataLpksi') ? 'active' : '' }} menuload">
                            <a href="{{ url('dataLpksi')}}"><i class="fa fa-ellipsis-h"></i>Peta Terkini</a>
                        </li>
                        <li class="{{ Request::is('analisisLpksi') ? 'active' : '' }} menuload">
                            <a href="{{ url('analisisLpksi')}}"><i class="fa fa-ellipsis-h"></i>Analisis Waran</a>
                        </li>
                        <li class="{{ Request::is('laporanLpksi') ? 'active' : '' }} menuload">
                            <a href="{{ url('laporanLpksi')}}"><i class="fa fa-ellipsis-h"></i>Prestasi</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (preg_match('/(reportLip)|(dataLip)|(laporanLip)|(analisisLip)|(laporanPetaLip)/', Request::path()) ? 'active' : '') }}">
                    <a href="#">
                        <span class="pull-left">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label">LIP</span> <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('reportLip') ? 'active' : '' }} menuload">
                            <a href="{{ url('reportLip')}}"><i class="fa fa-ellipsis-h"></i>Data</a>
                        </li>
                        <li class="{{ Request::is('dataLip') ? 'active' : '' }} menuload">
                            <a href="{{ url('dataLip')}}"><i class="fa fa-ellipsis-h"></i>Peta Terkini</a>
                        </li>
                        <li class="{{ Request::is('analisisLip') ? 'active' : '' }} menuload">
                            <a href="{{ url('analisisLip')}}"><i class="fa fa-ellipsis-h"></i>Analisis Waran</a>
                        </li>
                        <li class="{{ Request::is('laporanLip') ? 'active' : '' }} menuload">
                            <a href="{{ url('laporanLip')}}"><i class="fa fa-ellipsis-h"></i>Prestasi</a>
                        </li>
                    </ul>
                </li>
                <li class="border-bottom"></li>
                @endif

                {{-- Pengurusan Data --}}
                <li>
                    <div class="row">
                        <div class="text-center">
                            <span class="simple_tag">PENGURUSAN DATA</span>
                        </div>
                    </div>
                </li>

                <li class="{{ (preg_match('/(dataProcess)|(dataKenderaan)|(dataMap)|(dataGMaps)|(testApi)/', Request::path()) ? 'active' : '') }}">
                    <a href="#">
                        <span class="pull-left">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label">Data Kemalangan</span> <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        @if(Auth::user()->admin())
                        <li class="{{ Request::is('dataProcess') ? 'active' : '' }} menuload">
                            <a href="{{ url('dataProcess')}}"><i class="fa fa-ellipsis-h"></i>Proses Data</a>
                        </li>
                        @endif
                        <li class="{{ Request::is('dataMap') ? 'active' : '' }} menuload">
                            <a href="{{ url('dataMap')}}"><i class="fa fa-ellipsis-h"></i>Senarai Data</a>
                        </li>
                        <li class="{{ Request::is('dataGMaps') ? 'active' : '' }} menuload">
                            <a href="{{ url('dataGMaps')}}"><i class="fa fa-ellipsis-h"></i>Peta Data</a>
                        </li>
                        @if(Auth::user()->admin())
                        <li class="{{ Request::is('testApi') ? 'active' : '' }} menuload">
                            <a href="{{ url('testApi')}}"><i class="fa fa-ellipsis-h"></i>Raw Api Test</a>
                        </li>
                        @endif
                    </ul>
                </li>

                <li class="{{ (preg_match('/(dataKenderaan)/', Request::path()) ? 'active' : '') }}">
                    <a href="{{ url('dataKenderaan')}}">
                        <span class="pull-left">
                            <i class="fa fa-car"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label menuload">Data Kenderaan</span>
                        </span>
                    </a>
                </li>

                <li class="{{ (preg_match('/(dataJalan)/', Request::path()) ? 'active' : '') }}">
                    <a href="{{ url('dataJalan')}}">
                        <span class="pull-left">
                            <i class="fa fa-road"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label menuload">Data Jalan</span>
                        </span>
                    </a>
                </li>
                <li class="border-bottom"></li>

                {{-- Laporan --}}
                <li>
                    <div class="row">
                        <div class="text-center">
                            <span class="simple_tag">LAPORAN</span>
                        </div>
                    </div>
                </li>

                <li class="{{ (preg_match('/(laporanAwalan)/', Request::path()) ? 'active' : '') }}">
                    <a href="{{ url('laporanAwalan')}}">
                        <span class="pull-left">
                            <i class="fa fa-file-text-o"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label menuload">Laporan Awalan</span>
                        </span>
                    </a>
                </li>

                @if(Auth::user()->admin() || Auth::user()->adminjkr())
                <li class="{{ (preg_match('/(laporanForensik)/', Request::path()) ? 'active' : '') }}">
                    <a href="{{ route('forensik.laporanForensik')}}">
                        <span class="pull-left">
                            <i class="fa fa-files-o"></i>
                        </span>
                        <span class="clear">
                            Laporan Forensik
                        </span>
                    </a>
                </li>
                @endif
                <li class="border-bottom"></li>

                {{-- Pengurusan Pengguna --}}

                @if(!Auth::user()->pengguna())
                <li>
                    <div class="row">
                        <div class="text-center">
                            <span class="simple_tag">PENGURUSAN PENGGUNA</span>
                        </div>
                    </div>
                </li>

                <li class="{{ (preg_match('/(user)/', Request::path()) ? 'active' : '') }}">
                    <a href="{{ url('userUser')}}">
                        <span class="pull-left">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label menuload">Pengguna</span>
                        </span>
                    </a>
                </li>
                @if(Auth::user()->admin())
                <li class="{{ (preg_match('/(department)/', Request::path()) ? 'active' : '') }}">
                    <a href="{{ url('department')}}">
                        <span class="pull-left">
                            <i class="fa fa-briefcase"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label menuload">Bahagian</span>
                        </span>
                    </a>
                </li>

                <li class="{{ (preg_match('/(userRole)/', Request::path()) ? 'active' : '') }}">
                    <a href="{{ url('userRole')}}">
                        <span class="pull-left">
                            <i class="fa fa-suitcase"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label menuload">Peranan</span>
                        </span>
                    </a>
                </li>
                @endif
                <li class="border-bottom"></li>	
                @endif

                {{-- Sokongan --}}
                <li>
                    <div class="row">
                        <div class="text-center">
                            <span class="simple_tag">SOKONGAN</span>
                        </div>
                    </div>
                </li>

                <li class="{{ (preg_match('/(user)/', Request::path()) ? 'active' : '') }}">
                    <a href="{{ url('userManual')}}">
                        <span class="pull-left">
                            <i class="fa fa-file-pdf-o"></i>
                        </span>
                        <span class="clear">
                            <span class="nav-label menuload">Manual Pegguna</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>