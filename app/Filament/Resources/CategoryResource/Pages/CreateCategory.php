<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
    protected static ?string $title = 'Crear categoria'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }
}
