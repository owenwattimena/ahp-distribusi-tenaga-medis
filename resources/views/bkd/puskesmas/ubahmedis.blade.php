@extends('templates.templates')

@section('style')
    <!-- TABLE STYLES-->
    <link href="{{ asset('assets/js/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet" />
    <style>
        .mb-2 {
            margin-bottom: 5px;
        }

    </style>
@endsection

@section('page')
    Data Puskesmas {{ $puskesmas->nama }}

@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/puskesmas') }}">Puskesmas</a></li>
    <li><a href="{{ route('puskesmas.medis', $puskesmas->id) }}">Tenaga Medis</a></li>
    <li class="active">Ubah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form
                        action="{{ route('puskesmas.medis.put', ['id' => $puskesmas->id, 'idMedis' => $tenagaMedis->id]) }}"
                        method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input required type="text" class="form-control" id="nik" name="nik"
                                value="{{ $tenagaMedis->nik }}" placeholder="NIK">
                            @error('nik')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input required type="text" class="form-control" id="nama" name="nama"
                                value="{{ $tenagaMedis->nama }}" placeholder="Nama">
                            @error('nama')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input required type="text" class="form-control" id="nip" name="nip"
                                value="{{ $tenagaMedis->nip }}" placeholder="NIP">
                            @error('nip')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal lahir</label>
                            <input required type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ $tenagaMedis->tanggal_lahir }}" placeholder="Tanggal lahir">
                            @error('tanggal_lahir')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" placeholder="status" required>
                                <option {{ $tenagaMedis->status == 'PNS' ? 'selected' : '' }} value="PNS">PNS</option>
                                <option {{ $tenagaMedis->status == 'TNI AD' ? 'selected' : '' }} value="TNI AD">TNI AD
                                </option>
                                <option {{ $tenagaMedis->status == 'Kontrak Daerah' ? 'selected' : '' }}
                                    value="Kontrak Daerah">Kontrak Daerah</option>
                                <option {{ $tenagaMedis->status == 'BOK' ? 'selected' : '' }} value="BOK">BOK</option>
                            </select>
                            @error('status')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" placeholder="jenis_kelamin"
                                required>
                                <option {{ $tenagaMedis->jenis_kelamin == 'l' ? 'selected' : '' }} value="l">Laki-laki
                                </option>
                                <option {{ $tenagaMedis->jenis_kelamin == 'p' ? 'selected' : '' }} value="p">Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_tenaga">Jenis tenaga</label>
                            <select class="form-control" id="jenis_tenaga" name="jenis_tenaga" placeholder="jenis_tenaga"
                                required>
                                @foreach ($alternatif as $item)
                                    <option {{ $tenagaMedis->jenis_tanaga == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->alternatif }}</option>
                                @endforeach
                            </select>
                            @error('jenis_tenaga')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor_str">No STR</label>
                            <input required type="text" class="form-control" id="nomor_str" name="nomor_str"
                                value="{{ $tenagaMedis->nomor_str }}" placeholder="No STR">
                            @error('nomor_str')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_awal_str">Tanggal awal STR</label>
                            <input required type="date" class="form-control" id="tanggal_awal_str" name="tanggal_awal_str"
                                value="{{ $tenagaMedis->tanggal_awal_str }}" placeholder="Tanggal awal STR">
                            @error('tanggal_awal_str')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_akhir_str">Tanggal akhir STR</label>
                            <input required type="date" class="form-control" id="tanggal_akhir_str" name="tanggal_akhir_str"
                                value="{{ $tenagaMedis->tanggal_akhir_str }}" placeholder="Tanggal akhir STR">
                            @error('tanggal_akhir_str')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sip">SIP</label>
                            <input required type="text" class="form-control" id="sip" name="sip"
                                value="{{ $tenagaMedis->sip }}" placeholder="SIP">
                            @error('sip')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_sip">Tanggal SIP</label>
                            <input required type="date" class="form-control" id="tanggal_sip" name="tanggal_sip"
                                value="{{ $tenagaMedis->tanggal_sip }}" placeholder="Tanggal SIP">
                            @error('tanggal_sip')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
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
