@extends('layouts.app')

@section('content')



    <div>

        <div class="bg"></div>
        <div class="bg bg2"></div>
        <div class="bg bg3"></div>


        <div class="login-root">
            <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
            
            <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
                </div>
                <div class="formbg-outer">
                <div class="formbg">
                    <div class="formbg-inner padding-horizontal--48">
                    <span class="padding-bottom--15 text-center">
                        <h1>
                            Sistema Edsoft
                        </h1>
                    </span>
                    <br>
                    <form id="stripe-login" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="field padding-bottom--24">
                        <label for="email">Usuario</label>
                        <input id="email" type="email" name="email" placeholder="Ingrese su usuario" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="field padding-bottom--24">
                        <div class="grid--50-50">
                            <label for="password">Contraseña</label>
                            <div class="reset-pass">
                            </div>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Ingrese su contraseña">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                        <label for="checkbox">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            Recordar Sesión
                        </label>
                        </div>
                        <div class="field padding-bottom--24">

                        <input type="submit" name="submit" value="{{ __('Iniciar Sesión') }}">
                        
                        </div>
                        <div class="field">
                        {{-- <a class="ssolink" href="#">Sistema de Ventas (POS) 2022</a> --}}
                        </div>
                    </form>
                    </div>
                </div>
                <div class="footer-link padding-top--24">
                    {{-- <span>¿Nuestra Ubicación? <a href="">Click Aquí</a></span> --}}
                    {{-- <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
                    <span><a href="#">© Facebook</a></span>
                    <span><a href="#">WhatsApp</a></span>
                    <span><a href="#">Messenger</a></span>
                    </div> --}}
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
