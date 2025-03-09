<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @font-face {
            font-family: 'Perfectly Nineties';
            src: url('./fonts/PerfectlyNineties-Semibold.otf') format('opentype');
            font-weight: 600;
            /* You can adjust the weight */
            font-style: italic;
            /* Italic style */
        }

        .image-container {
            background: url('./assets/images/auth-img2.jpeg') center no-repeat;
            background-size: cover;
            height: 100vh;
        }

        .form-container {
            background-color: #142900;
            display: flex;
            justify-content: center;
        }

        .form-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
        }

        .form-box h4 {
            font-weight: bold;
            color: #fff;
            font-family: 'Perfectly Nineties', sans-serif;
            font-size: 2rem !important;
        }

        .form-box .form-input {
            position: relative;
        }

        .form-box .form-input input {
            width: 100%;
            height: 40px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            outline: none;
            background: white;
            padding-left: 45px;
        }

        .form-box .form-input span {
            position: absolute;
            top: 8px;
            padding-left: 20px;
            color: #142900;
        }

        .form-box .form-input input::placeholder {
            padding-left: 0px;
        }

        .form-box .form-input input:focus,
        .form-box .form-input input:valid {
            border-bottom: 2px solid #dc3545;
        }

        .form-box input[type="checkbox"]:not(:checked)+label:before {
            background: transparent;
            border: 2px solid #fff;
            width: 15px;
            height: 15px;
        }

        .form-box .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #dc3545;
            border: 0px;
        }

        .form-box button[type="submit"] {
            border: none;
            cursor: pointer;
            width: 150px;
            height: 40px;
            border-radius: 5px;
            background-color: #d7ff4a;
            color: #000;
            font-weight: bold;
            transition: 0.5s;
        }

        .form-box button[type="submit"]:hover {
            -webkit-box-shadow: 0px 9px 10px -2px rgba(0, 0, 0, 0.55);
            -moz-box-shadow: 0px 9px 10px -2px rgba(0, 0, 0, 0.55);
            box-shadow: 0px 9px 10px -2px rgba(0, 0, 0, 0.55);
        }

        .forget-link,
        .register-link,
        .login-link {
            color: #fff;
            font-weight: bold;
        }

        .forget-link:hover,
        .register-link:hover,
        .login-link:hover {
            color: #fff;
        }

        .form-box .btn-social {
            color: #fff;
            border: 0;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none !important;
        }

        .form-box .btn-facebook {
            background: #4866a8;
            border: 1px solid #ffffff86;
        }

        .form-box .btn-google {
            background: #da3f34;
            border: 1px solid #ffffff86;

        }

        .form-box .btn-twitter {
            background: #33ccff;
            border: 1px solid #ffffff86;

        }

        .form-box .btn-facebook:hover {
            color: #fff;
            background: #3d5785;

        }

        .form-box .btn-google:hover {
            background: #bf3b31;
            color: #fff;
        }

        .form-box .btn-twitter:hover {
            background: #2eb7e5;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 form-container">
                <div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box text-center">
                    <div class="logo">
                        <img src="{{asset('assets/images/logo.png')}}" width="150px">
                    </div>
                    <div class="heading mb-3">
                        <h4>Create An Account</h4>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name Field -->
                        <div class="form-input">
                            <span><i class="fa fa-user"></i></span>
                            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-input">
                            <span><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-input">
                            <span><i class="fa fa-lock"></i></span>
                            <input type="password" name="password" placeholder="Password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-input">
                            <span><i class="fa fa-lock"></i></span>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Custom Error Message -->
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-12 d-flex">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cb1" name="terms">
                                    <label class="custom-control-label text-white" for="cb1">I agree to <a href="#" style="font-weight: 600; color: #fff;">privacy policy</a> and <a href="#" style="font-weight: 600; color: #fff;">terms conditions</a></label>
                                </div>
                            </div>
                        </div>

                        <div class="text-left mb-3">
                            <button type="submit" class="btn">Register</button>
                        </div>

                        <div class="text-white">Already have an account?
                            <a href="{{route('login')}}" class="login-link">Login here</a>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-lg-6 col-md-6 d-none d-md-block image-container"></div>
        </div>
    </div>
</body>

</html>