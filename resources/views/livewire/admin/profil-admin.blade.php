@section('title', 'Profile')
<div class="border-2 rounded-lg w-auto h-auto p-2 bg-amber-50">
    <div class="flex gap-4">
        <div class="w-1/3 flex flex-col gap-2 items-center">
            <div class="border-2 rounded-full w-60 h-60 border-gray-500 bg-amber-50">
                @auth
                    @if (!$profil->image)
                        <img src="{{ asset('asset/img/profil default instagram.jpeg') }}" class="w-full h-full rounded-full"
                            alt="">
                    @else
                        <img src="{{ asset('storage/' . $profil->image) }}" class="w-full h-full rounded-full" alt="">
                    @endif
                @endauth
            </div>
            <form wire:submit.prevent="updateProfile" class="gap-2 flex flex-col">
                <label class="block w-full sm:w-2/3">
                    <span class="sr-only">Pilih File Foto</span>
                    <input type="file" wire:model="image"
                        class="
                            block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-gray-50 file:text-gray-700
                            hover:file:bg-gray-100 transition duration-150
                            cursor-pointer
                        " />
                </label>

                <button type="submit"
                    class="w-full px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    Ubah Profil
                </button>
            </form>
        </div>
        <div class="flex flex-col gap-2 p-2 w-full h-full rounded-lg mt-2">
            <h1 class="text-2xl font-bold">Profil Pegawai</h1>
            <div class="bg-gray-300 p-2 rounded-lg gap-2 h-full">
                <p class="text-lg font-semibold">Nama: <span class="font-normal">{{ $profil->name }}</span></p>
                <hr class="border-gray-500 w-1/2 items-center my-2">
                <p class="text-lg font-semibold">Email: <span class="font-normal">{{ $profil->email }}</span></p>
                <hr class="border-gray-500 w-1/2 items-center my-2">
                <p class="text-lg font-semibold">Role: <span class="font-normal">{{ $profil->role }}</span></p>
                <hr class="border-gray-500 w-1/2 items-center my-2">
                <p class="text-lg font-semibold">Dibuat: <span
                        class="font-normal">{{ $profil->created_at->format('d-m-Y') }}</span></p>
                <hr class="border-gray-500 w-1/2 items-center my-2">
                <p class="text-lg font-semibold">Diupdate: <span
                        class="font-normal">{{ $profil->updated_at->format('d-m-Y') }}</span></p>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('dashboardadmin') }}"
                    class="w-1/4 text-center px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 ease-in-out">Kembali</a>
            </div>
        </div>
    </div>
</div>
