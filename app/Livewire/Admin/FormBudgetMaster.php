<?php

namespace App\Livewire\Admin;

use App\Models\budgetmaster;
use Carbon\Carbon;
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

        $tahun_sekarang = Carbon::now()->year;

        // dd(Auth::id());
        $this->validate([
            'budget' => 'required|numeric',
            'tahun_anggaran' => 'required|numeric|unique:budgetmasters,tahun_anggaran|in:'.$tahun_sekarang,
            'detail' => 'required|string',
        ],[
            'budget.numeric' => 'Hanya Boleh Angka',
            'budget.required' => 'Harus Di isi!',
            'tahun_anggaran.required' => 'Harus Di isi',
            'tahun_anggaran.unique' => 'Tahun anggaran sudah ada',
            'detail.required' => 'Harus Di isi',
            'tahun_anggaran.in' => 'Hanya boleh 1 anggaran dalam 1 tahun'
        ]);

        $user = Auth::user();
        // dd($user);

        budgetmaster::create([
            'user_id' => $user->id,
            'budget' => $this->budget,
            'tahun_anggaran' => $this->tahun_anggaran,
            'detail' => $this->detail,
        ]);

        session()->flash('success', 'Budget berhasil ditambahkan.');
        return redirect()->route('admin.budget');

    }
    
    public function render()
    {
        return view('livewire.admin.form-budget-master')->extends('layouts.admin');
    }
}
