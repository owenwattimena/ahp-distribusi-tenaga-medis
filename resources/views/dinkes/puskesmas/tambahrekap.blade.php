@extends('templates.templates')

@section('page')
    Tambah <small>
        Rekap Kebutuhan Tenaga Medis {{ $puskesmas->nama }}
    </small>
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ route('dinkes.puskesmas') }}">Puskesmas</a></li>
    <li><a href="{{ route('dinkes.puskesmas.rekap', $puskesmas->id) }}">Rekap</a></li>
    <li class="active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('dinkes.puskesmas.rekap.post', $puskesmas->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun" required>
                            @error('tahun')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        @foreach ($alternatif as $item)

                            <div class="form-group">
                                <label for="{{ $item->id }}">{{ $item->alternatif }} </label>
                                <input type="number" min="0" value="0" class="form-control" id="{{ $item->id }}"
                                    name="{{ $item->id }}" placeholder="Masukan jumlah {{ $item->alternatif }}"
                                    required>
                                @error($item->id)
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                        @endforeach
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
