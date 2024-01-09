@extends('components.layouts.main')
@section('title', 'Login')

@section('page-style')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        body {
            /* min-height: 100vh; */
            /* display: flex; */
            align-items: center;
            justify-content: center;
            background: #1c1a55;
        }

        .wrapper {
            position: relative;
            max-width: 430px;
            width: 100%;
            background: #fff;
            padding: 34px;
            border-radius: 6px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .wrapper h2 {
            position: relative;
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }

        .wrapper h2::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 28px;
            border-radius: 12px;
            background: #4070f4;
        }

        .wrapper form {
            margin-top: 30px;
        }

        .wrapper form .input-box {
            height: 52px;
            margin: 18px 0;
        }

        form .input-box input {
            height: 100%;
            width: 100%;
            outline: none;
            padding: 0 15px;
            font-size: 17px;
            font-weight: 400;
            color: #333;
            border: 1.5px solid #C7BEBE;
            border-bottom-width: 2.5px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .input-box input:focus,
        .input-box input:valid {
            border-color: #4070f4;
        }

        form .policy {
            display: flex;
            align-items: center;
        }

        form h3 {
            color: #707070;
            font-size: 14px;
            font-weight: 500;
            margin-left: 10px;
        }

        .input-box.button input {
            color: #fff;
            letter-spacing: 1px;
            border: none;
            background: #4070f4;
            cursor: pointer;
        }

        .input-box.button input:hover {
            background: #0e4bf1;
        }

        form .text h3 {
            color: #333;
            width: 100%;
            text-align: center;
        }

        form .text h3 a {
            color: #4070f4;
            text-decoration: none;
        }

        form .text h3 a:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center justify-item-center">
            <div class="col-lg-12 col-12 d-flex justify-content-center mt-5">
                @if (Session::has('success'))
                    <div class="alert alert-success" style="background: #008080;opacity:0.8;color:white">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="wrapper">
                    <h2>Login</h2>
                    <form action="{{ route('post-login') }}">
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter your email"
                                required>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Create password"
                                required>
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Login Now</button>
                        </div>
                        <div class="text ">
                            <h3>Don't have an account? <a href="{{ route('register') }}">Register now</a></h3>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $(".alert").fadeTo(6000, 4500).slideUp(4500, function() {
                $(".alert").slideUp(4500);
            });
        });
    </script>
@endsection
