<div>
    {{-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi --}}
    <flux:header container class="border-b border-zinc-200 bg-white/80 backdrop-blur dark:border-zinc-700 dark:bg-zinc-900/80">
        @include('livewire.pages.guest.⚡home.partials.navbar')
    </flux:header>

    <flux:main container class="!max-w-none !p-4">
        @include('livewire.pages.guest.⚡home.partials.hero')
        @include('livewire.pages.guest.⚡home.partials.trust-strip')
        @include('livewire.pages.guest.⚡home.partials.about')
        @include('livewire.pages.guest.⚡home.partials.diseases')
        @include('livewire.pages.guest.⚡home.partials.how-it-works')
        @include('livewire.pages.guest.⚡home.partials.method-highlight')
        @include('livewire.pages.guest.⚡home.partials.faq')
        @include('livewire.pages.guest.⚡home.partials.cta-final')
        @include('livewire.pages.guest.⚡home.partials.footer')
    </flux:main>
</div>