<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Especie;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::all();

        return view('pets.index', compact(['pets']));
    }

    public function create()
    {
        $especies = Especie::all();

        return view('Pets.create', compact(['especies']));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Pet $pet)
    {
        //
    }

    public function edit(Pet $pet)
    {
        //
    }

    public function update(Request $request, Pet $pet)
    {
        //
    }

    public function destroy(Pet $pet)
    {
        //
    }
}
