<?php

declare(strict_types=1);

namespace App\Providers;

use Filament\Support\Enums\MaxWidth;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Support\ServiceProvider;

final class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureIcons();
        $this->configureTableActions();
    }

    private function configureIcons(): void
    {
        FilamentIcon::register([
            'panels::pages.dashboard.navigation-item' => 'untitledui-home-line',
            'actions::delete-action' => 'untitledui-trash-03',
            'actions::edit-action' => 'untitledui-edit-03',
        ]);
    }

    private function configureTableActions(): void
    {
        Tables\Actions\CreateAction::configureUsing(
            fn (Action $action): Action => $action->iconButton()
                ->modalWidth(MaxWidth::ExtraLarge)
                ->slideOver()
        );

        Tables\Actions\EditAction::configureUsing(
            fn (Action $action): Action => $action->iconButton()
                ->modalWidth(MaxWidth::ExtraLarge)
                ->slideOver()
        );

        Tables\Actions\DeleteAction::configureUsing(
            fn (Action $action): Action => $action->iconButton()
        );
    }
}
