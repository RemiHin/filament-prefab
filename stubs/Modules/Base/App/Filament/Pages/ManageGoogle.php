<?php

namespace RemiHin\FilamentPrefabStubs\Modules\Base\App\Filament\Pages;

use App\Settings\GoogleSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageGoogle extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GoogleSettings::class;

    protected static ?string $navigationGroup = 'settings';

    protected static ?int $navigationSort = 100;

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('Google Tag Manager');
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('gtm_id')
                    ->label(__('Google Tag Manager ID'))
                    ->required()
            ]);
    }
}
