<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Filament\Plugins\BlockModule;
use Illuminate\View\Component;
use App\Filament\Plugins\BaseBlock;

class Block extends Component
{
    /**
     * The block to render.
     *
     * @var object
     */
    public $block;

    /**
     * The block type.
     *
     * @var string
     */
    public $type;

    /**
     * Create the component instance.
     *
     * @param  object  $block
     * @return void
     */
    public function __construct($block)
    {
        $this->type = str_replace('_', '-', $block['type']);

        $this->block = BlockModule::reconstructBlock($this->type, $block['data']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render(): \Illuminate\View\View|\Closure|string
    {
        if (view()->exists("components.blocks.{$this->type}")) {
            return view("components.blocks.{$this->type}");
        }

        return view('components.blocks.default');
    }
}
