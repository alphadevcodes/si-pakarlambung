<div>

    {{-- Navbar --}}
    <flux:header
        container
        class="border-b border-zinc-200 bg-white/80 backdrop-blur dark:border-zinc-800 dark:bg-zinc-950/80">

        @include('livewire.pages.guest.⚡home.partials.navbar')

    </flux:header>

    {{-- Hero --}}
    <section
        class="border-b border-zinc-200 bg-gradient-to-b from-green-50 via-white to-white dark:border-zinc-800 dark:from-zinc-900 dark:via-zinc-950 dark:to-zinc-950">

        <div class="mx-auto max-w-6xl px-6 py-16">

            <div class="mx-auto max-w-3xl text-center">

                <div
                    class="mb-4 inline-flex rounded-full bg-green-100 px-4 py-1 text-sm font-medium text-green-700">

                    Diagnosis Selesai

                </div>

                <h1
                    class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-white">

                    Hasil Analisis Gejala

                </h1>

                <p
                    class="mt-4 text-zinc-600 dark:text-zinc-400">

                    Berikut adalah hasil analisis berdasarkan gejala
                    yang Anda pilih menggunakan metode Naive Bayes.

                </p>

            </div>

        </div>

    </section>

    {{-- Content --}}
    <section class="py-10">

        <div class="mx-auto max-w-6xl px-4">

            <div class="grid gap-8 lg:grid-cols-3">

                {{-- Main Result --}}
                <div class="lg:col-span-2">

                    <div
                        class="overflow-hidden rounded-3xl border border-green-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="border-b border-green-200 bg-green-50 p-6 dark:border-zinc-800 dark:bg-zinc-800">

                            <p
                                class="text-sm font-medium text-green-700">

                                Kemungkinan Tertinggi

                            </p>

                            <h2
                                class="mt-2 text-3xl font-bold">

                                {{ $result['name'] }}

                            </h2>

                        </div>

                        <div class="p-6">

                            <div class="mb-6">

                                <div
                                    class="mb-2 flex items-center justify-between">

                                    <span
                                        class="text-sm font-medium">

                                        Tingkat Keyakinan

                                    </span>

                                    <span
                                        class="font-semibold text-green-600">

                                        {{ number_format($result['probability'], 2) }}%

                                    </span>

                                </div>

                                <div
                                    class="h-3 overflow-hidden rounded-full bg-zinc-200">

                                    <div
                                        class="h-full rounded-full bg-green-500"
                                        style="width: {{ $result['probability'] }}%">
                                    </div>

                                </div>

                            </div>

                            <div>

                                <h3
                                    class="mb-3 text-lg font-semibold">

                                    Deskripsi

                                </h3>

                                <p
                                    class="leading-relaxed text-zinc-600 dark:text-zinc-400">

                                    {{ $result['description'] }}

                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Recommendation --}}
                    <div
                        class="mt-6 rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

                        <h3
                            class="mb-4 text-xl font-semibold">

                            Rekomendasi

                        </h3>

                        <div class="space-y-3">

                            @foreach($result['solution'] as $solution)

                                <div
                                    class="flex items-start gap-3">

                                    <div
                                        class="mt-1 flex h-6 w-6 items-center justify-center rounded-full bg-green-100 text-green-700">

                                        ✓

                                    </div>

                                    <p>{{ $solution }}</p>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                {{-- Sidebar --}}
                <div>

                    <div
                        class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

                        <h3
                            class="mb-5 text-lg font-semibold">

                            Kemungkinan Lain

                        </h3>

                        <div class="space-y-4">

                            @foreach($alternatives as $alternative)

                                <div>

                                    <div
                                        class="mb-2 flex justify-between">

                                        <span>
                                            {{ $alternative['name'] }}
                                        </span>

                                        <span
                                            class="font-medium">

                                            {{ number_format($alternative['probability'], 1) }}%

                                        </span>

                                    </div>

                                    <div
                                        class="h-2 overflow-hidden rounded-full bg-zinc-200">

                                        <div
                                            class="h-full rounded-full bg-sky-500"
                                            style="width: {{ $alternative['probability'] }}%">
                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                    {{-- Disclaimer --}}
                    <div
                        class="mt-6 rounded-3xl border border-amber-200 bg-amber-50 p-5 dark:border-amber-900 dark:bg-amber-950/30">

                        <h4
                            class="font-semibold text-amber-700 dark:text-amber-400">

                            Informasi Penting

                        </h4>

                        <p
                            class="mt-2 text-sm text-amber-700 dark:text-amber-300">

                            Hasil ini merupakan estimasi berdasarkan
                            metode Naive Bayes dan tidak menggantikan
                            diagnosis medis profesional.

                        </p>

                    </div>

                    <div class="mt-6">

                        <flux:button
                            href="{{ route('diagnosis') }}"
                            variant="primary"
                            class="w-full">

                            Diagnosis Ulang

                        </flux:button>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>