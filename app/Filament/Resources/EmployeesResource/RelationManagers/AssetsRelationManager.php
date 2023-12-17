<?php

namespace App\Filament\Resources\EmployeesResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Asset;
use Filament\Forms\Set;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AssetsRelationManager extends RelationManager
{
    protected static string $relationship = 'assets';

    protected static ?string $label = 'Voertuig(en)';

    protected static ?string $title = 'Voertuig(en)';

    protected static ?string $pluralLabel = 'werwe';

    public function form(Form $form): Form
    {   
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
            Tables\Columns\TextColumn::make('name'),
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
            //    Tables\Actions\EditAction::make(),
            //    Tables\Actions\DeleteAction::make(),

            // Simple action to detach asset from employee
               Tables\Actions\Action::make('Ontkoppelen')
               ->label('Ontkoppelen')
               ->icon("heroicon-o-x-mark")
               ->requiresConfirmation()
               ->action(function (Asset $record) {
                $record->employee_id = null;
                $record->status = Asset::STATUS_AVAILABLE;
                $record->save();
               }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
