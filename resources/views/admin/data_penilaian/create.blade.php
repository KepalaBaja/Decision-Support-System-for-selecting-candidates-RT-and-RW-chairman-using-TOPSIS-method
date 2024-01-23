@extends('layouts.admin.master')

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('data_penilaian.index') }}">Data Penilaian</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Nilai</li>
                </ol>
            </nav>
        </div>
    </div>
    <div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Tambah Nilai</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('data_penilaian.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="calon">Nama Calon</label>
                        <select class="form-control col-sm-5" name="calon_id">
                            <option>Pilih Calon</option>
                            @foreach ($calon as $calonItem)
                                @php
                                    $existingCalonIds = $nilai->pluck('id_calon')->toArray();
                                @endphp
                                @if (!in_array($calonItem->calon_id, $existingCalonIds))
                                    <option value="{{ $calonItem->calon_id }}">{{ $calonItem->nama_calon }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kriteria</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $kriteriaItem)
                                <tr>
                                    <td>{{ $kriteriaItem->nama_kriteria }}</td>
                                    <td>
                                        <input type="number" name="nilai[]" class="form-control" placeholder="1-100"
                                            required>
                                        <input type="hidden" name="kriteria_id[]" value="{{ $kriteriaItem->kriteria_id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        <button class="btn btn-primary">Simpan Nilai</button>
                        <a href="{{ route('data_penilaian.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
