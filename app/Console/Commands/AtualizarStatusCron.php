<?php

namespace App\Console\Commands;

use App\Models\ConsultaAgendamento;
use DateTime;
use DateTimeZone;
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
        $timeZone = new DateTimeZone('America/Sao_Paulo');
        $data_atual = DateTime::createFromFormat ('Y-m-d', $data, $timeZone);
        $consultas = ConsultaAgendamento::all();

        foreach($consultas as $item) {
            $data_consulta = DateTime::createFromFormat ('Y-m-d H:i:s', $item->data_consulta.' '.$item->horario_consulta);

            if($data_atual > $data_consulta && $item->status_id == 1) {
                $item->update([
                    'status_id' => 5,
                ]);
            }
        }
    }
}