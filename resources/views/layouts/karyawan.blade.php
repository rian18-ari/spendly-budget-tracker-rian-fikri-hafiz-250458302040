<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>{{ $title ?? 'Spendly-Budget Tracker' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
        }

        .scroll-container::-webkit-scrollbar {
            width: 8px;
        }

        .scroll-container::-webkit-scrollbar-thumb {
            background-color: #94a3b8;
            border-radius: 4px;
        }

        .scroll-container::-webkit-scrollbar-track {
            background-color: #e2e8f0;
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    @if (session('success'))
        <div id="success-notification" data-type="success" data-message="{{ session('success') }}">
        </div>
    @endif

    @if (session('error'))
        <div id="error-notification" data-type="error" data-message="{{ session('error') }}">
        </div>
    @endif

    <nav :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 w-50 bg-orange-200 border-r-2 rounded-lg transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:flex-shrink-0 -translate-x-full">

        <div class="p-2 mx-2 my-4 border-2 h-22 bg-gray-50 flex items-center justify-between rounded-lg">
            <img src="{{ asset('asset/img/spendly-high-resolution-logo-transparent.png') }}" alt=""
                class="w-70">
            <!-- Tombol Tutup Sidebar (Hanya Mobile) -->
            <button @click="sidebarOpen = false"
                class="lg:hidden text-cyan-900 hover:text-indigo-400 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Isi Menu Sidebar -->
        <div class="p-4 h-full">
            <a wire:navigate href="{{ route('dashboard') }}"
                class="flex items-center p-3 font-medium text-cyan-900 rounded-lg transition duration-150 hover:bg-cyan-900 hover:text-orange-200 text-xl">
                <i class="fa-solid fa-display mr-2"></i>
                Beranda
            </a>
            <a wire:navigate href="{{ route('transaksi') }}"
                class="flex items-center p-3 font-medium text-cyan-900 rounded-lg transition duration-150 hover:bg-cyan-900 hover:text-orange-200 text-xl">
                <i class="fa-solid fa-money-bill-wave mr-2"></i>
                Transaksi
            </a>
            <a href="{{ route('chart') }}"
                class="flex items-center p-3 font-medium text-cyan-900 rounded-lg transition duration-150 hover:bg-cyan-900 hover:text-orange-200 text-xl">
                <i class="fa-solid fa-chart-simple mr-2"></i>
                Statistik
            </a>
        </div>
    </nav>

    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 lg:hidden"></div>

    <div class="flex flex-col flex-1 bg-transparent transition-all duration-300">

        <header class="shadow-md p-4 sticky top-0 z-40 m-4 rounded-lg border-2 bg-amber-100">
            <div class="flex justify-between items-center">
                <button @click="sidebarOpen = true"
                    class="lg:hidden p-2 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                {{-- dropdown menu --}}
                <el-dropdown class="inline-block">
                    <button
                        class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white inset-ring-1 inset-ring-white/5 hover:bg-white/20">
                        <div class="ring-2 ring-gray-600 w-auto h-auto bg-gray-300 rounded-full">
                            @auth
                                @if (!Auth::user()->image)
                                    <i class="fa-solid fa-user text-gray-600 text-2xl"></i>
                                @else
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt=""
                                        class="w-10 h-10 rounded-full">
                                @endif
                            @endauth
                        </div>
                    </button>

                    <el-menu anchor="bottom end" popover
                        class="w-56 origin-top-right rounded-lg border-2 bg-amber-50 outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                        <div class="py-1">
                            @auth
                                <a href="{{route('karyawan.profile')}}" class="block px-4 py-2 ">{{ Auth::user()->name }}</a>
                            @endauth
                            <hr class="mx-auto w-50 border-1 mb-2">
                            <p
                                class="block px-4 py-2 text-sm text-gray-70000 focus:bg-white/5 focus:text-white focus:outline-hidden">
                                <a href="{{ route('karyawan.gantipassword', Auth::user()->id) }}">Ganti Password</a>
                            </p>
                            @auth
                                <p
                                    class="block px-4 py-2 text-sm text-gray-70000 focus:bg-white/5 focus:text-white focus:outline-hidden">
                                    @if (Auth::user()->role === 'admin')
                                        <span
                                            class="rounded-lg bg-red-200 w-auto h-auto p-1 border-red-300 border-2">admin</span>
                                </p>
                            @else
                                <span
                                    class="rounded-lg bg-yellow-200 w-auto h-auto p-1 border-yellow-300 border-2">Karyawan</span>
                                </p>
                                @endif
                            @endauth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full px-4 py-2 text-left text-sm text-red-600">Logout</button>
                            </form>
                        </div>
                    </el-menu>
                </el-dropdown>
            </div>
        </header>

        <main class="flex-1 p-6 overflow-y-auto scroll-container">

            @yield('content')

            <!-- Footer -->
            <footer class="text-center p-4 text-gray-500 text-sm border-t mt-6">
                &copy; 2025 Spendly. Hak Cipta Dilindungi.
            </footer>

        </main>
    </div>

    @livewireScripts
    @stack('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let successDiv = document.getElementById('success-notification');
            if (successDiv) {
                let message = successDiv.getAttribute('data-message');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: message,
                    showConfirmButton: false,
                    timer: 3000
                });

                successDiv.remove();
            }

            let errorDiv = document.getElementById('error-notification');
            if (errorDiv) {
                let message = errorDiv.getAttribute('data-message');
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: message,
                    showConfirmButton: true,
                });
                errorDiv.remove();
            }
        });
    </script>
    {{-- tailwind script --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</body>

</html>
