 @section('title', 'Karyawan')
 <div class="border-2 rounded-lg w-auto h-auto p-6 bg-amber-50">
     <div>
         <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Karyawan</h2>
     </div>
     {{-- form start --}}
     <form class="gap-x-4" wire:submit.prevent="store">
         <div class="grid grid-cols-2 gap-4">
             <div>
                 <label for="image">Foto</label>
                 <div class="mt-1">
                     <input type="file" wire:model="image" id="image" placeholder="foto karyawan"
                         class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                     @error('image')
                         <span class="text-sm text-red-500">
                             {{ $message }}
                         </span>
                     @enderror
                 </div>
             </div>
             <div>
                 {{-- name  --}}
                 <div>
                     <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                     <div class="mt-1">
                         <input type="text" wire:model="name" id="name" placeholder="nama karyawan"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('name')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- email --}}
                 <div>
                     <label for="email" class="block text-sm font-medium text-gray-900">email</label>
                     <div class="mt-1">
                         <input type="email" wire:model="email" id="email" placeholder="email karyawan"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('email')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- password --}}
                 <div>
                     <label for="amount" class="block text-sm font-medium text-gray-900">Password</label>
                     <div class="mt-1">
                         <input type="text" wire:model="password" id="password" placeholder="password karyawan"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('password')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- no hp --}}
                 <div>
                     <label for="no_hp" class="block text-sm font-medium text-gray-900">No. HP</label>
                     <div class="mt-1">
                         <input type="text" wire:model="no_hp" id="no_hp" placeholder="no hp karyawan"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('no_hp')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- role --}}

                 <div>
                     <label for="date" class="block text-sm font-medium text-gray-900">Jabatan</label>
                     <div class="mt-1">
                         <select wire:model="role" id="" required
                             class="block w-full rounded-md border-gray-300">
                             <option value="">--Pilih Jabatan--
                             </option>
                             <option value="karyawan">Karyawan
                             </option>
                             <option value="admin">Admin
                             </option>
                         </select>
                     </div>
                 </div>
                 <div>
                     <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-4 w-full">
                         <a wire:navigate href="{{ route('admin.karyawan') }}"
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
