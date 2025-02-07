<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class TeachersPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->login()
            ->id('teachers')
            ->path('teachers')
            ->breadcrumbs(false)
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Emerald,
                'info' => Color::Indigo,
                'primary' => Color::Violet,
                'success' => Color::Stone,
                'warning' => Color::Orange,
            ])
            ->darkMode(false)
            ->discoverResources(in: app_path('Filament/Teachers/Resources'), for: 'App\\Filament\\Teachers\\Resources')
            ->discoverPages(in: app_path('Filament/Teachers/Pages'), for: 'App\\Filament\\Teachers\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Teachers/Widgets'), for: 'App\\Filament\\Teachers\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
           // ->viteTheme('resources/css/filament/admin/theme.css')
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}