
<section class="border-y border-zinc-200 bg-white py-10 dark:border-zinc-800 dark:bg-zinc-900">
    <div class="mx-auto max-w-7xl px-6">
        @php
            // DRY: satu sumber data untuk grid statistik
            $stats = [
                ['icon' => 'circle-stack', 'value' => '3', 'label' => 'Kelas Diagnosis'],
                ['icon' => 'list-bullet', 'value' => 'Multi', 'label' => 'Indikator Gejala'],
                ['icon' => 'calculator', 'value' => 'Prior Klinis', 'label' => 'Naive Bayes'],
                ['icon' => 'academic-cap', 'value' => '100%', 'label' => 'Berbasis Riset'],
            ];
        @endphp

        <div class="grid grid-cols-2 gap-6 lg:grid-cols-4">
            @foreach ($stats as $stat)
                <div class="flex items-center gap-3 rounded-xl border border-zinc-100 bg-zinc-50 px-4 py-4 dark:border-zinc-800 dark:bg-zinc-800/50">
                    <flux:icon name="{{ $stat['icon'] }}" class="size-6 shrink-0 text-emerald-600 dark:text-emerald-400" />
                    <div>
                        <flux:text class="block !text-base !font-bold !text-zinc-900 dark:!text-white">
                            {{ $stat['value'] }}
                        </flux:text>
                        <flux:text size="sm" class="!text-zinc-500 dark:!text-zinc-400">
                            {{ $stat['label'] }}
                        </flux:text>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>