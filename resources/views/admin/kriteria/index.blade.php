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
    Kriteria
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Kriteria</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="table" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>
                                <a href="{{ route('kriteria.tambah') }}" class="btn btn-primary btn-sm rounded-0"><i
                                        class="fas fa-user-cog"></i>
                                    TAMBAH
                                </a>
                            </th>
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
                                    <a href="{{ route('kriteria.ubah', $data->id) }}"
                                        class="btn btn-warning btn-sm rounded-0"><i class="fas fa-user-cog"></i>
                                        UBAH
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm rounded-0"
                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                            class="fas fa-user-cog"></i>
                                        HAPUS
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
