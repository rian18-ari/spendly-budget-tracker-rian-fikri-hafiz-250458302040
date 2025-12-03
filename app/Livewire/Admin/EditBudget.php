<?php

namespace App\Livewire\Admin;

use App\Models\budgets; // Perhatikan, ini harusnya pakai huruf besar 'Budget'
use App\Models\BudgetUser;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB; // Perlu jika menggunakan DB::table

class EditBudget extends Component
{
    // Lebih baik gunakan nama Model yang benar: Budget
    public ?budgets $budget = null; // Diubah namanya dari $budgetId menjadi $budget
    
    public $name;
    public $total_amount;
    public $detail;
    public $start_date;
    public $end_date;
    public $user_ids = []; // Mengganti $user_id (singular) menjadi $user_ids (plural) untuk menampung banyak ID

    // Pastikan model 'budgets' diubah namanya menjadi 'Budget' (standar PSR)
    public function mount($id)
    {
        // 1. Ambil Budget
        $this->budget = budgets::findOrFail($id);
        
        // 2. Isi properti
        $this->name = $this->budget->name;
        $this->total_amount = $this->budget->total_amount;
        $this->detail = $this->budget->detail;
        $this->start_date = $this->budget->start_date;
        $this->end_date = $this->budget->end_date;
        
        // 3. AMBIL USER ID (Perbaikan Logika di sini)
        // Kita gunakan pluck() pada Builder untuk mengambil array berisi user_id saja
        $this->user_ids = BudgetUser::where('budget_id', $this->budget->id)
                                    ->pluck('user_id')
                                    ->toArray(); // Diubah menjadi array agar lebih mudah diproses
    }

    public function update()
    {
        $validated = $this->validate([
            'total_amount' => 'required|numeric', // Tambahkan validasi numeric
        ]);

        $this->budget->update($validated);

        // Jika kamu ingin mengupdate tabel pivot juga, tambahkan logika di sini,
        // menggunakan $this->budget->users()->sync($this->user_ids); 

        return redirect()->route('admin.budget')->with('success', 'Budget berhasil diperbarui.');
    }
    
    public function render()
    {
        // 1. Ambil semua Karyawan yang terkait dengan Budget ini
        // Menggunakan "whereIn" dengan array ID yang sudah kita ambil di mount().
        // Ini adalah cara yang benar untuk mencari banyak ID sekaligus.
        $dataKaryawan = User::whereIn('id', $this->user_ids)->get();

        // dd($budgetUser); // Baris ini sudah tidak diperlukan

        return view('livewire.admin.edit-budget', [
            'databudget' => budgets::all(),
            'dataKaryawan' => $dataKaryawan
        ])->extends('layouts.admin');
    }
}