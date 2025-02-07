<?php

namespace App\Filament\Resources\LaboratoryResource\Pages;

use App\Filament\Resources\LaboratoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLaboratory extends CreateRecord
{
    protected static string $resource = LaboratoryResource::class;
    protected static ?string $title = 'Crear Laboratorio'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }
}
