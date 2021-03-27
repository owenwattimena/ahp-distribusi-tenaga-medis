@extends('templates.templates')

@section('page')
    Tambah <small>
        Kriteria
    </small>
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ route('kriteria') }}">Kriteria</a></li>
    <li class="active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('kriteria.post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kode">Kode </label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                placeholder="Masukan Kode Kriteria">
                            @error('kode')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama </label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukan Nama Kriteria">
                            @error('nama')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
