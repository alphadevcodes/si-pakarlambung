<div
    x-data="{
        selectedSymptoms: []
    }"
>
    {{-- Navbar --}}
    <flux:header
        container
        class="border-b border-zinc-200 bg-white/80 backdrop-blur dark:border-zinc-800 dark:bg-zinc-950/80">

        @include('livewire.pages.guest.⚡home.partials.navbar')

    </flux:header>

    {{-- Hero --}}
    <section
        class="relative overflow-hidden border-b border-zinc-200 bg-gradient-to-b from-sky-50 via-white to-white dark:border-zinc-800 dark:from-zinc-900 dark:via-zinc-950 dark:to-zinc-950">

        <div class="mx-auto max-w-6xl px-6 py-16">

            <div class="mx-auto max-w-3xl text-center">

                <div
                    class="mb-4 inline-flex rounded-full border border-sky-200 bg-sky-100 px-4 py-1 text-sm font-medium text-sky-700">

                    Sistem Pakar Diagnosis Lambung

                </div>

                <h1
                    class="text-4xl font-bold tracking-tight text-zinc-900 md:text-5xl dark:text-white">

                    Diagnosis Awal Penyakit Lambung

                </h1>

                <p
                    class="mx-auto mt-5 max-w-2xl text-lg text-zinc-600 dark:text-zinc-400">

                    Pilih gejala yang sedang Anda alami untuk mendapatkan
                    diagnosis awal menggunakan metode Naive Bayes.

                </p>

            </div>

        </div>

    </section>

    {{-- Content --}}
    <section class="py-10">

        <div class="mx-auto max-w-6xl px-4">

            {{-- Toolbar --}}
            <div class="sticky top-24 z-30 mb-8">

                <div
                    class="rounded-2xl border border-zinc-200 bg-white/90 p-5 shadow-sm backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/90">

                    <div
                        class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                        <div class="flex-1">

                            <div
                                class="flex items-center justify-between">

                                <div>

                                    <h2 class="font-semibold">
                                        Gejala Dipilih
                                    </h2>

                                    <p
                                        class="text-sm text-zinc-500">

                                        <span x-text="selectedSymptoms.length"></span>
                                        gejala dipilih

                                    </p>

                                </div>

                                <div
                                    class="rounded-full bg-sky-100 px-3 py-1 text-sm font-semibold text-sky-700">

                                    <span x-text="selectedSymptoms.length"></span>

                                </div>

                            </div>

                        </div>

                        <div class="w-full lg:w-80">

                            <flux:input
                                wire:model.live.debounce.300ms="search"
                                icon="magnifying-glass"
                                placeholder="Cari gejala..." />

                        </div>

                    </div>

                </div>

            </div>

            {{-- Symptoms --}}
            <div
                class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

                @foreach($this->filteredSymptoms as $symptom)

                    <label
                        wire:key="{{ $symptom['code'] }}"
                        class="block cursor-pointer">

                        <input
                            type="checkbox"
                            class="peer sr-only"
                            value="{{ $symptom['code'] }}"

                            @change="
                                if ($event.target.checked) {
                                    selectedSymptoms.push('{{ $symptom['code'] }}')
                                } else {
                                    selectedSymptoms =
                                        selectedSymptoms.filter(
                                            item => item !== '{{ $symptom['code'] }}'
                                        )
                                }
                            "
                        >

                        <div
                            class="
                                h-full rounded-2xl border border-zinc-200
                                bg-white p-5 transition-all duration-200

                                hover:-translate-y-1
                                hover:shadow-lg

                                peer-checked:border-sky-500
                                peer-checked:bg-sky-50
                                peer-checked:shadow-md

                                dark:border-zinc-800
                                dark:bg-zinc-900
                            ">

                            <div
                                class="mb-4 flex items-center justify-between">

                                <span
                                    class="rounded-lg bg-zinc-100 px-2 py-1 text-xs font-semibold">

                                    {{ $symptom['code'] }}

                                </span>

                                <div
                                    class="
                                        hidden h-6 w-6 items-center justify-center
                                        rounded-full bg-sky-500 text-white
                                        peer-checked:flex
                                    ">
                                    ✓
                                </div>

                            </div>

                            <h3
                                class="font-semibold text-zinc-900 dark:text-white">

                                {{ $symptom['name'] }}

                            </h3>

                        </div>

                    </label>

                @endforeach

            </div>

        </div>

    </section>

    {{-- Floating Action --}}
    <div
        x-show="selectedSymptoms.length > 0"
        x-transition
        class="fixed bottom-6 left-1/2 z-50 w-[95%] max-w-lg -translate-x-1/2">

        <div
            class="rounded-2xl border border-zinc-200 bg-white/95 p-4 shadow-xl backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/95">

            <div class="flex items-center justify-between">

                <div>

                    <p class="font-semibold">

                        <span x-text="selectedSymptoms.length"></span>
                        gejala dipilih

                    </p>

                    <p class="text-sm text-zinc-500">
                        Lanjutkan ke konfirmasi
                    </p>

                </div>

                <flux:button
                    x-on:click="$wire.openConfirmation(selectedSymptoms)"
                    variant="primary">

                    Lanjutkan

                </flux:button>

            </div>

        </div>

    </div>

    {{-- Modal --}}
    <flux:modal wire:model="showConfirmation">

        <div class="space-y-6">

            <div>

                <h2 class="text-xl font-semibold">
                    Konfirmasi Gejala
                </h2>

                <p class="mt-2 text-sm text-zinc-500">
                    Pastikan gejala yang dipilih sudah sesuai.
                </p>

            </div>

            <div class="space-y-3">

                @foreach($selectedSymptoms as $selected)

                    @php
                        $symptom = collect($symptoms)
                            ->firstWhere('code', $selected);
                    @endphp

                    <div
                        class="flex items-center gap-3 rounded-xl border border-zinc-200 p-3 dark:border-zinc-700">

                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700">

                            ✓

                        </div>

                        <div>

                            <p class="font-medium">
                                {{ $symptom['name'] }}
                            </p>

                            <p class="text-xs text-zinc-500">
                                {{ $symptom['code'] }}
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="flex justify-end gap-3">

                <flux:button
                    variant="ghost"
                    wire:click="$set('showConfirmation', false)">

                    Periksa Lagi

                </flux:button>

                <flux:button
                    variant="primary"
                    wire:click="diagnose">

                    Mulai Diagnosis

                </flux:button>

            </div>

        </div>

    </flux:modal>

</div>