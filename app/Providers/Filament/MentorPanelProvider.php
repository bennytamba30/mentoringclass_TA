<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Http\Middleware\EnsureUserIsMentor;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Navigation\NavigationItem; 

class MentorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('mentor')
            ->path('mentor')
            ->login()
            ->profile()
            ->brandLogo(new \Illuminate\Support\HtmlString(
                    '<div class="flex items-center gap-3">
                        <img src="' . asset('image/LOGO.png') . '" alt="Logo HMPS" class="h-10 w-10 rounded shadow-md">
                        <div class="text-left leading-tight">
                            <span class="block text-base font-semibold text-indigo-600">Mentoring Class</span>
                            <span class="block text-xs text-gray-500">Sistem Mentor</span>
                        </div>
                    </div>'
                ))
            ->favicon(asset('image/LOGO.png'))
            ->authGuard('web')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->default()
            ->discoverResources(
                in: app_path('Filament/Mentor/Resources'),
                for: 'App\\Filament\\Mentor\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Mentor/Pages'),
                for: 'App\\Filament\\Mentor\\Pages'
            )

            ->discoverWidgets(
                in: app_path('Filament/Mentor/Widgets'),
                for: 'App\\Filament\\Mentor\\Widgets'
            )

            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
             
            ])
            ->navigationItems([
            
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
            ->authMiddleware([
                'auth',
                EnsureUserIsMentor::class,
            ]);
    }
}
