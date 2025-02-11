<?php

namespace App\Filament\Student\Resources\LoanResource\Pages;

use App\Filament\Student\Resources\LoanResource;
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
        $data['user_id'] = Auth::user()->id;
        $data['state_loan'] = 'waiting';

        return $data;
    }
}