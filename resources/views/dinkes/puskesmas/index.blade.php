@extends('templates.templates')

@section('style')
    <!-- TABLE STYLES-->
    <link href="{{ asset('assets/js/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet" />
    <style>
        .mb-2 {
            margin-bottom: 5px;
        }

    </style>
@endsection

@section('page')
    Data Puskesmas
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Data Puskesmas</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="table" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Puskesmas</th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($puskesmas as $item)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    @if (\Auth::user()->level == 'dinkes')
                                        <a href="{{ route('dinkes.puskesmas.ranking', $item->id) }}"
                                            class="btn btn-success btn-sm rounded-0"><i class="fa fa-eye"></i>
                                            Lihat Ranking
                                        </a>
                                    @endif
                                    <a href="{{ route('dinkes.puskesmas.rekap', $item->id) }}"
                                        class="btn btn-primary btn-sm rounded-0"><i class="fa fa-user"></i>
                                        Rekap Kebutuhan Tenaga Medis
                                    </a>
                                    <a href="{{ route('puskesmas.medis', $item->id) }}"
                                        class="btn btn-default btn-sm rounded-0"><i class="fa fa-user"></i>
                                        Data Tenaga Medis
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- DATA TABLE SCRIPTS -->
    <script src="{{ asset('assets/js/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/dataTables.bootstrap.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').dataTable();
        });

    </script>
@endsection
