 @section('title', 'Transaksi')
 <div class="border-2 rounded-lg w-auto h-auto p-6 bg-amber-50">
     <div>
         <h2 class="text-2xl font-semibold text-gray-800 mb-4">Form Tambah Transaksi</h2>
     </div>

     {{-- form start --}}
     <form class="gap-x-4" wire:submit.prevent="store">
         <div class="grid grid-flow-col grid-cols-2 gap-4">
             <div class="">
                 {{-- keterangan --}}
                 <div>
                     <label for="note" class="block text-sm font-medium text-gray-900">Keterangan</label>
                     <div class="mt-1">
                         <input type="text" wire:model="note" id="note" placeholder="Contoh: Belanja makanan"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('note')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- jenis --}}
                 <div>
                     <label for="note" class="block text-sm font-medium text-gray-900">Jenis</label>
                     <div class="mt-1">
                         <select wire:model="type" id=""class="block w-full rounded-md border-gray-300">
                             <option value="">--Pilih Jenis--
                             </option>
                             <option value="pemasukan">Pemasukan
                             </option>
                             <option value="pengeluaran">Pengeluaran
                             </option>
                         </select>
                         @error('type')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- budget --}}
                 <div>
                     <label for="note" class="block text-sm font-medium text-gray-900">Budget</label>
                     <div class="mt-1">
                         <select wire:model="budget" class="block w-full rounded-md border-gray-300">
                             <option value="">--Pilih Budget--</option>
                             @if ($pilihanbudget && count($pilihanbudget) > 0)
                                 @forelse ($pilihanbudget as $item)
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @empty
                                     <option value="">Belum ada budget terasosiasi.</option>
                                 @endforelse
                             @endif
                         </select>
                         @error('budget')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                 {{-- jumlah --}}
                 <div>
                     <label for="amount" class="block text-sm font-medium text-gray-900">Jumlah
                         (Rp.)</label>
                     <div class="mt-1">
                         <input type="number" wire:model="amount" id="amount"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('amount')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                     {{-- error message --}}
                     <div>
                         @if (session('error'))
                             <span class="text-sm text-red-500">
                                 {{ session('error') }}
                             </span>
                         @endif
                     </div>
                 </div>
                 {{-- tanggal --}}
                 <div>
                     <label for="date" class="block text-sm font-medium text-gray-900">Tanggal</label>
                     <div class="mt-1">
                         <input type="date" wire:model="date" id="date"
                             class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('date')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
                </div>
                 <div class="">
                     <label for="image" class="block text-sm font-medium text-gray-900">Foto Struk Transaksi</label>
                     <div class="mt-1">
                         <input type="file" wire:model="image" id="image" placeholder="Upload Struk Transaksi"
                             class="block h-75 bg-white w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                         @error('image')
                             <span class="text-sm text-red-500">
                                 {{ $message }}
                             </span>
                         @enderror
                     </div>
                 </div>
         </div>
         <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-4 w-full">
             <a wire:navigate href="{{ route('transaksi') }}" command="close" commandfor="dialog"
                 class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white hover:bg-red-400 sm:ml-3 sm:w-auto">Batal</a>
             <button type="submit"
                 class="mt-3 inline-flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 sm:mt-0 sm:w-auto">Simpan</button>
         </div>
     </form>
     {{-- form end --}}
 </div>
