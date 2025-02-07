<?php

namespace App\Filament\Teachers\Resources\LoanResource\Pages;

use App\Filament\Teachers\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;
    protected static ?string $title = 'Tickets';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Solicitar material'),
        ];
    }
}