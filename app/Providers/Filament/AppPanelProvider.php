<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use App\Models\Team;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Models\Organisation;
use App\Constants\ThemeColor;
use App\Livewire\MembershipPlan;
use App\Livewire\ActiveUserCount;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use App\Http\Middleware\ApplyTenantScopes;
use Filament\Http\Middleware\Authenticate;
use Filament\SpatieLaravelTranslatablePlugin;
use Illuminate\Session\Middleware\StartSession;
use App\Filament\App\Pages\Tenancy\RegisterTeam;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\App\Pages\Tenancy\EditTeamProfile;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\AvatarProviders\BoringAvatarsProvider;
use App\Filament\App\Pages\Tenancy\RegisterOrganisation;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Filament\App\Pages\Tenancy\EditOrganisationProfile;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Filament\Resources\AssetResource\Pages\ManageContracts;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('app')
            ->profile()
            ->registration()
            ->login()
            ->userMenuItems([
                MenuItem::make()
                ->label('Admin')
                ->icon('heroicon-o-cog-6-tooth')
                ->url('/admin')
                ->visible(fn (): bool => auth()->user()->is_admin)
            ])
            ->defaultAvatarProvider(BoringAvatarsProvider::class)
            ->tenant(Organisation::class, ownershipRelationship: 'organisation', slugAttribute: 'slug')
            ->tenantRegistration(RegisterOrganisation::class)
            
            ->tenantProfile(EditOrganisationProfile::class)
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
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            //    ManageContracts::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugin(
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en', 'nl']),
            )
            ->plugins([
               
            ])
            ->tenantMiddleware([
                ApplyTenantScopes::class,
            ], isPersistent: true);
            
    }
}
