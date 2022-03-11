@extends('layouts.login')

@section('content')
    {{-- <main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6" style="text-align: center;">
            <img src="https://phplaravel-317638-1888697.cloudwaysapps.com/storage/logo/v8dADuqvRXz6uLn33jCcHzA9yQqKdsoIwq3krd0F.png" alt="" style="width:80px">
            <div class="card">
                <div class="card-header text-center text-lg">Login</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main> --}}



    <div class="container" style="width: 60%; margin: 100px auto">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo">
                    <img src="https://phplaravel-317638-1888697.cloudwaysapps.com/storage/logo/v8dADuqvRXz6uLn33jCcHzA9yQqKdsoIwq3krd0F.png"
                        alt="" style="width:80px">
                    <img src="" alt="">
                </span>
                <h4 class="company_title">Leave application</h4>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row">
                        <h2>Log In</h2>
                    </div>
                    <div class="row">
                        <form method="POST" action="{{ route('login') }}" style="width: 100%;" class="form-group">
                            @csrf
                            <div class="row">
                                <input type="text" name="email" id="username" class="form__input @error('email') is-invalid @enderror"
                                    placeholder="Username" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                {{-- <span class="fa fa-lock"></span> --}}
                                <input type="password" name="password" id="password" class="form__input @error('password') is-invalid @enderror"
                                    placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <input type="checkbox" name="remember_me" id="remember_me" class="">
                                <label for="remember_me">Remember Me!</label>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                {{-- <input type="submit" value="Submit" class="btn"> --}}
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <p>Forgot your password?
                            <a class="" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="container-fluid text-center footer">
        MFT FULFILLMENT CENTRE &hearts; by <a href="https://mftfulfillmentcentre.com" target="_blank">Website</a></p>
    </div>
@endsection
