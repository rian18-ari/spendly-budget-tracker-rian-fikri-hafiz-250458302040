<?php

namespace App\Livewire\Karyawan;

use Livewire\Component;
use App\Models\budgets;
use App\Models\transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $userId = $user->id;
        $budgetIds = DB::table('budget_users')
            ->where('user_id', $userId)
            ->pluck('budget_id');
        $totalSaldo = budgets::whereIn('id', $budgetIds)->sum('total_amount');
        $totalpengeluaran = transaction::where('user_id', $userId);
        $maxTransactionObject = transaction::query()
            ->where('user_id', $userId)
            ->orderByDesc('amount') // Urutkan transaksi dari yang paling besar ke kecil
            ->first(); // Ambil satu baris pertama (yang paling besar)

        return view('livewire.karyawan.dashboard', [
            'title' => 'Dashboard Karyawan',
            'balance' => $totalSaldo,
            'total_pengeluaran' => $totalpengeluaran->sum('amount'),
            'nominalTerbesar' => $maxTransactionObject,

        ])->extends('layouts.karyawan');
    }
}
