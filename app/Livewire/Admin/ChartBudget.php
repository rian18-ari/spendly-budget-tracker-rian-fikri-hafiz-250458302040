<?php

namespace App\Livewire\Admin;

use App\Models\budgets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartBudget extends Component
{
    public $chartLabels = [];
    public $chartData = [];
    public $labels = [];
    public $count = [];
    public $value;

    public function mount()
    {
        // Panggil fungsi untuk mengambil dan memproses data saat komponen dimuat
        $this->loadChartData();
        $this->chartData();
    }

    private function loadChartData()
    {
        $transactions = DB::table('budgets')
                          ->select('name', DB::raw('SUM(total_amount) as total'))
                          ->groupBy('name')
                          ->get();

        // Mengisi properti chartLabels (nama kegiatan) dan chartData (jumlah total)
        $this->chartLabels = $transactions->pluck('name')->toArray();
        $this->chartData = $transactions->pluck('total')->toArray();
    }

    public function chartdata()
    {
        $budget = DB::table('transactions')
                        ->select('note', DB::raw('COUNT(*) as count'))
                        ->groupBy('note')
                        ->get();

        $this->labels = $budget->pluck('note')->toArray();
        $this->count = $budget->pluck('count')->toArray();
    }
    
    public function render()
    {
        return view('livewire.admin.chart-budget')->extends('layouts.admin');
    }
}
