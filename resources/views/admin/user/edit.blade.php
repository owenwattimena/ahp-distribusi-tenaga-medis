@extends('templates.templates')

@section('page')
    Ubah <small>
        User
    </small>
@endsection

@section('path')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ route('user') }}">User</a></li>
    <li class="active">Ubah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('user.put', $user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input required type="text" class="form-control" id="nama" value="{{ $user->nama }}"
                                name="nama" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input required type="text" class="form-control" id="alamat" value="{{ $user->alamat }}"
                                name="alamat" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control" id="level" name="level" placeholder="Level" required>
                                <option {{ $user->level == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                                <option {{ $user->level == 'dinkes' ? 'selected' : '' }} value="dinkes">Dinas Kesehatan
                                </option>
                                <option {{ $user->level == 'bkd' ? 'selected' : '' }} value="bkd">Badan Kepegawaian Daerah
                                </option>
                                <option {{ $user->level == 'puskesmas' ? 'selected' : '' }} value="puskesmas">Puskesmas
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required type="text" class="form-control" id="username" value="{{ $user->username }}"
                                name="username" placeholder="Username">
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('user.password', $user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required type="password" class="form-control" id="password" name="password"
                                placeholder="password">
                        </div>
                        <div class="form-group">
                            <label for="password_baru">Password Baru</label>
                            <input required type="password" class="form-control" id="password_baru" name="password_baru"
                                placeholder="Password Baru">
                        </div>
                        <div class="form-group">
                            <label for="password_baru_confirmation">Password Lama</label>
                            <input required type="password" class="form-control" id="password_baru_confirmation"
                                name="password_baru_confirmation" placeholder="Konfirmasi Password">
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
