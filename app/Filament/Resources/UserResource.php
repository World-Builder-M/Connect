<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\MembershipPlan;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Database\QueryException;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ViewUser;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Gebruikers';

    protected static ?string $modelLabel = 'Gebruiker';

    protected static ?string $pluralLabel = 'Gebruikers';

    protected static ?string $slug = 'Gebruikers';

    protected static ?string $navigationGroup = 'Gebruikerbeheer';

    protected static ?int $navigationSort = -2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Naam')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->hidden(fn ($livewire) => $livewire instanceof EditUser || $livewire instanceof ViewUser),
                Forms\Components\Select::make('roles')
                    ->label('Rollen')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->default([1])
                    ->hidden(),
                    //->hidden(fn ($livewire) => $livewire instanceof ViewUser)
            ]);
    }

    public static function table(Table $table): Table
    {
    
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Naam')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Actief')
                    ->sortable()
                    ->boolean()
                    ->getStateUsing(fn ($record): bool => $record->email_verified_at !== null),
                Tables\Columns\TextColumn::make('membershipPlan.name')
                    ->label('Pakket')
                    ->badge()
                    ->sortable()
                    ->color(fn (string $state): string => match ($state) {
                        MembershipPlan::BASIC    => 'gray',
                        MembershipPlan::STANDARD => 'warning',
                        MembershipPlan::PREMIUM  => 'success'
                    })
                    ->formatStateUsing(function (string $state): string {
                        switch ($state) {
                            case MembershipPlan::BASIC:
                                return 'Basis';
                            case MembershipPlan::STANDARD:
                                return 'Standaard';
                            case MembershipPlan::PREMIUM:
                                return 'Premium';
                            default:
                                return $state;
                        }
                    }),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Rollen')
                    ->badge()
                    ->sortable()
                    ->separator(', ')
                    ->formatStateUsing(function (string $state): string {
                        return implode(', ', array_map('ucfirst', explode(', ', $state)));
                    }),
                    // ->formatStateUsing(function (string $state): string {
                    //     $excludedRoleNames = ['Gebruiker'];
                
                    //     $roles = array_map('ucfirst', explode(', ', $state));
                
                    //     // Filter out excluded roles
                    //     $filteredRoles = array_filter($roles, function ($roleName) use ($excludedRoleNames) {
                    //         return !in_array($roleName, $excludedRoleNames);
                    //     });
                
                    //     return implode(', ', $filteredRoles);
                    // }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                SelectFilter::make('Pakket')
                    ->relationship('membershipPlan', 'name'),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->actions([
                 Impersonate::make()
                 ->label('Impersonate')
                 ->icon('heroicon-o-eye')
                 ->button()
                 ->redirectTo(route('filament.app.tenant')),
                Tables\Actions\ViewAction::make()->button(),
                Tables\Actions\EditAction::make()->button(),
               // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                  //  Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

     protected function getActions(): array
    {
        return [
            Impersonate::make()->record($this->getRecord()) 
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
