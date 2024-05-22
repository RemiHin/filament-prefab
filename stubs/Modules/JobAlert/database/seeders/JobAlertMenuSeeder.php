<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\MenuEnum;
use App\Models\Label;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

use function Database\Seeders\__;

class JobAlertMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /** @var Menu $menu */
        $menu = Label::getModel(MenuEnum::TOP);

        /** @var Page $jobAlertOverview */
        $jobAlertOverview = Label::getModel('job-alert-overview');

        $exists = $menu->query()
            ->whereHas('children', function (Builder $builder) use ($jobAlertOverview) {
                $builder->where('menuable_type', $jobAlertOverview->getMorphClass())
                    ->where('menuable_id', $jobAlertOverview->id);
            })
            ->exists();

        if (! $exists) {
            $menuItem = new MenuItem();

            $menuItem->title = __('Job Alert');
            $menuItem->url_type = 'internal';
            $menuItem->menu()->associate($menu);
            $menuItem->menuable()->associate($jobAlertOverview);
            $menuItem->order = $menu->children()->count();
            $menuItem->url = null;

            $menuItem->save();
        }
    }
}
