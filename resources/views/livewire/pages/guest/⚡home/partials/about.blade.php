
<section id="tentang" class="mx-auto max-w-7xl px-6 py-20">
    <div class="grid items-center gap-12 lg:grid-cols-2">
        <div>
            <flux:badge color="emerald" variant="outline" size="sm">Latar Belakang</flux:badge>

            <flux:heading size="2xl" level="2" class="mt-4 !font-bold tracking-tight text-zinc-900 dark:text-white">
                Dibangun dari Penelitian Ilmiah, Bukan Asumsi
            </flux:heading>

            <flux:text size="lg" class="mt-4 !text-zinc-600 dark:!text-zinc-400">
                Sistem ini merupakan implementasi nyata dari penelitian
                <span class="font-semibold text-zinc-800 dark:text-zinc-200">
                    "Sistem Pakar Diagnosis Penyakit Lambung Menggunakan Naive Bayes dengan Prior Klinis
                    untuk Klasifikasi Gastritis, GERD, dan Dispepsia"</span>.
                Pendekatan ini menggabungkan perhitungan probabilitas statistik dengan pengetahuan klinis dokter
                agar hasil diagnosis awal lebih relevan dengan kondisi nyata di lapangan.
            </flux:text>

            <div class="mt-8 space-y-4">
                @php
                    // DRY: poin keunggulan didefinisikan sekali
                    $highlights = [
                        [
                            'icon' => 'beaker',
                            'title' => 'Naive Bayes + Prior Klinis',
                            'desc' => 'Probabilitas awal (prior) disesuaikan dengan pengetahuan klinis, bukan hanya frekuensi data, sehingga hasil lebih akurat.',
                        ],
                        [
                            'icon' => 'clipboard-document-check',
                            'title' => 'Berbasis Gejala Terstruktur',
                            'desc' => 'Pertanyaan disusun berdasarkan indikator gejala khas Gastritis, GERD, dan Dispepsia.',
                        ],
                        [
                            'icon' => 'light-bulb',
                            'title' => 'Transparan & Bisa Dipertanggungjawabkan',
                            'desc' => 'Setiap hasil diagnosis disertai persentase keyakinan agar mudah dipahami pengguna.',
                        ],
                    ];
                @endphp

                @foreach ($highlights as $item)
                    <div class="flex gap-4">
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-900/40">
                            <flux:icon name="{{ $item['icon'] }}" class="size-5 text-emerald-600 dark:text-emerald-400" />
                        </div>
                        <div>
                            <flux:heading size="base" class="!font-semibold text-zinc-900 dark:text-white">
                                {{ $item['title'] }}
                            </flux:heading>
                            <flux:text size="sm" class="!text-zinc-600 dark:!text-zinc-400">
                                {{ $item['desc'] }}
                            </flux:text>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="relative">
            <flux:card class="border-emerald-100 bg-gradient-to-br from-emerald-50 to-white p-8 shadow-sm dark:border-emerald-900/40 dark:from-emerald-950/20 dark:to-zinc-800">
                <flux:icon name="document-text" class="size-10 text-emerald-600 dark:text-emerald-400" />
                <flux:heading size="lg" class="mt-4 !font-semibold text-zinc-900 dark:text-white">
                    Ringkasan Metodologi
                </flux:heading>

                <ul class="mt-5 space-y-3">
                    @php
                        $methodPoints = [
                            'Pengumpulan data gejala klinis pasien lambung',
                            'Perhitungan probabilitas prior berdasarkan data klinis dokter',
                            'Klasifikasi menggunakan algoritma Naive Bayes',
                            'Validasi hasil terhadap diagnosis aktual',
                        ];
                    @endphp

                    @foreach ($methodPoints as $point)
                        <li class="flex items-start gap-2.5">
                            <flux:icon name="check-circle" class="mt-0.5 size-5 shrink-0 text-emerald-600 dark:text-emerald-400" />
                            <flux:text size="sm" class="!text-zinc-700 dark:!text-zinc-300">{{ $point }}</flux:text>
                        </li>
                    @endforeach
                </ul>
            </flux:card>
        </div>
    </div>
</section>