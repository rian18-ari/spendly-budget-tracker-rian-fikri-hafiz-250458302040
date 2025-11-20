<?php

namespace App\Livewire\Karyawan;

use App\Models\budgets;
use App\Models\transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormTransaksi extends Component
{
    public $amount;
    public $note;
    public $date;
    public $type;
    public $budget;
    // public $budget_id;
    // public $category_id;

    
    
    public function store()
    {
        // dd($this->all());
        
        $this->Validate([
            'amount' => 'required|numeric',
            'note' => 'required|string',
            'type' => 'required|in:pengeluaran,pemasukan',
            'date' => 'required|date',
            'budget' => 'required'
        ],[
            'amount.required' => 'Jumlah transaksi wajib diisi.',
            'amount.numeric' => 'Jumlah transaksi harus berupa angka.',
            'note.required' => 'Keterangan wajib diisi.',
            'note.string' => 'Keterangan harus berupa teks.',
            'date.required' => 'Tanggal wajib diisi.',
            'date.date' => 'Tanggal tidak valid.',
            'type.required' => 'Harap pilih type',
            'budget.required' => 'Harap pilih budget'
        ]);

        $user = Auth::user();
        $budgetproses = budgets::find($this->budget);
        $budgetakhir = $budgetproses->total_amount;
        // $this->budget;
        // dd($budgetakhir);

        // Menyimpan data transaksi

        if($budgetakhir < $this->amount)
        {
            DB::rollBack();
            session()->flash('error', 'nominal tidak cukup!');
            return;
        } else {

            
            transaction::create([
                'user_id' => $user->id,
                'budget_id' => $this->budget,
                'amount' => $this->amount,
                'note' => $this->note,
                'type' => $this->type,
                'date' => $this->date,
            ]);
            
            
            
            if ($this->type === 'pengeluaran') {
                $budgetakhir -= $this->amount;
            } else {
                $budgetakhir += $this->amount;
            }
            
            $budgetproses->total_amount = $budgetakhir;  
            
            $budgetproses->save();
            
            session()->flash('message', 'Transaksi berhasil ditambahkan.');
            return redirect()->route('transaksi');
        }
    }

    public function render()
    {
        $datauser = Auth::user();
        $dataid = $datauser->id;
        $budget = DB::table('budget_users')->where('user_id', $dataid)->pluck('budget_id')->toArray();
        
        // dd($pilihanbudget);
        
         $pilihanbudget = !empty($budget)
        ? budgets::whereIn('id', $budget)->get()
        : null;

        return view('livewire.karyawan.form-transaksi', [
            'pilihanbudget' => $pilihanbudget
        ]);
    }
}
