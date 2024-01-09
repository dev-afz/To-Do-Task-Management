@extends('components.layouts.main')
@section('title', 'Registration')

@section('page-style')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        /* * {
                                                                                                                                                                                                                            margin: 0;
                                                                                                                                                                                                                            padding: 0;
                                                                                                                                                                                                                            box-sizing: border-box;
                                                                                                                                                                                                                            font-family: 'Poppins', sans-serif;
                                                                                                                                                                                                                        } */

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


                <div class="wrapper">
                    <h2>Registration</h2>
                    <form id="registration">
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter your email"
                                required>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Mobile</label>
                            <input type="text" class="form-control" name="mobile" pattern="[1-9]{1}[0-9]{9}"
                                placeholder="Enter your mobile number" required>
                            @error('mobile')
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
                            <button class="btn btn-primary">Register Now</button>
                        </div>
                        <div class="text ">
                            <h3>Already have an account? <a href="{{ route('login') }}">Login now</a></h3>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('page-script')
    <script>
        $('#registration').submit(function(e) {
            e.preventDefault();
            const data = $(this).serialize();
            Notiflix.Loading.standard('Please wait...');
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                type: "post",
                url: "{{ route('post-register') }}",
                data: data,
                success: function(response) {
                    Notiflix.Loading.remove();
                    Notiflix.Notify.success(response.message);
                    setTimeout(() => {
                        location.href = "{{ route('login') }}";
                    }, 2000);
                },
                error: function(error) {
                    console.log(error.responseJSON); // Log validation errors if any
                }
            });
        });
    </script>
@endsection
