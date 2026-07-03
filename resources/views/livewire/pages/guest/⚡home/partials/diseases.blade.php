<section id="penyakit" class="bg-zinc-50 py-20 dark:bg-zinc-800/30">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mx-auto max-w-2xl text-center">
            <flux:badge color="emerald" variant="outline" size="sm">Cakupan Diagnosis</flux:badge>
            <flux:heading size="2xl" level="2" class="mt-4 !font-bold tracking-tight text-zinc-900 dark:text-white">
                Tiga Kategori Penyakit Lambung Umum
            </flux:heading>
            <flux:text size="lg" class="mt-3 !text-zinc-600 dark:!text-zinc-400">
                Sistem mengklasifikasikan gejala ke dalam tiga kategori penyakit lambung yang paling sering dikeluhkan masyarakat.
            </flux:text>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-3">
            @php
                $diseases = [
                    [
                        'icon' => 'fire',
                        'name' => 'Gastritis',
                        'desc' => 'Peradangan pada dinding lambung yang umumnya ditandai nyeri ulu hati, mual, dan rasa perih terutama saat telat makan.',
                        'symptoms' => ['Nyeri ulu hati', 'Mual & kembung', 'Perih saat telat makan'],
                        'color' => 'amber',
                    ],
                    [
                        'icon' => 'arrow-up-circle',
                        'name' => 'GERD',
                        'desc' => 'Gastroesophageal Reflux Disease, kondisi naiknya asam lambung ke kerongkongan yang memicu rasa panas di dada.',
                        'symptoms' => ['Heartburn / dada panas', 'Asam naik ke tenggorokan', 'Sulit menelan'],
                        'color' => 'rose',
                    ],
                    [
                        'icon' => 'cube-transparent',
                        'name' => 'Dispepsia',
                        'desc' => 'Kumpulan gejala gangguan pencernaan bagian atas seperti rasa penuh, begah, dan cepat kenyang.',
                        'symptoms' => ['Cepat kenyang', 'Perut begah', 'Sendawa berlebihan'],
                        'color' => 'sky',
                    ],
                ];
            @endphp

            @foreach ($diseases as $disease)
                <flux:card class="group flex flex-col p-7 transition hover:shadow-lg hover:shadow-emerald-900/5">
                    <div class="flex size-12 items-center justify-center rounded-xl bg-{{ $disease['color'] }}-100 dark:bg-{{ $disease['color'] }}-900/30">
                        <flux:icon name="{{ $disease['icon'] }}" class="size-6 text-{{ $disease['color'] }}-600 dark:text-{{ $disease['color'] }}-400" />
                    </div>

                    <flux:heading size="lg" class="mt-5 !font-semibold text-zinc-900 dark:text-white">
                        {{ $disease['name'] }}
                    </flux:heading>

                    <flux:text size="sm" class="mt-2 !text-zinc-600 dark:!text-zinc-400">
                        {{ $disease['desc'] }}
                    </flux:text>

                    <flux:separator class="my-5" />

                    <div class="space-y-2">
                        @foreach ($disease['symptoms'] as $symptom)
                            <div class="flex items-center gap-2">
                                <flux:icon name="minus-circle" class="size-4 text-zinc-400 dark:text-zinc-500" />
                                <flux:text size="sm" class="!text-zinc-600 dark:!text-zinc-400">{{ $symptom }}</flux:text>
                            </div>
                        @endforeach
                    </div>
                </flux:card>
            @endforeach
        </div>

        {{--
            Catatan teknis: <flux:callout> tidak dipakai di sini karena status
            ketersediaannya di Flux Free tidak konsisten antar instalasi.
            Diganti dengan <flux:card> yang di-styling manual sebagai callout,
            memakai komponen yang sudah terbukti tersedia di Free tier.
        --}}
        <flux:card class="mt-10 flex items-start gap-3 border-amber-200 bg-amber-50 dark:border-amber-900/40 dark:bg-amber-950/20">
            <flux:icon name="information-circle" class="mt-0.5 size-5 shrink-0 text-amber-600 dark:text-amber-400" />
            <div>
                <flux:heading size="base" class="!font-semibold text-amber-900 dark:text-amber-200">
                    Catatan Penting
                </flux:heading>
                <flux:text size="sm" class="mt-1 !text-amber-800 dark:!text-amber-300">
                    Hasil sistem pakar ini bersifat diagnosis awal/skrining, bukan diagnosis medis final.
                    Selalu konsultasikan hasil dengan dokter atau tenaga kesehatan profesional.
                </flux:text>
            </div>
        </flux:card>
    </div>
</section>