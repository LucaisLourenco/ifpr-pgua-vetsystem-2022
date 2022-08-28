@extends('templates.main', ['titulo' => "Gestão de Parâmetros"])

@section('titulo') Parâmetros @endsection

@section('conteudo')
    <table class="table align-middle caption-top table-striped">
        <caption>Parametrizações do <b>CLIENTE</b></caption>
        <tbody>
            <tr>
                <td class="d-none d-md-table-cell table-primary">Gêneros</td>
                <td class="d-none d-md-table-cell table-primary" style="width: 10%; text-align: center">
                    <a href= "{{ route('generos.index') }}" class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                            <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table align-middle caption-top table-striped">
        <caption>Parametrizações do <b>PET</b></caption>
        <tbody>
            <tr>
                <td class="d-none d-md-table-cell table-primary">Espécies</td>
                <td class="d-none d-md-table-cell table-primary" style="width: 10%; text-align: center">
                    <a href= " " class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                            <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <td class="d-none d-md-table-cell table-primary">Raças</td>
                <td class="d-none d-md-table-cell table-primary" style="width: 10%; text-align: center">
                    <a href= " " class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                            <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection