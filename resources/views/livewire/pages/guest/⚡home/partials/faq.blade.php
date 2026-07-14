<section id="faq" class="mx-auto max-w-4xl px-6 py-20">
    <div class="text-center">
        <flux:badge color="emerald" variant="outline" size="sm">FAQ</flux:badge>
        <flux:heading size="2xl" level="2" class="mt-4 !font-bold tracking-tight text-zinc-900 dark:text-white">
            Pertanyaan yang Sering Diajukan
        </flux:heading>
    </div>

    @php
    $faqs = [
    [
    'q' => 'Apakah hasil diagnosis ini bisa dijadikan acuan medis resmi?',
    'a' => 'Tidak. Sistem ini hanya memberikan diagnosis awal/skrining berbasis gejala. Untuk kepastian medis, tetap diperlukan pemeriksaan oleh dokter.',
    ],
    [
    'q' => 'Apa itu "Prior Klinis" dalam metode Naive Bayes ini?',
    'a' => 'Prior klinis adalah probabilitas awal suatu penyakit yang disesuaikan dengan pengetahuan dan data klinis dokter, bukan hanya dihitung dari frekuensi data latih semata.',
    ],
    [
    'q' => 'Penyakit apa saja yang bisa dideteksi sistem ini?',
    'a' => 'Saat ini sistem berfokus pada tiga kategori: Gastritis, GERD (Gastroesophageal Reflux Disease), dan Dispepsia.',
    ],
    [
    'q' => 'Berapa lama waktu yang dibutuhkan untuk mendapatkan hasil?',
    'a' => 'Proses pengisian gejala hingga melihat hasil diagnosis awal umumnya memakan waktu kurang dari 2 menit.',
    ],
    [
    'q' => 'Apakah data gejala yang saya masukkan aman?',
    'a' => 'Data yang Anda masukkan digunakan semata untuk keperluan proses diagnosis dan riwayat pribadi Anda di sistem.',
    ],
    ];
    @endphp

    <div class="mt-10 space-y-3">
        @foreach ($faqs as $index => $faq)
        @php $isOpen = $openFaqIndex === $index; @endphp

        <flux:card class="overflow-hidden !p-0">
            <button
                type="button"
                wire:click="toggleFaq({{ $index }})"
                class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left transition hover:bg-zinc-50 dark:hover:bg-zinc-800/60">
                <flux:heading size="large" class="!font-semibold text-zinc-900 dark:text-white">
                    {{ $faq['q'] }}
                </flux:heading>

                @if ($isOpen)
                <flux:icon name="minus" class="size-5 shrink-0 text-emerald-600 dark:text-emerald-400" />
                @else
                <flux:icon name="plus" class="size-5 shrink-0 text-zinc-400 dark:text-zinc-500" />
                @endif
            </button>

            @if ($isOpen)
            <div class="border-t border-zinc-100 px-5 py-4 dark:border-zinc-700">
                <flux:text class="!text-zinc-600 dark:!text-zinc-400">{{ $faq['a'] }}</flux:text>
            </div>
            @endif
        </flux:card>
        @endforeach
    </div>
</section>