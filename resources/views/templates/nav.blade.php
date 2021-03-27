<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        {{-- sistem pendukung keputusan distribusi tenaga medis --}}
        {{-- spek --}}
        @php
            switch (\Auth::user()->level) {
                case 'dinkes':
                    $bg = '#009b4c';
                    break;
                case 'bkd':
                    $bg = '#009b4c';
                    break;
                default:
                    $bg = 'dark';
                    break;
            }
        @endphp
        <a class="navbar-brand" style="background-color: {!! $bg !!}" href="#">
            <strong><i class="icon fa fa-user-md"></i>
                SPK </strong> <small>SIGADIS</small>
        </a>
        <div id="sideNav" href="">
            <i class="fa fa-bars icon"></i>
        </div>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <!-- .dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li class="text-center">
                    <img src="https://ui-avatars.com/api/?name={{ \Auth::user()->nama }}&rounded=true" alt="">
                    <a href=""> {{ \Auth::user()->nama }} </a>
                    <small class="badge badge-success">{{ \Auth::user()->level }}</small>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
    </ul>
    <!-- /.dropdown -->
</nav>
