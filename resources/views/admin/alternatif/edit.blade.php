@extends('templates.templates')

@section('page')
    Ubah <small>
        Jenis Tenaga Medis
    </small>
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ route('alternatif') }}">Jenis Tenaga Medis</a></li>
    <li class="active">Ubah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('alternatif.put', $alternatif->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="alternatif">Alternatif</label>
                            <input type="text" class="form-control" id="alternatif" name="alternatif"
                                value="{{ $alternatif->alternatif }}" placeholder="Masukan alternatif">
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
