<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Constants\ThemeColor;
use App\Livewire\MembershipPlan;
use App\Livewire\ActiveUserCount;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use App\Http\Middleware\VerifyIsAdmin;
use Filament\Http\Middleware\Authenticate;
use Filament\SpatieLaravelTranslatablePlugin;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\AvatarProviders\BoringAvatarsProvider;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Filament\Resources\AssetResource\Pages\ManageContracts;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->profile()
            ->defaultAvatarProvider(BoringAvatarsProvider::class)
            ->id('admin')
            ->path('admin')
            ->userMenuItems([
                MenuItem::make()
                ->label('Dashboard')
                ->icon('heroicon-o-cog-6-tooth')
                ->url('/app')
            ])
            ->colors([
                'primary' => ThemeColor::CONNECT,
                'danger' => Color::Red,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'success' => ThemeColor::CONNECT,
                'warning' => Color::Orange,
            ])
            ->font('Poppins')
            ->brandName('Connect')
            ->brandLogo(asset('connect.png'))
            ->favicon(asset('connect.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                ManageContracts::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                MembershipPlan::class,
                ActiveUserCount::class,
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
                VerifyIsAdmin::class,
            ])
            ->plugin(
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en', 'nl']),
            )
            ->plugins([
               
            ]);
    }
}
