@extends('templates.templates')

@section('style')
    <!-- TABLE STYLES-->
    <link href="{{ asset('assets/js/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet" />
@endsection

@section('page')
    Matrix Perbandingan
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Matrix Perbandingan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="table" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>kode</th>
                            <th>Kriteria</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($kriteria as $data)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $data->kode }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>
                                    <a href="{{ route('matrix.show', $data->id) }}"
                                        class="btn btn-primary btn-sm rounded-0"><i class="fas fa-user-cog"></i>
                                        Input Nilai Matrix
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
