@extends('admin.layouts.auth')

@section('content')
<div class="auth-fluid-form-box">
    <div class="align-items-center d-flex h-100">
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <!-- Logo -->
            <div class="auth-brand text-center text-lg-left">
                <a href="{{ route('admin.login') }}">
                    <span><img src="{{ asset('admin/images/logo-light.png') }}" alt="" height="18"></span>
                </a>
            </div>

            <!-- title-->
            <h4 class="mt-0">Restablecer la contraseña</h4>
            <p class="text-muted mb-4">Ingrese su correo electrónico y le enviaremos un correo electrónico con
                instrucciones para restablecer su contraseña.</p>

            <!-- form -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label>

                    <input id="email" name="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}"
                        autocomplete="email" required autofocus placeholder="Ingrese su correo electrónico">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>

                    <input id="password" name="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" required
                        autocomplete="new-password" placeholder="Ingrese su nueva contraseña">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password-confirm">Confirmar contraseña</label>


                    <input id="password-confirm" name="password_confirmation" type="password" class="form-control"
                        required autocomplete="new-password" placeholder="Confirme su nueva contraseña">
                </div>

                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-lock-reset"></i>
                        Restablecer la contraseña </button>
                </div>

            </form>
            <!-- end form-->

            <!-- Footer-->
            <footer class="footer footer-alt">
                <p class="text-muted">Regresar a<a href="{{ route('admin.login') }}" class="text-muted ml-1"><b>iniciar
                            sesión</b></a></p>
            </footer>

        </div> <!-- end .card-body -->
    </div> <!-- end .align-items-center.d-flex.h-100-->
</div>
@endsection