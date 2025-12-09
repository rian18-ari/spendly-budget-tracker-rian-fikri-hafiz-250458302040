<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id', 'name', 'email', 'no_hp', 'role')->get();
    }

    /**
     * Mendefinisikan baris header (judul kolom) di Excel.
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'NAMA',
            'EMAIL',
            'NO. HP',
            'ROLE',
        ];
    }

    /**
     * Memetakan data dari Model ke baris Excel.
     * @param mixed $user
     * @return array
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->no_hp,
            $user->role,
        ];
    }
}
