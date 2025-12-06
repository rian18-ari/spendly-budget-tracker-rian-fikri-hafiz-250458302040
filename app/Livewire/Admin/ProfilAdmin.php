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
        $this->validate([
            'image' => 'nullable|image|max:1024',
        ]);

        if ($this->image) {
            Storage::disk('public')->delete($this->profil->image); 
            $path = $this->image->store('foto', 'public');

            // Simpan path hasil upload ke Model
            $this->profil->image = $path;
        }

        // 3. Simpan perubahan Model
        $this->profil->save();

        // 4. Reset properti upload agar form bersih
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
