<?php

namespace Database\Seeders;

use App\Enums\MenuEnum;
use App\Models\Label;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(MenuEnum::cases() as $menu) {
            $menuLabel = Label::getModel($menu->value);

            if(!$menuLabel) {
                $mainMenu = Menu::query()
                    ->create([
                        'title' => $menu->value,
                    ]);

                $mainMenu->label()->create([
                    'label' => $menu->value
                ]);
            }
        }

    }
}
