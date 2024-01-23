@extends('layouts.admin.master')

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
                    <li class="breadcrumb-item"><a href="{{ route('administrator.manajemen_akun/kelola_penilai') }}">Kelola
                            Penilai</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Penilai</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Penilai</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('administrator.manajemen_akun/kelola_penilai.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Penilai</label>
                    <input type="text" name="name" id="name" class="form-control" required
                        placeholder="Masukan Nama Penilai">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required
                        placeholder="Masukan Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" required
                            placeholder="Masukan Password">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="showPasswordBtn"
                                onclick="togglePasswordVisibility()">
                                Show
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control"
                            required placeholder="Masukan Password">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="showConfirmPasswordBtn"
                                onclick="toggleConfirmPasswordVisibility()">
                                Show
                            </button>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">Simpan Penilai</button>
                        <a href="{{ route('administrator.manajemen_akun/kelola_penilai') }}"
                            class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const showPasswordBtn = document.getElementById('showPasswordBtn');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showPasswordBtn.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                showPasswordBtn.textContent = 'Show';
            }
        }

        function toggleConfirmPasswordVisibility() {
            const confirmPasswordInput = document.getElementById('password-confirm');
            const showConfirmPasswordBtn = document.getElementById('showConfirmPasswordBtn');

            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                showConfirmPasswordBtn.textContent = 'Hide';
            } else {
                confirmPasswordInput.type = 'password';
                showConfirmPasswordBtn.textContent = 'Show';
            }
        }
    </script>
@endsection
