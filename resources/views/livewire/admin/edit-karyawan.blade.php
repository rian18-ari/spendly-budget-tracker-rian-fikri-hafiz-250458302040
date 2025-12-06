 @section('title', 'Karyawan')
 <div class="border-2 rounded-lg w-auto h-auto p-6 bg-amber-50">
     <div>
         <h2 class="text-2xl font-semibold text-gray-800 mb-4">Detail Karyawan</h2>
     </div>
     {{-- form start --}}
     <form class="gap-x-4" wire:submit.prevent="update">
         <div class="grid grid-cols-2 gap-4 w-full h-full">
             <div>
                 {{-- image --}}
                 <div class="flex flex-col justify-center items-center">
                     <label for="image" class="block text-sm font-medium text-gray-900">Foto</label>
                     <div class="border-2 mt-4 rounded-full w-60 h-60 border-gray-500 bg-amber-50">
                         @auth
                             @if (!$datakaryawan->image)
                                 <img src="{{ asset('asset/img/profil default instagram.jpeg') }}"
                                     class="w-full h-full rounded-full" alt="">
                             @else
                                 <img src="{{ asset('storage/' . $datakaryawan->image) }}" class="w-full h-full rounded-full"
                                     alt="">
                             @endif
                         @endauth
                     </div>
                 </div>
             </div>
             <div>
                 {{-- name  --}}
                 <div>
                     <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                     <div class="mt-1">
                         <input type="text" wire:model="name" id="name"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('name')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- no hp --}}
                 <div>
                     <label for="no_hp" class="block text-sm font-medium text-gray-900">No HP</label>
                     <div class="mt-1">
                         <input type="text" wire:model="no_hp" id="no_hp"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('no_hp')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- email --}}
                 <div>
                     <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                     <div class="mt-1">
                         <input type="text" wire:model="email" id="email"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('email')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- role --}}
                 <div>
                     <label for="role" class="block text-sm font-medium text-gray-900">Jabatan</label>
                     <div class="mt-1">
                         <select wire:model="role" id="role" required
                             class="block w-full rounded-md border-gray-300">
                             <option value="karyawan">Karyawan
                             </option>
                             <option value="admin">Admin
                             </option>
                         </select>
                     </div>
                 </div>
                 <div>
                     <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-4 w-full">
                         <a wire:navigate href="{{ route('admin.karyawan') }}" command="close" commandfor="dialog"
                             class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white hover:bg-red-400 sm:ml-3 sm:w-auto">Batal</a>
                         <button type="submit"
                             class="mt-3 inline-flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 sm:mt-0 sm:w-auto">Simpan</button>
                     </div>
                 </div>
             </div>
         </div>
     </form>
     {{-- form end --}}
 </div>
