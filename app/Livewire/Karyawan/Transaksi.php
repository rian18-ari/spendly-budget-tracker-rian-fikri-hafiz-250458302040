<?php

namespace App\Livewire\Karyawan;

use App\Models\budgets;
use App\Models\BudgetUser;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

class Transaksi extends Component
{
    #[Title('Transaksi Karyawan')]


    public function render()
    {
        $user = Auth::user();
        $userId = $user->id;
        $budgetIds = DB::table('budget_users')
            ->where('user_id', $userId)
            ->pluck('budget_id');
        $totalSaldo = budgets::whereIn('id', $budgetIds)->sum('total_amount');
        $riwayattransaksi = transaction::where('user_id', $userId)->get();

        return view('livewire.karyawan.transaksi', [
            'transaksi' => $riwayattransaksi,
            'saldo' => $totalSaldo,
            'ditolak' => transaction::where('status', 'di tolak')->count(),
            'disetujui' => transaction::where('status', 'di setujui')->count(),
            'menunggu' => transaction::where('status', 'menunggu')->count(),
            'flowtransaksi' => transaction::all()->count(),
        ])->extends('layouts.karyawan');
    }
}
