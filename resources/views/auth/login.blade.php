
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adminty - Premium Admin Template by Colorlib </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>

<body class="fix-menu">

    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                        <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="text-center">
                                <img src="/assets/images/logo.png" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Sign In</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                    <input placeholder="Your Email Address" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                    <span class="invalid-feedback form-bar" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <input placeholder="Password"  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                    <span class="form-bar invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <label>
                                                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right f-right">
                                                @if (Route::has('password.request'))
                                                <a class="text-right f-w-600" href="{{ route('password.request') }}"> Forgot Password?</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>
 
    <script type="text/javascript" src="/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="/assets/js/common-pages.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
</body>

</html>
