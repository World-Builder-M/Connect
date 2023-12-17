<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Resources\Pages\Page;

class ManageContracts extends Page
{
    protected static string $resource = AssetResource::class;

    protected static string $view = 'filament.resources.asset-resource.pages.manage-contracts';
}
