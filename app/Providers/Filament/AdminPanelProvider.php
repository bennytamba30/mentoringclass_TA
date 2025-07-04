<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use App\Http\Middleware\EnsureUserIsAdmin;
use Filament\Support\Facades\FilamentView;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Filament\Admin\Resources\AdminResource\Pages\AttendanceReport;
use App\Filament\Admin\Resources\AdminResource\Pages\SubmissionReport;

class AdminPanelProvider extends PanelProvider
{

    
protected function pages(): array
{
    return [
        AttendanceReport::class,
        
    ];
}
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()
            ->brandName('Mentoring Class')
            ->brandLogo(new \Illuminate\Support\HtmlString(
                    '<div class="flex items-center gap-3">
                        <img src="' . asset('image/LOGO.png') . '" alt="Logo HMPS" class="h-10 w-10 rounded shadow-md">
                        <div class="text-left leading-tight">
                            <span class="block text-base font-semibold text-indigo-600">Mentoring Class</span>
                            <span class="block text-xs text-gray-500">Sistem Administrator</span>
                        </div>
                    </div>'
                ))
            ->favicon(asset('image/LOGO.png')) // Pastikan file favicon sudah ada di public/images
            ->authGuard('web') // atau 'admin' kalau kamu pakai guard berbeda
            ->colors([
                'primary' => Color::Amber,
                
            ])
            ->discoverResources(
                in: app_path('Filament/Admin/Resources'),
                for: 'App\\Filament\\Admin\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Admin/Pages'),
                for: 'App\\Filament\\Admin\\Pages'
            )
            ->discoverWidgets(
                in: app_path('Filament/Admin/Widgets'),
                for: 'App\\Filament\\Admin\\Widgets'
            )
            ->pages([
                Pages\Dashboard::class,
                \App\Filament\Admin\Pages\Dashboard::class,
        
                AttendanceReport::class
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
                \App\Http\Middleware\EnsureUserIsAdmin::class,
            ]);
    }
}
