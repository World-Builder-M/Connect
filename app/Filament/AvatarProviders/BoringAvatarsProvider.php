<?php
 
namespace App\Filament\AvatarProviders;
 
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Filament\AvatarProviders\Contracts\AvatarProvider;
 
class BoringAvatarsProvider implements AvatarProvider
{
    public function get(Model | Authenticatable $record): string
    {
        $name = str(Filament::getNameForDefaultAvatar($record))
            ->trim()
            ->explode(' ')
            ->map(fn (string $segment): string => filled($segment) ? mb_substr($segment, 0, 2) : '')
            ->join(' ');
 
        $avatar = $record->id . $name;

        $themeColor = '28c828';

        return 'https://source.boringavatars.com/beam/120/' . urlencode($avatar) . '?colors=' . $themeColor;
    }
}