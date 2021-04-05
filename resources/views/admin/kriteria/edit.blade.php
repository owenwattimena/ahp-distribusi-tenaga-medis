@extends('templates.templates')

@section('page')
    Ubah <small>
        Kriteria
    </small>
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ route('kriteria') }}">Kriteria</a></li>
    <li class="active">Ubah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('kriteria.put', $kriteria->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="kode">Kode </label>
                            <input type="text" class="form-control" id="kode" name="kode" value="{{ $kriteria->kode }}"
                                placeholder="Masukan Kode Kriteria" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama </label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $kriteria->nama }}"
                                placeholder="Masukan Nama Kriteria">
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
