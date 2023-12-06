<?php

namespace App\Filament\Resources\CountryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    protected static ?string $title = 'Werknemers';

    protected static ?string $label = 'Werknemer';

    protected static ?string $icon = 'heroicon-o-user-group';

    public function form(Form $form): Form
    {
        return $form
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
                ->label('E-mail')
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
                ->native(false)
                ->displayFormat('d/m/Y')   
                ->label('Geboortedatum')
                ->required()
                ->columnSpan(1),
            Forms\Components\DatePicker::make('hired_at')
                ->label('In dienst sinds')
                ->native(false)
                ->displayFormat('d/m/Y')
                ->required()
                ->columnSpan(1),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('first_name')
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Voornaam'),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Achternaam')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->label('E-Mail')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->label('Postcode')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Adres')
                    ->limit(20)
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Werknemer aanmaken'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Bewerken'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
