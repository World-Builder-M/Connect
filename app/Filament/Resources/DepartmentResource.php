<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Department;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Filament\Resources\DepartmentResource\RelationManagers\EmployeesRelationManager;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';

    protected static ?string $navigationLabel = 'Afdelingen';

    protected static ?string $modelLabel = 'Afdeling';

    protected static ?string $pluralLabel = 'Afdelingen';

    protected static ?string $slug = 'afdelingen';

    protected static ?string $navigationGroup = 'Personeelbeheer';

    protected static ?string $recordTitleAttribute = 'name';
        
    protected static ?int $navigationSort = -3;


    public static function form(Form $form): Form
    {
        $today = now()->toDateString();

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Naam')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Beschrijving')
                    ->tooltip('Aanvullende basisinformatie over de afdeling')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Startdatum')
                    ->tooltip('De startdatum van uw afdeling')
                    ->required()
                    ->default($today),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Einddatum')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Naam')
                    ->searchable()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('employees_count')
                    ->counts('employees')
                    ->label('Werknemers')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('organisation.name')
                    ->label('Organisatie')
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Actief')
                    ->boolean()
                    ->getStateUsing(fn ($record): bool => now()->isAfter($record->start_date) && now()->isBefore($record->end_date))
                
            ])
            ->filters([
                //
            ])

            ->actions([
                Tables\Actions\ViewAction::make(),
                //  Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Afdeling')
                    ->schema([
                        TextEntry::make('name')->label('Naam'),
                        TextEntry::make('employees_count')
                        ->label('Werknemers in totaal')
                        ->state(function (Model $record): int {
                        return $record->employees()->count();
                        }),
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
            'index'  => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'view'   => Pages\ViewDepartment::route('/{record}'),
            'edit'   => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
