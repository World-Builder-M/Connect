<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Country;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmployeeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmployeeResource\RelationManagers;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Werknemers';

    protected static ?string $modelLabel = 'Werknemer';

    protected static ?string $pluralLabel = 'Werknemers';

    protected static ?string $slug = 'werknemers';

    protected static ?string $navigationGroup = 'Personeelbeheer';

    protected static ?int $navigationSort = 0;


    public static function form(Form $form): Form
    {
        $countries = Country::all();

        
        return $form
            ->schema([
               Forms\Components\Section::make('Persoonsgegevens')
               ->schema([
                Forms\Components\TextInput::make('first_name')
                ->label('Voornaam')
                ->required()
                ->maxLength(255)
                ->columnSpan(2),
            Forms\Components\TextInput::make('last_name')
                ->label('Achternaam')
                ->required()
                ->maxLength(255)
                ->columnSpan(2),
                Forms\Components\TextInput::make('contact_email')
                    ->label('E-mail adres')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),
                Forms\Components\TextInput::make('zip_code')
                    ->label('Postcode')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),
                Forms\Components\TextInput::make('address')
                    ->label('Adres')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->label('Geboortedatum')
                    ->required(),
                Forms\Components\DatePicker::make('hired_at')
                    ->label('In dienst sinds')
                    ->required(),
                    Forms\Components\Select::make('country_id')
                    ->options($countries->pluck('name', 'id'))->searchable()
                    ->required()
                    ->columnSpan(2),
            ])->columns(4),
        ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hired_at')
                    ->date()
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
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        try {
            return Employee::count();
        } catch (QueryException $e) {
            return 0;
        }
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
