<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use Filament\Forms\Get;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\CityResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Filament\Resources\CityResource\RelationManagers\EmployeesRelationManager;

class CityResource extends Resource
{
    
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Steden';

    protected static ?string $modelLabel = 'Stad';

    protected static ?string $pluralLabel = 'Steden';
    
    protected static ?string $slug = 'werknemer-steden';

    protected static ?string $navigationGroup = 'Locaties';

    protected static ?int $navigationSort = -1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('province_id')
                    ->label('Provincie')
                    ->relationship(name: 'province', titleAttribute: 'name')
                    ->searchable(),
                Forms\Components\TextInput::make('name')
                    ->label('Naam van de stad')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('province.name')
                    ->label('Provincie')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Stad')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
            EmployeesRelationManager::class,
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
            'index'  => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'view'   => Pages\ViewCity::route('/{record}'),
            'edit'   => Pages\EditCity::route('/{record}/edit'),
        ];
    }    
}
