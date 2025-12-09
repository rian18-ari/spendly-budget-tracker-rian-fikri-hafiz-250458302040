<?php

namespace App\Exports;

use App\Models\transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return transaction::select('id', 'amount', 'note', 'date', 'type', 'status')->get();
    }

    /**
     * Mendefinisikan baris header (judul kolom) di Excel.
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'NOMINAL',
            'NAMA TRANSAKSI',
            'TANGGAL',
            'TIPE',
            'STATUS'
        ];
    }

    /**
     * Memetakan data dari Model ke baris Excel.
     * @param mixed $transaction
     * @return array
     */
    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->amount,
            $transaction->note,
            $transaction->date,
            $transaction->type,
            $transaction->status,
            
        ];
    }
}
