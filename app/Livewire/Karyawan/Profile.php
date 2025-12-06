<?php

namespace App\Livewire\Karyawan;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $image;
    public $profile;

    public function mount()
    {
        $this->profile = Auth::user();
    }

    public function updateProfile()
    {
        $this->validate([
            'image' => 'nullable|image|max:1024',
        ]);

        if ($this->image) {
            Storage::disk('public')->delete($this->profile->image); 
            $path = $this->image->store('foto', 'public');

            // Simpan path hasil upload ke Model
            $this->profile->image = $path;
        }

        // 3. Simpan perubahan Model
        $this->profile->save();

        // 4. Reset properti upload agar form bersih
        $this->reset('image');

        session()->flash('success', 'Profile berhasil diperbarui');
    }

    public function render()
    {
        $user = Auth::user();
        $userId = $user->id;

        return view('livewire.karyawan.profile', [
            'user' => User::where('id', $userId)->first()
        ])->extends('layouts.karyawan');
    }
}
