@extends('templates.templates')

@section('style')
    <!-- TABLE STYLES-->
    <link href="{{ asset('assets/js/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet" />
@endsection

@section('page')
    Data
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Data</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('puskesmas.data.post') }}" method="POST">
                @csrf
                @foreach ($kriteria as $data)
                    <h3 style="margin-bottom: 10px"> {{ $data->nama }} </h3>
                    @foreach ($data->subkriteria as $item)
                        <div class="form-group">
                            <label for="{{ $item->id }}">{{ $item->nama }}</label>
                            <input required type="number" min="0" class="form-control" id="{{ $item->id }}"
                                name="{{ $item->id }}"
                                value="{{ $dataPkm->where('id_subkriteria', $item->id)->first()->nilai ?? 0 }}"
                                placeholder="Masukan {{ $item->nama }}">
                        </div>
                    @endforeach
                @endforeach
                @if (count($kriteria) > 0)
                    <button type="submit" class="btn btn-default">Submit</button>
                @else
                    <p class="text-danger">BELUM ADA DATA!</p>
                @endif
            </form>
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
