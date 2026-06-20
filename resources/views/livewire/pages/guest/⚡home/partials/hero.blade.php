{{--
    Partial: Hero
    Tanggung jawab tunggal: value proposition utama + CTA primer/sekunder + ilustrasi.
--}}
<section class="relative overflow-hidden bg-gradient-to-b from-emerald-50 via-white to-white dark:from-emerald-950/30 dark:via-zinc-900 dark:to-zinc-900">
    {{-- Dekorasi blur, murni visual --}}
    <div class="pointer-events-none absolute -top-24 right-0 h-96 w-96 rounded-full bg-emerald-200/40 blur-3xl dark:bg-emerald-500/10"></div>
    <div class="pointer-events-none absolute -bottom-24 -left-24 h-96 w-96 rounded-full bg-teal-200/40 blur-3xl dark:bg-teal-500/10"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-6 py-20 lg:grid-cols-2 lg:py-28">
        <div class="space-y-6">
            <flux:badge color="emerald" variant="solid" size="sm" icon="sparkles">
                Berbasis Penelitian Ilmiah
            </flux:badge>

            <flux:heading size="3xl" level="1" class="!text-4xl !font-bold !leading-tight tracking-tight text-zinc-900 sm:!text-5xl dark:text-white">
                Diagnosis Awal Penyakit Lambung,
                <span class="text-emerald-600 dark:text-emerald-400">Lebih Cepat & Terarah.</span>
            </flux:heading>

            <flux:text size="lg" class="max-w-xl !text-zinc-600 dark:!text-zinc-400">
                Sistem pakar yang membantu mengenali gejala awal <strong class="font-semibold text-zinc-800 dark:text-zinc-200">Gastritis</strong>,
                <strong class="font-semibold text-zinc-800 dark:text-zinc-200">GERD</strong>, dan
                <strong class="font-semibold text-zinc-800 dark:text-zinc-200">Dispepsia</strong>
                menggunakan algoritma <em>Naive Bayes dengan Prior Klinis</em> — menggabungkan data gejala dengan pengetahuan medis nyata.
            </flux:text>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <flux:button href="#" variant="primary" icon-trailing="arrow-right" class="!px-6 !py-3 !text-base">
                    Mulai Diagnosis Sekarang
                </flux:button>
                <flux:button href="#tentang" variant="ghost" icon="book-open" class="!px-6 !py-3 !text-base">
                    Pelajari Penelitiannya
                </flux:button>
            </div>

            <div class="flex flex-wrap items-center gap-x-6 gap-y-2 pt-4 text-sm text-zinc-500 dark:text-zinc-400">
                <div class="flex items-center gap-1.5">
                    <flux:icon name="shield-check" class="size-4 text-emerald-600 dark:text-emerald-400" />
                    Bukan pengganti diagnosis dokter
                </div>
                <div class="flex items-center gap-1.5">
                    <flux:icon name="clock" class="size-4 text-emerald-600 dark:text-emerald-400" />
                    Hasil &lt; 2 menit
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="rounded-2xl border border-zinc-200 bg-white p-2 shadow-xl shadow-emerald-900/5 dark:border-zinc-700 dark:bg-zinc-800">
                <div class="rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 p-8 text-white">
                    <div class="mb-6 flex items-center justify-between">
                        <flux:icon name="beaker" class="size-8" />
                        <flux:badge color="zinc" variant="solid" size="sm" class="!bg-white/20 !text-white">
                            Naive Bayes + Prior Klinis
                        </flux:badge>
                    </div>

                    <flux:heading size="lg" class="!text-white">Probabilitas Diagnosis</flux:heading>

                    <div class="mt-5 space-y-4">
                        @php
                            // DRY: data demo probabilitas didefinisikan sekali, dirender via loop
                            $demoResults = [
                                ['label' => 'Gastritis', 'value' => 72],
                                ['label' => 'GERD', 'value' => 19],
                                ['label' => 'Dispepsia', 'value' => 9],
                            ];
                        @endphp

                        @foreach ($demoResults as $result)
                            <div>
                                <div class="mb-1 flex justify-between text-sm font-medium">
                                    <span>{{ $result['label'] }}</span>
                                    <span>{{ $result['value'] }}%</span>
                                </div>
                                <div class="h-2 w-full overflow-hidden rounded-full bg-white/25">
                                    <div class="h-full rounded-full bg-white" style="width: {{ $result['value'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Floating badge kecil --}}
            <div class="absolute -bottom-5 -left-5 hidden rounded-xl border border-zinc-200 bg-white px-4 py-3 shadow-lg sm:block dark:border-zinc-700 dark:bg-zinc-800">
                <div class="flex items-center gap-2">
                    <flux:icon name="check-badge" class="size-5 text-emerald-600 dark:text-emerald-400" />
                    <flux:text size="sm" class="font-medium !text-zinc-700 dark:!text-zinc-200">Skripsi/Penelitian Terverifikasi</flux:text>
                </div>
            </div>
        </div>
    </div>
</section>