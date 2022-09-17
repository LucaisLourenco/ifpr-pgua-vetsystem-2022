<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>Login Cliente</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="../css/util.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="icon" href="../images/img-11.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        
        <div class="limiter">
            <div class="container-logincliente100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="../images/img-03.png" alt="IMG">
                    </div>

                    @yield('conteudo')
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
