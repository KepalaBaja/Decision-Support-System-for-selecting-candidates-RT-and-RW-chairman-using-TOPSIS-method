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
                    <li class="breadcrumb-item active" aria-current="page">Edit Kriteria</li>
                </ol>
            </nav>
        </div>
    </div>
    <div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Edit Kriteria</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kelola_kriteria.update', $kriteria->kriteria_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="kode_kriteria" class="col-md-2 col-form-label">Kode Kriteria</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="kode_kriteria"
                                value="{{ $kriteria->kode_kriteria }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_kriteria" class="col-md-2 col-form-label">Nama Kriteria</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria"
                                value="{{ $kriteria->nama_kriteria }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bobot" class="col-md-2 col-form-label">Bobot</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="bobot" value="{{ $kriteria->bobot }}">
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="jenis_kriteria" class="col-md-2 col-form-label">Jenis Kriteria</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="jenis_kriteria" name="jenis_kriteria">
                                <option value="cost" @if ($kriteria->jenis_kriteria == 'cost') selected @endif>Cost</option>
                                <option value="benefit" @if ($kriteria->jenis_kriteria == 'benefit') selected @endif>Benefit</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="col-md-10 offset-md-2">
                            <button class="btn btn-primary">Update Kriteria</button>
                            <a href="{{ route('kelola_kriteria.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
