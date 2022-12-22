@extends('layouts.app')

@section('content')
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>


    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container ps-2 pe-0">
            {{-- <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white"
        href="../../../pages/dashboards/default.html">
        Sistema Edsoft
    </a> --}}
            {{-- <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
        </span>
    </button> --}}
        </div>
    </nav>

    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 m-3 border-radius-lg"
            style="background-image: url('{{ asset('img/signin-cover.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">¡Bienvenido!</h1>
                        <p class="text-lead text-white">
                            El único modo de hacer un gran trabajo es amar lo que haces - Steve Jobs
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card">
                        <div class="card-header pb-0 text-start text-center mx-auto">
                            <h3 class="font-weight-bolder">Sistema Edsoft</h3>
                            <p class="mb-0">Ingrese correo electrónico y contraseña</p>
                        </div>
                        <div class="card-body">










                            <form role="form" class="text-start" id="stripe-login" method="POST"
                                action="{{ route('login') }}">
                                @csrf
                                <label for="email">Usuario</label>
                                <div class="mb-3">
                                    <input class="form-control" id="email" type="email" name="email"
                                        placeholder="Ingrese su usuario" value="{{ old('email') }}" required
                                        autocomplete="email" autofocus aria-label="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <label for="password">Contraseña</label>
                                <div class="reset-pass">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" id="password" type="password" name="password" required
                                        autocomplete="current-password" placeholder="Ingrese su contraseña">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rememberMe">Recodar Sesión</label>
                                </div>
                                <div class="text-center">
                                    <input class="btn btn-primary w-100 mt-4 mb-0" type="submit" name="submit"
                                        value="{{ __('Iniciar Sesión') }}">
                                </div>
                            </form>




                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
