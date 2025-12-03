@section('title', 'Budget')
 <div class="border-2 rounded-lg w-auto h-auto p-6 bg-amber-50">
     <div>
         <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Budget</h2>
     </div>
     {{-- form start --}}
     <form class="gap-x-4" wire:submit.prevent="simpan">
         <div>
             {{-- budget --}}
             <div>
                 <label for="budget" class="block text-sm font-medium text-gray-900">Budget</label>
                 <div class="mt-1">
                     <input type="number" wire:model="budget" id="budget" placeholder="nominal budget"
                         class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                     @error('budget')
                         <span class="text-sm text-red-500">
                             {{ $message }}
                         </span>
                     @enderror
                 </div>
             </div>
             {{-- tahun anggaran --}}
             <div>
                 <label for="tahun_anggaran" class="block text-sm font-medium text-gray-900">Tahun Anggaran</label>
                 <div class="mt-1">
                     <input type="number" wire:model="tahun_anggaran" id="tahun_anggaran" placeholder="Tahun anggaran"
                         class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                     @error('email')
                         <span class="text-sm text-red-500">
                             {{ $message }}
                         </span>
                     @enderror
                 </div>
             </div>
             {{-- datail --}}
             <div>
                 <label for="amount" class="block text-sm font-medium text-gray-900">Detail</label>
                 <div class="mt-1">
                     <input type="text" wire:model="detail" id="detail" placeholder="tulis detail"
                         class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                     @error('password')
                         <span class="text-sm text-red-500">
                             {{ $message }}
                         </span>
                     @enderror
                 </div>
             </div>
             {{-- end date --}}
             <div>
                 <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-4 w-full">
                     <a wire:navigate href="{{route('admin.budget')}}" type="button" command="close" commandfor="dialog"
                         class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white hover:bg-red-400 sm:ml-3 sm:w-auto">Batal</a>
                     <button type="submit"
                         class="mt-3 inline-flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 sm:mt-0 sm:w-auto">Simpan</button>
                 </div>
             </div>
     </form>
     {{-- form end --}}
 </div>
