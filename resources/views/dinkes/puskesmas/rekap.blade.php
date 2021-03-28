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
    Rekap Tenaga Medis {{ $puskesmas->nama }}
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/puskesmas') }}">Puskesmas</a></li>
    <li class="active">Rekap</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-right" style="margin-bottom:10px">
                <a href="{{ route('dinkes.puskesmas.rekap.tambah', $puskesmas->id) }}"
                    class="btn btn-primary btn-sm rounded-0"><i class="fas fa-user-cog"></i>
                    TAMBAH
                </a>
            </div>
            <div class="table-responsive">
                <table id="table" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            @foreach ($alternatif as $item)
                                <th>{{ $item->alternatif }}</th>
                            @endforeach
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekap as $item)
                            <tr>
                                <td>{{ $item->tahun }}</td>
                                @foreach ($detailRekap->where('id_rekap_distribusi', $item->id) as $item)
                                    <td>{{ $item->jumlah }}</td>
                                @endforeach
                                <td>
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
