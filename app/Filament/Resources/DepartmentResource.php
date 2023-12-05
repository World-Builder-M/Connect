<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Department;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';

    protected static ?string $navigationLabel = 'Afdelingen';
    
    protected static ?string $modelLabel = 'Afdeling';

    protected static ?string $pluralLabel = 'Afdelingen';

    protected static ?string $slug = 'afdelingen';

    protected static ?string $navigationGroup = 'Systeembeheer';

    protected static ?int $navigationSort = 0;
    

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
                Forms\Components\Toggle::make('active')
                    ->label('Actief')
                    ->hidden(),
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
                Tables\Columns\IconColumn::make('active')
                    ->label('Actief')
                    ->boolean()
                    ->searchable()
                    ->sortable(),
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        try {
            return Department::count();
        } catch (QueryException $e) {
            return 0;
        }
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
