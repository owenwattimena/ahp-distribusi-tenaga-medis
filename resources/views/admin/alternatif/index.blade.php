@extends('templates.templates')

@section('style')
    <!-- TABLE STYLES-->
    <link href="{{ asset('assets/js/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet" />
@endsection

@section('page')
    Alternatif
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Alternatif</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="table" class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Alternatif</th>
                            <th>
                                <a href="{{ route('alternatif.tambah') }}" class="btn btn-primary btn-sm rounded-0"><i
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
                        @foreach ($alternatif as $data)

                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $data->alternatif }}</td>
                                <td>
                                    <a href="{{ route('alternatif.ubah', $data->id) }}"
                                        class="btn btn-warning btn-sm rounded-0"><i class="fas fa-user-cog"></i>
                                        UBAH
                                    </a>
                                    <form action="{{ route('alternatif.delete', $data->id) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-0"
                                            onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                class="fas fa-user-cog"></i>
                                            HAPUS
                                        </button>
                                    </form>

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
