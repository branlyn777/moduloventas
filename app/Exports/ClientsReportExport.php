<?php

namespace App\Exports;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClientsReportExport implements FromCollection, WithHeadings, WithCustomStartCell,WithTitle
{
    protected $date_From, $date_To;

    function __construct($dateFrom, $dateTo)
    {
        $this->date_From = $dateFrom;
        $this->date_To = $dateTo;
    }
    
    public function collection()
    {
        $cont = 1;

        $clients = Cliente::join("procedencia_clientes as pc", "pc.id","clientes.procedencia_cliente_id")
        ->join("cliente_movs as cm","cm.cliente_id", "clientes.id")
        ->join("movimientos as m", "m.id", "cm.movimiento_id")
        ->join("mov_services as ms", "ms.movimiento_id", "m.id")
        ->join("services as s", "s.id", "ms.service_id")
        ->join("cat_prod_services as cps", "cps.id", "s.cat_prod_service_id" )
        ->select(DB::raw('0 as no'),"clientes.nombre as nombre","clientes.celular as celular",
        "pc.procedencia as procedencia","cps.nombre as nombrecps", DB::raw('0 as created'),"clientes.created_at as created_at")
        ->whereBetween("clientes.created_at", [Carbon::parse($this->date_From)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->date_To)->format('Y-m-d')  . ' 23:59:59'])
        ->get();

        foreach ($clients as $c)
        {
            $c->created = Carbon::parse($c->created_at)->format('d-m-Y H:i:s');
            $c->no = $cont;
            $cont++;
        }


        return $clients;
    }
    public function headings(): array
    {
        return ["NO","NOMBRE","CELULAR","PROCEDENCIA","CATEGORIA","FECHA CREACIÓN"];
    }
    public function startCell(): string
    {
        return 'B2';
    }
    public function stayles(Worksheet $sheet)
    {
        return [
            2 => ['font' => ['bold' => true]]
        ];
    }
    public function title(): string
    {
        return "Reporte de Clientes";
    }
}
