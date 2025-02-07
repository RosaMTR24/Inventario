<?php

namespace App\Filament\Resources\LaboratoryResource\Pages;

use App\Filament\Resources\LaboratoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaboratories extends ListRecords
{
    protected static string $resource = LaboratoryResource::class;
    protected static ?string $title = 'Laboratorios';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Añadir laboratorios'),
        ];
    }
}
