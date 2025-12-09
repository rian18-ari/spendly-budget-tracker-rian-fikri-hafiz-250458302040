<?php

namespace App\Livewire\Admin;

use App\Exports\BudgetExport;
use App\Models\BudgetMaster;
use App\Models\budgetmaster as ModelsBudgetmaster;
use App\Models\budgets;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Budget extends Component
{ 
    public $search = '';
    // protected $queryString = ['search'];
    
    // HILANGKAN FUNGSI mount()
    // Karena query sudah dilakukan secara dinamis di render(), mount() tidak diperlukan dan hanya menyebabkan query ganda.
    // public function mount()
    // {
    //     $this->searchKey = budgets::all();
    // }
    
    public function export()
    {
        return Excel::download(new BudgetExport, 'data-budget-'.now()->timestamp.'.xlsx');
    }
    
    public function deletebudget($id)
    {
        // ... (Logika delete sudah benar, tidak perlu diubah)
        $budget = budgets::find($id);
        if ($budget) {
            $budget->delete();
            session()->flash('message', 'Budget berhasil dihapus.');
        } else {
            session()->flash('error', 'Budget tidak ditemukan.');
        }
    }

    public function render()
    {

        return view('livewire.admin.budget',[
            'title' => 'Budget Management',
            'budgets' => budgets::all(), 
            'budget_master' => ModelsBudgetmaster::where('tahun_anggaran', now()->year)->first(),
            'totalBudget' => budgets::count(),
        ])->extends('layouts.admin');
    }
}