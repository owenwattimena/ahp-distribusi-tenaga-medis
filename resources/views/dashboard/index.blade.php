@extends('templates.templates')

@section('page')
    Dashboard <small>{{ \Auth::user()->nama }}</small>
@endsection

@section('path')
    <li class="active">Home</li>
@endsection

@section('content')
    <div class="row">
        @if (\Auth::user()->level == 'admin')

            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="board">
                    <div class="panel panel-primary">
                        <div class="number">
                            <h3>
                                <h3>{{ count($alternatif) }}</h3>
                                <small>Alternatif</small>
                            </h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa fa-user fa-5x red"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="board">
                    <div class="panel panel-primary">
                        <div class="number">
                            <h3>
                                <h3>{{ count($kriteria) }}</h3>
                                <small>Kriteria</small>
                            </h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list fa-5x blue"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="board">
                    <div class="panel panel-primary">
                        <div class="number">
                            <h3>
                                <h3>{{ count($subkriteria) }}</h3>
                                <small>Sub Kriteria</small>
                            </h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list fa-5x green"></i>
                        </div>

                    </div>
                </div>
            </div>
        @elseif(\Auth::user()->level == 'dinkes' || \Auth::user()->level == 'walikota')
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="board">
                    <div class="panel panel-primary">
                        <div class="number">
                            <h3>
                                <h3>{{ count($pukesmas) }}</h3>
                                <small>Puskesmas</small>
                            </h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-hospital-o fa-5x yellow"></i>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="board">
                    <div class="panel panel-primary">
                        <div class="number">
                            <h3>
                                <h3>{{ count($tenagaMedis) }}</h3>
                                <small>Tenaga Medis</small>
                            </h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-hospital-o fa-5x yellow"></i>
                        </div>

                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
