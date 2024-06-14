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


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        User::created(['email'=>$data['email'],'password'=>$data['password']]);
        $user_id = User::where('email', $data['email'])->value('id');
        unset($data['email']);
        unset($data['password']);
        $data['user_id'] = auth()->id();
        $data['teacher_id'] = Auth::user()->teacher->id;
        $data['state_loan'] = 'on_loan';
        $data['user_id'] = $user_id;
    return $data;
    }
     

}

