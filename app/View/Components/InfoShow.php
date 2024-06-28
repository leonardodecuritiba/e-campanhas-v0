<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoShow extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $info;

    /**
     * Create the component instance.
     *
     * @param string|null $info
     * @return void
     */
    public function __construct(string $info = null)
    {
        $this->info = $info;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function render()
    {
        return view('components.info-show');
    }
}
