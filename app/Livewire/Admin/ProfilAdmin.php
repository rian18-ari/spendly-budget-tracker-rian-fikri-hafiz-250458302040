<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilAdmin extends Component
{
    use WithFileUploads;
    public $image;
    public $profil;

    public function mount()
    {
        $this->profil = Auth::user();
    }

    public function updateProfile()
    {
        // 1. Validasi
        $this->validate([
            'image' => 'nullable|image|max:1024',
        ]);

        // Ambil path gambar lama dengan aman (null-safe)
        // Jika $this->profile->image bernilai NULL atau kosong, $oldImagePath akan menjadi null
        $oldImagePath = $this->profile->image;

        if ($this->image) {
            // 2. Hapus Gambar Lama HANYA JIKA path-nya valid (bukan null atau string kosong)
            if ($oldImagePath) {
                // Karena kita sudah yakin $oldImagePath bukan null, kita bisa menghapusnya
                Storage::disk('public')->delete($oldImagePath);
            }

            // 3. Upload Gambar Baru
            $path = $this->image->store('foto', 'public');

            // Simpan path hasil upload ke Model
            $this->profile->image = $path;
        }

        // 4. Simpan perubahan Model (bisa berupa path baru atau hanya perubahan data lain)
        $this->profile->save();

        // 5. Reset properti upload agar form bersih
        $this->reset('image');

        session()->flash('success', 'Profile berhasil diperbarui');
    }

    public function render()
    {
        $user = Auth::user();
        $userId = $user->id;

        return view('livewire.admin.profil-admin', [
            'profil' => User::where('id', $userId)->first()
        ])->extends('layouts.admin');
    }
}
