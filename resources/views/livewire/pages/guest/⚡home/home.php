<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new
    #[Layout('layouts::guest')]
    class extends Component
    {
    //
        /**
         * Status terbuka/tertutupnya menu navigasi mobile.
         * Dikontrol murni lewat Livewire (wire:click + wire:show),
         * tanpa Alpine, agar tetap konsisten dengan pendekatan PHP-first.
         */
        public bool $mobileMenuOpen = false;

        public function toggleMobileMenu(): void
        {
            $this->mobileMenuOpen = ! $this->mobileMenuOpen;
        }

        public function closeMobileMenu(): void
        {
            $this->mobileMenuOpen = false;
        }


        /**
         * Index FAQ yang sedang terbuka (null = semua tertutup).
         * Menggantikan <flux:accordion> (komponen Flux Pro) dengan
         * disclosure manual: wire:click memanggil method ini, lalu
         * partial FAQ merender ulang isinya dengan @if biasa (server
         * round-trip standar Livewire, bukan wire:show client-side).
         */
        public ?int $openFaqIndex = null;

        public function toggleFaq(int $index): void
        {
            $this->openFaqIndex = $this->openFaqIndex === $index ? null : $index;
        }
        public function render()
        {
            return view('livewire.pages.guest.⚡home.home');
        }
    };
