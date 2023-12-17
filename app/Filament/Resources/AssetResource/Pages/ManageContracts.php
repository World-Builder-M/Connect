<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Models\Contract;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\AssetResource;

class ManageContracts extends Page
{
    protected static string $resource = AssetResource::class;

    protected static ?string $navigationGroup = 'Personeelbeheer';
    
    protected static ?string $model = Contract::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationLabel = 'Contracten';

    protected static ?string $modelLabel = 'Vervoer';

    protected static ?string $pluralLabel = 'Vervoersmiddelen';

    protected static ?string $slug = 'contractenn';

    protected static ?int $navigationSort = 1;
    
    protected static string $view = 'filament.resources.asset-resource.pages.manage-contracts';
}

   

