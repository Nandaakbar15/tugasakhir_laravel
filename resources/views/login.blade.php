<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset("images/playstationlogo.png") }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("vendor/bootstrap/css/bootstrap.min.css") }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("fonts/font-awesome-4.7.0/css/font-awesome.min.css") }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("vendor/animate/animate.css") }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("vendor/css-hamburgers/hamburgers.min.css") }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("vendor/select2/select2.min.css") }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("css/util.css") }}">
	<link rel="stylesheet" type="text/css" href="{{ asset("css/main.css") }}">
<!--===============================================================================================-->
</head>
<body>
    @include('flash-message')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset("images/ps1icon.png") }}" alt="IMG">
				</div>

				<form action="/login" class="login100-form validate-form" enctype="multipart/form-data" method="post">
                    @csrf
					<span class="login100-form-title">
						Selamat Datang
					</span>

					<div class="wrap-input100 validate-input">
                        <label for="email">Email</label>
						<input class="input100 @error('email') is-invalid @enderror" type="email" name="email" id="email" required value="{{ old('email') }}">
						<span class="focus-input100"></span>
                        @error('email')
                            <div class="is-invalid">
                                {{ $message }}
                            </div>
                        @enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <label for="password">Password</label>
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" id="password" value="{{ old('password') }}">
						<span class="focus-input100"></span>

                        @error('password')
                            <div class="is-invalid">
                                {{ $message }}
                            </div>
                        @enderror
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="/register">
							Belum punya akun? Register sekarang juga!
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="{{ asset("vendor/jquery/jquery-3.2.1.min.js") }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset("vendor/bootstrap/js/popper.js") }}"></script>
	<script src="{{ asset("vendor/bootstrap/js/bootstrap.min.js") }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset("vendor/select2/select2.min.js") }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset("vendor/tilt/tilt.jquery.min.js") }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset("js/main.js") }}"></script>

</body>
</html>
