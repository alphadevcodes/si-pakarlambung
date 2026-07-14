{{--
    Partial: Footer
    Tanggung jawab tunggal: navigasi sekunder, kredit penelitian, dan disclaimer.
--}}
<footer class="border-t border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
    <div class="mx-auto max-w-7xl px-6 py-12">
        <div class="grid gap-10 md:grid-cols-4">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2">
                    <flux:icon name="heart" class="size-6 text-emerald-600 dark:text-emerald-400" />
                    <span class="text-lg font-semibold text-zinc-900 dark:text-white">
                        Gastro<span class="text-emerald-600 dark:text-emerald-400">Pakar</span>
                    </span>
                </div>
                <flux:text size="sm" class="mt-3 max-w-sm !text-zinc-500 dark:!text-zinc-400">
                    Sistem pakar diagnosis awal penyakit lambung (Gastritis, GERD, dan Dispepsia) berbasis algoritma
                    Naive Bayes dengan Prior Klinis — hasil implementasi dari penelitian ilmiah.
                </flux:text>
            </div>

            @php
                // DRY: kolom footer didefinisikan sebagai data, bukan markup berulang
                $footerColumns = [
                    [
                        'title' => 'Navigasi',
                        'links' => [
                            ['label' => 'Tentang', 'href' => '#tentang'],
                            ['label' => 'Penyakit', 'href' => '#penyakit'],
                            ['label' => 'Cara Kerja', 'href' => '#cara-kerja'],
                            ['label' => 'FAQ', 'href' => '#faq'],
                        ],
                    ],
                    [
                        'title' => 'Lainnya',
                        'links' => [
                            ['label' => 'Mulai Diagnosis', 'href' => '#'],
                            ['label' => 'Masuk', 'href' => '#'],
                            ['label' => 'Kebijakan Privasi', 'href' => '#'],
                        ],
                    ],
                ];
            @endphp

            @foreach ($footerColumns as $column)
                <div>
                    <flux:heading size="sm" class="!font-semibold text-zinc-900 dark:text-white">
                        {{ $column['title'] }}
                    </flux:heading>
                    <ul class="mt-4 space-y-2.5">
                        @foreach ($column['links'] as $link)
                            <li>
                                <flux:link href="{{ $link['href'] }}" class="!text-sm !text-zinc-500 dark:!text-zinc-400">
                                    {{ $link['label'] }}
                                </flux:link>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <flux:separator class="my-8" />

        <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
            <flux:text size="sm" class="!text-zinc-500 dark:!text-zinc-400">
                &copy; {{ date('Y') }} GastroPakar. Implementasi penelitian Sistem Pakar Diagnosis Penyakit Lambung.
            </flux:text>
            <flux:badge size="sm" color="zinc" variant="outline" icon="exclamation-triangle">
                Bukan pengganti diagnosis medis profesional
            </flux:badge>
        </div>
    </div>
</footer>