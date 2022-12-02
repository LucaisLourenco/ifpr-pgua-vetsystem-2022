<?php

namespace App\Http\Controllers;

use App\Facades\UserPermissions;
use App\Models\Especialidade;
use App\Models\Veterinario;
use App\Models\VeterinarioEspecialidade;
use Illuminate\Http\Request;

class VeterinarioEspecialidadeController extends Controller
{
    public function __construct() {
        $this->authorizeResource(VeterinarioEspecialidade::class, 'veterinarioespecialidade');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if(!UserPermissions::isAuthorized('veterinarios.create')) {
            return view('acessonegado.index');
        }

        $veterinario = Veterinario::find($request->veterinario_id);
        $veterinario->especialidades()->detach();

        if(isset($request['especialidade_id'])) {
            foreach($request['especialidade_id'] as $item) {
                $especialidade = Especialidade::find($item);    
                if(isset($especialidade)){
                    $especialidades = new VeterinarioEspecialidade();
                    $especialidades->veterinario()->associate($veterinario);
                    $especialidades->especialidade()->associate($especialidade);
                    $especialidades->save();
                }
            }
        }
        
        return redirect()->route('veterinarios.show', $veterinario->id);
    }

    public function show(VeterinarioEspecialidade $veterinarioEspecialidade)
    {
        //
    }

    public function edit(VeterinarioEspecialidade $veterinarioEspecialidade)
    {
        //
    }

    public function update(Request $request, VeterinarioEspecialidade $veterinarioEspecialidade)
    {
        //
    }

    public function destroy(VeterinarioEspecialidade $veterinarioEspecialidade)
    {
        //
    }

    public function gravar($id) 
    {
        if(!UserPermissions::isAuthorized('veterinarios.create')) {
            return view('acessonegado.index');
        }

        $especialidades = Especialidade::all();
        $veterinario = Veterinario::with(['especialidades'])->get()->find($id);

        return view('veterinarioespecialidades.gravar', compact(['especialidades','veterinario']));
    }
}
