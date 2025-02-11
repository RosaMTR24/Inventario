<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Editar administrador'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Borrar') // Cambia el texto del botón
            ->modalHeading('Borrar administrador') // Cambia el título del modal de confirmación
            ->modalSubheading('¿Estás seguro de borrar a este administrador?') // Cambia el mensaje de confirmación,,
        ];
    }
}