<?php

namespace App\Console\Commands;

use App\Models\ConsultaAgendamento;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class AtualizarStatusCron extends Command
{
    protected $signature = 'atualizarstatus:cron';

    protected $description = 'Atualizar Status de Consultas';

    public function handle()
    {
        $data = date("Y-m-d");
        $hora = date("H:i:s");

        $consultas = ConsultaAgendamento::all();

        foreach($consultas as $item) {
            if(strtotime($item->data_consulta) <= strtotime($data) 
                && strtotime($item->hora_consulta) <= strtotime($hora) && $item->status == 1) {
                $item->update([
                    'status_id' => 5,
                ]);
            }
        }
    }
}