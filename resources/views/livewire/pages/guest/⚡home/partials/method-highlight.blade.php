
<section id="cara-kerja" class="mx-auto max-w-7xl px-6 py-20">
    <div class="mx-auto max-w-2xl text-center">
        <flux:badge color="emerald" variant="outline" size="sm">Alur Penggunaan</flux:badge>
        <flux:heading size="2xl" level="2" class="mt-4 !font-bold tracking-tight text-zinc-900 dark:text-white">
            Cara Kerja Sistem
        </flux:heading>
        <flux:text size="lg" class="mt-3 !text-zinc-600 dark:!text-zinc-400">
            Hanya butuh empat langkah sederhana untuk mendapatkan hasil diagnosis awal.
        </flux:text>
    </div>

    <div class="relative mt-14 grid gap-8 md:grid-cols-4">
        {{-- Garis penghubung untuk layar besar --}}
        <div class="absolute top-7 left-0 hidden h-px w-full bg-zinc-200 md:block dark:bg-zinc-700"></div>

        @php
            $steps = [
                ['icon' => 'user-plus', 'title' => 'Buat Akun / Masuk', 'desc' => 'Daftar singkat untuk menyimpan riwayat diagnosis Anda.'],
                ['icon' => 'clipboard-document-list', 'title' => 'Isi Gejala', 'desc' => 'Jawab pertanyaan seputar gejala yang Anda rasakan saat ini.'],
                ['icon' => 'cpu-chip', 'title' => 'Sistem Memproses', 'desc' => 'Naive Bayes dengan prior klinis menghitung probabilitas tiap penyakit.'],
                ['icon' => 'document-chart-bar', 'title' => 'Lihat Hasil', 'desc' => 'Dapatkan hasil diagnosis awal beserta persentase keyakinannya.'],
            ];
        @endphp

        @foreach ($steps as $step)
            <div class="relative flex flex-col items-center text-center">
                <div class="relative z-10 flex size-14 items-center justify-center rounded-full border-4 border-white bg-emerald-600 text-white shadow-sm dark:border-zinc-900">
                    <flux:icon name="{{ $step['icon'] }}" class="size-6" />
                </div>
                <flux:badge size="sm" color="zinc" class="mt-3">Langkah {{ $loop->iteration }}</flux:badge>
                <flux:heading size="base" class="mt-2 !font-semibold text-zinc-900 dark:text-white">
                    {{ $step['title'] }}
                </flux:heading>
                <flux:text size="sm" class="mt-1 !text-zinc-600 dark:!text-zinc-400">
                    {{ $step['desc'] }}
                </flux:text>
            </div>
        @endforeach
    </div>
</section>
