<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;
    protected static ?string $title = 'Crear Profesor'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = new User();
        $user->name = $data['name'];
        $user->career = $data['career'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        $user->assignRole('teacher');


        //se limpia la data
        unset($data['email']);
        unset($data['password']);
      //  unset($data['name']);
      //  unset($data['career']);

        $data['user_id'] = $user->id;

        return $data;
    }
}