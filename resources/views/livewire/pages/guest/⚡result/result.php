<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new
    #[Layout('layouts::guest')]
    class extends Component
    {
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
        public array $result = [
            'name' => 'Gastritis',
            'probability' => 87.35,
            'description' => 'Gastritis adalah peradangan pada lapisan lambung yang dapat menyebabkan nyeri ulu hati, mual, muntah, dan gangguan pencernaan.',
            'solution' => [
                'Makan secara teratur.',
                'Hindari makanan pedas dan asam.',
                'Kurangi konsumsi kopi dan minuman bersoda.',
                'Istirahat yang cukup.',
                'Segera konsultasikan ke dokter apabila gejala semakin parah.'
            ]
        ];

        public array $alternatives = [
            [
                'name' => 'GERD',
                'probability' => 65.20
            ],
            [
                'name' => 'Dispepsia',
                'probability' => 42.10
            ],
            [
                'name' => 'Gastiris',
                'probability' => 30.50
            ],
        ];

        public function render()
        {
            return view('livewire.pages.guest.⚡result.result');
        }
    };
