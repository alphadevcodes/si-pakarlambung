<div class="relative w-full">
    <flux:navbar class="w-full">
        <a href="#" wire:navigate class="flex items-center gap-2 font-semibold text-zinc-900 dark:text-white">
            <flux:icon name="heart" class="size-7 text-emerald-600 dark:text-emerald-400" />
            <span class="text-lg tracking-tight">Gastro<span class="text-emerald-600 dark:text-emerald-400">Pakar</span></span>
        </a>

        <flux:spacer />

        <flux:navbar class="hidden gap-1 lg:flex">
            <flux:navbar.item href="#tentang">Tentang</flux:navbar.item>
            <flux:navbar.item href="#penyakit">Penyakit</flux:navbar.item>
            <flux:navbar.item href="#cara-kerja">Cara Kerja</flux:navbar.item>
            <flux:navbar.item href="#metode">Metode</flux:navbar.item>
            <flux:navbar.item href="#faq">FAQ</flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <div class="hidden items-center gap-2 lg:flex">
            <flux:button href="#" variant="ghost" size="sm">Masuk</flux:button>
            <flux:button href="#" variant="primary" size="sm" icon-trailing="arrow-right">
                Mulai Diagnosis
            </flux:button>
        </div>

        {{-- Tombol toggle menu mobile: murni wire:click, tanpa Alpine --}}
        <flux:button
            wire:click="toggleMobileMenu"
            variant="ghost"
            size="sm"
            square
            class="lg:hidden"
        >
            <flux:icon wire:show="!mobileMenuOpen" name="bars-3" class="size-5" />
            <flux:icon wire:show="mobileMenuOpen" wire:cloak name="x-mark" class="size-5" />
        </flux:button>
    </flux:navbar>

    {{-- Panel menu mobile, murni dikontrol wire:show --}}
    <div
        wire:show="mobileMenuOpen"
        wire:cloak
        class="absolute inset-x-0 top-full z-50 border-b border-zinc-200 bg-white px-6 py-4 shadow-lg lg:hidden dark:border-zinc-700 dark:bg-zinc-900"
    >
        <nav class="flex flex-col gap-1">
            <flux:navbar.item href="#tentang" wire:click="closeMobileMenu">Tentang</flux:navbar.item>
            <flux:navbar.item href="#penyakit" wire:click="closeMobileMenu">Penyakit</flux:navbar.item>
            <flux:navbar.item href="#cara-kerja" wire:click="closeMobileMenu">Cara Kerja</flux:navbar.item>
            <flux:navbar.item href="#metode" wire:click="closeMobileMenu">Metode</flux:navbar.item>
            <flux:navbar.item href="#faq" wire:click="closeMobileMenu">FAQ</flux:navbar.item>
        </nav>

        <flux:separator class="my-4" />

        <div class="flex flex-col gap-2">
            <flux:button href="#" variant="ghost" size="sm">Masuk</flux:button>
            <flux:button href="#" variant="primary" size="sm" icon-trailing="arrow-right">
                Mulai Diagnosis
            </flux:button>
        </div>
    </div>
</div>