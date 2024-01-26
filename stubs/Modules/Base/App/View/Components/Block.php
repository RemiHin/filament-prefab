<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Block extends Component
{
    public $block;

    public string $type = '';

    public function __construct($block)
    {
        $this->block = $block;
        $this->type = $block['type'];
    }

    public function render(): View
    {
        if (view()->exists("components.blocks.{$this->type}")) {
            return view("components.blocks.{$this->type}");
        }

        return view('components.blocks.default');
    }
}
