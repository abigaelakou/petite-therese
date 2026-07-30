<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
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
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login() // ← AJOUTÉ — crée la route filament.admin.auth.login

            // ============================================================
            // BRANDING — Logo + Nom école
            // ============================================================
            ->brandName('La Petite Thérèse')
            ->brandLogo(asset('assets/img/logo/logoNew.jpg'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('assets/img/logo/favicon.png'))

            // ============================================================
            // COULEURS — Charte du logo
            // ============================================================
            ->colors([
                'primary'   => Color::hex('#1B2B6B'), // Bleu marine
                'secondary' => Color::hex('#2E9EC5'), // Bleu ciel
                'warning'   => Color::hex('#C9A84C'), // Or
                'success'   => Color::hex('#16a34a'),
                'danger'    => Color::hex('#dc2626'),
                'info'      => Color::hex('#2E9EC5'),
                'gray'      => Color::hex('#6b7280'),
            ])

            // ============================================================
            // STYLE GLOBAL
            // ============================================================
            ->font('Nunito')
            ->darkMode(false)

            // ============================================================
            // NAVIGATION
            // ============================================================
            ->navigationGroups([
                'Scolarité',
                'Finance',
                'Communication',
                'Ressources',
                'Site vitrine',
                'Administration',
            ])
            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()

            // ============================================================
            // PAGES & WIDGETS
            // ============================================================
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])

            // ============================================================
            // CSS CUSTOM — Charte graphique La Petite Thérèse
            // ============================================================
            ->renderHook(
                'panels::head.end',
                fn() => '<link rel="stylesheet" href="' . asset('assets/css/custom-admin.css') . '">'
            )

            // ============================================================
            // MIDDLEWARE
            // ============================================================
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
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}