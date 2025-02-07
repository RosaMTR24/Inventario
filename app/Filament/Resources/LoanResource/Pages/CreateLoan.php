<?php

namespace App\Filament\Resources\LoanResource\Pages;

use App\Filament\Resources\LoanResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLoan extends CreateRecord
{
    protected static string $resource = LoanResource::class;
    protected static ?string $title = 'Crear ticket'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        // dd($data);
        $data['state_loan'] = 'on_loan';

        return $data;
    }

}
