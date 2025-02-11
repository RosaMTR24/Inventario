<?php

namespace App\Filament\Resources\StoreResource\Pages;

use App\Filament\Resources\StoreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStore extends EditRecord
{
    protected static string $resource = StoreResource::class;
    protected static ?string $title = 'Editar componente'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Borrar') // Cambia el texto del botón
            ->modalHeading('Borrar componente') // Cambia el título del modal de confirmación
            ->modalSubheading('¿Estás seguro de borrar este componente?'),
        ];
    }
}
