<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class FAQ extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'FAQ';

    protected static ?string $label = 'FAQ';

    protected static ?int $navigationSort =  12;

    protected static string $view = 'filament.pages.f-a-q';
}
