<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\State;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Employee;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Facades\Filament;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\EmployeeResource\Pages;
use App\Filament\App\Resources\EmployeeResource\RelationManagers;
use App\Filament\App\Resources\EmployeeResource\Widgets\PanelEmployeeOverviewMessage;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Werknemers';

    protected static ?string $modelLabel = 'Werknemer';

    protected static ?string $pluralLabel = 'Werknemers';

    protected static ?string $slug = 'werknemers';

    protected static ?string $navigationGroup = 'Organisatie beheer';

    protected static ?string $recordTitleAttribute = 'first_name';

    protected static ?int $navigationSort = -3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Vestigingslocatie & Afdeling')
                    ->schema([
                        Forms\Components\Select::make('country_id')
                            ->label('Land')
                            ->relationship(name: 'country', titleAttribute: 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('province_id', null);
                                $set('city_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('province_id')
                            ->label('Provincie')
                            ->options(fn (Get $get): Collection => Province::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('city_id', null))
                            ->required(),
                        Forms\Components\Select::make('city_id')
                            ->label('Stad')
                            ->options(fn (Get $get): Collection => City::query()
                                ->where('province_id', $get('province_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('department_id')
                            ->label('Afdeling')
                            ->relationship(
                                name: 'department', 
                                titleAttribute: 'name',
                                modifyQueryUsing: fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant())
                                )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])->columns(2),
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
                    ])->columns(4),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        $url = url()->current();
        
        $isAdmin = Str::startsWith($url, url('/admin'));
        
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Voornaam')
                    ->searchable()
                    ->sortable(),
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

                Tables\Columns\TextColumn::make('hired_at')
                    ->label('In dienst sinds')
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
            ->defaultSort('first_name')
            ->filters([
                SelectFilter::make('Department')
                    ->relationship('department', 'name')
                    ->label('Afdeling')
                    ->searchable(),
                // Filter::make('created_at')
                // ->form([
                //    DatePicker::make('date')
                //    ->label('In dienst sinds'), 
            ])
            // ->indicateUsing(function (array $data): ?string {
            //         if (! $data['date']) {
            //             return null;
            //         }

            //         return 'Aangenomen op ' . Carbon::parse($data['date'])->toFormattedDateString();
            //     }),
            // ])
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Vestigingslocatie & Afdeling')
                    ->schema([
                        TextEntry::make('country.name')
                            ->label('Land')
                            ->badge(),
                        TextEntry::make(
                            'province.name'
                        )->label('Provincie')
                        ->badge(),
                        TextEntry::make(
                            'city.name'
                        )->label('Stad')
                        ->badge(),
                        TextEntry::make('department.name')
                            ->label('Afdeling')
                            ->badge(),
                    ])->columns(2),
                Section::make('Naam')
                    ->schema([
                        TextEntry::make('first_name')
                        ->label('Voornaam')
                        ->badge(),
                        TextEntry::make(
                            'last_name'
                        )->label('Achternaam')
                        ->badge(),
                    ])->columns(2),
                Section::make('Adres')
                    ->schema([
                        TextEntry::make('address')
                            ->label('Adres')
                            ->badge(),
                        TextEntry::make(
                            'zip_code'
                        )->label('Postcode')
                        ->badge(),
                    ])->columns(2)
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // public static function getNavigationBadge(): ?string
    // {
    //       $e = '✓';
    //       return $e;
    // }

    public static function getWidgets(): array
    {
        return [
            PanelEmployeeOverviewMessage::class,
        ];
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
