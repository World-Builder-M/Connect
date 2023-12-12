<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Asset;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Employee;
use Filament\Forms\Form;
use App\Models\Department;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AssetResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\AssetResource\RelationManagers;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-window';

    protected static ?string $navigationLabel = 'Vervoersmiddelen';

    protected static ?string $modelLabel = 'Vervoer';

    protected static ?string $pluralLabel = 'Vervoersmiddelen';

    protected static ?string $slug = 'vervoersmiddelen';

    protected static ?string $navigationGroup = 'Personeelbeheer';

    protected static ?int $navigationSort = -1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('department_id')
                    ->label('Afdeling')
                    ->relationship(name: 'department', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    // ->live() makes sure it updates quickly
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('organisation_id', null))
                    ->required(),
                Forms\Components\Select::make('organisation_id')
                    ->label('Organisatie')
                    ->options(function (Get $get): Collection {
                        $selectedDepartment = Department::find($get('department_id'));
                        if ($selectedDepartment && $selectedDepartment->organisation) {
                            return collect([$selectedDepartment->organisation->id => $selectedDepartment->organisation->name]);
                        }
                        return collect([]);
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live(),
                // Forms\Components\Select::make('employee_id')
                //     ->label('Werknemer')
                //     ->options(function (Get $get): Collection {
                //         $selectedDepartment = Department::find($get('department_id'));

                //         if ($selectedDepartment && $selectedDepartment->organisation) {
                //             return $selectedDepartment->employees->pluck('first_name', 'id');
                //         }

                //         return collect([]);
                //     })
                //     ->preload()
                //     ->live(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('type')
                    ->label('Voertuig soort')
                    ->options(Asset::getTypeOptions()),
                Forms\Components\TextInput::make('serial_number')
                    ->label('Kenteken/Serienummer')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->required()
                    ->default(Asset::STATUS_AVAILABLE)
                    ->options(Asset::getStatusOptions()),
                Forms\Components\Textarea::make('description')
                    ->label('Overige informatie')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organisation.name')
                    ->label('Organisatie')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Afdeling')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('employee.first_name')
                    ->label('Werknemer')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Voertuig naam')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type voertuig')
                    ->formatStateUsing(function (string $state): string {
                        switch ($state) {
                            case Asset::TYPE_BIKE:
                                return 'Fiets';
                            case Asset::TYPE_CAR:
                                return 'Auto';
                            default:
                                return $state;
                        }
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->label('Serienummer/Kenteken')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                ->formatStateUsing(function (string $state): string {
                    switch ($state) {
                        case Asset::STATUS_AVAILABLE:
                            return 'Beschikbaar';
                        case Asset::STATUS_IN_USE:
                            return 'In Gebruik';
                        case Asset::STATUS_UNDER_MAINTENANCE:
                            return 'In onderhoud';
                        default:
                            return $state;
                    }
                })
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}
