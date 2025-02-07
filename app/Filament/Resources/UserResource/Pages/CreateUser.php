<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Crear administrador'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }

    protected function afterCreate(): void
    {
        $this->record->assignRole('admin');
    }
}