@extends('layouts.admin.master')

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kelola_calon.index') }}">Kelola Calon</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Calon</li>
                </ol>
            </nav>
        </div>
    </div>
    <div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Tambah Calon</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kelola_calon.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="nama_calon" class="col-md-2 col-form-label">Nama Calon</label>
                        <div class="col-md-10">
                            <input type="text" name="nama_calon" class="form-control" placeholder="Masukkan Nama Calon">
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary">Simpan Calon</button>
                        <a href="{{ route('kelola_calon.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
