<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WelcomeWidget extends Widget
{
    protected static ?int $sort = 1;
    protected string $view = 'filament.widgets.welcome-widget';
    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return true; // Visible pour tous les rôles
    }
}