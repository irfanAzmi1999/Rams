<nav class="navbar navbar-fixed-top white-bg" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#"><i class="fa fa-bars"></i> </a>
        <span>
            <img alt="RAMS" src="{{ URL::asset('rams/images/rams_h60.png') }}" height="60" />
        </span>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <a href="{{url('userprofile')}}"><button class="label label-primary text-lg" >{{ Auth::user()->fullname }}</button></a>
        </li>			@if(Auth::user()->admin())
        <!-- 			<li> -->
        <!-- 				<a class="right-sidebar-toggle" href="userAccess">Akses</a> -->
        <!--             </li> -->
        <li>
            <a class="right-sidebar-toggle" data-toggle="dropdown">
                Senggara
                <i class="fa fa-gear"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages dropdown-menu-right">
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="audit">
                            Audit
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="arah">
                            Arah
                        </a>
                    </div>
                </li>
                <li class="dropdown-divider"></li>
                <!--
                                                        <li>
                                                                <div class="dropdown-messages-box">
                                                                        <a class="dropdown-item float-left" href="department">
                                                                                Bahagian
                                                                        </a>
                                                                </div>
                                                        </li>
                -->
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="balai">
                            Balai
                        </a>
                    </div>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="bentukJalan">
                            Bentuk Jalan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="bulan">
                            Bulan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="cahaya">
                            Cahaya
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="cuaca">
                            Cuaca
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="daerah">
                            Daerah
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="hadLaju">
                            Had Laju
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="hari">
                            Hari
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="jenisBahuJalan">
                            Jenis Bahu Jalan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="jenisGaris">
                            Jenis Garis
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="jenisJalan">
                            Jenis Jalan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="jenisKawalan">
                            Jenis Kawalan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="jenisKawasan">
                            Jenis Kawasan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="jenisKemalangan">
                            Jenis Kemalangan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="jenisLanggarPertama">
                            Jenis Langgar Pertama
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="jenisPermukaan">
                            Jenis Permukaan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="jenisTempat">
                            Jenis Tempat
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="keadaanJalan">
                            Keadaan Jalan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="kualitiPermukaan">
                            Kualiti Permukaan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="langgarLari">
                            Langgar Lari
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="mukaJalan">
                            Muka Jalan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="negeri">
                            Negeri
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="sebabBinatang">
                            Sebab Binatang
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="sebabCacatJalan">
                            Sebab Cacat Jalan
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="sistemLaluan">
                            Sistem Laluan
                        </a>
                    </div>
                </li>
            </ul>
        </li>
        @endif
        |
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> Log Keluar
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>