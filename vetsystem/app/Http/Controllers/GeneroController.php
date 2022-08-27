<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index()
    {
        $genero = Genero::all();

        return view('generos.index', compact(['genero']));
    }

    public function create()
    {
        return view('generos.create');
    }

    public function store(Request $request)
    {
        Genero::create([
            "nome" => mb_strtoupper($request->nome)
        ]);

        return redirect()->route('generos.index');
    }

    public function show(Genero $genero)
    {
        return view('generos.show', compact(['genero']));
    }

    public function edit(Genero $genero)
    {
        return view('generos.edit', compact(['genero']));
    }

    public function update(Request $request, Genero $genero)
    {
        $genero->update([
            "nome" => mb_strtoupper($request->nome)
        ]);

        return redirect()->route('generos.index');
    }

    public function destroy(Genero $genero)
    {
        $genero->delete();

        return redirect()->route('generos.index');
    }
}
