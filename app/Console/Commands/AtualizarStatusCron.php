<?php

namespace App\Console\Commands;

use App\Models\ConsultaAgendamento;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AtualizarStatusCron extends Command
{
    protected $signature = 'atualizarstatus:cron';

    protected $description = 'Atualizar Status de Consultas';

    public function handle()
    {
        /*$consultas = ConsultaAgendamento::all();

        foreach($consultas as $item) {
            if($item->status->id == 1) {
                $item->update([
                    'status_id' => 2,
                ]);
            }
        }*/
    }
}