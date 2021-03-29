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
    Data Tenaga Medis
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Tenaga Medis</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">


            <div class="table-responsive">
                <table id="table" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>NIP</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Status</th>
                            <th>Jenis Kelamin</th>
                            <th>Jenis Tenaga</th>
                            <th>Nomor STR</th>
                            <th>Masa Berlaku STR</th>
                            <th>SIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($tenagaMedis as $item)
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nip }}</td>
                            <td>{{ $item->tanggal_lahir }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $item->alternatif->alternatif }}</td>
                            <td>{{ $item->nomor_str }}</td>
                            <td>{{ $item->tanggal_awal_str }} s/d {{ $item->tanggal_akhir_str }}</td>
                            <td>{{ $item->sip }}</td>
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
