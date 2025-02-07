<?php

namespace App\Filament\Resources\StoreResource\Pages;

use App\Filament\Resources\StoreResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStore extends CreateRecord
{
    protected static string $resource = StoreResource::class;
    protected static ?string $title = 'Inventario'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }
}
