<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eclectic | {{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets2') }}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets2') }}/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('assets2') }}/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="{{ route('forgot-password') }}" method="POST">

                    <span class="login100-form-title" style="margin-bottom: 50px">
                        <img src="{{ asset('logo eclectic web.png') }}" alt="" width="250">
                        <p style="text-transform: uppercase; margin-top: 20px; font-weight: bold; font-size: 17px">
                            Office Management
                            System</p>
                        <p style=" margin-top: 20px; font-weight: bold; font-size: 15px; margin-bottom: -20px;">
                            We'll send a password reset link to your email. </p>
                    </span>

                    @if ($errors->has('email'))
                        <script>
                            window.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Maaf...',
                                    text: '{{ $errors->first('email') }}',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        </script>
                    @elseif (session('success'))
                        <script>
                            window.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: '{{ session('success') }}',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        </script>
                    @elseif (session('error'))
                        <script>
                            window.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Maaf...',
                                    text: '{{ session('error') }}',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        </script>
                    @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="wrap-input100 validate-input" data-validate="Email required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" placeholder="Type your email">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>




                    <div class="container-login100-form-btn p-t-20" style="padding-bottom: 10px">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Reset Password
                            </button>
                        </div>
                    </div>

                    <div class="txt1 text-center p-t-20 p-b-20">
                        <span>
                            Atau
                        </span>
                    </div>

                    <div class="container-login100-form-btn ">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <a href="{{ route('login') }}" class="login100-form-btn">Login</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ asset('assets2') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('assets2') }}/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
