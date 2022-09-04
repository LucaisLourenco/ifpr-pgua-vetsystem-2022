<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>Login Veterinário</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="../css/util.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
    </head>
    <body>
        
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="../images/img-02.png" alt="IMG">
                    </div>

                    <form method="POST" action="{{ route('veterinario.login') }}">
                        {{ csrf_field() }}
                        <span class="login100-form-title">
                            Login Veterinário
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                            <input name="email" type="email" value="{{ old('email') }}" class="input100" placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input name="password" type="password" class="input100" placeholder="Senha">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        
                        <div class="container-login100-form-btn">
                            <button type="submit" value="login" class="login100-form-btn">
                                Login
                            </button>
                        </div>

                        <div class="text-center p-t-12">
                            @if (Route::has('password.request'))
                                <span class="txt1">
                                    Forgot
                                </span>
                                <a class="txt2" href="{{ route('veterinario.password.request') }}">
                                    Username / Password?
                                </a>
                            @endif
                        </div>

                        <div class="text-center p-t-136">
                            <a class="txt2" href="#">
                                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                
        <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="../vendor/bootstrap/js/popper.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendor/select2/select2.min.js"></script>
        <script src="../vendor/tilt/tilt.jquery.min.js"></script>
        <script >
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script>
        <script src="../js/main.js"></script>
    </body>
</html>
