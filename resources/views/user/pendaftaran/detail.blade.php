@extends('layouts.user.master')

@section('content')
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pendaftaran_rt_rw') }}">Pendaftaran RT/RW</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pendaftaran</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Detail Pendaftaran</h5>
        </div>
        <div class="card-body justify-content-center">
            <form action="{{ route('pendaftaran_rt_rw.update_user', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <label class="col-form-label" for="nama_lengkap">Nama Lengkap:</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan Nama Lengkap"
                            value="{{ $pendaftaran->nama_lengkap }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-2">
                        <label class="col-form-label" for="tempat_lahir">Tempat Lahir:</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir"
                            value="{{ $pendaftaran->tempat_lahir }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label" for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                            value="{{ $pendaftaran->tanggal_lahir }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <label class="col-form-label" for="jenis_kelamin">Jenis Kelamin:</label>
                        <input type="text" name="jenis_kelamin" class="form-control"
                            value="{{ $pendaftaran->jenis_kelamin }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <label class="col-form-label" for="telpon">Nomor Telepon:</label>
                        <input type="text" name="telpon" class="form-control" placeholder="08xxxxxxxxxx"
                            value="{{ $pendaftaran->telpon }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-2">
                        <label class="col-form-label" for="pendidikan">Pendidikan Terakhir:</label>
                        <input type="text" name="pendidikan" class="form-control"
                            placeholder="Masukan Pendidikan Terakhir" value="{{ $pendaftaran->pendidikan }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-2">
                        <label class="col-form-label" for="pekerjaan">Pekerjaan:</label>
                        <input type="text" name="pekerjaan" class="form-control" placeholder="Masukan Pekerjaan"
                            value="{{ $pendaftaran->pekerjaan }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label" for="berkas">Berkas:</label>
                        <div class="d-flex align-items-center">
                            @if ($pendaftaran->berkas)
                                <a href="{{ asset('storage/berkas/' . $pendaftaran->berkas) }}" target="_blank"
                                    class="mr-2">{{ $pendaftaran->berkas }}</a>
                            @else
                                <span>Tidak ada berkas</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('pendaftaran_rt_rw') }}" class="btn btn-primary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
