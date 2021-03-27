@extends('templates.templates')

@section('page')
    Tambah <small>
        Sub Kriteria
    </small>
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ route('kriteria') }}">Kriteria</a></li>
    <li><a href="{{ route('sub-kriteria') }}">Sub Kriteria</a></li>
    <li class="active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('sub-kriteria.post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_kriteria">Kriteria </label>
                            <select class="form-control" id="id_kriteria" name="id_kriteria" placeholder="Pilih Kriteria">
                                @foreach ($kriteria as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama </label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukan Nama Kriteria">
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
