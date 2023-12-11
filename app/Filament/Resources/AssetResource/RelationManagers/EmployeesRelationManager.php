<?php

namespace App\Filament\Resources\AssetResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Asset;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employee';

    protected static ?string $label = 'Koppel werknemer';

    protected static ?string $title = 'Koppel werknemer';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->options(function (RelationManager $livewire): array {
                        // $livewire->ownerRecord is an instance of App\Models\Asset
                        $asset = $livewire->ownerRecord;
    
                        // Check if the asset is found
                        if ($asset) {
                            // Access the associated department and retrieve employees
                            $employees = $asset->department->employees->pluck('first_name', 'id')->toArray();
                            return $employees;
                        }
    
                        return [];
                    }),
            ]);
    }
    


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('werknemers')
            ->columns([
                Tables\Columns\TextColumn::make('first_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
               Tables\Actions\CreateAction::make(),
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
