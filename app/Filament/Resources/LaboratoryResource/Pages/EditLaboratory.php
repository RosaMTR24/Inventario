<?php

namespace App\Filament\Resources\LaboratoryResource\Pages;

use App\Filament\Resources\LaboratoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaboratory extends EditRecord
{
    protected static string $resource = LaboratoryResource::class;
    protected static ?string $title = 'Editar laboratorio'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Borrar') // Cambia el texto del botón
            ->modalHeading('Borrar laboratorio') // Cambia el título del modal de confirmación
            ->modalSubheading('¿Estás seguro de borrar este laboratorio?'),
        ];
    }
}
