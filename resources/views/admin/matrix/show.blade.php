@extends('templates.templates')

@section('style')
    <style>
        table tr th,
        table tr td {
            text-align: center !important;
        }

        .border {
            border: 1px green dashed!important;
            margin-top: 10px;
            padding: 10px;
        }

    </style>
@endsection

@section('page')
    Matrix Perbandingan
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/matrix') }}">Matrix Perbandingan</a></li>
    <li class="active">Input Nilai</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $kriteria->nama }} ({{ $kriteria->kode }})</h1>
        </div>
        <div class="col-md-12" style="margin-top:18px">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <form action="{{ route('matrix.post', $kriteria->id) }}" method="POST" class="form-inline">
                            @csrf
                            <div class="form-group">
                                <label for="baris">Baris</label>
                                <select class="form-control" id="baris" name="baris">
                                    @foreach ($alternatif as $item)
                                        <option value="{{ $item->id }}">{{ $item->alternatif }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kolom">Kolom</label>
                                <select class="form-control" id="kolom" name="kolom">
                                    @foreach ($alternatif as $item)
                                        <option value="{{ $item->id }}">{{ $item->alternatif }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kolom">Bobot</label>
                                <select class="form-control" id="kolom" name="bobot">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th class="bg-success">{{ $kriteria->nama }}</th>
                                    @foreach ($alternatif as $item)
                                        <th class="bg-primary">{{ $item->alternatif }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $key1 => $item1)
                                    <tr>
                                        <th class="bg-primary">{{ $item1->alternatif }}</th>
                                        {{-- @foreach ($alternatif as $item2)
                                        <td>{{ $matrices->where('baris', $item1->id)->where('kolom', $item2->id)->first()->bobot ?? 1 }}
                                        </td>
                                    @endforeach --}}
                                        @foreach ($matrix[$key1] as $key2 => $item2)
                                            <td>{{ $item2 }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfood>
                                <tr>
                                    <th class="bg-success">JUMLAH</th>
                                    @foreach ($total_matrix as $item)
                                        <th class="bg-default">{{ $item }}</th>
                                    @endforeach
                                </tr>
                            </tfood>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th class="bg-success">Nilai Eigen</th>
                                    @foreach ($alternatif as $item)
                                        <th class="bg-warning">{{ $item->alternatif }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $key1 => $item1)
                                    <tr>
                                        <th class="bg-warning">{{ $item1->alternatif }}</th>
                                        @foreach ($nilai_eigen[$key1] as $key2 => $item2)
                                            <td>{{ $item2 }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th class="bg-warning">{{ $kriteria->nama }}</th>
                                    <th class="bg-success">Jumlah</th>
                                    <th class="bg-success">Prioritas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatif as $key => $item)
                                    <tr>
                                        <th class="bg-success">{{ $item->alternatif }}</th>
                                        <td>{{ $jumlah_eigen[$key] }}</td>
                                        <td>{{ $prioritas[$key] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfood>
                                <tr>
                                    <th class="bg-success">Jumlah</th>
                                    <th class="bg-success">
                                        {{ collect($jumlah_eigen)->sum() }}
                                    </th>
                                    <th class="bg-success">
                                        {{ collect($prioritas)->sum() }}
                                    </th>
                                </tr>
                            </tfood>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th class="bg-warning">Alternatif</th>
                                <th class="bg-success">Peringkat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($sort as $key => $item)
                                <tr>
                                    <td>{{ $item['alternatif'] }}</td>
                                    <th>{{ ++$no }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-body">
                    <h1>Konsistensi</h1>
                    <div class="border {!! $konsistensi['ci'] > 0.1 ? 'bg-danger' : 'bg-success' !!}">
                        {!! $konsistensi['ci'] > 0.1 ? '<small class="text-danger">Tidak Konsisten</small>' : '<small class="text-success">Konsisten</small>' !!}
                        <h4>CI = {{ $konsistensi['ci'] }} </h4>
                    </div>

                    <div class="border {!! $konsistensi['cr'] > 0.1 ? 'bg-danger' : 'bg-success' !!}">
                        {!! $konsistensi['cr'] > 0.1 ? '<small class="text-danger">Tidak Konsisten</small>' : '<small class="text-success">Konsisten</small>' !!}
                        <h4>CR = {{ $konsistensi['cr'] }} </h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
