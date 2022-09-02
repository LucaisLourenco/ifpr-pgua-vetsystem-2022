<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> VetSystem Veterinário @yield('titulo')</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

        <style type="text/css">

            @media all and (min-width: 992px) {
                .dropdown-menu li{
                    position: relative;
                }
                
                .dropdown-menu .submenu{ 
                    display: none;
                    position: absolute;
                    right:100%; top:10px;
                }
                
                .dropdown-menu .submenu-left{ 
                    right:100%; left:auto;
                }

                .dropdown-menu > li:hover{ background-color: #f1f1f1 }
                .dropdown-menu > li:hover > .submenu{
                    display: block;
                }
            }	

            @media (max-width: 991px) {
                .dropdown-menu .dropdown-menu{
                    margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
                }
            }	
        </style>
               
    </head>

    <body>
        <nav id="navbar" class="navbar sticky-top navbar-expand-md navbar-dark bg-danger">
            <div class="container-fluid">
                <a href="{{route('veterinario')}}" class="navbar-brand ms-sm-3 text-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-heart-pulse" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01L8 2.748ZM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5Zm8.252-6.686a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162l-1.874-4.686Z"/>
                    </svg>
                    <span class="ms-3 fs-5 text-dark">VetSystem Medico Veterinário</span>
                </a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#itens">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-menu-button-wide" viewBox="0 0 16 16">
                        <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
                        <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </button>
                <div class="collapse navbar-collapse" id="itens">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item ps-2 me-3">
                            <form method="POST" action="{{ route('veterinario.logout') }}" id="form">
                                    {{ csrf_field() }}
                                <a nohref style="cursor:pointer" class="nav-link text-dark" onclick="document.getElementById('form').submit()">  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                    </svg>
                                    <span class="ps-1 text-dark">Sair</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container py-4">
            <div class="row">
                <div class="col">
                    <h3 class="display-7 text-secondary d-none d-md-block"><b>{{ $titulo }}</b></h3>
                </div>
                @if(isset($rota))
                    <div class="col d-flex justify-content-end">
                        <a href= "{{ route($rota) }}" class="btn btn-secondary text-white">Cadastrar
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
            <hr>
                @yield('conteudo')
            <hr>
        </div>
        <nav class="navbar fixed-bottom navbar-dark bg-danger">
            <div class="container-fluid">
                <span class="text-dark fw-light">{{ Auth::guard('veterinario')->user()->name }}</span>
            </div>
        </nav>
    </body>

    <div class="modal fade" tabindex="-1" id="infoModalSuccess">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-success">Success
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-envelope-check" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                        </svg>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="infoModalSuccess" onclick="closeInfoModalSuccess()" aria-label="Close"></button>
                </div>
                <div class="modal-body text-secondary">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-block align-content-center" onclick="closeInfoModalSuccess()">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="infoModalDanger">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-danger">Warning
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-envelope-x" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-4.854-1.354a.5.5 0 0 0 0 .708l.647.646-.647.646a.5.5 0 0 0 .708.708l.646-.647.646.647a.5.5 0 0 0 .708-.708l-.647-.646.647-.646a.5.5 0 0 0-.708-.708l-.646.647-.646-.647a.5.5 0 0 0-.708 0Z"/>
                        </svg>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="infoModalDanger" onclick="closeInfoModalDanger()" aria-label="Close"></button>
                </div>
                <div class="modal-body text-secondary">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-block align-content-center" onclick="closeInfoModalDanger()">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" tabindex="-1" id="removeModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger">Operação de Remoção</h5>
              <button type="button" class="btn-close" data-bs-dismiss="removeModal" onclick="closeRemoveModal()" aria-label="Close"></button>
            </div>
            <input type="hidden" id="id_remove">
            <div class="modal-body text-secondary">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block align-content-center" onclick="closeRemoveModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    &nbsp; Não
                </button>
              <button type="button" class="btn btn-danger" onclick="remove()">
                    Sim &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
              </button>
            </div>
          </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

    <script type="text/javascript">

        function showInfoModalSuccess() {
            $('#infoModalSuccess').modal().find('.modal-body').html("");
            for(let a=0; a< arguments.length; a++) {
                $('#infoModalSuccess').modal().find('.modal-body').append("<h7><strong> Hi {{Auth::guard('veterinario')->user()->name}}! </strong>" + arguments[a] + "</h7>");
            }
            $("#infoModalSuccess").modal('show');
        }

        function closeInfoModalSuccess() {
            $("#infoModalSuccess").modal('hide');
        }

        function showInfoModalDanger() {
            $('#infoModalDanger').modal().find('.modal-body').html("");
            for(let a=0; a< arguments.length; a++) {
                $('#infoModalDanger').modal().find('.modal-body').append("<h7><strong> Hi {{Auth::guard('veterinario')->user()->name}}! </strong>" + arguments[a] + "</h7>");
            }
            $("#infoModalDanger").modal('show');
        }

        function closeInfoModalDanger() {
            $("#infoModalDanger").modal('hide');
        }

        function showRemoveModal(id, nome) {
            $('#id_remove').val(id);
            $('#removeModal').modal().find('.modal-body').html("");
            $('#removeModal').modal().find('.modal-body').append("Deseja remover o registro <b class='text-danger'>'"+nome+"'</b> ?");
            $("#removeModal").modal('show');
        }

        function closeRemoveModal() {
            $("#removeModal").modal('hide');
        }

        function remove() {
            let id = $('#id_remove').val();
            let form = "form_" + $('#id_remove').val();
            document.getElementById(form).submit();
            $("#removeModal").modal('hide')
        }

        $(document).ready(function(){
            setTimeout(() => {
                $(".alert").fadeOut("slow", function(){
                    $(this).alert('close');
                })
            }, 4000);
        });

        $(document).ready(function(){
            setTimeout(() => {
                closeInfoModalDanger();
                closeInfoModalSuccess();
            }, 5000);
        });

    </script>

    @yield('script')
</html>