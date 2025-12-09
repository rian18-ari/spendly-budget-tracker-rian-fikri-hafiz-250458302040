<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Spendly | Budget Tracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    {{-- haeder start --}}
    <header class="bg-orange-200 shadow m-4 rounded-lg">
        {{-- navbar start --}}
        <nav aria-label="Global" class="p-4 bg-orange-200 flex justify-between items-center rounded-lg border-2">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img src="{{ asset('/asset/img/spendly-high-resolution-logo-transparent.png') }}" alt=""
                        class="h-8 w-auto" />
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button" command="show-modal" commandfor="mobile-menu"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-cyan-900">
                    <span class="sr-only">Open main menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <el-popover-group class="hidden lg:flex lg:gap-x-12">
                <a href="#tentang" class="text-sm/6 font-semibold text-cyan-900">Tentang Kami</a>
                <a href="#fitur" class="text-sm/6 font-semibold text-cyan-900">Fitur Unggulan</a>
            </el-popover-group>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="{{ route('login') }}" class="text-sm/6 font-semibold text-cyan-900">Log in <span
                        aria-hidden="true">&rarr;</span></a>
            </div>
        </nav>
        {{-- navbar end --}}

        {{-- android menu start --}}
        <el-dialog>
            <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
                <div tabindex="0" class="fixed inset-0 focus:outline-none flex items-center justify-center">
                    <el-dialog-panel
                        class="fixed h-auto w-full sm:w-80 overflow-y-auto bg-orange-200 p-6 rounded-lg shadow-lg transition transition-discrete [--dialog-gap:--spacing(3)] open:block data-closed:opacity-0 data-closed:scale-95 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in border-2 inset-center">
                        <div class="flex items-center justify-between">
                            <a href="#" class="-m-1.5 p-1.5">
                                <span class="sr-only">Your Company</span>
                                <p class="text-orange-200 border-2 bg-cyan-900 rounded-lg w-16 text-center font-bold">
                                    menu</p>
                            </a>
                            <button type="button" command="close" commandfor="mobile-menu"
                                class="-m-2.5 rounded-md p-2.5 text-cyan-900">
                                <span class="sr-only">Close menu</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    data-slot="icon" aria-hidden="true" class="size-6">
                                    <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        {{-- menu start --}}
                        <div class="mt-6 flow-root">
                            <div class="-my-6 divide-y divide-white/10">
                                <div class="space-y-2 py-6 flex flex-col gap-2">
                                    <a href="#tentang" onclick="document.getElementById('mobile-menu').close()"
                                        class="text-sm/6 font-semibold text-cyan-900">Tentang Kami</a>
                                    <a href="#fitur" onclick="document.getElementById('mobile-menu').close()"
                                        class="text-sm/6 font-semibold text-cyan-900">Fitur Unggulan</a>
                                </div>
                                <div class="py-6 flex flex-col gap-2">
                                    <a href="{{ route('login') }}"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-cyan-900 hover:bg-white/5">Log
                                        in</a>
                                </div>
                            </div>
                        </div>
                        {{-- menu end --}}
                    </el-dialog-panel>
                </div>
            </dialog>
        </el-dialog>
        {{-- android menu end --}}
    </header>
    {{-- end navbar --}}


    {{-- start hero section --}}
    {{-- start hero section --}}
    <section class="bg-gray-50 shadow-sm min-h-screen flex items-center justify-center">
        <div class="container mx-auto px-4 flex flex-col lg:flex-row w-full items-center">
            <div class="flex flex-col justify-start items-start mb-10 lg:mb-0 py-4 w-full lg:w-1/2" data-aos="fade-up"
                data-aos-duration="1000">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 text-cyan-900 leading-tight">Track Keuangan
                    dengan mudah & cermat !</h2>
                <p class="mb-8 text-lg text-cyan-700">Permudah track anggaran dengan pelacakan real time dan laporan
                    yang akurat.</p>
                <a href="
                {{ route('login') }}">
                    <button
                        class="px-6 py-3 bg-cyan-900 text-white rounded-lg hover:bg-cyan-800 transition duration-300 shadow-lg">Mulai
                        Sekarang</button>
                </a>
            </div>
            <div class="w-full lg:w-1/2 flex justify-center items-center p-4" data-aos="fade-left"
                data-aos-duration="1000" data-aos-delay="200">
                {{-- gambar nanti disini --}}
                <svg class="w-full h-auto max-w-md lg:max-w-lg text-cyan-900" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <x-icon.iconpack></x-icon.iconpack>
                </svg>
            </div>
        </div>
    </section>
    {{-- end hero section --}}
    {{-- end hero section --}}

    {{-- start about section --}}
    {{-- start about section --}}
    <section class="py-20 bg-white" id="tentang">
        <div class="container mx-auto px-4">
            <h1 class="text-center text-4xl md:text-5xl font-bold mb-16 text-cyan-900" data-aos="fade-up">Tentang Kami
            </h1>
            {{-- start card --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- start card 01 --}}
                <div class="bg-amber-50 shadow-lg rounded-xl p-8 text-center border-2 transform hover:-translate-y-2 transition duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-2xl font-bold mb-4 text-cyan-900">Spendly: Kontrol Penuh atas Anggaran</h2>
                    <p class="mb-6 text-cyan-700">Kami mentransformasi pelacakan pengeluaran menjadi manajemen
                        spending. Spendly memberikan tim kamu kemampuan untuk mengendalikan anggaran dari awal, bukan
                        hanya merekonsiliasi di akhir.</p>
                </div>
                {{-- start card 02 --}}
                <div class="bg-amber-50 shadow-lg rounded-xl p-8 text-center border-2 transform hover:-translate-y-2 transition duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-2xl font-bold mb-4 text-cyan-900">Data Real-Time untuk Tindakan Cepat</h2>
                    <p class="mb-6 text-cyan-700">Dapatkan visualisasi real-time dari setiap transaksi yang dilakukan.
                        Dashboard Spendly memungkinkan kamu mengidentifikasi anomali atau overspend seketika untuk
                        intervensi yang cepat dan tepat.</p>
                </div>
                {{-- start card 03 --}}
                <div class="bg-amber-50 shadow-lg rounded-xl p-8 text-center border-2 transform hover:-translate-y-2 transition duration-300"
                    data-aos="fade-up" data-aos-delay="300">
                    <h2 class="text-2xl font-bold mb-4 text-cyan-900">Otomatisasi Kepatuhan & Audit</h2>
                    <p class="mb-6 text-cyan-700">Spendly memastikan kepatuhan kebijakan perusahaan secara otomatis.
                        Kami menyiapkan jejak audit yang rapi dan terverifikasi (Audit Trail) sehingga proses peninjauan
                        finansial menjadi sederhana dan bebas stres.</p>
                </div>
            </div>
            {{-- end card --}}
        </div>
    </section>
    {{-- end about section --}}

    {{-- start fitur section --}}
    {{-- start fitur section --}}
    <section class="py-20 bg-gray-50" id="fitur">
        <div class="container mx-auto px-4">
            <h1 class="text-center text-4xl md:text-5xl font-bold mb-16 text-cyan-900" data-aos="fade-up">Fitur
                Unggulan</h1>
            {{-- start card --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- start card 01 (Pelacakan Anggaran) --}}
                <div class="bg-white shadow-lg rounded-xl p-8 text-center border-2 transform hover:-translate-y-2 transition duration-300 flex flex-col justify-between"
                    data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="mb-6 flex justify-center">
                            {{-- Icon placeholder --}}
                            <div
                                class="h-16 w-16 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-900">
                                <i class="fa-solid fa-file-export text-2xl"></i>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold mb-4 text-cyan-900">Integrasi Data Lintas Platform Cepat</h2>
                        <p class="mb-6 text-cyan-700">Jangan biarkan data kamu terisolasi. Dengan satu klik, kamu bisa
                            ekspor semua data transaksi ke format Excel. Ini memudahkan analisis mendalam, pelaporan ke
                            direksi, dan integrasi dengan sistem akuntansi eksternal (ERP) kamu.</p>
                    </div>
                </div>
                {{-- start card 02 (Laporan Keuangan) --}}
                <div class="bg-white shadow-lg rounded-xl p-8 text-center border-2 transform hover:-translate-y-2 transition duration-300 flex flex-col justify-between"
                    data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="mb-6 flex justify-center">
                            {{-- Icon placeholder --}}
                            <div
                                class="h-16 w-16 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-900">
                                <i class="fa-solid fa-check-circle text-2xl"></i>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold mb-4 text-cyan-900">Kontrol Penuh dan Audit Keuangan</h2>
                        <p class="mb-6 text-cyan-700">Sediakan visibilitas penuh bagi role Admin untuk memvalidasi
                            status setiap transaksi sebelum diproses. Fitur ini memastikan tidak ada transaksi fiktif
                            atau yang tidak sah lolos, memberikan lapisan keamanan dan kontrol akhir pada arus kas
                            perusahaan.</p>
                    </div>
                </div>
                {{-- start card 03 (Sinkronisasi Akun) --}}
                <div class="bg-white shadow-lg rounded-xl p-8 text-center border-2 transform hover:-translate-y-2 transition duration-300 flex flex-col justify-between"
                    data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="mb-6 flex justify-center">
                            {{-- Icon placeholder --}}
                            <div
                                class="h-16 w-16 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-900">
                                <i class="fa-solid fa-credit-card text-2xl"></i>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold mb-4 text-cyan-900">Pendelegasian Budget Berbasis Akuntabilitas
                        </h2>
                        <p class="mb-6 text-cyan-700">Alokasikan dana spesifik langsung ke karyawan, tim, atau proyek.
                            Fitur ini menciptakan akuntabilitas biaya yang jelas, memastikan pengeluaran selalu di bawah
                            kontrol, dan menghilangkan kebingungan tentang sisa budget yang tersedia bagi setiap
                            pemegang dana.</p>
                    </div>
                </div>
            </div>
            {{-- end card --}}
        </div>
    </section>
    {{-- end fitur section --}}


    {{-- start contact section --}}
    {{-- start contact section --}}
    {{-- <section class="py-20 bg-white" id="hubungi">
        <div class="container mx-auto px-4">
            <h1 class="text-center text-4xl md:text-5xl font-bold mb-16 text-cyan-900" data-aos="fade-up">Hubungi Kami</h1>
            <div class="max-w-4xl mx-auto bg-white shadow-2xl overflow-hidden flex flex-col border-2 rounded-lg md:flex-row" data-aos="zoom-in" data-aos-duration="1000"> --}}
    {{-- start form --}}
    {{-- <div class="w-full md:w-1/2 p-8 md:p-12">
                    <form action="" class="space-y-6">
                        <div>
                            <label for="name" class="block text-cyan-900 font-bold mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" placeholder="Masukkan nama anda">
                        </div>
                        <div>
                            <label for="email" class="block text-cyan-900 font-bold mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" placeholder="nama@email.com">
                        </div>
                        <div>
                            <label for="message" class="block text-cyan-900 font-bold mb-2">Pesan</label>
                            <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" placeholder="Tulis pesan anda disini..."></textarea>
                        </div>
                        <button type="submit" class="w-full px-6 py-3 bg-cyan-900 text-white font-bold rounded-lg hover:bg-cyan-800 transition duration-300">Kirim Pesan</button>
                    </form>
                </div>
                <div class="w-full md:w-1/2 bg-cyan-900 p-8 md:p-12 flex flex-col justify-center items-center text-white">
                    <h3 class="text-2xl font-bold mb-4">Info Kontak</h3>
                    <p class="mb-6 text-center text-cyan-100">Punya pertanyaan? Jangan ragu untuk menghubungi kami.</p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>+62 123 4567 890</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z"></path></svg>
                            <span>support@spendly.com</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Jakarta, Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- end contact section --}}
    {{-- end contact section --}}

    {{-- section unknown --}}
    <section class="w-full h-auto py-10 px-4">
        <div class="container mx-auto flex items-center justify-center h-48 sm:h-64 l:h-72" data-aos="fade-up"
            data-aos-duration="1000">
            <img src="{{ asset('asset/img/spendly-high-resolution-logo-transparent.png') }}" alt=""
                class="h-full w-auto object-contain">
        </div>
    </section>
    {{-- end section unknown --}}

    {{-- start footer --}}
    <footer class="bg-white rounded-lg">
        <div class="bg-gray-50 text-center p-4 rounded-lg border-2 m-4 shadow text-cyan-900">
            <p>&copy; 2025 Spendly - for finance tracking. All rights reserved.</p>
            <p>made with love by <a href="https://rian18-ari.github.io/ari-dev-rian-fikri-hafiz-250458302040/"
                    target="_blank" class="hover:text-blue-500">rian fikri hafiz</a></p>
        </div>
    </footer>
    {{-- end footer --}}


    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
