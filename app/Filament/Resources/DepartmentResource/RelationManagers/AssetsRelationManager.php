<?php

namespace App\Filament\Resources\DepartmentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Asset;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AssetsRelationManager extends RelationManager
{
    protected static string $relationship = 'assets';

    protected static ?string $title = 'Vervoersmiddelen';

    protected static ?string $icon = 'heroicon-o-window';

    public function form(Form $form): Form
    {
        $department = $this->getOwnerRecord();

        $departmentEmployees = Employee::where('department_id', $department->id)
            ->get()
            ->pluck('first_name', 'id')
            ->toArray();
            
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->label('Werknemer')
                    ->options($departmentEmployees)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Vervoersmiddelen')
            ->columns([
            // Tables\Columns\TextColumn::make('organisation.name')
            //     ->label('Organisatie')
            //     ->numeric()
            //     ->sortable(),
            // Tables\Columns\TextColumn::make('department.name')
            //     ->label('Afdeling')
            //     ->numeric()
            //     ->sortable(),
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
