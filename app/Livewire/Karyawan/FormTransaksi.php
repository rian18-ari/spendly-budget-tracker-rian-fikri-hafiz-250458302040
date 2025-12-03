<?php

namespace App\Livewire\Karyawan;

use App\Models\budgets;
use App\Models\transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormTransaksi extends Component
{
    use WithFileUploads;
    public $amount;
    public $note;
    public $date;
    public $type;
    public $budget;
    public $image;
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
            'budget' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ],[
            'amount.required' => 'Jumlah transaksi wajib diisi.',
            'amount.numeric' => 'Jumlah transaksi harus berupa angka.',
            'note.required' => 'Keterangan wajib diisi.',
            'note.string' => 'Keterangan harus berupa teks.',
            'date.required' => 'Tanggal wajib diisi.',
            'date.date' => 'Tanggal tidak valid.',
            'type.required' => 'Harap pilih type',
            'budget.required' => 'Harap pilih budget',
            'image.required' => 'Foto struk wajib diisi.',
            'image.image' => 'Foto struk harus berupa gambar.',
            'image.mimes' => 'Foto struk harus berformat jpeg, png, jpg, atau gif.',
            'image.max' => 'Foto struk tidak boleh lebih dari 2MB.',
        ]);

        $user = Auth::user();
        $budgetproses = budgets::find($this->budget);
        $budgetakhir = $budgetproses->total_amount;

        if($this->type === 'pengeluaran' && $budgetakhir < $this->amount)
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
                'image' => $this->image->store('struk', 'public'),
                'date' => $this->date,
            ]);
            
            
            
            if ($this->type === 'pengeluaran') {
                $budgetakhir -= $this->amount;
            } else {
                $budgetakhir += $this->amount;
            }
            
            $budgetproses->total_amount = $budgetakhir;  
            
            $budgetproses->save();
            
            session()->flash('success', 'Transaksi berhasil ditambahkan.');
            return redirect()->route('transaksi');
        }
    }

    public function render()
    {
        $datauser = Auth::user();
        $dataid = $datauser->id;
        $budget = DB::table('budget_users')->where('user_id', $dataid)->pluck('budget_id')->toArray();
        
         $pilihanbudget = !empty($budget)
        ? budgets::whereIn('id', $budget)->get()
        : null;

        return view('livewire.karyawan.form-transaksi', [
            'pilihanbudget' => $pilihanbudget
        ])->extends('layouts.karyawan');
    }
}
