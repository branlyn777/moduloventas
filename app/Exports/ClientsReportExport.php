<?php

namespace App\Exports;

use App\Models\Cliente;
use Carbon\Carbon;
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
        $cont = 0;

        $clients = Cliente::join("procedencia_clientes as pc", "pc.id","clientes.procedencia_cliente_id")
        ->select("clientes.id as id","clientes.nombre as nombre","clientes.celular as celular","pc.procedencia as procedencia","clientes.created_at as created_at")
        ->whereBetween("clientes.created_at", [Carbon::parse($this->date_From)->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->date_To)->format('Y-m-d')     . ' 23:59:59'])
        ->where("clientes.estado","ACTIVO")
        ->get();

        foreach ($clients as $c)
        {
            $c->created_at = Carbon::parse($c->created_at)->format('d-m-Y H:i');
            $cont++;
        }
        return $clients;
    }
    public function headings(): array
    {
        return ["ID","NOMBRE","CELULAR","PROCEDENCIA","FECHA CREACIÓN"];
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
