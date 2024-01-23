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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pendaftaran_rt_rw') }}">Pendaftaran RT/RW</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Pendaftaran</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Edit Pendaftaran</h5>
        </div>
        <div class="card-body justify-content-center">
            <form action="{{ route('pendaftaran_rt_rw.update_user', $pendaftaran->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <label class="col-form-label for="nama_lengkap">Nama Lengkap:</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan Nama Lengkap"
                            value="{{ $pendaftaran->nama_lengkap }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-2">
                        <label class="col-form-label" for="tempat_lahir">Tempat Lahir:</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir"
                            value="{{ $pendaftaran->tempat_lahir }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label" for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                            value="{{ $pendaftaran->tanggal_lahir }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <label class="col-form-label for="jenis_kelamin">Jenis Kelamin:</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="Laki-laki" {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <label class="col-form-label" for="telpon">Nomor Telepon:</label>
                        <input type="text" name="telpon" class="form-control" placeholder="08xxxxxxxxxx"
                            value="{{ $pendaftaran->telpon }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-2">
                        <label class="col-form-label" for="pendidikan">Pendidikan Terakhir:</label>
                        <input type="text" name="pendidikan" class="form-control"
                            placeholder="Masukan Pendidikan Terakhir" value="{{ $pendaftaran->pendidikan }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 offset-md-2">
                        <label class="col-form-label" for="pekerjaan">Pekerjaan:</label>
                        <input type="text" name="pekerjaan" class="form-control" placeholder="Masukan Pekerjaan"
                            value="{{ $pendaftaran->pekerjaan }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label" for="berkas">Berkas:</label>
                        <div class="custom-file">
                            <input type="file" name="berkas" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">{{ $pendaftaran->berkas }}</label>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update Berkas</button>
                    <a href="{{ route('pendaftaran_rt_rw') }}" class="btn btn-secondary">Batal</a>
                </div>
                {{-- Script guna mengubah file sewaktu edit --}}
                <script>
                    $(document).ready(function() {
                        // Ketika ada perubahan pada input berkas
                        $('#inputGroupFile01').on('change', function() {
                            // Ambil nama file yang dipilih
                            var fileName = $(this).val().split('\\').pop();
                            // Ubah teks label dengan nama file yang dipilih
                            $(this).next('.custom-file-label').html(fileName);
                        });
                    });
                </script>
            </form>
        </div>
    </div>
@endsection
