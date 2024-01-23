@extends('layouts.user.master')

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pendaftaran_rt_rw') }}">Pendaftaran RT/RW</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Jadi Calon RT/RW</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Daftar Jadi Calon RT/RW</h5>
        </div>
        <div class="card-body justify-content-center">
            <form action="{{ route('pendaftaran_rt_rw.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <label class="col-form-label" for="nama_lengkap">Nama Lengkap:</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan Nama Lengkap"
                            value="{{ old('nama_lengkap') }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-2">
                        <label class="col-form-label" for="tempat_lahir">Tempat Lahir:</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir"
                            value="{{ old('tempat_lahir') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label" for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <label class="col-form-label" for="jenis_kelamin">Jenis Kelamin:</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <label class="col-form-label" for="telpon">Nomor Telepon:</label>
                        <input type="text" name="telpon" class="form-control" placeholder="08xxxxxxxxxx"
                            value="{{ old('telpon') }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-2">
                        <label class="col-form-label" for="pendidikan">Pendidikan Terakhir:</label>
                        <input type="text" name="pendidikan" class="form-control"
                            placeholder="Masukan Pendidikan Terakhir" value="{{ old('pendidikan') }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-2">
                        <label class="col-form-label" for="pekerjaan">Pekerjaan:</label>
                        <input type="text" name="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan"
                            value="{{ old('pekerjaan') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label" for="berkas">Berkas: tipe PDF maks 2mb, dengan penamaan file :
                            <b>SuratPernyataan_NamaCalon</b></label>
                        <input type="file" name="berkas" class="form-control-file" required>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('pendaftaran_rt_rw') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
