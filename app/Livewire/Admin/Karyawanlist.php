<?php

namespace App\Livewire\Admin;

use App\Exports\UsersExport;
use App\Models\User;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Karyawanlist extends Component
{
    public $selected_id;
    public $search;

    
    public function render()
    {
        return view('livewire.admin.karyawanlist', [
            'karyawans' => User::where('role', 'karyawan')->where('name', 'like', '%' . $this->search . '%')->get(),
            'totalkaryawan' => user::all()->count(),
            'jeniskaryawan' => User::where('role', 'karyawan')->count(),
            'totaladmin' => User::where('role', 'admin')->count(),
        ])->extends('layouts.admin');
    }
    
    public function export()
    {
        return Excel::download(new UsersExport, 'data-pegawai-'.now()->timestamp.'.xlsx');
    }

    public function confirmDelete($id)
    {
        $this->selected_id = $id;
    }

    public function deleteKaryawan()
    {

        $karyawan = User::find($this->selected_id);
        if ($karyawan) {
            $karyawan->delete();
            session()->flash('message', 'Karyawan berhasil dihapus.');
        } else {
            session()->flash('error', 'Karyawan tidak ditemukan.');
        }
        $this->selected_id = null; 
    }
}
