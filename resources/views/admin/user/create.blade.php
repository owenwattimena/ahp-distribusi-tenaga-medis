@extends('templates.templates')

@section('page')
    Tambah <small>
        User
    </small>
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ route('user') }}">User</a></li>
    <li class="active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('user.post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input required type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                            @error('nama')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input required type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                            @error('alamat')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control" id="level" name="level" placeholder="Level" required>
                                <option value="admin">Admin</option>
                                <option value="walikota">Walikota</option>
                                <option value="dinkes">Dinas Kesehatan</option>
                                <option value="puskesmas">Puskesmas</option>
                            </select>
                            @error('level')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required type="text" class="form-control" id="username" name="username"
                                placeholder="Username">
                            @error('username')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                            @error('password')
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
