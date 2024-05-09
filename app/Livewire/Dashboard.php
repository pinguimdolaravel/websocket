<?php

declare(strict_types = 1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.dashboard');
    }
}
