<?php

namespace App\Filament\Teachers\Resources\LoanResource\Pages;

use App\Filament\Teachers\Resources\LoanResource;
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
        // User::created(['email' => $data['email'], 'password' => $data['password']]);
        // $user_id = User::where('email', $data['email'])->value('id');
        // unset($data['email']);
        // unset($data['password']);
        $user = Auth::user();
        // dd($user->teacher);
        
        $data['user_id'] = auth()->id();
        $data['teacher_id'] = $user->teacher->id;
        $data['state_loan'] = 'on_loan';
        // $data['user_id'] = $user_id;
        return $data;
    }
}