<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
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
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="/register" enctype="multipart/form-data" method="post" class="login100-form validate-form" >
                    @csrf
					<span class="login100-form-title">
						Register
					</span>

					<div class="wrap-input100 validate-input">
                        <label for="name">Nama</label>
						<input class="input100 @error('name') is-invalid @enderror" type="text" name="name" required value="{{ old('name') }}">
						<span class="focus-input100"></span>

                        @error('name')
                            <div class="is-invalid">
                                {{ $message }}
                            </div>
                        @enderror
					</div>

                    <div class="wrap-input100 validate-input">
                        <label for="username">Username</label>
						<input class="input100 @error('username') is-invalid @enderror" type="text" name="username" required value="{{ old('username') }}">
						<span class="focus-input100"></span>

                        @error('username')
                            <div class="is-invalid">
                                {{ $message }}
                            </div>
                        @enderror
					</div>

					<div class="wrap-input100 validate-input">
                        <label for="password">Password</label>
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" required value="{{ old('password') }}">
						<span class="focus-input100"></span>

                        @error('password')
                            <div class="is-invalid">
                                {{ $message }}
                            </div>
                        @enderror
					</div>

                    <div class="wrap-input100 validate-input">
                        <label for="email">Email</label>
						<input class="input100 @error('email') is-invalid @enderror" type="text" name="email" required value="{{ old('email') }}">
						<span class="focus-input100"></span>

                        @error('email')
                            <div class="is-invalid">
                                {{ $message }}
                            </div>
                        @enderror
					</div>

                     <!-- Optionally, add a message for email verification -->
                    {{-- <div class="text-center p-t-10">
                        <small>An email verification link will be sent upon registration.</small>
                    </div> --}}

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="/login">
							Sudah punya akun? Langsung login aja!
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
