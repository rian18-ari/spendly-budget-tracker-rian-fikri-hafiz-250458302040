<?php

namespace App\Livewire\Admin;

use App\Exports\TransaksiExport;
use App\Models\budgets;
use App\Models\transaction;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Transaksi extends Component
{
    public $statusFilter;

    public function export()
    {
        return Excel::download(new TransaksiExport, 'data-transaksi-' . now()->timestamp . '.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.transaksi', [
            'transaksi' => transaction::all(),
            'flowtransaksi' => transaction::count(),
            'ditolak' => transaction::where('status', 'di tolak')->count(),
            'disetujui' => transaction::where('status', 'di setujui')->count(),
            'menunggu' => transaction::where('status', 'menunggu')->count(),
        ])->extends('layouts.admin');
    }
}
