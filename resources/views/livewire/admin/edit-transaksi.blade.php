 @section('title', 'Transaksi')
 <div class="border-2 rounded-lg w-auto h-auto p-6 bg-amber-50">
     <div class="flex justify-between">
         <h2 class="text-2xl font-semibold text-gray-800 mb-4">Detail Transaksi</h2>
         <div class="bg-gray-700/25 px-4 py-3 rounded-lg border-gray-700/25">
             <p class="text-sm font-medium text-gray-900">Pembuat</p>
             <h3 class="text-lg font-semibold text-gray-800">{{ $userName }}</h3>
         </div>
     </div>
     {{-- form start --}}
     <form class="gap-x-4" wire:submit.prevent="update">
         <div class="grid grid-cols-2 gap-4">
             <div>
                 {{-- name  --}}
                 <div>
                     <label for="note" class="block text-sm font-medium text-gray-900">Name</label>
                     <div class="mt-1">
                         <input type="text" wire:model="note" id="note"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('note')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- nominal --}}
                 <div>
                     <label for="amount" class="block text-sm font-medium text-gray-900">Nominal</label>
                     <div class="mt-1">
                         <input type="text" wire:model="amount" id="amount"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('amount')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- tanggal --}}
                 <div>
                     <label for="date" class="block text-sm font-medium text-gray-900">Tanggal</label>
                     <div class="mt-1">
                         <input type="text" wire:model="date" id="date"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('date')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 <div class="grid gap-4 grid-cols-2">
                     <div class="col-span-1">
                         <label for="type" class="block text-sm font-medium text-gray-900">Tipe</label>
                         <div class="mt-1">
                             <input type="text" wire:model="type" id="type" required
                                 class="block w-full rounded-md border-gray-300">
                             @error('type')
                                 <span class="text-sm text-red-500">
                                     {{ $message }}
                                 </span>
                             @enderror
                         </div>
                     </div>
                     <div class="col-span-1">
                         <label for="status" class="block text-sm font-medium text-gray-900">Status</label>
                         <div class="mt-1">
                             <select wire:model="status" id="status" required
                                 class="block w-full rounded-md border-gray-300">
                                 @error('status')
                                     <span class="text-sm text-red-500">
                                         {{ $message }}
                                     </span>
                                 @enderror
                                 <option value="menunggu">menunggu</option>
                                 <option value="di setujui">di setujui</option>
                                 <option value="di tolak">di tolak</option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
             <div>
                <label for="image" class="block text-sm font-medium text-gray-900">Foto Struk Transaksi</label>
                <div class="mt-1">
                    <img src="{{ asset('storage/' . $transaksi->image) }}" alt="">
                </div>
             </div>
         </div>
         <div>
             <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-4 w-full">
                 <a wire:navigate href="{{ route('transaksiadmin') }}" command="close" commandfor="dialog"
                     class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white hover:bg-red-400 sm:ml-3 sm:w-auto">Batal</a>
                 <button type="submit"
                     class="mt-3 inline-flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 sm:mt-0 sm:w-auto">Simpan</button>
             </div>
         </div>
     </form>
     {{-- form end --}}
 </div>
