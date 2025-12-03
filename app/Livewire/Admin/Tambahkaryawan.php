<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Tambahkaryawan extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;
    public $no_hp;

    public function store()
    {
        // dd($this->all());
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,karyawan',
            'no_hp' => 'required|min:9|unique:users,no_hp'
        ],[
            'name.required' => 'nama harap di isi!',
            'email.required' => 'email harap di isi!',
            'email.unique' => 'email sudah digunakan',
            'password.required' => 'password harap di isi!',
            'role.required' => 'role harap di pilih!',
            'no_hp.required' => 'nomor HP harap di isi!',
            'no_hp.unique' => 'nomor HP sudah digunakan'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]);

        session()->flash('success', 'Karyawan berhasil ditambahkan.');
        return redirect()->route('admin.karyawan');
    }
    
    
    public function render()
    {
        return view('livewire.admin.tambahkaryawan')->extends('layouts.admin');
    }
}
