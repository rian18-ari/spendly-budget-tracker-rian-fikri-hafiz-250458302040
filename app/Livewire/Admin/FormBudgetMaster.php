<?php

namespace App\Livewire\Admin;

use App\Models\budgetmaster;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormBudgetMaster extends Component
{
    public $budget;
    public $tahun_anggaran;
    public $detail;
    
    public function mount(){
        //
    }

    public function simpan(){

        // dd(Auth::id());
        $this->validate([
            'budget' => 'required|numeric',
            'tahun_anggaran' => 'required|numeric',
            'detail' => 'required|string'
        ],[
            'budget.numeric' => 'Hanya Boleh Angka',
            'budget.required' => 'Harus Di isi!',
            'tahun-anggaran.required' => 'Harus Di isi',

        ]);

        $user = Auth::user();
        // dd($user);

        budgetmaster::create([
            'user_id' => $user->id,
            'budget' => $this->budget,
            'tahun_anggaran' => $this->tahun_anggaran,
            'detail' => $this->detail,
        ]);

        return redirect()->route('admin.budget');

    }
    
    public function render()
    {
        return view('livewire.admin.form-budget-master')->extends('layouts.admin');
    }
}
