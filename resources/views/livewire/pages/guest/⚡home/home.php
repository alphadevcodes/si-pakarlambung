<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new
#[Layout('layouts::guest')] 
class extends Component
{
    //
    public function render()
    {
        return view('livewire.pages.guest.⚡home.home');
    }
};