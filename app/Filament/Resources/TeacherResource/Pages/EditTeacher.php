<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;
    protected static ?string $title = 'Editar profesor'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name'] = $this->record->user->name;
        $data['career'] = $this->record->user->career;
        $data['email'] = $this->record->user->email;
        // dd($data);


        return $data;
    }
}