<div id="page-wrapper">
    <div class="header">
        <h1 class="page-header">
            @yield('page')
        </h1>
        <ol class="breadcrumb">
            @yield('path')
        </ol>

    </div>
    <div id="page-inner">
        @if (session('pesan'))
            <div class="alert {!! session('tipe') !!} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                {!! session('pesan') !!}
            </div>
        @endif

        @yield('content')


        <footer>
            <p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez.com</a></p>
        </footer>
    </div>
    <!-- /. PAGE INNER  -->
</div>
