<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new
#[Layout('layouts::guest')]
class extends Component
{
    public bool $mobileMenuOpen = false;

    public bool $showConfirmation = false;

    public string $search = '';

    public array $selectedSymptoms = [];

    public array $symptoms = [
        ['code' => 'G01', 'name' => 'Nyeri pada ulu hati'],
        ['code' => 'G02', 'name' => 'Mual'],
        ['code' => 'G03', 'name' => 'Muntah'],
        ['code' => 'G04', 'name' => 'Perut kembung'],
        ['code' => 'G05', 'name' => 'Sering bersendawa'],
        ['code' => 'G06', 'name' => 'Nafsu makan menurun'],
        ['code' => 'G07', 'name' => 'Rasa panas pada dada'],
        ['code' => 'G08', 'name' => 'Cepat kenyang'],
        ['code' => 'G09', 'name' => 'BAB berwarna hitam'],
        ['code' => 'G10', 'name' => 'Penurunan berat badan'],
        ['code' => 'G11', 'name' => 'Perut terasa penuh'],
        ['code' => 'G12', 'name' => 'Gangguan pencernaan'],
    ];

    public function openConfirmation(array $selected): void
    {
        $this->selectedSymptoms = $selected;

        $this->validate([
            'selectedSymptoms' => ['required', 'array', 'min:1'],
        ]);

        $this->showConfirmation = true;
    }

    public function diagnose(): void
    {
        // TODO:
        // Jalankan Naive Bayes

        $this->redirectRoute('result');
    }

    public function getFilteredSymptomsProperty(): array
    {
        if (blank($this->search)) {
            return $this->symptoms;
        }

        return collect($this->symptoms)
            ->filter(fn ($symptom) =>
                str_contains(
                    mb_strtolower($symptom['name']),
                    mb_strtolower($this->search)
                )
            )
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.pages.guest.⚡diagnosis.diagnosis');
    }
};