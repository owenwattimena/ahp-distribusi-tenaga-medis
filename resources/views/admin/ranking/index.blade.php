@extends('templates.templates')

@section('style')
    <!-- TABLE STYLES-->
    <link href="{{ asset('assets/js/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet" />
@endsection

@section('page')
    Ranking
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Ranking</li>
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
                                    <a href="{{ route('ranking.show', $item->id) }}"
                                        class="btn btn-success btn-sm rounded-0"><i class="fa fa-eye"></i>
                                        Lihat Ranking
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
