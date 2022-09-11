<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>Login Sistema</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="../css/util.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        
    <div class="limiter">
            <div class="container-logingestao100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="../images/img-01.png" alt="IMG">
                    </div>
                    <form method="POST" action="{{ route('password.update') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $request->token }}" required>
                        <input name="email" type="hidden" value="{{ old('email', $request->email) }}" required>
                        
                        <span class="login100-form-title">
                            Redefinir Senha Cliente
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input name="password" type="password" class="input100 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Senha" required>
                            @if($errors->has('password'))
                                <div class='invalid-feedback'>
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Password_confirmation is required">
                            <input name="password_confirmation" type="password" class="input100 {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="Confirme a Senha" required>
                            @if($errors->has('password_confirmation'))
                                <div class='invalid-feedback'>
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                                        
                        <div class="container-login100-form-btn">
                            <button type="submit" value="redefinir" class="login100-form-btngestao">
                                Redefinir Senha
                            </button>
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

            $(document).ready(function(){
                setTimeout(() => {
                    $(".mensagem-false").fadeOut("slow", function(){
                        $(this).alert('close');
                    })
                }, 4000);
            });
        </script>
        <script src="../js/main.js"></script>
    </body>
</html>