<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem; 
use Jeffgreco13\FilamentBreezy\BreezyCore;
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
                 \App\Filament\Mentor\Pages\BulkAttendancePage::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                
            ])
            ->plugin(
                BreezyCore::make()
                ->myProfile(
                    shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                    userMenuLabel: 'My Profile', // Customizes the 'account' link label in the panel User Menu (default = null)
                    shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                    navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                    hasAvatars: true, // Enables the avatar upload form component (default = false)
                    slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                )
            )
            ->navigationItems([
            NavigationItem::make('Absensi Massal')
                ->label('Absensi Massal')
                ->icon('heroicon-o-clipboard-document-check')
                // ->url(fn () => BulkAttendancePage::getUrl()) // ✅ AMAN & DINAMIS
                ->group('📆 Absensi')
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
