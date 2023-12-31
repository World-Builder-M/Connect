<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProvinceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProvinceResource\RelationManagers;
use App\Filament\Resources\ProvinceResource\RelationManagers\CitiesRelationManager;
use App\Filament\Resources\ProvinceResource\RelationManagers\EmployeesRelationManager;

class ProvinceResource extends Resource
{
    protected static ?string $model = Province::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Provincies';

    protected static ?string $modelLabel = 'Provincie';

    protected static ?string $pluralLabel = 'Provincies';

    protected static ?string $slug = 'werknemer-provincies';

    protected static ?string $navigationGroup = 'Locaties';

    protected static ?int $navigationSort = -2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Provincie')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\Select::make('country_id')
                //     ->relationship(name: 'country', titleAttribute: 'name')
                //     ->label('Land')
                //     ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country.name')
                    ->label('Land')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Provincie')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('country.name')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // CitiesRelationManager::class,
            // EmployeesRelationManager::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        try {
            return static::getModel()::count();
        } catch (QueryException $e) {
            return 0;
        }
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 0 ? 'primary' : 'gray';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProvinces::route('/'),
            'create' => Pages\CreateProvince::route('/create'),
            'edit' => Pages\EditProvince::route('/{record}/edit'),
        ];
    }
}
