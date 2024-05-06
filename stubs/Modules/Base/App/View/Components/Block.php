<?php

declare(strict_types=1);

namespace App\View\Components;

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

    public string $group;

    /**
     * Create the component instance.
     *
     * @param  object  $block
     * @return void
     */
    public function __construct($block, string $group = 'active')
    {
        $this->type = str_replace('_', '-', $block['type']);

        $this->group = $group;
        $this->block = $this->getBlock($this->type, $block['data']);
    }

    protected function getBlock(string $type, array $data): BaseBlock
    {
        $class = collect(config('blocks.' . $this->group, []))
            ->firstWhere(fn (string|BaseBlock $block) => $block::getType() === $type);

        return new $class($data);
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
