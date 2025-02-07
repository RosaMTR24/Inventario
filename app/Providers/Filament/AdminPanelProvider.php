<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
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

class AdminPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            // ->defaultThemeMode(ThemeMode::Light)
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Usuarios')
                    ->icon('heroicon-o-user-group'),
                NavigationGroup::make()
                    ->label('Complementos')
                    ->icon('heroicon-o-book-open')
            ])

            ->breadcrumbs(false)
            ->darkMode(false)

            // ->topbar(false)
            // ->topNavigation()
            // ->sidebarCollapsibleOnDesktop()
            ->default()
            ->font('Open Sans', provider: GoogleFontProvider::class)
            // ->size(TextColumnSize::Large)
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()
            ->colors([
                'danger' => Color::Red,         // Red
                'gray' => Color::Blue,          // Blue
                'info' => Color::Cyan,          // Cyan
                'primary' => Color::Pink,       // Pink
                'success' => Color::Green,      // Green
                'warning' => Color::Orange,                     
                //'danger' => Color::Red,
               // 'gray' => Color::Amber,
                //'info' => Color::Blue,
                //'primary' => Color::Fuchsia,
                //'success' => Color::Stone,
                //'warning' => Color::Orange,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->brandName('Laboratorios FIE')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
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
            /*->viteTheme('resources/css/filament/admin/theme.css')*/
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}