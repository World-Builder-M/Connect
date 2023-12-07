<?php

namespace App\Filament\App\Pages\Tenancy;
 
use App\Models\Organisation;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Database\Eloquent\Model;
 
class RegisterOrganisation extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Registreer uw organisatie';
    }
    
    public function form(Form $form): Form
    {
          return $form
                ->schema([
                      TextInput::make('name'),
                      TextInput::make('slug'),
                ]);
    }
    
    protected function handleRegistration(array $data): Organisation
      {
            $organisation = Organisation::create($data);

            $organisation->members()->attach(auth()->user());

            return $organisation;
      }
}