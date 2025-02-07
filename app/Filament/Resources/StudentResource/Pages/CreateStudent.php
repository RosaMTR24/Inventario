<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected static ?string $title = 'Crear Estudiante'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }

    protected function mutateFormDataBeforeCreate(array $data): array

    
    {
        //Se crea el user que se relacionara con este estudiante
        $user = new User();
        $user->name = $data['name'];
        $user->career = $data['career'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        
        $user->assignRole('student');

        //se limpia la data
        unset($data['email']);
        unset($data['password']);
     //   unset($data['name']);
       // unset($data['career']);

        $data['user_id'] = $user->id;
        // dd($data);

        return $data;
    }
}