<?php

namespace App\Livewire\Admin;

use App\Models\budgetmaster;
use App\Models\budgets;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $chartLabels = [];
    public $chartData = [];

    // Judul untuk komponen
    public $title = 'Visualisasi Pengeluaran Anggaran';

    public function mount()
    {
        // Panggil fungsi untuk mengambil dan memproses data saat komponen dimuat
        $this->loadChartData();
    }

    private function loadChartData()
    {
        // Mengambil data dari database.
        // Kita kelompokkan berdasarkan 'name' untuk mendapatkan total_amount per kegiatan.
        // Jika kamu memiliki banyak data, lebih baik batasi atau tambahkan filter.
        $transactions = DB::table('budgets')
                          ->select('name', DB::raw('SUM(total_amount) as total'))
                          ->groupBy('name')
                          ->get();

        // Mengisi properti chartLabels (nama kegiatan) dan chartData (jumlah total)
        $this->chartLabels = $transactions->pluck('name')->toArray();
        $this->chartData = $transactions->pluck('total')->toArray();
    }
    
    public function render()
    {
        return view('livewire.admin.dashboard' ,[
            // 'user' => Auth::user()->id,
            'budget_master' => budgetmaster::all(),
            'total_pengeluaran' => transaction::where('type', 'pengeluaran')->sum('amount'),
            'pengguna' => User::all()->count(),
            'dataChart' => budgets::all(),
            'budgetAktif' => budgets::all()->count(),
            // dd($budgetmaster)
        ])->extends('layouts.admin');
    }
}
