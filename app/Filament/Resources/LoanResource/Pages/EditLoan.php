<?php

namespace App\Filament\Resources\LoanResource\Pages;

use App\Filament\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLoan extends EditRecord
{
    protected static string $resource = LoanResource::class;
    protected static ?string $title = 'Editar ticket'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Borrar') // Cambia el texto del botón
            ->modalHeading('Borrar ticket') // Cambia el título del modal de confirmación
            ->modalSubheading('¿Estás seguro de borrar este ticket?'),
        ];
    }
}
