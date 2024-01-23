@extends('layouts.admin.master')

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kelola_kriteria.index') }}">Kelola Kriteria</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Kriteria</li>
                </ol>
            </nav>
        </div>
    </div>
    <div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Tambah Kriteria</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kelola_kriteria.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="kode_kriteria" class="col-md-2 col-form-label">Kode Kriteria</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria"
                                placeholder="Masukan Kode Kriteria">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_kriteria" class="col-md-2 col-form-label">Nama Kriteria</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria"
                                placeholder="Masukan Nama Kriteria">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bobot" class="col-md-2 col-form-label">Bobot Kriteria</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" id="bobot" name="bobot" placeholder="0-10"
                                min="0" max="10" step="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jenis_kriteria" class="col-md-2 col-form-label">Jenis Kriteria</label>
                        <div class="col-md-3">
                            <select class="form-control" id="jenis_kriteria" name="jenis_kriteria">
                                <option>Pilih Jenis Kriteria</option>
                                <option value="cost">Cost</option>
                                <option value="benefit">Benefit</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">Simpan Kriteria</button>
                            <a href="{{ route('kelola_kriteria.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
