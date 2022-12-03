<?php

use App\Models\ConsultaAgendamento;
use App\Models\ServicoAgendamento;

function array_exists_in_array($array1, $array2) {
    
    $verificador = 0;

    foreach($array1 as $item) {
        if($item->id == $array2->id) {
            $verificador = $verificador + 1;
        }
    }

    if($verificador == 0) {
        return false;
    }

    return true;
}

function buscar_consultas_hoje() {

    $data = date("Y-m-d");

    $consultas = ConsultaAgendamento::where('data_consulta', $data)->orderBy('horario_consulta', 'ASC')->get();

    return $consultas;
}

function buscar_servicos_hoje() {

    $data = date("Y-m-d");

    $servicos = ServicoAgendamento::where('data_servico', $data)->orderBy('horario_servico', 'ASC')->get();

    return $servicos;
}