<!DOCTYPE html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Lezato : Restaurant Admin Template" />
	<meta property="og:title" content="Lezato : Restaurant Admin Template" />
	<meta property="og:description" content="Lezato : Restaurant Admin Template" />
	<meta property="og:image" content="social-image.png" />
	<meta name="format-detection" content="telephone=no">
    
	<!-- PAGE TITLE HERE -->
	<title>Lezato : Restaurant Admin Template</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{asset('../assets/images/favicon.png')}}" />
    <link href="{{asset('../assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="{{asset('../assets/images/logo-full.png')}}" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                    <form method="POST" action="{{ route('login') }}">
                                       @csrf
                                            <div class="mb-3">
                                            <label class="mb-1" :value="__('Email')" ><strong>Email</strong></label>
                                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="form-control" :value="old('email')"  >
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                            
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1" for="password" :value="__('Password')"><strong>Password</strong></label>
                                            <input id="password"  type="password"   name="password" class="form-control"  required autocomplete="current-password">
                                            <x-input-error :messages="$errors->get('Password')" class="mt-2" />
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                               <div class="form-check custom-checkbox ms-1">
													<input type="checkbox" type="checkbox" class="form-check-input" id="basic_checkbox_1" name="remember">
													<label for="remember_me" class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <div class="mb-3">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}}">{{ __('Forgot your password?') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="{{ __('Log in') }}" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="page-register.html">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    
    <script src="{{asset('../assets/vendor/global/global.min.js')}}"></script>
            <script src="{{asset('../assets/js/custom.min.js')}}"></script>
            <script src="{{asset('../assets/js/deznav-init.js')}}"></script>
            <script src="{{asset('../assets/js/styleSwitcher.js')}}"></script>

</body>
</html>