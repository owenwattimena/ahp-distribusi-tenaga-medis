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
            @if (\Auth::user()->level == 'dinkes')
                <div class="text-right" style="margin-bottom:10px">
                    <a href="{{ route('dinkes.puskesmas.rekap.tambah', $puskesmas->id) }}"
                        class="btn btn-primary btn-sm rounded-0"><i class="fas fa-user-cog"></i>
                        TAMBAH
                    </a>
                </div>
            @endif
            <div class="table-responsive">
                <table id="table" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            @foreach ($alternatif as $item)
                                <th>{{ $item->alternatif }}</th>
                            @endforeach
                            @if (\Auth::user()->level == 'dinkes')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekap as $item1)
                            <tr>
                                <td>{{ $item1->tahun }}</td>
                                @foreach ($detailRekap->where('id_rekap_distribusi', $item1->id) as $item2)
                                    <td>{{ $item2->jumlah }}</td>
                                @endforeach
                                @if (\Auth::user()->level == 'dinkes')
                                    <td>
                                        <form
                                            action="{{ route('dinkes.puskesmas.rekap.delete', ['id' => $puskesmas->id, 'idRekap' => $item1->id]) }}"
                                            method="POST" style="display: inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-0"
                                                onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                    class="fas fa-user-cog"></i>
                                                HAPUS
                                            </button>
                                        </form>
                                    </td>
                                @endif
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
