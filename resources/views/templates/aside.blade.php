a<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a class="{{ request()->is('/') ? 'active-menu ' : '' }}" href="{{ url('/') }}"><i
                        class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            @switch(\Auth::user()->level)
                @case("admin")

                <li>
                    <a class="{{ request()->is('alternatif') || request()->is('sub-kriteria') || request()->is('kriteria') || request()->is('matrix') || request()->is('ranking') ? 'active-menu ' : '' }}"
                        href="#"><i class="fa fa-sitemap"></i> AHP<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('kriteria') }}"
                                class="{{ request()->is('kriteria') ? 'active-menu' : '' }}">Kriteria</a>
                        </li>
                        <li>
                            <a href="{{ route('sub-kriteria') }}"
                                class="{{ request()->is('sub-kriteria') ? 'active-menu' : '' }}">Sub Kriteria</a>
                        </li>
                        <li>
                            <a href="{{ route('alternatif') }}"
                                class="{{ request()->is('alternatif') ? 'active-menu' : '' }}">Alternatif</a>
                        </li>
                        <li>
                            <a href="{{ route('matrix') }}"
                                class="{{ request()->is('matrix') ? 'active-menu' : '' }}">Matrix
                                Perbandingan</a>
                        </li>
                        <li>
                            <a href="{{ route('ranking') }}"
                                class="{{ request()->is('ranking') ? 'active-menu' : '' }}">Hasil
                                Perengkingan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{{ request()->is('user') ? 'active-menu ' : '' }}" href="{{ url('/user') }}"><i
                            class="fa fa-user"></i> User</a>
                </li>

                @break
                @case("puskesmas")
                <li>
                    <a class="{{ request()->is('data') ? 'active-menu ' : '' }}"
                        href="{{ route('puskesmas.data') }}"><i class="fa fa-archive"></i> Data Puskesmas</a>
                </li>
                @break
                @case("dinkes")
                <li>
                    <a class="{{ request()->is('prioritas') || request()->is('prioritas/*') ? 'active-menu ' : '' }}"
                        href="{{ route('dinkes.prioritas') }}"><i class="fa fa-archive"></i> Data Nilai Prioritas</a>
                </li>
                @break
                @case("bkd")
                <li>
                    <a class="{{ request()->is('puskesmas') ? 'active-menu ' : '' }}"
                        href="{{ route('puskesmas') }}"><i class="fa fa-archive"></i> Data Puskesmas</a>
                </li>
                @break
                @default

            @endswitch


        </ul>

    </div>

</nav>
