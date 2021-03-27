@extends('templates.templates')

@section('page')
    Tambah <small>
        Alternatif
    </small>
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ route('alternatif') }}">Alternatif</a></li>
    <li class="active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('alternatif.post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="alternatif">Alternatif</label>
                            <input type="text" class="form-control" id="alternatif" name="alternatif"
                                placeholder="Masukan Alternatif">
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
