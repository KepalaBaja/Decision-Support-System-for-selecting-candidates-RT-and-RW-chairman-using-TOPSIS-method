@extends('layouts.auth')

@section('content')
<div class="container py-5 h-100">
    <!-- Outer Row -->
    <div class="row d-flex justify-content-center align-items-center h-100" >
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 2rem;">
                <div class="card-body p-5" >
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Administrator</h1>
                                </div>
                                <hr>
                                @if(Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('administrator.login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror form-control-user"
                                            name="email" value="{{ old('email') }}" required autofocus id="emmail"
                                            aria-describedby="emailHelp" placeholder="Masukan Alamat Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror form-control-user"
                                            name="password" required id="password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Masuk
                                    </button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
