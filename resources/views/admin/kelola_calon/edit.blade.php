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
                    <li class="breadcrumb-item"><a href="{{ route('kelola_calon.index') }}">Kelola Calon</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Calon</li>
                </ol>
            </nav>
        </div>
    </div>
    <div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Calon</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kelola_calon.update', $calon->calon_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Calon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nama_calon"
                                            value="{{ $calon->nama_calon }}">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <button class="btn btn-primary">Update Calon</button>
                        <a href="{{ route('kelola_calon.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
