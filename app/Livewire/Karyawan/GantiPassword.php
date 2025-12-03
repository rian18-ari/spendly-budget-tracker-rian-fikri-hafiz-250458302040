<?php

namespace App\Livewire\Karyawan;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

class GantiPassword extends Component
{
    #[Title('Ganti Password')]

    public $current_password;
    public $password;
    public $password_confirmation;

    public function save()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed|different:current_password',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password.different' => 'Password baru tidak boleh sama dengan password lama.',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->save();

        $this->reset();

        session()->flash('success', 'Password berhasil diubah!');
    }

    public function render()
    {
        return view('livewire.karyawan.ganti-password')->extends('layouts.karyawan');
    }
}
