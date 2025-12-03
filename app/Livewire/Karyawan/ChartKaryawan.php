<?php

namespace App\Livewire\Karyawan;

use App\Models\transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartKaryawan extends Component
{
    public $labels = [];   
    public $data = [];     
    public $userId = null;
    public $chartTitle;
    
    public $filterDays = 14;

    public function mount()
    {
        $this->userId = Auth::id();
        $this->loadChartData();
    }

    public function loadChartData()
    {
        $userId = $this->userId;
        
        $filterData = (int) $this->filterDays; 
        
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays($filterData - 1); 
        // dd($filterData);
        $dailyTransactions = transaction::query()
            ->where('user_id', $userId) 
            ->whereBetween('date', [$startDate, $endDate])
            ->select(
                'date',
                DB::raw('SUM(amount) as daily_amount') 
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date');

        $this->labels = [];
        $this->data = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dateString = $date->toDateString();
            $this->labels[] = $date->format('d/M'); 
            $dailyAmount = $dailyTransactions[$dateString]->daily_amount ?? 0;
            $this->data[] = (int) $dailyAmount; 
        }
        
        $this->chartTitle = 'Tren Pengeluaran ' . $this->filterDays . ' Hari Terakhir';

        $this->dispatch('chart-data-updated', [
            'labels' => $this->labels,
            'data' => $this->data,
            'title' => $this->chartTitle, 
        ]);
    }

    public function render()
    {
        return view('livewire.karyawan.chart-karyawan')->extends('layouts.karyawan'); 
    }
}